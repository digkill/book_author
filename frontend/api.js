import axios from 'axios';

const axiosClient = axios.create({
    baseURL: 'http://books.loc/api/',
    responseType: 'json',
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

export default {
    getList: url => axiosClient.get(url).then(res => res.data),
    getTop10: url => axiosClient.get(url).then(res => res.data),
}