export default [

    /////////////////////////////////////////////////////////////////////////////////////////////////
    //            Corporate

    {
        path: '/client/:id',
        name: 'firmalar-goster',
        component: () => import('@/views/clients/corporate/getclient/getclient.vue'),
        meta: {
            requiresAuth: true,
            uzman: true,
            pageTitle: 'Bilgiler',
            breadcrumb: [{
                text: 'Firmalar',
                to: '/clients',


            }, ],
        }
    },
    {
        path: '/clients',
        name: 'clients',
        component: () => import('@/views/clients/corporate/clients.vue'),
        meta: {
            requiresAuth: true,
            uzman: true,
            pageTitle: 'Kurumsal Müşteriler',
            breadcrumb: [{
                text: 'Home',
                active: true,
            }, ],
        }
    },

    {
        path: '/clientview',
        name: 'clients',
        component: () => import('@/views/clients/corporate/getclient/getclient.vue'),
        meta: {
            requiresAuth: true,
            uzman: true
        }
    },
    {
        path: '/clients',
        name: 'clients',
        component: () => import('@/views/clients/corporate/getclient/getclient.vue'),
        meta: {
            requiresAuth: true,
            uzman: true
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
            uzman: true
        }
    },
    {
        path: '/individual',
        name: 'individual',
        component: () => import('@/views/clients/individual/individual.vue'),
        meta: {
            requiresAuth: true,
            uzman: true,
            pageTitle: 'Bireysel Müşteriler',
            breadcrumb: [{
                text: 'Home',
                active: true,
            }, ],
        }
    },

    {
        path: '/individualview',
        name: 'individual',
        component: () => import('@/views/clients/individual/getclient/getindividual.vue'),
        meta: {
            requiresAuth: true,
            uzman: true
        }
    },
    {
        path: '/individual',
        name: 'individual',
        component: () => import('@/views/clients/individual/getclient/getindividual.vue'),
        meta: {
            requiresAuth: true,
            uzman: true
        }
    },









    /////////////////////////////////////////////////////////////////////////////////////////////////
    //            Lab








    {
        path: '/results',
        name: 'results',
        component: () => import('@/views/lab/lab.vue'),
        meta: {
            requiresAuth: true,
            pageTitle: 'Laboratuvar',
            breadcrumb: [{
                text: 'Ana Sayfa',
                active: true,
            }, ],

        }


    },



    {
        path: '/sertifika',
        name: 'sertifika',
        component: () => import('@/views/belge/certficate/certifa.vue'),
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
        component: () => import('@/views/belge/certficate/sertifika.vue'),
        meta: {
            requiresAuth: true,

        }
    },





]
