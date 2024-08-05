<template>
    <div class="container mt-5">
        <h1 class="mb-4">Books</h1>
        <div class="row">
            <div v-for="book in books.data" :key="book.id" class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ book.title }}</h5>
                        <p class="card-text">
                            <b>About Book: </b>{{ book.description }}
                        </p>
                        <router-link :to="`/books/${book.id}`" class="btn btn-primary">Read More</router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button @click="prevPage" :disabled="!books.prev_page_url" class="btn btn-primary btn-sm">Previous</button>
            <button @click="nextPage" :disabled="!books.next_page_url" class="btn btn-primary btn-sm ml-2">Next</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            books: {
                data: [],
                prev_page_url: null,
                next_page_url: null
            }
        };
    },
    created() {
        this.fetchBooks();
    },
    methods: {
        async fetchBooks(page = 1) {
            try {
                const response = await axios.get(`/api/books?page=${page}`);
                this.books = response.data;
            } catch (error) {
                console.error('There was an error fetching the books:', error);
            }
        },
        prevPage() {
            if (this.books.prev_page_url) {
                const page = new URL(this.books.prev_page_url).searchParams.get('page');
                this.fetchBooks(page);
            }
        },
        nextPage() {
            if (this.books.next_page_url) {
                const page = new URL(this.books.next_page_url).searchParams.get('page');
                this.fetchBooks(page);
            }
        }
    }
};
</script>
