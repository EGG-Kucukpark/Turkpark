export default [

    /////////////////////////////////////////////////////////////////////////////////////////////////
    //            Corporate

    {
        path: '/client/:id',
        name: 'firmalar-goster',
        component: () => import('@/views/clients/corporate/getclient/getclient.vue'),
        meta: {
            requiresAuth: true,
            uzman: true
        }
    },
    {
        path: '/clients',
        name: 'clients',
        component: () => import('@/views/clients/corporate/clients.vue'),
        meta: {
            requiresAuth: true,
            uzman: true
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
            uzman: true
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
        }


    },

    {
        path: '/measures',
        name: 'measures',
        component: () => import('@/views/lab/measure/measure.vue'),
        meta: {
            requiresAuth: true,
        }


    },

    {
        path: '/sertifika',
        name: 'sertifika',
        component: () => import('@/views/belge/belge.vue'),
        meta: {
            requiresAuth: true,
        }


    }





]
