export default [
    {
        path: '/calisanlar/:id',
        name: 'calisan-goster',
        component: () => import('@/views/clients/corporate/getworker/worker.vue'),
        meta: {
            requiresAuth: true, uzman:true

        }
    },
    {
        path: '/raporlar',
        name: 'raporlar',
        component: () => import('@/views/lab/raporlar/raporlar.vue'),
        meta: {
            requiresAuth: true, admin:true

        }
    },










]
