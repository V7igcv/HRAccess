<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Office;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Clear table first
        DB::statement('SET CONSTRAINTS ALL DEFERRED;');
        User::truncate();
        DB::statement('SET CONSTRAINTS ALL IMMEDIATE;');

        // Get role IDs
        $superadminRole = Role::where('name', 'SUPERADMIN')->first();
        $officeAdminRole = Role::where('name', 'OFFICE ADMIN')->first();

        // Get all offices
        $offices = Office::all();

        // Create SUPERADMIN account
        User::create([
            'username' => 'superadmin',
            'password_hash' => Hash::make('superadmin'),
            'office_id' => null, // Superadmin has no office
            'role_id' => $superadminRole->id,
            'last_login_at' => null,
        ]);

        // Create OFFICE ADMIN accounts mapped to their offices
        $adminAccounts = [
            ['username' => 'cmo_admin', 'office_name' => 'Office of the City Mayor (CMO)'],
            ['username' => 'cmo_ls_admin', 'office_name' => 'Office of the City Mayor-Library Services (CMO-LS)'],
            ['username' => 'cmo_lcc_admin', 'office_name' => 'Office of the City Mayor-Ligao Community College (CMO-LCC)'],
            ['username' => 'cgso_admin', 'office_name' => 'City General Services Office (CGSO)'],
            ['username' => 'clcr_admin', 'office_name' => 'Office of the City Local Civil Registrar (CLCR)'],
            ['username' => 'cto_admin', 'office_name' => 'City Treasurer\'s Office (CTO)'],
            ['username' => 'cto_oee_admin', 'office_name' => 'Office of the City Treasurer\'s Office-Operation Economic Enterprise (CTO-OEE)'],
            ['username' => 'cao_admin', 'office_name' => 'City Assessor\'s Office (CAO)'],
            ['username' => 'bplo_admin', 'office_name' => 'Business Processing Licensing Office (BPLO)'],
            ['username' => 'cenro_admin', 'office_name' => 'City Environment and Natural Resources Office (CENRO)'],
            ['username' => 'ceo_admin', 'office_name' => 'City Engineering\'s Office (CEO)'],
            ['username' => 'ccdo_admin', 'office_name' => 'City Cooperative and Development Office (CCDO)'],
            ['username' => 'clo_admin', 'office_name' => 'City Legal Office (CLO)'],
            ['username' => 'ao_admin', 'office_name' => 'Admin Office (AO)'],
            ['username' => 'cho_admin', 'office_name' => 'City Health Office (CHO)'],
            ['username' => 'oca_admin', 'office_name' => 'Office of the City Agriculturist (OCA)'],
            ['username' => 'ocv_admin', 'office_name' => 'Office of the City Veterinarian (OCV)'],
            ['username' => 'cswdo_admin', 'office_name' => 'Office of the City Social Welfare and Development Officer (CSWDO)'],
            ['username' => 'peso_admin', 'office_name' => 'Public Employment Service Office (PESO)'],
            ['username' => 'cpc_admin', 'office_name' => 'Office of the City Planning Coordinator (CPC)'],
            ['username' => 'cdrrmo_admin', 'office_name' => 'Office of the City Disaster Risk Reduction Management Officer (CDRRMO)'],
            ['username' => 'chrmo_admin', 'office_name' => 'Office of the City Human Resource Management Officer (CHRMO)'],
            ['username' => 'caco_admin', 'office_name' => 'City Accounting Office (CAO)'],
            ['username' => 'cbo_admin', 'office_name' => 'City Budget Office (CBO)'],
        ];

        foreach ($adminAccounts as $account) {
            $office = $offices->firstWhere('office_name', $account['office_name']);
            
            if ($office) {
                User::create([
                    'username' => $account['username'],
                    'password_hash' => Hash::make('12345678'),
                    'office_id' => $office->id,
                    'role_id' => $officeAdminRole->id,
                    'last_login_at' => null,
                ]);
            }
        }

        $this->command->info('Users seeded successfully!');
        $this->command->info('Total users created: ' . User::count());
    }
}