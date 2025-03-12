import './bootstrap';

// setup axios
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// setup htmx
//htmx.config.defaultSwapStyle = 'none';

