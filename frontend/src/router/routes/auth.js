export default [

    {
        path: '/login',
        name: 'login',
        component: () => import('@/views/auth/Login.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }



    },

    {
        path: '/register',
        name: 'register',
        component: () => import('@/views/auth/Register.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }


    },

    {
        path: '/email/verify/:id',
        name: 'verification.verify',
        component: () => import('@/views/auth/verify.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }
    },

    {
        path: '/admin/verify/:id',
        name: 'verification.verify',
        component: () => import('@/views/auth/adminverify.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }
    },


    {
        path: '/password/reset',
        name: 'password.request',
        component: () => import('@/views/auth/forgot.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }
    },

    {
        path: '/password/reset/:token',
        name: 'password.reset',
        component: () => import('@/views/auth/newpass.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }
    },
]
