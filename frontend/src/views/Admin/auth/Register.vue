<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">
      <!-- Left Text-->
      <b-col lg="8" class="d-none d-lg-flex align-items-center p-5">
        <div
          class="w-100 d-lg-flex align-items-center justify-content-center px-5"
        >
          <b-img fluid :src="imgUrl" alt="Register V2" />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Register-->
      <b-col lg="4" class="d-flex align-items-center auth-bg px-2 p-lg-5">
        <b-col sm="8" md="6" lg="12" class="px-xl-2 mx-auto">
          <b-card-title class="mb-1"> Macera Burada Başlıyor 🚀 </b-card-title>
          <b-card-text class="mb-2">
            Belge ve iş yönetimini eğlenceli hale Getirin!
          </b-card-text>

          <card v-if="mustVerifyEmail" :title="$t('register')">
            <div class="alert alert-success" role="alert">
              {{ $t("verify_email_address") }}
            </div>
          </card>

          <template v-if="show">
            <b-alert show variant="warning">
              <p>
                {{ errors }}
              </p>
            </b-alert>
          </template>

          <!-- form -->
          <validation-observer ref="registerForm" #default="{ invalid }">
            <b-form class="auth-register-form mt-2" @submit.prevent="register">
              <b-form-group label="Kullanıcı Türü" label-for="register-email">
                <validation-provider
                  v-slot="{ errors }"
                  rules="required"
                  name="Kullanıcı Türü"
                >
                  <b-form-select v-model="role" @input="label">
                    <b-form-select-option disabled value=" " hidden="true"
                      >Lütfen Bir Seçim Yapınız</b-form-select-option
                    >

                    <b-form-select-option selected value="Bireysel"
                      >Bireysel Kullanıcı</b-form-select-option
                    >
                    <b-form-select-option selected value="Firma"
                      >Kurumsal Kullanıcı</b-form-select-option
                    >
                  </b-form-select>

                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <!-- username -->

              <b-form-group id="label" label="İsminiz">
                <validation-provider
                  #default="{ errors }"
                  name="İsim"
                  rules="required|alpha"
                >
                  <b-form-input
                    v-model="name"
                    :state="errors.length > 0 ? false : null"
                    placeholder="johndoe"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <!-- Telefon -->
              <b-form-group label="Telefon Numaranız:">
                <validation-provider
                  #default="{ errors }"
                  name="Telefon"
                  rules="required"
                >
                  <cleave
                    id="phone"
                    v-model="telefon"
                    class="form-control"
                    :raw="false"
                    :state="errors.length > 0 ? false : null"
                    :options="options.phone"
                    placeholder="555 555 55 55"
                  />

                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <b-form-group label="E-Posta:" label-for="register-email">
                <validation-provider
                  #default="{ errors }"
                  name="E-Posta"
                  vid="email"
                  rules="required|email"
                >
                  <b-form-input
                    id="register-email"
                    v-model="email"
                    name="register-email"
                    :state="errors.length > 0 ? false : null"
                    placeholder="john@example.com"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <!-- password -->
              <b-form-group label-for="register-password" label="Şifreniz:">
                <validation-provider
                  #default="{ errors }"
                  name="Şifre"
                  rules="required|min:6|confirmed:confirmation"
                >
                  <b-input-group
                    class="input-group-merge"
                    :class="errors.length > 0 ? 'is-invalid' : null"
                  >
                    <b-form-input
                      v-model="Şifre"
                      class="form-control-merge"
                      :type="passwordFieldType"
                      :state="errors.length > 0 ? false : null"
                      placeholder="············"
                    />
                    <b-input-group-append is-text>
                      <feather-icon
                        :icon="passwordToggleIcon"
                        class="cursor-pointer"
                        @click="togglePasswordVisibility"
                      />
                    </b-input-group-append>
                  </b-input-group>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <b-form-group
                label-for="register-password"
                label="Şifre Doğrulama:"
              >
                <validation-provider
                  #default="{ errors }"
                  vid="confirmation"
                  name="Şifre Doğrulama"
                  rules="required|min:6"
                >
                  <b-input-group
                    class="input-group-merge"
                    :class="errors.length > 0 ? 'is-invalid' : null"
                  >
                    <b-form-input
                      id="register-password"
                      v-model="password_confirmation"
                      class="form-control-merge"
                      :type="passwordFieldType"
                      :state="errors.length > 0 ? false : null"
                      name="register-password"
                      placeholder="············"
                    />
                    <b-input-group-append is-text>
                      <feather-icon
                        :icon="passwordToggleIcon"
                        class="cursor-pointer"
                        @click="togglePasswordVisibility"
                      />
                    </b-input-group-append>
                  </b-input-group>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <b-button
                v-if="spin"
                variant="primary"
                block
                type="submit"
                :disabled="invalid"
              >
                <b-spinner class="mr-1" Small Spinner variant="light" />
              </b-button>

              <b-button
                v-if="spin === false"
                variant="primary"
                block
                type="submit"
                :disabled="invalid"
              >
                Kayıt Ol
              </b-button>
            </b-form>
          </validation-observer>

          <p class="text-center mt-2">
            <span>Hesabın var mı?</span>
            <b-link :to="{ name: 'login' }">
              <span>&nbsp;Giriş yap</span>
            </b-link>
          </p>
        </b-col>
      </b-col>
      <!-- /Register-->
    </b-row>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { ValidationProvider, ValidationObserver } from "vee-validate";

import { required, email } from "@validations";
import { togglePasswordVisibility } from "@core/mixins/ui/forms";
import store from "@/store/index";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import axios from "@axios";
import Cleave from "vue-cleave-component";
// eslint-disable-next-line import/no-extraneous-dependencies
import "cleave.js/dist/addons/cleave-phone.us";

export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    ToastificationContent,
    Cleave,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      options: {
        phone: {
          phone: true,
          phoneRegionCode: "US",
        },
      },
      name: "",
      max: 11,
      errors: "",
      email: "",
      telefon: "",
      role: " ",
      Şifre: "",
      spin: false,

      password_confirmation: "",
      mustVerifyEmail: false,
      show: false,
      sideImg: require("@/assets/images/pages/register-v2.svg"),
      // validation
      required,
      email,
    };
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === "password" ? "EyeIcon" : "EyeOffIcon";
    },
    imgUrl() {
      if (store.state.appConfig.layout.skin === "dark") {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require("@/assets/images/pages/register-v2-dark.svg");
        return this.sideImg;
      }
      return this.sideImg;
    },
  },
  methods: {
    label() {
      if (this.role === "Firma") {
        document.getElementById("label__BV_label_").innerHTML = "Kurum Adı";
      } else {
        document.getElementById("label__BV_label_").innerHTML = "İsminiz";
      }
    },
    register() {
      this.$refs.registerForm.validate().then((success) => {
        this.spin = true;
        if (success) {
          axios
            .post("/api/register", {
              name: this.name,
              email: this.email,
              Şifre: this.Şifre,
              telefon: this.telefon,
              role: this.role,
              password_confirmation: this.password_confirmation,
            })
            .then((response) => {
              this.$router.replace("/login").then(() => {
                this.$toast({
                  component: ToastificationContent,
                  position: "top-right",
                  props: {
                    title: `Kayıt Başarılı`,
                    icon: "CoffeeIcon",
                    variant: "success",
                    text: `Kayıt onayı için lütfen mail adresinizi kontrol ediniz!`,
                  },
                });
              });
            })
            .catch((error) => {
              if (error.response.status === 400) {
                this.spin = false;
                this.show = true;
                this.errors = "Bu adrese ait kayıtlı bir kullanıcı mevcut.";
              }
            })
            .then(
              axios.post("/api/email", {
                name: this.name,
                email: this.email,
                telefon: this.telefon,
                role: this.role,
              })
            );
        }
      });
    },
  },
};
/* eslint-disable global-require */
</script>

<style lang="scss">
@import "@core/scss/vue/pages/page-auth.scss";
</style>
