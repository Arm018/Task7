<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Books List</h2>
                        <router-link to="/admin/books/create" class="btn btn-primary float-right">Create New Book</router-link>
                    </div>
                    <div class="card-body">
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <div v-if="books.length > 0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Publication Year</th>
                                    <th>Author</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="book in books" :key="book.id">
                                    <td>{{ book.title }}</td>
                                    <td>{{ book.description }}</td>
                                    <td>{{ book.publication_year }}</td>
                                    <td>
                                        <span v-for="author in book.authors" :key="author.id">{{ author.first_name }} </span>
                                    </td>
                                    <td>
                                        <router-link :to="`/admin/books/${book.id}/edit`" class="btn btn-warning btn-sm">Edit</router-link>
                                        <button @click="deleteBook(book.id)" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>
                            <div class="alert alert-info">
                                No books found.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const books = ref([]);
const successMessage = ref('');

const fetchBooks = async () => {
    try {
        const response = await axios.get('/api/books');
        books.value = response.data.data;
    } catch (error) {
        console.error('Error fetching books:', error);
    }
};

const deleteBook = async (id) => {
    try {
        await axios.delete(`/api/books/${id}`);
        successMessage.value = 'Book deleted successfully.';
        await fetchBooks();
    } catch (error) {
        console.error('Error deleting book:', error);
    }
};

onMounted(fetchBooks);
</script>

