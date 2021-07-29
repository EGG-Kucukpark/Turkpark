export default [{
        path: '/users',
        name: 'users',
        component: () => import('@/views/Admin/users/users.vue'),
        meta: {
            requiresAuth: true,
            admin: true,

        }
    },



]
