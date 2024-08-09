<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Add New Author</h3>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="submitForm">
                            <div class="form-group">
                                <label for="first_name">First Name:</label>
                                <input
                                    type="text"
                                    id="first_name"
                                    v-model="form.first_name"
                                    class="form-control"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name:</label>
                                <input
                                    type="text"
                                    id="last_name"
                                    v-model="form.last_name"
                                    class="form-control"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label for="biography">Biography:</label>
                                <textarea
                                    id="biography"
                                    v-model="form.biography"
                                    class="form-control"
                                    rows="5"
                                    required
                                ></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Author</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
    setup() {
        const router = useRouter();
        const form = ref({
            first_name: '',
            last_name: '',
            biography: ''
        });

        const submitForm = async () => {
            try {
                await axios.post('/api/authors', form.value);
                router.push('/admin/authors'); // Redirect to authors list or another page
            } catch (error) {
                console.error('Error adding author:', error);
                // Handle errors, such as showing an error message
            }
        };

        return {
            form,
            submitForm
        };
    }
};
</script>

<style scoped>
/* Add any additional styles here */
</style>
