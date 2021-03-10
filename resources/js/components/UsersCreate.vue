<template>
  <form method="POST" @submit.prevent="onSubmit">
    <div v-if="success" class="alert alert-success">
        Successfully created!
    </div>

    <div class="form-group">
      <label for="name">Name</label>
      <input
        v-model="form.name"
        id="name"
        type="text"
        :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
      />
      <span v-if="form.errors.has('name')" class="invalid-feedback" role="alert">
        <strong>{{ form.errors.get("name") }}</strong>
      </span>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input
        v-model="form.email"
        id="email"
        type="email"
        :class="['form-control', form.errors.has('email') ? 'is-invalid' : '']"
      />
      <span
        v-if="form.errors.has('email')"
        class="invalid-feedback d-inline"
        role="alert"
      >
        <strong>{{ form.errors.get("email") }}</strong>
      </span>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input
        v-model="form.password"
        id="password"
        type="password"
        :class="['form-control', form.errors.has('password') ? 'is-invalid' : '']"
      />
      <span
        v-if="form.errors.has('password')"
        class="invalid-feedback d-inline"
        role="alert"
      >
        <strong>{{ form.errors.get("password") }}</strong>
      </span>
    </div>

    <button type="submit" class="btn btn-primary">Send</button>
  </form>
</template>

<script>
import Form from "../core/Form";

export default {
  name: "UsersCreate",
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        password: "",
      }),

      success: false

    };
  },
  methods: {
    onSubmit() {
        this.form.submit('post', '/api/users')
            .then(data => {
                this.success = true
                console.log(data)
            })
            .catch(error => {
                this.success = false
                console.log(error)
            })

    },
  },
};
</script>