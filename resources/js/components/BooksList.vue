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
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            books: {
                data: []
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
        }
    }
};
</script>
