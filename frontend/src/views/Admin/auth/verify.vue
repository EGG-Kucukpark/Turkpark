<template>
  <!-- Error page-->
  <div class="misc-wrapper">
    <b-link class="brand-logo">

      <h2 class="brand-text text-primary ml-1">Türkpark </h2>
    </b-link>

    <div class="misc-inner p-2 p-sm-3">
      <div class="w-100 text-center">
        <h2 class="mb-1">Hesap Onaylandı 💪</h2>
        <p class="mb-2">Aşağıdaki butondan serüvenine başlayabilirsin! 🤘🏼</p>

        <b-button
          variant="primary"
          class="mb-2 btn-sm-block"
          :to="{ path: '/login' }"
        >
          Giriş Sayfası
        </b-button>

        <!-- image -->
        <b-img fluid :src="imgUrl" alt="Error page" />
      </div>
    </div>
  </div>
  <!-- / Error page-->
</template>

<script>
/* eslint-disable global-require */
import { BLink, BButton, BImg } from "bootstrap-vue";

import store from "@/store/index";
import axios from "axios";
const qs = (params) =>
  Object.keys(params)
    .map((key) => `${key}=${params[key]}`)
    .join("&");

export default {
  async beforeRouteEnter(to, from, next) {
    try {
      const { data } = await axios.post(
        `/api/email/verify/${to.params.id}?${qs(to.query)}`
      );

      next((vm) => {
        vm.success = data.status;
      });
    } catch (e) {
      next((vm) => {
        vm.error = e.response.data.status;
      });
    }
  },

  middleware: "guest",

  metaInfo() {
    return { title: this.$t("verify_email") };
  },
  components: {

    BLink,
    BButton,
    BImg,
  },
  data() {
    return {
      error: "",
      success: "",
      downImg: require("@/assets/images/pages/error.svg"),
    };
  },
  computed: {
    imgUrl() {
      if (store.state.appConfig.layout.skin === "dark") {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.downImg = require("@/assets/images/pages/error-dark.svg");
        return this.downImg;
      }
      return this.downImg;
    },
  },
};
</script>

<style lang="scss">
@import "@core/scss/vue/pages/page-misc.scss";
</style>
