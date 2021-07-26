<template>
  <div>
    <template>
      <egitiminfo class="mt-2 pt-75" />
      <musteriler v-if="user === false" class="mt-2 pt-75" />
      <useregitimler v-if="user != false" class="mt-2 pt-75" />
    </template>
  </div>
</template>

<script>
import { BRow, BCol, BAlert, BLink, BTabs, BTab, BButton } from "bootstrap-vue";

import egitiminfo from "./egitiminfo.vue";
import musteriler from "./musteriler.vue";
import useregitimler from "@/views/User/kursiyer/egitimler.vue";

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

    egitiminfo,
    musteriler,
    useregitimler,
  },
  data() {
    return {
      user: false,
    };
  },
  created() {
    var user = JSON.parse(localStorage.getItem("user"));
    if (user.role === "Firma") {
      this.user = true;
    }
  },
};
</script>

<style>
</style>
