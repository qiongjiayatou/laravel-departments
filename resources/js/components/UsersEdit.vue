<template>
  <form method="POST" @submit.prevent="onSubmit">
    <div v-if="success" class="alert alert-success">Successfully updated!</div>

    <div class="form-group">
      <label for="name">Name</label>
      <input
        v-model="form.name"
        id="name"
        type="text"
        :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
      />
      <span
        v-if="form.errors.has('name')"
        class="invalid-feedback"
        role="alert"
      >
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
        :class="[
          'form-control',
          form.errors.has('password') ? 'is-invalid' : '',
        ]"
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
import Form from "../core/Form"
import api from "../api/users"

export default {
  name: "UsersEdit",
  props: ["userId"],
  data() {
    return {
      form: new Form({
        id: null,
        name: '',
        email: '',
        password: '',
      }),

      success: false,
    };
  },
  methods: {
    onSubmit() {

      this.form.submit('put', `/api/users/${this.userId}`)
        .then(response => {
          this.success = true
          this.form.name = response.data.name
          this.form.email = response.data.email

          // console.log(response)
        }) 
        .catch(_ => {
          this.success = false
        })

    },
  },
  created() {

    api.find(this.userId)
      .then(({ data }) => {
        console.log(data.data.name)
        this.form.name = data.data.name
        this.form.email = data.data.email
      })

  },
};
</script>