import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ConnectView from "@/views/ConnectView.vue";
import AdminPanel from "@/views/AdminPanel.vue";
import PayOrder from "@/views/PayOrder.vue";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/connection',
    name: 'connection',
    component: ConnectView
  }
  ,
  {
    path: '/admin-panel',
    name: 'admin',
    component: AdminPanel
  },
  {
    path: '/pay/:orderId',
    name: 'pay-order',
    component: PayOrder
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
