import axios from 'axios'

const config = {
  headers: {
    "content-type": "multipart/form-data",
  },
};

export default {

    all() {
        return axios.get('/api/sections');
    },
    find(id) {
        return axios.get(`/api/sections/${id}`);
    },
    store(data) {
        return axios.post(`/api/sections`, data, config);
    },
    update(id, data) {
        return axios.post(`/api/sections/${id}`, data, config);
    },
    delete(id) {
        return axios.delete(`/api/sections/${id}`)
    },
    getPage(page = 1) {
        return axios.get(`/api/sections?page=${page}`)
    }

}