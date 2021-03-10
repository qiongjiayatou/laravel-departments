<template>
  <div>
    <div v-if="deleted" class="alert alert-success">Deleted successfully!</div>

    <table class="table">
      <!-- <thead>
        <tr class="d-flex">
          <th class="col-2">Image</th>
          <th class="col-5">Info</th>
          <th class="col-3">Users</th>
          <th class="col-2"></th>
        </tr>
      </thead> -->
      <tbody>
        <tr
          v-for="section in laravelData.data"
          :key="section.id"
          class="d-flex"
        >
          <td class="col-2">
            <img
              :src="'/storage/logo/' + section.logo"
              :alt="section.logo"
              class="img-thumbnail d-block mx-auto"
              style="width: 10rem; height: 10rem"
            />
          </td>
          <td class="col-5">
            <div>
              <h5>{{ section.name }}</h5>
            </div>
            <div>
              {{ section.description }}
            </div>
          </td>
          <td class="col-3">
            <div v-if="section.users.length > 0">
              <h5>Users</h5>
              <ul>
                <li
                  v-for="user in section.users"
                  :key="user.id"
                  style="list-style-type: none"
                >
                  {{ user.name }}
                </li>
              </ul>
            </div>
          </td>
          <td class="col-2">
            <a
              :href="'/sections/' + section.id + '/edit'"
              class="btn btn-secondary"
              >Edit</a
            >
            <button @click="deleteSection(section.id)" class="btn btn-danger">
              Delete
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="mt-3">
      <pagination
        :data="laravelData"
        @pagination-change-page="getResults"
      ></pagination>
    </div>
  </div>
</template>

<script>
import moment from "moment";
// import apiUsers from "../api/users";
import api from "../api/sections";

import axios from "axios";

export default {
  name: "SectionsList",
  components: {},
  data() {
    return {
      deleted: false,

      laravelData: {},
    };
  },
  methods: {
    getResults(page) {
      api.getPage(page).then((response) => {
        this.laravelData = response.data;
        console.log(response.data);
      });
    },
    deleteSection(id) {
      api
        .delete(id)
        .then((_) => {
          this.deleted = true;

          this.laravelData.data = this.laravelData.data.filter(
            (el) => el.id !== id
          );
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  created() {
    this.getResults();
  },
};
</script>