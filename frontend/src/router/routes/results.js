export default [


    {
        path: '/laboratuvar-sonuclar',
        name: 'flaboratuvar',
        component: () => import('@/views/lab/lab.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Laboratuvar',
            breadcrumb: [{
                text: 'Laboratuvar',
                active: true,


            }, ]
        }
    }, {
        path: '/periyodik-sonuclar',
        name: 'fperiyodik',
        component: () => import('@/views/lab/periyodik/periyodik.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Periyodik',
            breadcrumb: [{
                text: 'Periyodik',
                active: true,


            }, ]
        }
    },
    {
        path: '/olcumler-sonuclar',
        name: 'fölcümler',
        component: () => import('@/views/lab/measure/olcum.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Ölçümler',
            breadcrumb: [{
                text: 'Ölçümler',
                active: true,


            }, ]
        }
    },
    {
        path: '/ilkyardim-sonuclar',
        name: 'filkyardim',
        component: () => import('@/views/lab/ilkyardim/ilkyardim.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'İlk Yardım',
            breadcrumb: [{
                text: 'İlk Yardım',
                active: true,


            }, ]
        }
    },
    {
        path: '/asansor-sonuclar',
        name: 'fasansor',
        component: () => import('@/views/lab/asansor/asansor.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Asansör',
            breadcrumb: [{
                text: 'Asansör',
                active: true,


            }, ]
        }
    },







]
