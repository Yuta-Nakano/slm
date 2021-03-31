import Vue from 'vue'
import VueRouter from 'vue-router'

import store from './store'

import Login from './pages/login'
import Template from './pages/template'

import Branch from './pages/branch'
import BranchAdd from './pages/branch/add'
import BranchEdit from './pages/branch/edit'
import BranchDetail from './pages/branch/detail'

import Product from './pages/product'
import ProductAdd from './pages/product/add'
import ProductEdit from './pages/product/edit'
import ProductDetail from './pages/product/detail'
import ProductStockInventory from './pages/product/detail/Inventory'
import ProductStockInventoryHistory from './pages/product/detail/Inventory/history'

Vue.use(VueRouter)

const ifNotAuthenticated = (to, from, next) => {
  if (!store.getters.isAuthenticated) {
    next()
    return
  }
  next('/branch')
}

const ifAuthenticated = (to, from, next) => {
  if (store.getters.isAuthenticated) {
    next()
    return
  }
  next({
    path: '/login',
    query: { redirect: to.fullPath },
  })
}

const routes = [
  {
    path: '/',
    redirect: { name: 'branch' },
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    beforeEnter: ifNotAuthenticated,
  },
  {
    path: '/branch',
    name: 'branch',
    component: Branch,
    beforeEnter: ifAuthenticated,
    props: true,
  },
  {
    path: '/branch/add',
    component: BranchAdd,
    beforeEnter: ifAuthenticated,
  },
  {
    path: '/branch/:branchId',
    component: BranchDetail,
    beforeEnter: ifAuthenticated,
    props: true,
  },
  {
    path: '/branch/:branchId/edit',
    component: BranchEdit,
    beforeEnter: ifAuthenticated,
    props: true,
  },
  {
    path: '/product',
    name: 'product',
    component: Product,
    beforeEnter: ifAuthenticated,
    props: true,
  },
  {
    path: '/product/add',
    component: ProductAdd,
    beforeEnter: ifAuthenticated,
  },
  {
    path: '/product/:productId',
    component: ProductDetail,
    beforeEnter: ifAuthenticated,
    props: true,
  },
  {
    path: '/product/:productId/edit',
    component: ProductEdit,
    beforeEnter: ifAuthenticated,
    props: true,
  },
  {
    path: '/product/:productId/inventory',
    component: ProductStockInventory,
    beforeEnter: ifAuthenticated,
    props: true,
  },
  {
    path: '/product/:productId/branch/:branchId/history',
    component: ProductStockInventoryHistory,
    beforeEnter: ifAuthenticated,
    props: true,
  },
]

const router = new VueRouter({
  mode: 'history',
  routes,
})

export default router
