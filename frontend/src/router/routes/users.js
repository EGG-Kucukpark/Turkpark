export default [{
        path: '/users',
        name: 'users',
        component: () => import('@/views/users/users.vue'),
        meta: {
            requiresAuth: true,
            uzman: true

        }
    },
    {
        path: '/profil',
        name: 'profil',
        component: () => import('@/views/users/settings/Account.vue'),
        meta: {
            requiresAuth: true,


        }
    },


]
