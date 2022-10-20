import axios from "axios";

const baseUrl = 'http://'+import.meta.env.VITE_API_BACKEND_ADDRESS + ':'+import.meta.env.VITE_API_BACKEND_PORT+'/api'

export default axios.create({
    baseURL: baseUrl,
    headers: {
        "Content-type": "application/json",
        "Access-Control-Allow-Origin": "*"
    }
});