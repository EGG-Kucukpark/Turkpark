import Vue from 'vue'
import { ToastPlugin, ModalPlugin } from 'bootstrap-vue'
import VueCompositionAPI from '@vue/composition-api'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import 'vue-search-select/dist/VueSearchSelect.css'




import router from './router'
import store from './store'
import App from './App.vue'

// Global Components
import './global-components'
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'
import JsonExcel from "vue-json-excel";
import VCalendar from 'v-calendar';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';





// 3rd party plugins
import '@/libs/portal-vue'
import '@/libs/toastification'

// BSV Plugin Registration
Vue.use(ToastPlugin)
Vue.use(ModalPlugin)
Vue.use(VueGoodTablePlugin);
Vue.component('v-select', vSelect)
Vue.component("downloadExcel", JsonExcel);
Vue.use(VCalendar)
Vue.use(VueSweetalert2);


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
