import {createApp} from 'vue';
import BooksList from './components/BooksList.vue';
import BookShow from './components/BookShow.vue';
import AuthorsList from './components/AuthorsList.vue';
import AuthorShow from './components/AuthorShow.vue';
import {createRouter, createWebHistory} from 'vue-router';

const routes = [
    {path: '/authors', component: AuthorsList},
    {path: '/authors/:id', component: AuthorShow, props: true},
    {path: '/books', component: BooksList},
    {path: '/books/:id', component: BookShow, props: true}
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

const app = createApp({});
app.use(router);
app.component('authors-list', AuthorsList);
app.component('author-show', AuthorShow);
app.component('books-list',BooksList);
app.component('book-show',BookShow);
app.mount('#app');
