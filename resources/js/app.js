import { createApp } from "vue";
import "./bootstrap"; // Import any other setup or global styles
import {App} from "vue";

const app = createApp(App); // Create the app instance with the root component
app.mount("#app"); // Mount the app to the DOM element with id 'app'
