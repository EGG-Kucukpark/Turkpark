export default [

    {

        path: '/error-404',
        name: 'error-404',
        component: () => import('@/views/Admin/additional/error.vue'),
        meta: {

            layout: 'full',
        },
    },
    {

        path: '/unauthorized',
        name: 'unauthorized',
        component: () => import('@/views/Admin/additional/unauthorized.vue'),
        meta: {

            layout: 'full',
        },
    },
]
