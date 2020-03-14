import VueRouter from 'vue-router'

const Overview = () => import('./views/Overview');

//Users
const Users = () => import('./views/Users/Index');
const UsersCreate = () => import('./views/Users/Create');
const UsersView = () => import('./views/Users/View');
const UsersUpdate = () => import('./views/Users/Update');

//Intro
const IntroView = () => import('./views/Intro/View');
const IntroCreate = () => import('./views/Intro/Create');
const IntroEdit = () => import('./views/Intro/Edit');

//About
const AboutView = () => import('./views/About/View');
const AboutCreate = () => import('./views/About/Create');
const AboutEdit = () => import('./views/About/Edit');

const router = new VueRouter({
    mode: 'history',
    routes: [
        // Users
        { path: '/', name: 'overview', component: Overview },
        { path: '/users', name: 'users.index', component: Users },
        { path: '/users/create', name: 'users.create', component: UsersCreate },
        { path: '/users/:id', name: 'users.view', component: UsersView },
        { path: '/users/:id/edit', name: 'users.update', component: UsersUpdate },

        // Intro
        { path: '/intro', name: 'intro.index', component: IntroView },
        { path: '/intro/create', name: 'intro.create', component: IntroCreate },
        { path: '/intro/edit', name: 'intro.edit', component: IntroEdit },

        // About
        { path: '/about', name: 'about.index', component: AboutView },
        { path: '/about/create', name: 'about.create', component: AboutCreate },
        { path: '/about/edit', name: 'about.edit', component: AboutEdit },
    ]
});

export default router;