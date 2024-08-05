<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Authors</h2>
                    </div>
                    <div class="card-body">
                        <p v-if="authors.data.length === 0" class="text-center">No authors found.</p>
                        <ul v-else class="list-group">
                            <li v-for="author in authors.data" :key="author.id" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ author.first_name }} {{ author.last_name }}</span>
                                <a :href="`/authors/${author.id}`" class="btn btn-info btn-sm">View Details</a>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center mt-4">
                            <button @click="prevPage" :disabled="!authors.prev_page_url" class="btn btn-primary btn-sm">Previous</button>
                            <button @click="nextPage" :disabled="!authors.next_page_url" class="btn btn-primary btn-sm ml-2">Next</button>
                        </div>
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
            authors: {
                data: [],
                prev_page_url: null,
                next_page_url: null
            }
        };
    },
    created() {
        this.fetchAuthors();
    },
    methods: {
        async fetchAuthors(page = 1) {
            try {
                const response = await axios.get(`/api/authors?page=${page}`);
                this.authors = response.data;
            } catch (error) {
                console.error('There was an error fetching the authors:', error);
            }
        },
        prevPage() {
            if (this.authors.prev_page_url) {
                const page = new URL(this.authors.prev_page_url).searchParams.get('page');
                this.fetchAuthors(page);
            }
        },
        nextPage() {
            if (this.authors.next_page_url) {
                const page = new URL(this.authors.next_page_url).searchParams.get('page');
                this.fetchAuthors(page);
            }
        }
    }
};
</script>
