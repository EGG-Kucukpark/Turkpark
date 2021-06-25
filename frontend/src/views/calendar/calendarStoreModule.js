import axios from '@axios'

export default {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {

        fetchEvents(ctx) {

            return new Promise((resolve, reject) => {

                var user = (JSON.parse(localStorage.getItem('user')));

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
                    .post('/apps/calendar/events', {
                        event
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
                    .get(`/api/takvimsil/${id}`)
                    .then(response => resolve(response))
                    .catch(error => reject(error))
            })
        },
    },
}
