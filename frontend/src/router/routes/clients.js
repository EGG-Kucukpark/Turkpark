export default [

    /////////////////////////////////////////////////////////////////////////////////////////////////
    //            Corporate

    {
        path: '/client/:id',
        name: 'firmalar-goster',
        component: () => import('@/views/clients/corporate/getclient/getclient.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Bilgiler',
            breadcrumb: [{
                text: 'Firmalar',
                to: '/clients',


            }, ],
        }
    },
    {
        path: '/clients',
        name: 'musteriler',
        component: () => import('@/views/clients/liste.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Müşteriler',

        }
    },

    {
        path: '/clientview',
        name: 'clients',
        component: () => import('@/views/clients/corporate/getclient/getclient.vue'),
        meta: {
            requiresAuth: true,
            admin: true
        }
    },
    {
        path: '/clients',
        name: 'clients',
        component: () => import('@/views/clients/corporate/getclient/getclient.vue'),
        meta: {
            requiresAuth: true,
            admin: true
        }
    },



    /////////////////////////////////////////////////////////////////////////////////////////////////
    //            individual

    {
        path: '/individual/:id',
        name: 'bireysel-goster',
        component: () => import('@/views//clients/individual/getclient/getindividual.vue'),
        meta: {
            requiresAuth: true,
            admin: true,
            pageTitle: 'Müşteri',
            breadcrumb: [{
                text: 'Bireysel Müşteriler',
                to: '/clients',


            }, ]
        }
    },

    {
        path: '/individualview',
        name: 'individual',
        component: () => import('@/views/clients/individual/getclient/getindividual.vue'),
        meta: {
            requiresAuth: true,
            admin: true
        }
    },
    {
        path: '/individual',
        name: 'individual',
        component: () => import('@/views/clients/individual/getclient/getindividual.vue'),
        meta: {
            requiresAuth: true,
            admin: true
        }
    },









    /////////////////////////////////////////////////////////////////////////////////////////////////
    //            Lab











    {
        path: '/kursiyerler',
        name: 'kursiyerler',
        component: () => import('@/views/belge/certficate/liste.vue'),
        meta: {
            requiresAuth: true,

        }
    },
    {
        path: '/kursiyerler/:id',
        name: 'kursiyer-firma',
        component: () => import('@/views/belge/certficate/sertifika/certifa.vue'),
        meta: {
            requiresAuth: true,

        }
    },
    {
        path: '/kursiyerler/bireysel/:id',
        name: 'kursiyer-bireysel',
        component: () => import('@/views/belge/certficate/sertifika/certifa.vue'),
        meta: {
            requiresAuth: true,

        }
    },
    {
        path: '/egitimler',
        name: 'egitim',
        component: () => import('@/views/belge/egitim/egitim.vue'),
        meta: {
            requiresAuth: true,

        }
    },

    {
        path: '/egitimler/:id',
        name: 'egitim-goster',
        component: () => import('@/views/belge/egitim/egitimgoster.vue'),
        meta: {
            requiresAuth: true,

        }
    },
    {
        path: '/sertifika/:id',
        name: 'sertifika-goster',
        component: () => import('@/views/belge/certficate/sertifika/sertifika.vue'),
        meta: {
            requiresAuth: true,

        }
    },





]
