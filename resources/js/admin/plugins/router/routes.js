export const routes = [
    {path: '/', redirect: '/'},
    {
        path: '/',
        component: () => import('@/layouts/default.vue'),
        children: [
            {
                path: 'admin/dashboard',
                component: () => import('@/pages/dashboard.vue'),
            },
            {
                path: 'admin/books',
                component: () => import('@/pages/BookList.vue'),
                name: 'BooksList'
            },
            {
                path: 'admin/books/create',
                component: () => import('@/pages/BookCreate.vue'),
                name: 'BooksCreate'
            },
            {
                path: 'admin/books/:id/edit',
                component: () => import('@/pages/BookEdit.vue'),
                name: 'BooksEdit',
                props: true
            },
            {
                path: 'admin/authors',
                component: () => import('@/pages/AuthorList.vue'),
                name: 'AuthorList'
            },
            {
                path: 'admin/authors/create',
                component: () => import('@/pages/AuthorCreate.vue'),
                name: 'AuthorCreate'
            },
            {
                path: 'admin/authors/:id/edit',
                component: () => import('@/pages/AuthorEdit.vue'),
                name: 'AuthorEdit',
                props: true
            },
            {
                path: 'account-settings',
                component: () => import('@/pages/account-settings.vue'),
            },
        ],
    },

]
