<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Author - {{ author.first_name }} {{ author.last_name }}</h2>
                    </div>
                    <div class="card-body">
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <form @submit.prevent="updateAuthor">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input
                                    type="text"
                                    id="first_name"
                                    class="form-control"
                                    v-model="author.first_name"
                                />
                                <span v-if="errors.first_name" class="text-danger">{{ errors.first_name }}</span>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input
                                    type="text"
                                    id="last_name"
                                    class="form-control"
                                    v-model="author.last_name"
                                />
                                <span v-if="errors.last_name" class="text-danger">{{ errors.last_name }}</span>
                            </div>

                            <div class="form-group">
                                <label for="biography">Biography:</label>
                                <textarea
                                    id="biography"
                                    class="form-control"
                                    v-model="author.biography"
                                ></textarea>
                                <span v-if="errors.biography" class="text-danger">{{ errors.biography }}</span>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Author</button>
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
            author: {
                first_name: '',
                last_name: '',
                biography: ''
            },
            errors: {},
            successMessage: ''
        };
    },
    mounted() {
        this.fetchAuthor();
    },
    methods: {
        async fetchAuthor() {
            try {
                const response = await axios.get(`/api/authors/${this.$route.params.id}/edit`);
                this.author = response.data.data;
            } catch (error) {
                console.error('Error fetching author data:', error);
            }
        },
        async updateAuthor() {
            try {
                const response = await axios.put(`/api/authors/${this.$route.params.id}`, this.author);
                this.successMessage = response.data.message || 'Author updated successfully';
                this.errors = {};

                this.$router.push({ name: 'AuthorList' });
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = error.response.data.errors;
                } else {
                    console.error('Error updating author:', error);
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
