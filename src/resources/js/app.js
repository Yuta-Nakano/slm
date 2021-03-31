import './bootstrap'
import Vue from 'vue'
import VueMeta from 'vue-meta'
import router from './router'
import store from './store'
import mixin from './mixn'
import { USER_REQUEST } from './store/actions/user'

import App from './App.vue'
import DefaultLayout from './layouts/default'
import Nav from './components/Nav'
Vue.component('DefaultLayout', DefaultLayout)
Vue.component('Nav', Nav)

Vue.use(VueMeta, {
  keyName: 'head',
  refreshOnceOnNavigation: true,
})

Vue.mixin(mixin)
;(async () => {
  await store.dispatch(USER_REQUEST)
  // Set-instance
  new Vue({
    el: '#app',
    router,
    store,
    template: '<App />',
    components: { App },
    head() {
      return {
        title: 'Logistics',
        titleTemplate: titleChunk => {
          return titleChunk ? `${titleChunk} - Logistics` : 'Logistics'
        },
      }
    },
  })
})()
