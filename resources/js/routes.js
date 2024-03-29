export const routes = [
    {
        path: "/unauthorized",
        name: 'unauthorized',
        component: () => import('./components/Unauthorized.vue')
    },
    {
        path: "/pengantar-skck",
        name: 'pengantar-skck',
        component: () => import('./components/admin/SKCK.vue')
    },
    {
        path: "/pengantar-umum",
        name: 'pengantar-umum',
        component: () => import('./components/admin/Umum.vue')
    },
    {
        path: "/",
        name: 'profile',
        component: () => import('./components/CompanyProfile.vue')
    },
    {
        path: "/login",
        name: 'login',
        component: () => import('./components/Login.vue')
    },
    {
        path: "/register",
        name: 'register',
        component: () => import('./components/Register.vue')
    },
    {
        path: "/lupa-password",
        name: 'lupa-password',
        component: () => import('./components/LupaPassword.vue')
    },

    // admin
    {
        path: '/admin-dashboard',
        name: 'admin-dashboard',
        component: () => import('./components/admin/Dashboard.vue')
    },
    {
        path: '/admin-invoice',
        name: 'admin-invoice',
        component: () => import('./components/admin/ListInvoice.vue')
    },
    {
        path: '/admin-list-user',
        name: 'admin-list-user',
        component: () => import('./components/admin/ListUser.vue')
    },
    {
        path: '/admin-tambah-user',
        name: 'admin-tambah-user',
        component: () => import('./components/admin/TambahUser.vue')
    },
    {
        path: '/admin-edit-user',
        name: 'admin-edit-user',
        component: () => import('./components/admin/EditUser.vue')
    },


    // user
    {
        path: '/user-dashboard',
        name: 'user-dashboard',
        component: () => import('./components/user/Dashboard.vue')
    },
    {
        path: '/invoice-page',
        name: 'invoice-page',
        component: () => import('./components/user/InvoicePage.vue')
    },
    {
        path: '/layanan-page',
        name: 'layanan-page',
        component: () => import('./components/user/LayananPage.vue')
    },
    {
        path: '/user-skck',
        name: 'user-skck',
        component: () => import('./components/user/PengajuanSKCK.vue')
    },
    {
        path: '/user-pengantar',
        name: 'user-pengantar',
        component: () => import('./components/user/PengajuanPengantar.vue')
    },
]