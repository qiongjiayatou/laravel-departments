class Error {
    constructor() {
        this.errors = {}
    }



    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0]
        }
    }

    set(errors) {
        this.errors = errors
    }

    has(field) {
        return this.errors.hasOwnProperty(field)
    }

    any() {
        return Object.keys(this.errors).length > 0
    }

    clear() {
        this.errors = {}
    }
    
}

export default Error