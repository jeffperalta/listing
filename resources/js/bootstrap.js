import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Add CSRF token from meta
const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}