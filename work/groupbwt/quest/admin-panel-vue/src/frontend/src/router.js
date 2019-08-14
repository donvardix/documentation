import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Users from './views/users/Users.vue'
import Hotels from './views/hotels/Hotels.vue'

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/users',
            name: 'user',
            component: Users
        },
        {
            path: '/hotels',
            name: 'hotels',
            component: Hotels
        }
    ]
})
