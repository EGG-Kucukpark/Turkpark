export default [

    {
        path: '/login',
        name: 'login',
        component: () => import('@/views/Admin/auth/Login.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }



    },

    {
        path: '/register',
        name: 'register',
        component: () => import('@/views/Admin/auth/Register.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }


    },

    {
        path: '/email/verify/:id',
        name: 'verification.verify',
        component: () => import('@/views/Admin/auth/verify.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }
    },

    {
        path: '/admin/verify/:id',
        name: 'verification.verify',
        component: () => import('@/views/Admin/auth/adminverify.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }
    },


    {
        path: '/password/reset',
        name: 'password.request',
        component: () => import('@/views/Admin/auth/forgot.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }
    },
    {
        path: '/email/resend',
        name: 'email.request',
        component: () => import('@/views/Admin/auth/emailforgot.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }
    },

    {
        path: '/password/reset/:token',
        name: 'password.reset',
        component: () => import('@/views/Admin/auth/newpass.vue'),
        meta: {
            guest:true,
            layout: 'full',
        }
    },
]
