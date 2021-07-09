export default [


    {
        path: '/laboratuvar-sonuclar',
        name: 'flaboratuvar',
        component: () => import('@/views/lab/laboratuvar/liste.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Laboratuvar',
            breadcrumb: [{
                text: 'Laboratuvar',
                to: "/laboratuvar-sonuclar",


            }, ]
        }
    },

    {
        path: '/laboratuvar-sonuclar/:id',
        name: 'flaboratuvar-firma',
        component: () => import('@/views/lab/laboratuvar/sonuclar/client.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Laboratuvar',
            breadcrumb: [{
                text: 'Laboratuvar',
                to: "/laboratuvar-sonuclar",


            }, ]
        }
    },
    {
        path: '/laboratuvar-sonuclar/bireysel/:id',
        name: 'flaboratuvar-bireysel',
        component: () => import('@/views/lab/laboratuvar/sonuclar/individual.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Laboratuvar',
            breadcrumb: [{
                text: 'Laboratuvar',
                to: "/laboratuvar-sonuclar",


            }, ]
        }
    },




    {
        path: '/periyodik-sonuclar',
        name: 'fperiyodik',
        component: () => import('@/views/lab/periyodik/liste.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Periyodik',
            breadcrumb: [{
                text: 'Periyodik',
                to: "/periyodik-sonuclar",


            }, ]
        }
    },


    {
        path: '/periyodik-sonuclar/:id',
        name: 'fperiyodik-firma',
        component: () => import('@/views/lab/periyodik/sonuclar/client.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Periyodik',
            breadcrumb: [{
                text: 'Periyodik',
                to: "/periyodik-sonuclar",


            }, ]
        }
    },

    {
        path: '/periyodik-sonuclar/bireysel/:id',
        name: 'fperiyodik-bireysel',
        component: () => import('@/views/lab/periyodik/sonuclar/individual.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Periyodik',
            breadcrumb: [{
                text: 'Periyodik',
                to: "/periyodik-sonuclar",


            }, ]
        }
    },


    {
        path: '/olcumler-sonuclar',
        name: 'fölcümler',
        component: () => import('@/views/lab/olcum/liste.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Ölçümler',
            breadcrumb: [{
                text: 'Ölçümler',
                to: "/olcumler-sonucla",


            }, ]
        }
    },
    {
        path: '/olcumler-sonuclar/:id',
        name: 'fölcümler-firma',
        component: () => import('@/views/lab/olcum/sonuclar/client.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Ölçümler',
            breadcrumb: [{
                text: 'Ölçümler',
                to: "/olcumler-sonucla",


            }, ]
        }
    },
    {
        path: '/olcumler-sonuclar/bireysel/:id',
        name: 'fölcümler-bireysel',
        component: () => import('@/views/lab/olcum/sonuclar/individual.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Ölçümler',
            breadcrumb: [{
                text: 'Ölçümler',
                to: "/olcumler-sonucla",


            }, ]
        }
    },







    {
        path: '/ilkyardim-sonuclar',
        name: 'filkyardim',
        component: () => import('@/views/lab/ilkyardim/liste.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'İlk Yardım',
            breadcrumb: [{
                text: 'İlk Yardım',
                to: "/ilkyardim-sonuclar",


            }, ]
        }
    },
    {
        path: '/ilkyardim-sonuclar/:id',
        name: 'filkyardim-firma',
        component: () => import('@/views/lab/ilkyardim/sonuclar/client.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'İlk Yardım',
            breadcrumb: [{
                text: 'İlk Yardım',
                to: "/ilkyardim-sonuclar",


            }, ]
        }
    },
    {
        path: '/ilkyardim-sonuclar/bireysel/:id',
        name: 'filkyardim-bireysel',
        component: () => import('@/views/lab/ilkyardim/sonuclar/individual.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'İlk Yardım',
            breadcrumb: [{
                text: 'İlk Yardım',
                to: "/ilkyardim-sonuclar",


            }, ]
        }
    },





    {
        path: '/asansor-sonuclar',
        name: 'fasansor',
        component: () => import('@/views/lab/asansor/liste.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Asansör',
            breadcrumb: [{
                text: 'Asansör',
                to: "/asansor-sonuclar",


            }, ]
        }
    },
    {
        path: '/asansor-sonuclar/:id',
        name: 'fasansor-firma',
        component: () => import('@/views/lab/asansor/sonuclar/client.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Asansör',
            breadcrumb: [{
                text: 'Asansör',
                to: "/asansor-sonuclar",


            }, ]
        }
    },

    {
        path: '/asansor-sonuclar/bireysel/:id',
        name: 'fasansor-bireysel',
        component: () => import('@/views/lab/asansor/sonuclar/individual.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Asansör',
            breadcrumb: [{
                text: 'Asansör',
                to: "/asansor-sonuclar",


            }, ]
        }
    },








]
