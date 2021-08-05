import axios from "axios"

export default {

    state: {
        firmalar: null,
        table: {
            perPage: 10,
            pageOptions: [10, 20, 30],
            totalRows: 1,
            currentPage: 1,
            sortBy: "",
            sortDesc: false,
            sortDirection: "asc",
            filter: null,
            filterOn: [],

        },


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
