/*
 * Import remote dependencies.
 */
import axios from 'axios';

/*
 * Create a Api object with Axios and
 * configure it for the WordPRess Rest Api.
 *
 * The 'mynamespace' object is injected into the page
 * using the WordPress wp_localize_script function.
 */
const api = axios.create({
    baseURL: coachingData.root_url,
    headers: {
        'content-type': 'application/json',
        'X-WP-Nonce': coachingData.api_nonce
    }
});

export default api;
