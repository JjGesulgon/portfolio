import VueRouter from 'vue-router'

const Overview = () => import('./views/Overview');

const router = new VueRouter({
    mode: 'history',
    routes: [
        // Main Page
        { path: '/', name: 'overview', component: Overview },
    ]
});

export default router;