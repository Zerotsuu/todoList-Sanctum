import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

export async function getCsrfCookie() {
    await axios.get('/sanctum/csrf-cookie');
}

export async function apiGet(url) {
    return axios.get(url);
}

export async function apiPost(url, data) {
    return axios.post(url, data);
}

export async function apiDelete(url) {
    return axios.delete(url);
}

export async function apiPut(url, data) {
    return axios.put(url, data);
}