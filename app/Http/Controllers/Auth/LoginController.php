<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::with('role', 'office')->where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password_hash)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Check if user is deleted (soft delete)
        if ($user->trashed()) {
            throw ValidationException::withMessages([
                'username' => ['This account has been deactivated.'],
            ]);
        }

        // Update last login timestamp
        $user->updateLastLogin();

        // Create token for API authentication
        $token = $user->createToken('auth-token', [$user->role->name])->plainTextToken;

        // Determine redirect path based on role
        $redirectTo = $this->redirectBasedOnRole($user);

        return response()->json([
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->role->name,
                'office' => $user->office ? [
                    'id' => $user->office->id,
                    'name' => $user->office->office_name,
                    'logo' => $user->office->logo,
                ] : null,
                'last_login' => $user->last_login_at,
            ],
            'token' => $token,
            'redirect_to' => $redirectTo,
        ], 200);
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout(Request $request)
    {
        // Revoke the current user's token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }

    /**
     * Get the authenticated user.
     */
    public function me(Request $request)
    {
        $user = $request->user()->load('role', 'office');
        
        return response()->json([
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->role->name,
                'office' => $user->office ? [
                    'id' => $user->office->id,
                    'name' => $user->office->office_name,
                    'logo' => $user->office->logo,
                ] : null,
                'last_login' => $user->last_login_at,
            ]
        ]);
    }

    /**
     * Determine redirect path based on user role.
     */
    private function redirectBasedOnRole($user)
    {
        switch ($user->role->name) {
            case 'SUPERADMIN':
                return '/superadmin/dashboard';
            case 'OFFICE ADMIN':
                return '/office/dashboard';
            default:
                return '/dashboard';
        }
    }
}