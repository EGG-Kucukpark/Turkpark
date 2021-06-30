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
            Şifreni Sıfırlama 🔒
          </b-card-title>
          <b-card-text class="mb-2">
            Aşağıdaki formu doldurarak şifrenizi sıfırlayabilirsiniz.
          </b-card-text>

          <template v-if="show">
            <b-alert
              style="height: 50px; text-align: center; padding-top: 10px"
              show
              variant="warning"
            >
              <ul>
                <li v-for="errors in errors" :key="errors.name">
                  {{ errors[0] }}
                </li>
              </ul>
            </b-alert>
          </template>

          <template v-if="show2">
            <b-alert
              style="height: 50px; text-align: center; padding-top: 10px"
              show
              variant="danger"
            >
              <p>{{ error }}</p>
            </b-alert>
          </template>

          <!-- form -->
          <validation-observer ref="passwordform">
            <b-form
              class="auth-forgot-password-form mt-2"
              @submit.prevent="validationForm"
            >
              <b-form-group
                label="E-Posta Adresiniz:"
                label-for="forgot-password-email"
              >
                <validation-provider
                  #default="{ errors }"
                  name="E-posta"
                  rules="required|email"
                >
                  <b-form-input
                    disabled
                    id="forgot-password-email"
                    v-model="email"
                    :state="errors.length > 0 ? false : null"
                    name="forgot-password-email"
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
                  vid="Şifree"
                  rules="required|min:8"
                >
                  <b-input-group
                    class="input-group-merge"
                    :class="errors.length > 0 ? 'is-invalid' : null"
                  >
                    <b-form-input
                      id="Şifree"
                      v-model="password"
                      class="form-control-merge"
                      :type="passwordFieldType"
                      :state="errors.length > 0 ? false : null"
                      name="Şifree"
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
                  name="Şifre "
                  vid="Şifreverify"
                  rules="required|confirmed:Şifree"
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
                type="submit"
                variant="primary"
                block
                :disabled="invalid"
              >
                Gönder
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
  BImg,
  BCol,
  BLink,
  BButton,
  BForm,
  BCardText,
  BCardTitle,
  BFormCheckbox,
  BFormGroup,
  BFormInput,
  BInputGroup,
  BInputGroupAppend,
  BAlert,
  BListGroup,
  BListGroupItem,
  BFormSelect,
  BFormSelectOption,
  // validations
} from "bootstrap-vue";
import { required, email } from "@validations";
import store from "@/store/index";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import axios from "@axios";
import { togglePasswordVisibility } from "@core/mixins/ui/forms";
export default {
  components: {
    BRow,
    BImg,
    BCol,
    BLink,
    BButton,
    BForm,
    BCardText,
    BCardTitle,
    BFormCheckbox,
    BFormGroup,
    BFormInput,
    BInputGroup,
    BInputGroupAppend,
    BAlert,
    BListGroup,
    BListGroupItem,
    BFormSelect,
    BFormSelectOption,
    // validations
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      token: "",
      email: "",
      password: "",
      password_confirmation: "",
      show: false,
      show2: false,
      errors: [],
      error: "",
      sideImg: require("@/assets/images/pages/forgot-password-v2.svg"),
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
  created() {
    this.email = this.$route.query.email;
    this.token = this.$route.params.token;
  },

  methods: {
    validationForm() {
      this.$refs.passwordform.validate().then(
        axios
          .post("/api/password/reset", {
            email: this.email,
            token: this.token,
            password: this.password,
            password_confirmation: this.password_confirmation,
          })
          .catch((error) => {
            if (error.response.status === 400) {
              this.error = "Bu linkin süresi dolmuştur.";
              this.show2 = true;
              this.show = false;
            } else {
            }
          })
          .then((res) => {
            this.$router.replace("/login").then(
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: "Şifreniz Güncellendi.",
                  icon: "EditIcon",
                  variant: "success",
                },
              })
            );
          })
      );
    },
  },
};
</script>

<style lang="scss">
@import "@core/scss/vue/pages/page-auth.scss";
</style>
