export default [

    {
        path: '/arsiv',
        name: 'arsiv',
        component: () => import('@/views/arsiv/arsiv.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Arşiv',
            breadcrumb: [{
                text: 'Arşiv',

                active: true,
            }, ],

        }
    },

    {
        path: '/kursiyerler-arsiv',
        name: 'kursiyerler-arsiv',
        component: () => import('@/views/arsiv/kursiyer/liste.vue'),
        meta: {
            requiresAuth: true,

        }
    },
    {
        path: '/kursiyerler-arsiv/:id',
        name: 'kursiyer-arsiv-firma',
        component: () => import('@/views/arsiv/kursiyer/sertifika/certifa.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Kursiyerler Arşiv',
            breadcrumb: [{
                text: 'Arşiv',
                to: '/arsiv',
            }, ],

        }
    },
    {
        path: '/kursiyerler-arsiv/bireysel/:id',
        name: 'kursiyer-arsiv-bireysel',
        component: () => import('@/views/arsiv/kursiyer/sertifika/certifa.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Kursiyerler Arşiv',
            breadcrumb: [{
                text: 'Arşiv',
                to: '/arsiv',
            }, ],

        }
    },
]
