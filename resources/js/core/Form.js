import Error from './Error'

class Form {
    constructor(data) {
        this.originalData = data

        for(let field in data) {
            this[field] = data[field]
        }

        this.errors = new Error()
        
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear()
    }

    data() {

        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }

    submit(requestType, url) {

        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data);

                    resolve(response.data);
                })
                .catch(error => {
                    this.onFail(error.response.data.errors);

                    reject(error.response.data.errors);
                });     
        });
        
    }

    onSuccess(data) {

        // alert(data.message);
        this.message = data.message
        this.reset();
    }

    onFail(errors) {
        this.errors.set(errors);
        // console.log(error);
    }

}

export default Form