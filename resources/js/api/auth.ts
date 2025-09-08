import axios from 'axios';

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

export async function getCsrfCookie() {
    await axios.get('/sanctum/csrf-cookie');
}

export async function apiGet<T>(url:string) {
    return axios.get<T>(url);
}

export async function apiPost<T>(url:string, data?:any) {
    return axios.post<T>(url, data);
}

export async function apiDelete<T>(url:string) {
    return axios.delete<T>(url);
}

export async function apiPut<T>(url:string, data?:any) {
    return axios.put<T>(url, data);
}