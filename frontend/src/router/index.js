import Vue from 'vue'
import VueRouter from 'vue-router'
import homepage from './routes/homepage'

import additional from './routes/additional'
import auth from './routes/auth'
import clients from './routes/clients'
import workers from './routes/workers'
import users from './routes/users'
import todo from './routes/todo'
import calendar from './routes/calendar'
import axios from '@axios'
import archive from './routes/archive'
import results from './routes/results'
import settings from './routes/settings'


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
            var database;




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
    // Remove initial loading
    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = 'none'
    }

})

export default router
