<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">
      <!-- Brand logo-->
      <b-link class="brand-logo"> </b-link>
      <!-- /Brand logo-->

      <!-- Left Text-->
      <b-col lg="8" class="d-none d-lg-flex align-items-center p-5">
        <div
          class="w-100 d-lg-flex align-items-center justify-content-center px-5"
        >
          <b-img fluid :src="imgUrl" alt="Login V2" />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Login-->
      <b-col lg="4" class="d-flex align-items-center auth-bg px-2 p-lg-5">
        <b-col sm="8" md="6" lg="12" class="px-xl-2 mx-auto">
          <b-card-title title-tag="h2" class="font-weight-bold mb-1">
            Türkpark'a Hoşgeldiniz! 👋
          </b-card-title>
          <b-card-text class="mb-2">
            E-posta ve şifreniz ile güvenli giriş yapabilirsiniz.
          </b-card-text>

          <template v-if="show">
            <b-alert show variant="warning">
              <h4 class="alert-heading">{{ error }}</h4>
            </b-alert>
          </template>
          <template v-if="show2">
            <b-alert show variant="danger">
              <h4 class="alert-heading">{{ error }}</h4>
            </b-alert>
          </template>

          <!-- form -->
          <validation-observer ref="loginValidation">
            <b-form class="auth-login-form mt-2" @submit.prevent>
              <b-link :to="{ name: 'email.request' }">
                <small style="float: right">Doğrulamayı Yeniden Gönder.</small>
              </b-link>
              <!-- email -->

              <b-form-group label="E-posta Adresiniz:" label-for="login-email">
                <validation-provider
                  #default="{ errors }"
                  name="Email"
                  rules="required|email"
                >
                  <b-form-input
                    id="login-email"
                    v-model="email"
                    :state="errors.length > 0 ? false : null"
                    name="login-email"
                    placeholder="john@example.com"
                  />

                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <!-- forgot password -->
              <b-form-group>
                <div class="d-flex justify-content-between">
                  <label for="login-password">Şifreniz:</label>
                  <b-link :to="{ name: 'password.request' }">
                    <small>Şifreni mi unuttun?</small>
                  </b-link>
                </div>
                <validation-provider
                  #default="{ errors }"
                  name="Şifre"
                  rules="required"
                >
                  <b-input-group
                    class="input-group-merge"
                    :class="errors.length > 0 ? 'is-invalid' : null"
                  >
                    <b-form-input
                      id="login-password"
                      v-model="password"
                      :state="errors.length > 0 ? false : null"
                      class="form-control-merge"
                      :type="passwordFieldType"
                      name="login-password"
                      placeholder="············"
                    />
                    <b-input-group-append is-text>
                      <feather-icon
                        class="cursor-pointer"
                        :icon="passwordToggleIcon"
                        @click="togglePasswordVisibility"
                      />
                    </b-input-group-append>
                  </b-input-group>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <!-- checkbox -->

              <!-- submit buttons -->

              <b-button
                v-if="spin === true"
                type="submit"
                variant="primary"
                block
                @click="validationForm"
              >
                <b-spinner class="mr-1" Small Spinner :variant="light" />
              </b-button>

              <b-button
                v-if="spin === false"
                type="submit"
                variant="primary"
                block
                @click="validationForm"
              >
                Giriş Yap
              </b-button>
            </b-form>
          </validation-observer>

          <b-card-text class="text-center mt-2">
            <span>Hesabınız yok mu? </span>
            <b-link :to="{ name: 'register' }">
              <span>&nbsp;Hesap oluştur!</span>
            </b-link>
          </b-card-text>

          <!-- divider -->
          <div class="divider my-2">
            <div class="divider-text">ya da</div>
          </div>

          <!-- social buttons -->
          <div class="auth-footer-btn d-flex justify-content-center">
            <b-button variant="outline-facebook">
              <feather-icon icon="FacebookIcon" /> Facebook
            </b-button>

            <b-button variant="outline-google">
              <feather-icon icon="MailIcon" /> Google
            </b-button>
            <b-button variant="outline-github" href="javascript:void(0)">
              <feather-icon icon="GithubIcon" /> Github
            </b-button>
          </div>
        </b-col>
      </b-col>
      <!-- /Login-->
    </b-row>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { ValidationProvider, ValidationObserver } from "vee-validate";
import VuexyLogo from "@/assets/images/logo/logo.png";

import {
  BRow,
  BCol,
  BLink,
  BFormGroup,
  BFormInput,
  BInputGroupAppend,
  BInputGroup,
  BFormCheckbox,
  BCardText,
  BCardTitle,
  BImg,
  BForm,
  BAlert,
  BButton,
  BSpinner,
} from "bootstrap-vue";
import { required, email } from "@validations";
import { togglePasswordVisibility } from "@core/mixins/ui/forms";
import store from "@/store/index";
import { mapActions } from "vuex";
import axios from "@axios";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";

export default {
  components: {
    BRow,
    BCol,
    BLink,
    BFormGroup,
    BFormInput,
    BInputGroupAppend,
    BInputGroup,
    BFormCheckbox,
    BCardText,
    BCardTitle,
    BImg,
    BForm,
    BButton,
    VuexyLogo,
    ValidationProvider,
    BAlert,
    ValidationObserver,
    BSpinner,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      password: "",
      email: "",

      sideImg: require("@/assets/images/pages/login-v2.svg"),
      // validation rulesimport store from '@/store/index'
      required,
      email,
      show: false,
      show2: false,
      error: null,
      spin: false,
    };
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === "password" ? "EyeIcon" : "EyeOffIcon";
    },
    imgUrl() {
      if (store.state.appConfig.layout.skin === "dark") {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require("@/assets/images/pages/login-v2-dark.svg");
        return this.sideImg;
      }
      return this.sideImg;
    },
  },
  methods: {
    validationForm() {
      axios
        .post("/api/login", {
          email: this.email,
          password: this.password,
        })
        .catch((error) => {
          if (error.response.status === 404) {
            this.error = "Bilgileriniz hatalı. Lütfen kontrol ediniz.";
            this.show2 = true;
            this.show = false;
            this.spin === false;
          } else if (error.response.status === 400) {
            this.error =
              "Sistem yetkilisi tarafından hesabınız onaylandıktan sonra giriş yapabilirsiniz!";
            this.show = true;
            this.show2 = false;
            this.spin === false;
          } else if (error.response.status === 422) {
            this.error =
              "Hesabınız onay aşamasasındadır. Lütfen Email adresinizden onay veriniz.";
            this.show = true;
            this.show2 = false;
            this.spin === false;
          }
        })

        .then((res) => {
          var user = res.data.user;
          localStorage.setItem("token", res.data.access_token);
          localStorage.setItem("user", JSON.stringify(res.data.user));
          this.spin = true;

          this.$router.replace("/").then(() => {
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Hoşgeldin ${user.name} `,
                icon: "CoffeeIcon",
                variant: "success",
                text: `${user.role} olarak başarıyla giriş yaptın. Şimdi işe koyulabilirsin!`,
              },
            });
          });
        });
    },
  },
};
</script>

<style lang="scss">
@import "@core/scss/vue/pages/page-auth.scss";
</style>
