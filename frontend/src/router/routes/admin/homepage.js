export default [
    {
        path: '/',
        name: 'Home',
        component: () => import('@/views/Admin/homepage/Analytics.vue'),
        meta:{
            requiresAuth: true,


        }
    },
]
