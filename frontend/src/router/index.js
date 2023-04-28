import { createRouter, createWebHistory } from 'vue-router'

//view login
import Login from '../views/auth/Login.vue'
// view tasktodo
import ListTasktodo from '../views/admin/tasktodo/List.vue'
// view user
import ListUser from '../views/admin/users/List.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: { hideNavigation: true }
    },
    {
      path: '/tasktodo',
      name: 'tasktodo',
      component: ListTasktodo,
      meta: { hideNavigation: false }
    },
    {
      path: '/users',
      name: 'users',
      component: ListUser,
      meta: { hideNavigation: false }
    }
  ]
})

export default router
