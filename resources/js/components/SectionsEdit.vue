<template>
  <div>
    <div v-if="success" class="alert alert-success">Updated successfully!</div>

    <form
      method="POST"
      @submit.prevent="onSubmit"
      enctype="multipart/form-data"
    >
      <div class="form-group">
        <label for="name">Name</label>
        <input
          v-model="form.name"
          :class="['form-control', form.errors.has('name') ? 'is-invalid' : '']"
          id="name"
          type="text"
        />

        <span
          v-if="form.errors.has('name')"
          class="invalid-feedback d-inline"
          role="alert"
        >
          <strong>{{ form.errors.get("name") }}</strong>
        </span>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          v-model="form.description"
          :class="[
            'form-control',
            form.errors.has('description') ? 'is-invalid' : '',
          ]"
          id="description"
          cols="30"
          rows="5"
        ></textarea>

        <span
          v-if="form.errors.has('description')"
          class="invalid-feedback d-inline"
          role="alert"
        >
          <strong>{{ form.errors.get("description") }}</strong>
        </span>
      </div>

      <label class="form-label">Logo</label>
      <div class="custom-file form-group">
        <input
          @change="onFileChange"
          type="file"
          :class="[
            'custom-file-input',
            form.errors.has('logo') ? 'is-invalid' : '',
          ]"
          id="logo"
        />
        <label class="custom-file-label" for="logo">{{ filename }}</label>

        <span
          v-if="form.errors.has('logo')"
          class="invalid-feedback d-inline"
          role="alert"
        >
          <strong>{{ form.errors.get("logo") }}</strong>
        </span>
      </div>

      <h2 class="mt-3">Users</h2>
      <div v-for="user in usersList" :key="user.id" class="form-group mt-3">
        <div class="custom-control custom-checkbox">
          <input
            @click="toggleUser(user.id)"
            type="checkbox"
            class="custom-control-input"
            :checked="isChecked(user.id)"
            :id="'user-' + user.id"
          />
          <label class="custom-control-label" :for="'user-' + user.id">{{
            user.name
          }}</label>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Send</button>
    </form>
  </div>
</template>

<script>
import apiUsers from "../api/users";
import api from "../api/sections";

import Form from "../core/Form";


export default {
  name: "SectionsEdit",
  props: ["sectionId"],
  data() {
    return {
      form: new Form({
        name: "",
        description: "",
        logo: "",
        users: [],
        _method: 'put'
      }),

      usersList: [],

      success: false,
      filename: "",
    };
  },
  methods: {
    onSubmit() {
      var formData = new FormData();

      Object.keys(this.form.data()).forEach((k) => {
        formData.append(k, this.form.data()[k]);
      });

      // console.log(formDataEdit);
      // Object.keys(this.form.data()).forEach(e => console.log(`key=${e}  value=${this.form.data()[e]}`));

      api
        .update(this.sectionId, formData)
        .then(_ => {
          
          this.form.errors.clear()
          this.filename = ""
          this.success = true
        })
        .catch((error) => {
          this.form.onFail(error.response.data.errors)
          this.success = false
        });
    },

    isChecked(id) {
      return this.form.users.includes(id);
    },

    toggleUser(id) {
      if (this.form.users.find((el) => el == id)) {
        this.form.users = this.form.users.filter((item) => item != id);
      } else {
        this.form.users.push(id);
      }
    },

    onFileChange(e) {
      this.filename = e.target.files[0].name;
      this.form.logo = e.target.files[0];

      // console.log(e.target.files[0])
    },
  },
  created() {
    api.find(this.sectionId).then((response) => {
      // console.log(response.data.section)
      let data = response.data;

      this.form.name = data.section.name;
      this.form.description = data.section.description;
      this.form.users = data.users;

      // console.log(this.form)
    });

    apiUsers.all().then((response) => {
      // console.log(response.data.data)
      this.usersList = response.data.data;
    });
  },
};
</script>

<style scoped>
</style>