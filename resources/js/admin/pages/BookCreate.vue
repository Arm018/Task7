<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Create New Book</h2>
                    </div>
                    <div class="card-body">
                        <div v-if="errors.length" class="alert alert-danger">
                            <ul>
                                <li v-for="error in errors" :key="error">{{ error }}</li>
                            </ul>
                        </div>
                        <form @submit.prevent="submitForm">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input v-model="form.title" type="text" id="title" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea v-model="form.description" id="description" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="publication_year">Publication Year:</label>
                                <input v-model="form.publication_year" type="number" id="publication_year" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="authors">Authors:</label>
                                <select v-model="form.authors" id="authors" class="form-control" multiple>
                                    <option v-for="author in authors" :value="author.id" :key="author.id">
                                        {{ author.first_name }}
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Create Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();
const form = ref({
    title: '',
    description: '',
    publication_year: '',
    authors: [],
});

const errors = ref([]);
const authors = ref([]);

const fetchAuthors = async () => {
    try {
        const response = await axios.get('/api/authors');
        authors.value = response.data.data;
    } catch (error) {
        console.error('Error fetching authors:', error);
    }
};

const submitForm = async () => {
    try {
        const response = await axios.post('/api/books', form.value);
        router.push('/admin/books');
    } catch (error) {
        if (error.response && error.response.data.errors) {
            errors.value = Object.values(error.response.data.errors).flat();
        } else {
            console.error('Error creating book:', error);
        }
    }
};

onMounted(fetchAuthors);
</script>
