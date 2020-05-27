import VueRouter from 'vue-router'

const Overview = () => import('./views/Overview');
const About = () => import('./views/About');

const router = new VueRouter({
    mode: 'history',
    routes: [
        // Main Page
        { path: '/', name: 'overview', component: Overview },

        // About Page
        { path: '/about', name: 'about', component: About },
    ]
});

export default router;