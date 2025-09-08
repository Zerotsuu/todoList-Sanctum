// resources/js/types/api.d.ts
declare module '@/api/auth' {
    import type { AxiosResponse } from 'axios';

    export function getCsrfCookie(): Promise<AxiosResponse<void>>;

    export function apiGet<T>(url: string): Promise<AxiosResponse<T>>;

    export function apiPost<T>(url: string, data?: any): Promise<AxiosResponse<T>>;

    export function apiDelete<T>(url: string): Promise<AxiosResponse<T>>;

    export function apiPut<T>(url: string, data?: any): Promise<AxiosResponse<T>>;
}
