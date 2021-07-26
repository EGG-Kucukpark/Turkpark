
export default [



    {


        path: '/calisanlar/:id',
        name: 'calisan-goster',
        component: () => import('@/views/Admin/clients/corporate/getworker/worker.vue'),


        meta: {
            requiresAuth: true,



        }
    },












]
