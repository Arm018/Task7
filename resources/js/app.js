import { createApp } from 'vue';
import BooksList from './components/BooksList.vue';
import BookShow from './components/BookShow.vue';
import AuthorsList from './components/AuthorsList.vue';
import AuthorShow from './components/AuthorShow.vue';
import LoginComponent from './components/Login.vue';

import { createRouter, createWebHistory } from 'vue-router';
import axios from 'axios';

const token = localStorage.getItem('authToken');
if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

const routes = [
    { path: '/authors', component: AuthorsList },
    { path: '/authors/:id', component: AuthorShow, props: true },
    { path: '/books', component: BooksList },
    { path: '/books/:id', component: BookShow, props: true }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Create Vue App
const app = createApp({});

app.component('login-component', LoginComponent);

app.use(router);

app.mount('#app');
