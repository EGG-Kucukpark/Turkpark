<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">
      <!-- Brand logo-->

      <!-- /Brand logo-->

      <!-- Left Text-->
      <b-col lg="8" class="d-none d-lg-flex align-items-center p-5">
        <div
          class="w-100 d-lg-flex align-items-center justify-content-center px-5"
        >
          <b-img fluid :src="imgUrl" alt="Forgot password V2" />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Forgot password-->
      <b-col lg="4" class="d-flex align-items-center auth-bg px-2 p-lg-5">
        <b-col sm="8" md="6" lg="12" class="px-xl-2 mx-auto">
          <b-card-title title-tag="h2" class="font-weight-bold mb-1">
            E-posta doğrulamasını yeniden gönder. 🔒
          </b-card-title>
          <b-card-text class="mb-2">
            E-postanızı girin ve size aktivasyon için talimat
            gönderelim.
          </b-card-text>

          <template v-if="show">
            <b-alert
              style="height: 55px; text-align: center; padding-top: 10px"
              show
              variant="danger"
            >
              <p>{{ error }}</p>
            </b-alert>
          </template>

          <!-- form -->
          <validation-observer ref="simpleRules">
            <b-form
              class="auth-forgot-password-form mt-2"
              @submit.prevent="validationForm"
            >
              <b-form-group label="E-Posta" label-for="forgot-password-email">
                <validation-provider
                  #default="{ errors }"
                  name="Email"
                  rules="required|email"
                >
                  <b-form-input
                    id="forgot-password-email"
                    v-model="email"
                    :state="errors.length > 0 ? false : null"
                    name="forgot-password-email"
                    placeholder="john@example.com"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <b-button v-if="spin" type="submit" variant="primary" block>
                <b-spinner class="mr-1" Small Spinner variant="light" />
              </b-button>

              <b-button
                v-if="spin === false"
                type="submit"
                variant="primary"
                block
              >
                Aktivasyon Linkini Gönder
              </b-button>
            </b-form>
          </validation-observer>

          <p class="text-center mt-2">
            <b-link :to="{ name: 'login' }">
              <feather-icon icon="ChevronLeftIcon" /> Giriş Sayfasına Geri Dön
            </b-link>
          </p>
        </b-col>
      </b-col>
      <!-- /Forgot password-->
    </b-row>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { ValidationProvider, ValidationObserver } from "vee-validate";
import VuexyLogo from "@core/layouts/components/Logo.vue";
import {
  BRow,
  BCol,
  BLink,
  BCardTitle,
  BCardText,
  BImg,
  BForm,
  BFormGroup,
  BFormInput,
  BButton,
  BAlert,
  BSpinner,
} from "bootstrap-vue";
import { required, email } from "@validations";
import store from "@/store/index";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import axios from "@axios";

export default {
  components: {
    VuexyLogo,
    BRow,
    BCol,
    BLink,
    BImg,
    BForm,
    BButton,
    BFormGroup,
    BFormInput,
    BCardTitle,
    BCardText,
    ValidationProvider,
    ValidationObserver,
    BAlert,
    BSpinner,
  },

  data() {
    return {
      email: "",
      show: false,

      error: "",
      spin: false,

      sideImg: require("@/assets/images/pages/forgot-password-v2.svg"),
      // validation
      required,
      email,
    };
  },

  computed: {
    imgUrl() {
      if (store.state.appConfig.layout.skin === "dark") {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require("@/assets/images/pages/forgot-password-v2-dark.svg");
        return this.sideImg;
      }
      return this.sideImg;
    },
  },
  methods: {
    validationForm() {
      this.$refs.simpleRules
        .validate()
        .then((success) => {
          this.spin = true;
        })
        .then(
          axios
            .post("/api/email/resend", { email: this.email })
            .then((res) => {
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: "E-Posta Gönderildi.",
                  icon: "EditIcon",
                  variant: "success",
                },
              }),
                this.spin = false;
            })
            .catch((error) => {
              this.show = true;
              this.spin = false;

              if (error.response.data.email) {
                this.error = error.response.data.email;
              } else {
                this.error = "Lütfen Düzgün Bir E-Posta Değeri Giriniz.";
              }
            })
        );
    },
  },
};
</script>

<style lang="scss">
@import "@core/scss/vue/pages/page-auth.scss";
</style>
