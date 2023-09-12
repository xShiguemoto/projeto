import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '*',
    redirect: '/login',
  },
  {
    path: '/',
    redirect: '/login',
  },
  {
    path: '/login',
    name: 'login',
    meta:{
      requiresAuth: false 
    },
    component: () => import('../views/LoginView.vue')
  },
  {
    path: '/register',
    name: 'register',
    meta:{
      requiresAuth: false 
    },
    component: () => import('../views/RegisterView.vue')
  },
  {
    path: '/dashboard',
    name: 'home',
    meta:{
      requiresAuth: true 
    },
    component: () => import('../views/DashboardView.vue')
  },
  {
    path: '/view/:id/:token',
    name: 'view',
    meta:{
      requiresAuth: false 
    },
    component: () => import('../views/TaskView.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
