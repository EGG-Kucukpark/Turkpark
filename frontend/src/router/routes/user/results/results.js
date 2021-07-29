export default [

    {
        path: '/calisanlar',
        name: 'calisanlar',
        component: () => import('@/views/User/results/workers.vue'),
        meta: {
            requiresAuth: true
        }





    },

    {
        path: '/Laboratuvar',
        name: 'laboratuvar',
        component: () => import('@/views/User/results/laboratuvar.vue'),
        meta: {
            requiresAuth: true
        }





    },
    {
        path: '/Asansor',
        name: 'asansor',
        component: () => import('@/views/User/results/asansor.vue'),
        meta: {
            requiresAuth: true
        }





    },
    {
        path: '/Egitimler',
        name: 'egitimler',
        component: () => import('@/views/User/results/egitimler.vue'),



        meta: {
            requiresAuth: true
        }





    },
    {
        path: '/Ilkyardim',
        name: 'ilkyardim',
        component: () => import('@/views/User/results/ilkyardim.vue'),
        meta: {
            requiresAuth: true
        }





    }, {
        path: '/Periyodik-Olcumler',
        name: 'periyodik',
        component: () => import('@/views/User/results/periyodik.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Periyodik Ölçümler',
            breadcrumb: [{
                text: 'Ana Sayfa',
                active: true,
            }, ],
        }





    },
    {
        path: '/Ortam-Olcumler',
        name: 'ortam',
        component: () => import('@/views/User/results/ortam.vue'),
        meta: {
            requiresAuth: true
        }





    },
]
