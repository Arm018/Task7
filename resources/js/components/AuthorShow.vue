<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Author: {{ author.first_name }} {{ author.last_name }}</h2>
                    </div>
                    <div class="card-body">
                        <p><b>Biography:</b> {{ author.biography }}</p>
                        <p><strong>Books:</strong></p>
                        <ul class="list-group">
                            <li v-for="book in author.books" :key="book.id" class="list-group-item">
                                <a :href="`/books/${book.id}`">{{ book.title }}</a>
                            </li>
                        </ul>
                        <a href="/authors" class="btn btn-primary mt-3">Back to Authors</a>
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
            author: {
                first_name: '',
                last_name: '',
                biography: '',
                books: []
            }
        };
    },
    created() {
        this.fetchAuthor();
    },
    methods: {
        async fetchAuthor() {
            try {
                const response = await axios.get(`/api/authors/${this.$route.params.id}`);
                this.author = response.data;
            } catch (error) {
                console.error('There was an error fetching the author:', error);
            }
        }
    }
};
</script>
