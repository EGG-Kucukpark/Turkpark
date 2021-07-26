<template>
  <div>
    <template>
      <b-tabs pills>
        <!-- Tab: Account -->
        <b-tab active>
          <template #title>
            <feather-icon
              icon="FileMinusIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline"> Eğitimler </span>
          </template>
          <egitimler :user="user" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Information -->
        <b-tab v-if="show">
          <template #title>
            <feather-icon icon="ArchiveIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Eğitim İşlemleri</span>
          </template>
          <egitimislem class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Social -->
      </b-tabs>
    </template>
  </div>
</template>

<script>
import { BRow, BCol, BAlert, BLink, BTabs, BTab, BButton } from "bootstrap-vue";
import egitimler from "./egitimler";

import egitimislem from "./egitim-islem";

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

    egitimler,
    egitimislem,
  },
  data() {
    return {
      show: true,
      user: false,
    };
  },
  created() {
    var user = JSON.parse(localStorage.getItem("user"));
    if (user.role === "Firma") {
      this.show = false;
      this.user = true;
    }
  },
};
</script>


