import axios from 'axios';

axios.defaults.withCredentials = true;

async function getCsrfCookie() {
    await axios.get('/sanctum/csrf-cookie');
}

export async function login(email, password) {
    await getCsrfCookie();
    return axios.post('/login', { email, password });
}

export async function logout() {
    return axios.post('/logout');
}

export async function apiGet(url) {
    return axios.get(url);
}

export async function apiPost(url, data) {
    return axios.post(url, data);
}