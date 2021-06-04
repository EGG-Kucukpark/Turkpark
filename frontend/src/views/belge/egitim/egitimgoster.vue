<template>
  <div>
    <template>
      <egitiminfo class="mt-2 pt-75" />
      <musteriler @submit-event="submit" class="mt-2 pt-75" />
    </template>
  </div>
</template>

<script>
import { BRow, BCol, BAlert, BLink, BTabs, BTab, BButton } from "bootstrap-vue";

import egitiminfo from "./egitiminfo.vue";
import musteriler from "./musteriler.vue";

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
  },

  methods: {
    submit() {
      alert("Deniz");
    },
  },
};
</script>

<style>
</style>
