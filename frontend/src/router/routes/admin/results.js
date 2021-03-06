export default [


    {
        path: '/laboratuvar-sonuclar',
        name: 'flaboratuvar',
        component: () => import('@/views/Admin/lab/laboratuvar/liste.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
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
        component: () => import('@/views/Admin/lab/laboratuvar/sonuclar/client.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
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
        component: () => import('@/views/Admin/lab/laboratuvar/sonuclar/individual.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
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
        component: () => import('@/views/Admin/lab/periyodik/liste.vue'),
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
        component: () => import('@/views/Admin/lab/periyodik/sonuclar/client.vue'),
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
        component: () => import('@/views/Admin/lab/periyodik/sonuclar/individual.vue'),
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
        name: 'f??lc??mler',
        component: () => import('@/views/Admin/lab/olcum/liste.vue'),
        meta: {
            requiresAuth: true,
            admin: true,

            pageTitle: '??l????mler',
            breadcrumb: [{
                text: '??l????mler',
                to: "/olcumler-sonucla",


            }, ]
        }
    },
    {
        path: '/olcumler-sonuclar/:id',
        name: 'f??lc??mler-firma',
        component: () => import('@/views/Admin/lab/olcum/sonuclar/client.vue'),
        meta: {
            requiresAuth: true,
            admin: true,

            pageTitle: '??l????mler',
            breadcrumb: [{
                text: '??l????mler',
                to: "/olcumler-sonucla",


            }, ]
        }
    },
    {
        path: '/olcumler-sonuclar/bireysel/:id',
        name: 'f??lc??mler-bireysel',
        component: () => import('@/views/Admin/lab/olcum/sonuclar/individual.vue'),
        meta: {
            requiresAuth: true,
            admin: true,

            pageTitle: '??l????mler',
            breadcrumb: [{
                text: '??l????mler',
                to: "/olcumler-sonucla",


            }, ]
        }
    },







    {
        path: '/ilkyardim-sonuclar',
        name: 'filkyardim',
        component: () => import('@/views/Admin/lab/ilkyardim/liste.vue'),
        meta: {
            requiresAuth: true,
            admin: true,

            pageTitle: '??lk Yard??m',
            breadcrumb: [{
                text: '??lk Yard??m',
                to: "/ilkyardim-sonuclar",


            }, ]
        }
    },
    {
        path: '/ilkyardim-sonuclar/:id',
        name: 'filkyardim-firma',
        component: () => import('@/views/Admin/lab/ilkyardim/sonuclar/client.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            admin: true,
            pageTitle: '??lk Yard??m',
            breadcrumb: [{
                text: '??lk Yard??m',
                to: "/ilkyardim-sonuclar",


            }, ]
        }
    },
    {
        path: '/ilkyardim-sonuclar/bireysel/:id',
        name: 'filkyardim-bireysel',
        component: () => import('@/views/Admin/lab/ilkyardim/sonuclar/individual.vue'),
        meta: {
            requiresAuth: true,
            admin: true,

            pageTitle: '??lk Yard??m',
            breadcrumb: [{
                text: '??lk Yard??m',
                to: "/ilkyardim-sonuclar",


            }, ]
        }
    },





    {
        path: '/asansor-sonuclar',
        name: 'fasansor',
        component: () => import('@/views/Admin/lab/asansor/liste.vue'),
        meta: {
            requiresAuth: true,
            admin: true,

            pageTitle: 'Asans??r',
            breadcrumb: [{
                text: 'Asans??r',
                to: "/asansor-sonuclar",


            }, ]
        }
    },
    {
        path: '/asansor-sonuclar/:id',
        name: 'fasansor-firma',
        component: () => import('@/views/Admin/lab/asansor/sonuclar/client.vue'),
        meta: {
            requiresAuth: true,
            admin: true,

            pageTitle: 'Asans??r',
            breadcrumb: [{
                text: 'Asans??r',
                to: "/asansor-sonuclar",


            }, ]
        }
    },

    {
        path: '/asansor-sonuclar/bireysel/:id',
        name: 'fasansor-bireysel',
        component: () => import('@/views/Admin/lab/asansor/sonuclar/individual.vue'),
        meta: {
            requiresAuth: true,
            admin: true,

            pageTitle: 'Asans??r',
            breadcrumb: [{
                text: 'Asans??r',
                to: "/asansor-sonuclar",


            }, ]
        }
    },








]
