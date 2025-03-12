import Alpine from 'alpinejs'
import axios from 'axios';

// setup axios
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// setup alpine
window.Alpine = Alpine
Alpine.start()

