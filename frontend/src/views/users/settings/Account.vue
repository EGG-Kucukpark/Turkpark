<template>
  <b-tabs
    vertical
    content-class="col-12 col-md-9 mt-1 mt-md-0"
    pills
    nav-wrapper-class="col-md-3 col-12"
    nav-class="nav-left"
  >
    <!-- general tab -->
    <b-tab active>
      <!-- title -->
      <template #title>
        <feather-icon icon="UserIcon" size="18" class="mr-50" />
        <span class="font-weight-bold">Genel</span>
      </template>

      <account-setting-general v-if="options" :options="options" />
    </b-tab>
    <!--/ general tab -->

    <!-- change password tab -->
    <b-tab>
      <!-- title -->
      <template #title>
        <feather-icon icon="LockIcon" size="18" class="mr-50" />
        <span class="font-weight-bold">Şifre İşlemleri</span>
      </template>

      <account-setting-password />
    </b-tab>
    <!--/ change password tab -->

    <!-- info -->

  </b-tabs>
</template>

<script>
import { BTabs, BTab } from "bootstrap-vue";
import AccountSettingGeneral from "./AccountSettingGeneral.vue";
import AccountSettingPassword from "./AccountSettingPassword.vue";


export default {
  components: {
    BTabs,
    BTab,
    AccountSettingGeneral,
    AccountSettingPassword,

  },
  setup() {
    var options = null;
    options = JSON.parse(localStorage.getItem("user"));

    return {
      options,
    };
  },
};
</script>
