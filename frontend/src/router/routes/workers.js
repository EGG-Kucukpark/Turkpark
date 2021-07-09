
export default [



    {


        path: '/calisanlar/:id',
        name: 'calisan-goster',
        component: () => import('@/views/clients/corporate/getworker/worker.vue'),


        meta: {
            requiresAuth: true,



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
        path: '/Egitimler',
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
        path: '/Periyodik-Olcumler',
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
        path: '/Ortam-Olcumler',
        name: 'ortam',
        component: () => import('@/views/workers/ortam.vue'),
        meta: {
            requiresAuth: true
        }





    },











]
