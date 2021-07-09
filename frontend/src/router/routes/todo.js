export default [

    // *--------- TODO & IT'S FILTERS N TAGS ---------------------------------------*
    // *===============================================---*
    {
        path: '/todo',
        name: 'apps-todo',
        component: () => import('@/views/todo/Todo.vue'),
        meta: {
            contentRenderer: 'sidebar-left',
            contentClass: 'todo-application',
            requiresAuth: true,



        },

    },
    {
        path: '/todo/:filter',
        name: 'apps-todo-filter',
        component: () => import('@/views/todo/Todo.vue'),
        meta: {
            contentRenderer: 'sidebar-left',
            contentClass: 'todo-application',
            navActiveLink: 'apps-todo',
            requiresAuth: true,
        },
        beforeEnter(to, _, next) {
            if (['important', 'completed', 'deleted'].includes(to.params.filter)) next()
            else next({
                name: 'error-404'
            })
        },
    },






    {
        path: '/todo/tag/:tag',
        name: 'apps-todo-tag',
        component: () => import('@/views/todo/Todo.vue'),
        meta: {
            contentRenderer: 'sidebar-left',
            contentClass: 'todo-application',
            navActiveLink: 'apps-todo',
            requiresAuth: true,
        },
        beforeEnter(to, _, next) {
            if (['team', 'low', 'medium', 'high', 'update'].includes(to.params.tag)) next()
            else next({
                name: 'error-404'
            })
        },
    },




]
