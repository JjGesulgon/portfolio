import VueRouter from 'vue-router'

const Overview = () => import('./views/Overview');
const About = () => import('./views/About');
const Projects = () => import('./views/Projects');
const Contact = () => import('./views/Contact');

const router = new VueRouter({
    mode: 'history',
    routes: [
        // Main Page
        { path: '/', name: 'overview', component: Overview },

        // About Page
        { path: '/about', name: 'about', component: About },

        // Projects Page
        { path: '/projects', name: 'projects', component: Projects },

        // Contact Page
        { path: '/contact-me', name: 'contact-me', component: Contact },
    ]
});

export default router;