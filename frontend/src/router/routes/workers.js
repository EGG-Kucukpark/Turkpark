export default [
    {
        path: '/calisanlar/:id',
        name: 'calisan-goster',
        component: () => import('@/views/clients/corporate/getworker/worker.vue'),
        meta: {
            requiresAuth: true, uzman:true

        }
    },








]
