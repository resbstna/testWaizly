import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './index.css'
import axios from 'axios'
import 'flowbite/dist/flowbite.js';
import './sidebar.js';
import './charts.js';


// axios base url
axios.defaults.baseURL = 'http://localhost:8000/api/';

//header token
axios.defaults.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;

const app = createApp(App)


app.use(router)

app.mount('#app')
