export default [
    {
        path: '/users',
        name: 'users',
        component: () => import('@/views/users/users.vue'),
        meta: { requiresAuth: true, uzman:true

        }
    },

]
