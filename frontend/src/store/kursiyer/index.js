import axios from '@axios'
export default {

    state: {
        sayi: null
    },
    mutations: {
        kurs_sayi(state, sayi) {
            state.sayi = sayi
        }
    },
    actions: {

        kursiyer_sayi:({commit}, id) => {
console.log(id)
            axios.post("/api/sertifikagetir", {id: id}).then((res) => (this.items = res.data));
        }
    }




}
