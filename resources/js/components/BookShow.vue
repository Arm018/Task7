<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ book.title }}</h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ book.description }}</p>
                        <p><strong>Publication Year:</strong> {{ book.publication_year }}</p>
                        <router-link to="/books" class="btn btn-primary mt-3">Back to Books</router-link>
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
            book: {
                title: '',
                description: '',
                publication_year: '',
            },
            error: null
        };
    },
    created() {
        this.fetchBook();
    },
    methods: {
        async fetchBook() {
            try {
                const response = await axios.get(`/api/books/${this.$route.params.id}`);
                this.book = response.data.data; // Access the `data` property
                console.log('Book data:', this.book);
            } catch (error) {
                console.error('There was an error fetching the book:', error);
                this.error = 'Failed to load book details.';
            }
        }
    }
};
</script>


