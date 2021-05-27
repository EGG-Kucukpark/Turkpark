<template>
  <div>
    <!-- Alert: No item found -->
    <b-alert variant="danger" :show="userData === undefined">
      <h4 class="alert-heading">Error fetching user data</h4>
      <div class="alert-body">
        No user found with this user id. Check
        <b-link class="alert-link" :to="{ name: 'apps-users-list' }">
          User List
        </b-link>
        for other users.
      </div>
    </b-alert>

    <template v-if="userData">
      <!-- First Row -->
      <b-row>
        <b-col cols="15" xl="12" lg="10" md="9">
          <workerinfo :user-data="userData" />
        </b-col>
        <b-col cols="15" xl="12" lg="10" md="9"> </b-col>
      </b-row>

      <b-row>
        <b-col cols="15" xl="12" lg="10" md="9">
          <files :user-data="userData" />
        </b-col>
      </b-row>
    </template>
  </div>
</template>

<script>
import store from "@/store";
import router from "@/router";
import { ref, onUnmounted } from "@vue/composition-api";
import { BRow, BCol, BAlert, BLink, } from "bootstrap-vue";

import getworker from "./getworker";
import workerinfo from "./workerinfo.vue";
import files from "./workerfiles.vue";

export default {
  components: {
    BRow,
    BCol,
    BAlert,
    BLink,


    // Local Components

    workerinfo,
    files,
  },
  setup() {
    const userData = ref(null);

    const USER_APP_STORE_MODULE_NAME = "app-user";

    // Register module
    if (!store.hasModule(USER_APP_STORE_MODULE_NAME))
      store.registerModule(USER_APP_STORE_MODULE_NAME, getworker);

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(USER_APP_STORE_MODULE_NAME))
        store.unregisterModule(USER_APP_STORE_MODULE_NAME);
    });

    store
      .dispatch("app-user/fetchWorker", {
        id: router.currentRoute.params.id,
      })
      .then((response) => {
        userData.value = response.data;
      });

    return {
      userData,
    };
  },
};
</script>

<style>
</style>
