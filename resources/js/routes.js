import Vue from 'vue';
import VueRouter from 'vue-router';
import { store } from './store'
Vue.use(VueRouter);


// Components
import LoginVoters from './components/auth/LoginVoters';
import VoteViewComponent from './components/vote';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginVoters,
            beforeEnter: (to, from, next) => {
                if (store.getters.loggedIn) {
                    next({ name: 'home' });
                } else {
                    next();
                }
            }
        },
        {
            path: '/vote',
            name: 'vote',
            component: VoteViewComponent,
            meta: {
                requiresAuth: true
            }
        }
    ]
})

export default router;
