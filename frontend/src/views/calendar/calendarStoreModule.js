import axios from '@axios'
var user = (JSON.parse(localStorage.getItem('user')));
export default {

    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {

        fetchEvents(ctx) {

            return new Promise((resolve, reject) => {



                axios
                    .post('/api/takvim', {
                        id: user.id
                    })
                    .then(response => resolve(response))
                    .catch(error => reject(error))
            })
        },
        addEvent(ctx, {
            event
        }) {
            return new Promise((resolve, reject) => {
                axios
                    .post('/api/takvimekle', {
                        event,
                        user_id: user.id
                    })
                    .then(response => resolve(response))
                    .catch(error => reject(error))
            })
        },
        updateEvent(ctx, {
            event
        }) {
            return new Promise((resolve, reject) => {
                axios
                    .post(`/api/takvimduzenle/${event.id}`, {
                        event
                    })
                    .then(response => resolve(response))
                    .catch(error => reject(error))
            })
        },
        removeEvent(ctx, {
            id
        }) {
            return new Promise((resolve, reject) => {
                axios
                    .post(`/api/takvimsil`, {id: id})
                    .then(response => resolve(response))
                    .catch(error => reject(error))
            })
        },
    },
}
