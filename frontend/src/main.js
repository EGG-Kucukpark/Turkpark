import Vue from 'vue'
import {
    ToastPlugin,
    ModalPlugin,
    BootstrapVue
} from 'bootstrap-vue'
import VueCompositionAPI from '@vue/composition-api'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import 'vue-search-select/dist/VueSearchSelect.css'
import router from './router'
import store from './store'
import Axios from 'axios'
Vue.prototype.$http = Axios;
Vue.use(BootstrapVue)
import App from './App.vue'
import calisan from '@/views/Components/calisan.vue'
import select from '@/views/Components/select.vue'
import kunye from "@/views/Admin/clients/corporate/getclient/clientinfo.vue";

// Global Components
import './global-components'
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
import VCalendar from 'v-calendar';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import JsonExcel from "vue-json-excel";
import * as VueGoogleMAps from 'vue2-google-maps'
import PortalVue from 'portal-vue'
// 3rd party plugins
import '@/libs/portal-vue'
import '@/libs/toastification'
import '@/assets/fonts/govde.ttf';
// BSV Plugin Registration
Vue.use(ToastPlugin)
Vue.use(ModalPlugin)
Vue.use(VueGoodTablePlugin);
Vue.component('v-select', vSelect)
Vue.component("downloadExcel", JsonExcel);
Vue.component('calisan-ekle', calisan)
Vue.component('vue-select', select)
Vue.component('kunye', kunye)
Vue.use(VCalendar)
Vue.use(VueSweetalert2);
Vue.use(PortalVue);
Vue.use(VueGoogleMAps, {
    load: {
        key: 'AIzaSyBA6gH1LTs7-6RTKi__xXvdaZ4bV78IdOE',
        libraries: "places",
        location: 'tr',

    }
});



// Composition API
Vue.use(VueCompositionAPI)

// import core styles
require('@core/scss/core.scss')

// import assets styles
require('@/assets/scss/style.scss')

Vue.config.productionTip = false

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app')
