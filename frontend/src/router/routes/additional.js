export default [

    {

        path: '/error-404',
        name: 'error-404',
        component: () => import('@/views/additional/error.vue'),
        meta: {
            requiresAuth: true,
            layout: 'full',
        },
    },
    {

        path: '/unauthorized',
        name: 'unauthorized',
        component: () => import('@/views/additional/unauthorized.vue'),
        meta: {
            guest: true,
            layout: 'full',
        },
    },
]
