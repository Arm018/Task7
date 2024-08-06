<template>
    <div class="login-container">
        <form @submit.prevent="login">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" v-model="password" required>
            </div>
            <button type="submit">Login</button>
            <div v-if="error" class="error-message">{{ error }}</div>
        </form>
        <div v-if="response" class="response-container">
            <h3>Response:</h3>
            <pre>{{ response }}</pre>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref } from 'vue';

export default {
    name: 'LoginComponent',
    setup() {
        const email = ref('');
        const password = ref('');
        const error = ref('');
        const response = ref(null);

        const login = async () => {
            try {
                const res = await axios.post('/admin/login', {
                    email: email.value,
                    password: password.value
                });

                const token = `${res.data.token_type} ${res.data.token}`;
                localStorage.setItem('authToken', token);

                axios.defaults.headers.common['Authorization'] = token;

                response.value = {
                    token: res.data.token,
                    token_type: res.data.token_type,
                    expires_in: res.data.expires_in
                };

            } catch (err) {
                if (err.response && err.response.data && err.response.data.message) {
                    error.value = err.response.data.message;
                } else {
                    error.value = 'An error occurred. Please try again.';
                }
            }
        };

        return {
            email,
            password,
            error,
            response,
            login
        };
    }
};
</script>

<style scoped>
.login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.error-message {
    color: red;
    margin-top: 10px;
}

.response-container {
    margin-top: 20px;
}

.response-container pre {
    background-color: #f8f9fa;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
</style>
