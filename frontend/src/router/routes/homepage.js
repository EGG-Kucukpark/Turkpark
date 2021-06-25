export default [
    {
        path: '/',
        name: 'Home',
        component: () => import('@/views/homepage/Analytics.vue'),
        meta:{
            requiresAuth: true,


        }
    },
]
