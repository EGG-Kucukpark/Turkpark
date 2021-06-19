export default [

    {
        path: '/arsiv',
        name: 'arsiv',
        component: () => import('@/views/arsiv/arsiv.vue'),
        meta: {
            requiresAuth: true,
            admin: true

        }
    },
]
