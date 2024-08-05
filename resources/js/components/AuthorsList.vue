<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Authors</h2>
                    </div>
                    <div class="card-body">
                        <p v-if="authors.length === 0" class="text-center">No authors found.</p>
                        <ul v-else class="list-group">
                            <li v-for="author in authors" :key="author.id" class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ author.first_name }} {{ author.last_name }}</span>
                                <a :href="`/authors/${author.id}`" class="btn btn-info btn-sm">View Details</a>
                            </li>
                        </ul>
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
            authors: [],
        };
    },
    created() {
        this.fetchAuthors();
    },
    methods: {
        async fetchAuthors() {
            try {
                const response = await axios.get('/api/authors');
                this.authors = response.data.data;
            } catch (error) {
                console.error('There was an error fetching the authors:', error);
            }
        }
    }
};
</script>
