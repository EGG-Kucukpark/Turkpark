<template>
  <div>
    <!-- Alert: No item found -->


    <template >
      <b-tabs  pills>
        <!-- Tab: Account -->
        <b-tab active>
          <template #title>
            <feather-icon
              icon="HeartIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline">Sonuçlar</span>
          </template>


        </b-tab>

        <!-- Tab: Information -->
        <b-tab>
          <template #title>
            <feather-icon icon="UsersIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Kullanıcılar</span>
          </template>

        </b-tab>
        <b-tab>
          <template #title>
            <feather-icon icon="BriefcaseIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Firmalar</span>
          </template>

        </b-tab>



      </b-tabs>
    </template>
  </div>
</template>

<script>

import router from "@/router";

import { BRow, BCol, BAlert, BLink, BTabs, BTab, BButton } from "bootstrap-vue";



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


  },
  setup() {

  },
};
</script>

<style>
</style>
