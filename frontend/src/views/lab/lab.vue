<template>
  <div>
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
            <span class="d-none d-sm-inline"> Firma Sonuçları </span>
          </template>
          <client :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Information -->
        <b-tab v-if="show">
          <template #title>
            <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Bireysel Sonuçlar</span>
          </template>
          <individual :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Social -->
      </b-tabs>
    </template>
  </div>
</template>

<script>

import { ref } from "@vue/composition-api";
import { BRow, BCol, BAlert, BLink, BTabs, BTab, BButton } from "bootstrap-vue";
import individual from "./individual";
import client from "./client";

export default {
  components: {
    BRow,
    BCol,
    BAlert,
    BLink,
    BTabs,
    BTab,
    BButton,

    // Local Components

    individual,
    client,
  },
  data() {
    return {
      show: true,
    };
  },
  created() {
    var user =  JSON.parse(localStorage.getItem("user"));
    if (user.role == "Client") {
      this.show = false
    }
  },
  setup() {
    const userData = ref(null);
    userData.value = JSON.parse(localStorage.getItem("user"));

    return {
      userData,
    };
  },
};
</script>

<style>
</style>
