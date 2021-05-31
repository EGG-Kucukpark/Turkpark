export default [


    {
        path: '/apps/calendar',
        name: 'apps-calendar',
        component: () => import('@/views/calendar/Calendar.vue'),
        meta:{
            requiresAuth:true

        }
      },
]
