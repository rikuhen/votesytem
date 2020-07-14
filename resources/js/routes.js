import Vue from 'vue';
import VueRouter from 'vue-router';
import { store } from './store'
Vue.use(VueRouter);


// Components
import LoginVoters from './components/auth/LoginVoters';
import VoteViewComponent from './components/vote';
import AdminTemplate from './components/admin/AdminTemplate';
import LoginUsers from './components/admin/auth/LoginUsers'
import UserDashboard from './components/admin/dashboard/UserDashboard'

const hasAnyRole = (roles) => {
    // store.dispatch("getUser").then(user => {
    //     let hasRole = roles.contains(user.role)
    //     console.log(hasRole);
    // })
    console.log(store.getters.getUser);

}

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
            component: AdminTemplate,
            redirect: { name: 'login-admin' },
            children: [
                {
                    path: 'login',
                    name: 'login-admin',
                    component: LoginUsers,
                    beforeEnter: (to, from, next) => {
                        // TODO validate role
                        if (store.getters.loggedIn) {
                            next({ name: 'admin-dashboard' });
                        } else {
                            next();
                        }
                    },

                },
                {
                    path: 'dashboard',
                    name: 'admin-dashboard',
                    component: UserDashboard,
                    meta: {
                        requiresAuth: true
                    }
                }
            ]
        }
    ]
})

export default router;
