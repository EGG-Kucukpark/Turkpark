export default [

    {


        path: '/profil',
        name: 'profil',
        component: () => import('@/views/settings/user/Account.vue'),
        meta: {
            requiresAuth: true,


        }
    },
    {
        path: '/raporlar',
        name: 'rapor-turu',
        component: () => import('@/views/settings/raporlar/raporlar.vue'),
        meta: {
            requiresAuth: true,
            admin: true

        }
    },

    {
        path: '/dosya-turu',
        name: 'dosya-turu',
        component: () => import('@/views/settings/dosyalar/raporlar.vue'),
        meta: {
            requiresAuth: true,
            admin: true

        }
    },
    {
        path: '/egitim-turu',
        name: 'egitim-turu',
        component: () => import('@/views/settings/egitimler/raporlar.vue'),
        meta: {
            requiresAuth: true,
            admin: true

        }
    },




]
