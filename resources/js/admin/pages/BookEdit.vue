<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Book - {{ book.title }}</h2>
                    </div>
                    <div class="card-body">
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <form @submit.prevent="updateBook">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input
                                    type="text"
                                    id="title"
                                    class="form-control"
                                    v-model="book.title"
                                />
                                <span v-if="errors.title" class="text-danger">{{ errors.title }}</span>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea
                                    id="description"
                                    class="form-control"
                                    v-model="book.description"
                                ></textarea>
                                <span v-if="errors.description" class="text-danger">{{ errors.description }}</span>
                            </div>

                            <div class="form-group">
                                <label for="publication_year">Publication Year:</label>
                                <input
                                    type="number"
                                    id="publication_year"
                                    class="form-control"
                                    v-model="book.publication_year"
                                />
                                <span v-if="errors.publication_year" class="text-danger">{{ errors.publication_year }}</span>
                            </div>

                            <div class="form-group">
                                <label for="authors">Authors:</label>
                                <select
                                    id="authors"
                                    class="form-control"
                                    v-model="selectedAuthors"
                                    multiple
                                >
                                    <option v-for="author in authors" :key="author.id" :value="author.id">
                                        {{ author.first_name }} {{ author.last_name }}
                                    </option>
                                </select>
                                <span v-if="errors.authors" class="text-danger">{{ errors.authors }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Book</button>
                        </form>
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
                authors: []
            },
            authors: [],
            selectedAuthors: [],
            errors: {},
            successMessage: ''
        };
    },
    mounted() {
        this.fetchBook();
    },
    methods: {
        async fetchBook() {
            try {
                const response = await axios.get(`/api/books/${this.$route.params.id}/edit`);
                this.book = response.data.book;
                this.authors = response.data.authors;
                this.selectedAuthors = this.book.authors.map(author => author.id);
            } catch (error) {
                console.error('Error fetching book data:', error);
            }
        },
        async updateBook() {
            try {
                const response = await axios.put(`/api/books/${this.$route.params.id}`, {
                    ...this.book,
                    authors: this.selectedAuthors
                });
                this.successMessage = response.data.message;
                this.errors = {};

                this.$router.push({ name: 'BooksList' });
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                }
            }
        }
    }
};
</script>

<style scoped>
.text-danger {
    color: #dc3545;
}
</style>
