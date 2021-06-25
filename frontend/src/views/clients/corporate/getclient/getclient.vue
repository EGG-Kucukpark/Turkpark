<template>
  <div>
    <b-breadcrumb style="margin: 18px" class="breadcrumb-slash">
      <b-breadcrumb-item to="/">
        <feather-icon icon="HomeIcon" size="20" variant="primary" />
      </b-breadcrumb-item>

      <b-breadcrumb-item style="font-size: 14px" to="/">
        Ana Sayfa
      </b-breadcrumb-item>

      <b-breadcrumb-item style="font-size: 14px" to="/clients">
        Kurumsal Firmalar
      </b-breadcrumb-item>

      <b-breadcrumb-item style="font-size: 14px" active
        >{{ userData.name }}
      </b-breadcrumb-item>
    </b-breadcrumb>
    <!-- Alert: No item found -->
    <b-alert variant="danger" :show="userData === undefined">
      <h4 class="alert-heading">Veri Çekilemedi</h4>
      <div class="alert-body">
        Bu ID'ye sahip firma bulunamadı. Diğer Firmalar için:
        <b-link class="alert-link" :to="{ name: 'firmalar' }">
          Firmalar
        </b-link>
      </div>
    </b-alert>

    <template v-if="userData">
      <b-tabs v-if="userData" pills>
        <!-- Tab: Account -->
        <b-tab active>
          <template #title>
            <feather-icon
              icon="BriefcaseIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline">Firma Bilgileri</span>
          </template>
          <clientinfo :user-data="userData" class="mt-2 pt-75" />
          <workers :user-data="userData" />
        </b-tab>

        <!-- Tab: Information -->
        <b-tab>
          <template #title>
            <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Ek Bilgiler</span>
          </template>
          <info :user-data="userData" class="mt-2 pt-75" />
        </b-tab>
        <b-tab>
          <template #title>
            <feather-icon icon="FileIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Firma notu</span>
          </template>
          <notes class="mt-2 pt-75" :user-data="userData" />
        </b-tab>

        <!-- Tab: Social -->
        <b-tab>
          <template #title>
            <feather-icon icon="FileIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Dosyalar</span>
          </template>
          <files class="mt-2 pt-75" :user-data="userData" />
        </b-tab>
      </b-tabs>
    </template>
  </div>
</template>

<script>
import store from "@/store";
import router from "@/router";
import { ref, onUnmounted } from "@vue/composition-api";
import {
  BRow,
  BCol,
  BAlert,
  BLink,
  BTabs,
  BTab,
  BButton,
  BBreadcrumb,
  BBreadcrumbItem,
} from "bootstrap-vue";

import userStoreModule from "../userStoreModule";
import clientinfo from "./clientinfo.vue";
import workers from "./workers.vue";
import notes from "./notes.vue";
import info from "./info.vue";
import files from "./files.vue";

export default {
  components: {
    BRow,
    BCol,
    BAlert,
    BBreadcrumb,
    BBreadcrumbItem,
    BLink,
    BTabs,
    BTab,
    BButton,

    // Local Components

    clientinfo,
    workers,
    notes,
    info,
    files,
  },
  setup() {
    const userData = ref(null);

    const USER_APP_STORE_MODULE_NAME = "app-user";

    // Register module
    if (!store.hasModule(USER_APP_STORE_MODULE_NAME))
      store.registerModule(USER_APP_STORE_MODULE_NAME, userStoreModule);

    // UnRegister on leave
    onUnmounted(() => {
      if (store.hasModule(USER_APP_STORE_MODULE_NAME))
        store.unregisterModule(USER_APP_STORE_MODULE_NAME);
    });

    store
      .dispatch("app-user/fetchUser", { id: router.currentRoute.params.id })
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
