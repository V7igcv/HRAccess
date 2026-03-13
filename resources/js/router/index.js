import { createRouter, createWebHistory } from 'vue-router';
import Login from '../pages/auth/Login.vue';

// Layouts
import SuperAdminLayout from '../layouts/SuperAdminLayout.vue';
import OfficeAdminLayout from '../layouts/OfficeAdminLayout.vue';

// Superadmin Pages
import OfficeManagement from '../pages/superadmin/OfficeManagement.vue';
import OfficeServices from '../pages/superadmin/OfficeServices.vue';
import UserManagement from '../pages/superadmin/UserManagement.vue';

// Office Admin Pages
import Dashboard from '../pages/officeadmin/Dashboard.vue';
import CSMDataEntry from '../pages/officeadmin/CSMDataEntry.vue';


const routes = [
    {
        path: '/',
        redirect: '/login'
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta: { guest: true }
    },
    // Superadmin Routes
    {
        path: '/superadmin',
        component: SuperAdminLayout,
        meta: { requiresAuth: true, role: 'SUPERADMIN' },
        children: [
            {
                path: '',
                name: 'SuperAdminDashboard',
                component: OfficeManagement // Landing page for superadmin
            },
            {
                path: 'users',
                name: 'SuperAdminUsers',
                component: UserManagement
            },
            {
                path: 'offices/:id/services',
                name: 'OfficeServices',
                component: OfficeServices
            }
        ]
    },
    // Office Admin Routes
    {
        path: '/officeadmin',
        component: OfficeAdminLayout,
        meta: { requiresAuth: true, role: 'OFFICE ADMIN' },
        children: [
            {
                path: '',
                name: 'OfficeAdminDashboard',
                component: Dashboard // Landing page for office admin
            },
            {
                path: 'csm',
                name: 'OfficeAdminCSM',
                component: CSMDataEntry
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Navigation Guards
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('auth_token');
    const userStr = localStorage.getItem('user');
    let user = null;
    
    if (userStr) {
        try {
            user = JSON.parse(userStr);
        } catch (e) {
            console.error('Invalid user data in local storage', e);
        }
    }

    if (to.matched.some(record => record.meta.requiresAuth)) {
        // Route requires authentication
        if (!token || !user) {
            // Not logged in, redirect to login page
            next({ name: 'Login' });
        } else {
            // Check if route requires specific role
            const requiredRole = to.matched.find(record => record.meta.role)?.meta.role;
            if (requiredRole && user.role !== requiredRole) {
                // Wrong role, redirect to appropriate landing page
                if (user.role === 'SUPERADMIN') {
                    next({ name: 'SuperAdminDashboard' });
                } else if (user.role === 'OFFICE ADMIN') {
                    next({ name: 'OfficeAdminDashboard' });
                } else {
                    next({ name: 'Login' });
                }
            } else {
                next(); // Allow entry
            }
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        // Route is for guests only (e.g., login)
        if (token && user) {
            // Already logged in, redirect to their dashboard
            if (user.role === 'SUPERADMIN') {
                next({ name: 'SuperAdminDashboard' });
            } else if (user.role === 'OFFICE ADMIN') {
                next({ name: 'OfficeAdminDashboard' });
            } else {
                next();
            }
        } else {
            next(); // Allow entry
        }
    } else {
        next(); // Make sure to always call next()!
    }
});

export default router;
