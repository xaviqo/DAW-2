import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
import {StripePlugin} from "@vue-stripe/vue-stripe";

Vue.config.productionTip = false
export const EventBus = new Vue();

Vue.use(StripePlugin, {
  pk: `${process.env.VUE_APP_STRIPE_PUB}`
});

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
