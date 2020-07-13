import Vue from 'vue';
import VueRouter from 'vue-router';
import { store } from './store'
Vue.use(VueRouter);


// Components
import LoginVoters from './components/auth/LoginVoters';
import VoteViewComponent from './components/vote';
import LoginUsers from './components/admin/auth/LoginUsers'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginVoters,
            beforeEnter: (to, from, next) => {
                if (store.getters.loggedIn) {
                    next({ name: 'vote' });
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
        },
        {
            path: '/voteadmin',
            name: 'voteadmin',
            component: LoginUsers,
            beforeEnter: (to, from, next) => {
                // TODO validate role
                if (store.getters.loggedIn) {
                    next({ name: 'vote' });
                } else {
                    next();
                }
            },
            children: [
                {
                    path: 'dashboard',
                    name: 'admin-dashboard',

                }
            ]
        }
    ]
})

export default router;
