import {createRouter, createWebHistory} from 'vue-router';
import BooksList from './components/BooksList.vue';
import BooksTopAuthor from './components/BooksTopAuthor.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'books',
            path: '/',
            component: BooksList,
        },
        {
            name: 'books-top10',
            path: '/books/top10',
            component: BooksTopAuthor,
        },
    ],
});

export default router;