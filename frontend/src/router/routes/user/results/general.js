export default [


    {
        path: '/hizmet-gecmisi',
        name: 'hizmet-gecmisi',
        component: () => import('@/views/User/hizmetLog/hizmetLog.vue'),
        meta: {
            requiresAuth: true
        }


    },



    {
        path: '/hizmet-gecmisi/:status/:id',
        component: () => import('@/views/User/hizmetLog/hizmetLog.vue'),


    },

    {
        path: '/hizmet-gecmisi/:id',
        name: 'hizmet-gecmisi-goster',
        component: () => import('@/views/User/hizmetLog/hizmetShow.vue'),


    }

]
