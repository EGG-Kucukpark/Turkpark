export default [{

        path: '/calisanlar/:id',
        name: 'calisan-goster',
        component: () => import('@/views/clients/corporate/getworker/worker.vue'),
        meta: {
            requiresAuth: true,

            pageTitle: 'Bilgiler',
            breadcrumb: [{
                text: 'Firmalar',
                to: '/clients'


            }, ]

        }
    },
    {
        path: '/raporlar',
        name: 'raporlar',
        component: () => import('@/views/lab/raporlar/raporlar.vue'),
        meta: {
            requiresAuth: true,
            admin: true

        }
    },

    {
        path: '/calisanlar',
        name: 'calisanlar',
        component: () => import('@/views/workers/workers.vue'),
        meta: {
            requiresAuth: true
        }





    },

    {
        path: '/Laboratuvar',
        name: 'laboratuvar',
        component: () => import('@/views/workers/laboratuvar.vue'),
        meta: {
            requiresAuth: true
        }





    },
    {
        path: '/Asansor',
        name: 'asansor',
        component: () => import('@/views/workers/asansor.vue'),
        meta: {
            requiresAuth: true
        }





    },
    {
        path: '/Eğitimler',
        name: 'egitimler',
        component: () => import('@/views/workers/egitimler.vue'),
        meta: {
            requiresAuth: true
        }





    },
    {
        path: '/Ilkyardim',
        name: 'ilkyardim',
        component: () => import('@/views/workers/ilkyardim.vue'),
        meta: {
            requiresAuth: true
        }





    }, {
        path: '/Periyodik-Ölcümler',
        name: 'periyodik',
        component: () => import('@/views/workers/periyodik.vue'),
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
        path: '/Ortam-Ölcümler',
        name: 'ortam',
        component: () => import('@/views/workers/ortam.vue'),
        meta: {
            requiresAuth: true
        }





    },











]
