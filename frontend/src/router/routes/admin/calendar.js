export default [


    {
        path: '/apps/calendar',
        name: 'apps-calendar',
        component: () => import('@/views/Admin/calendar/Calendar.vue'),
        meta:{
            requiresAuth:true

        }
      },
]
