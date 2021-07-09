<template>
  <div>
    <div style="margin-bottom: 20px; ">
      <h2 class="content-header-title float-left pr-1 mb-0">Bilgiler</h2>


      <b-breadcrumb class="breadcrumb-chevron mb-0">
        <b-breadcrumb-item to="/"> <feather-icon size="15" icon="HomeIcon"/> </b-breadcrumb-item>

        <b-breadcrumb-item :to="path" style="font-size:15px;"> {{firma.name}} </b-breadcrumb-item>
      </b-breadcrumb>
    </div>
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
import axios from '@axios'
import { ref, onUnmounted } from "@vue/composition-api";
import {
  BRow,
  BCol,
  BAlert,
  BLink,
  BBreadcrumb,
  BBreadcrumbItem,
} from "bootstrap-vue";

import getworker from "./getworker";
import workerinfo from "./workerinfo.vue";
import files from "./workerfiles.vue";

export default {
  data() {
    return { path: null, firma:null };
  },

  components: {
    BRow,
    BCol,
    BAlert,
    BLink,
    BBreadcrumb,
    BBreadcrumbItem,

    // Local Components

    workerinfo,
    files,
  },

  created() {
    const path = localStorage.getItem("path");
    const id = path.slice(8);
    axios('/api/firmagoster/' + id).then((res) => this.firma = res.data);
    this.path = path;
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
