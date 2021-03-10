<template>
  <div>
    <!-- <Alert :show="showAlert" :message="alertMessage" :status="alertStatus" /> -->
    <div v-if="deleted" class="alert alert-success">Deleted successfully!</div>

    <table class="table">
      <thead>
        <tr class="d-flex">
          <th class="col-3">Name</th>
          <th class="col-3">Email</th>
          <th class="col-3">Created</th>
          <th class="col-3"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in laravelData.data" :key="user.id" class="d-flex">
          <template v-if="user.id !== userId">
            <td class="col-3">{{ user.name }}</td>
            <td class="col-3">{{ user.email }}</td>
            <td class="col-3">{{ user.created_at | formatDate }}</td>
            <td class="col-3">
              <a :href="'/users/' + user.id + '/edit'" class="btn btn-secondary"
                >Edit</a
              >
              <button @click="deleteUser(user.id)" class="btn btn-danger">
                Delete
              </button>
            </td>
          </template>
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
import api from "../api/users";

export default {
  name: "UsersList",
  props: ["userId"],
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
      });
    },
    deleteUser(id) {
      api.delete(id).then((response) => {
        console.log(response);
        this.deleted = true;

        this.laravelData.data = this.laravelData.data.filter(
          (el) => el.id !== id
        );
      });
    },
  },
  filters: {
    formatDate: function (date) {
      return moment(date).format("YYYY-MM-DD HH:mm:ss");
    },
  },
  created() {
    this.getResults();
  },
};
</script>