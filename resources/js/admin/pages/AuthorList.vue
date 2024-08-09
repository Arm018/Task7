<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Authors List</h2>
                        <router-link to="/admin/authors/create" class="btn btn-primary float-right">Add New Author</router-link>
                    </div>
                    <div class="card-body">
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <div v-if="authors.length > 0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Biography</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="author in authors" :key="author.id">
                                    <td>{{ author.first_name }}</td>
                                    <td>{{ author.last_name }}</td>
                                    <td>{{ author.biography }}</td>
                                    <td>
                                        <router-link :to="`/admin/authors/${author.id}/edit`" class="btn btn-warning btn-sm">Edit</router-link>
                                        <button @click="deleteAuthor(author.id)" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>
                            <p>No authors available.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const authors = ref([]);
        const successMessage = ref('');

        const fetchAuthors = async () => {
            try {
                const response = await axios.get('/api/authors');
                authors.value = response.data.data;
            } catch (error) {
                console.error('Error fetching authors:', error);
            }
        };

        const deleteAuthor = async (id) => {
            if (confirm('Are you sure you want to delete this author?')) {
                try {
                    await axios.delete(`/api/authors/${id}`);
                    successMessage.value = 'Author deleted successfully.';
                    await fetchAuthors();
                } catch (error) {
                    console.error('Error deleting author:', error);
                }
            }
        };

        onMounted(fetchAuthors);

        return {
            authors,
            successMessage,
            deleteAuthor
        };
    }
};
</script>

