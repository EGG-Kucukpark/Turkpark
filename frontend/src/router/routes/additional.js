export default [

    {

        path: '/error-404',
        name: 'error-404',
        component: () => import('@/views/additional/error.vue'),
        meta: {

            layout: 'full',
        },
    },
    {

        path: '/unauthorized',
        name: 'unauthorized',
        component: () => import('@/views/additional/unauthorized.vue'),
        meta: {

            layout: 'full',
        },
    },
]
