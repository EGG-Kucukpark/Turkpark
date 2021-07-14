import axios from "axios"

export default {

    state: {
        firmalar: null,
        firma_cek: null,

    },
    mutations: {

        Firmalar(state, data) {
            state.firmalar = data
        },

        Firma(state, firma) {
            state.firma_cek = firma

        }

    },
    actions: {

        firmalar({
            commit
        }) {

            axios.post('/api/firmalar').then((res) => {
                commit('Firmalar', res.data)
            })
        },

        firmacek({
            commit
        }, id) {


            axios('/api/firmagoster/' + id).then((res) => {
                let firma = res.data
                commit('Firma', firma)
            })
        },

        calisanlar() {

        }


    },


}
