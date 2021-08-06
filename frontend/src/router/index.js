import Vue from 'vue'
import VueRouter from 'vue-router'
import homepage from './routes/admin/homepage'

import additional from './routes/admin/additional'
import auth from './routes/admin/auth'
import clients from './routes/admin/clients'
import workers from './routes/admin/workers'
import users from './routes/admin/users'
import todo from './routes/admin/todo'
import calendar from './routes/admin/calendar'
import archive from './routes/admin/archive'
import results from './routes/admin/results'
import settings from './routes/admin/settings'
import user_result from './routes/user/results/results'
import user_general from './routes/user/results/general'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    scrollBehavior() {
        return {
            x: 0,
            y: 0
        }
    },
    routes: [

        ...homepage,
        ...additional,
        ...auth,
        ...clients,
        ...workers,
        ...users,
        ...todo,
        ...calendar,
        ...archive,
        ...results,
        ...settings,
        ...user_result,
        ...user_general,
        {
            path: '*',
            redirect: 'error-404',
        },


    ],
})





//Giriş Ve Rol Kontrol

router.beforeEach((to, from, next) => {



    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('token') == null) {
            next('/login')
        } else {
            var user = JSON.parse(localStorage.getItem('user'))





            if (to.matched.some(record => record.meta.admin)) {
                if (user.role == 'Admin') {
                    next()
                } else {
                    next('/unauthorized')
                }
            } else if (to.matched.some(record => record.meta.hekim)) {
                if (user.role == 'Hekim' || user.role == 'Admin') {
                    next()
                } else {
                    next('/unauthorized')
                }

            } else if (to.matched.some(record => record.meta.uzman)) {
                if (user.role == 'Uzman' || user.role == 'Admin') {
                    next()
                } else {
                    next('/unauthorized')
                }

            } else if (to.matched.some(record => record.meta.firma)) {
                if (user.role == 'Firma' || user.role == 'Admin') {
                    next()
                } else {
                    next('/unauthorized')
                }

            } else {
                next()
            }


        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (localStorage.getItem('token') == null) {
            next()
        } else {
            next({
                name: '/'
            })
        }
    } else {
        next()
    }
})



router.afterEach(() => {



    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = 'none';

    }

})

export default router
