import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta :{
        allowAnonymous: true,
      } 
    },
    {
      path: '/list',
      name: 'about',
      meta :{
        allowAnonymous: true,
      } ,
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/detail/:id/:seatType',
      name: 'detail',
      component: () => import('../views/DetailView.vue'),
      meta :{
        allowAnonymous: false
      } 
      
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.

    },

    {
      path: '/login',
      name: 'login',
      meta :{
        allowAnonymous: true,
      } ,
      
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/LoginView.vue')
    }
  ]
})
router.beforeEach((to, from, next) => {
  if (!to.meta.allowAnonymous && window.localStorage.getItem('token')) {
    next({
      path: '/login',
    })
  }
  else {
    next()
  }  
})
export default router
