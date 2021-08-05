<template>
  <b-card>
    <!-- form -->
    <validation-observer ref="registerForm" #default="{ invalid }">
      <b-form>
        <b-row>
          <b-col md="6">
            <b-form-group
              label="Eski Şifreniz"
              label-for="account-old-password"
            >
              <validation-provider
                #default="{ errors }"
                vid="confirmation"
                name="Şifre"
                rules="required"
              >
                <b-input-group class="input-group-merge">
                  <b-form-input
                    id="account-old-password"
                    v-model="oldpass"
                    name="old-password"
                    :state="errors.length > 0 ? false : null"
                    :type="passwordFieldTypeOld"
                    placeholder="Eski Şifreniz"
                  />
                  <b-input-group-append is-text>
                    <feather-icon
                      :icon="passwordToggleIconOld"
                      class="cursor-pointer"
                      @click="togglePasswordOld"
                    />
                  </b-input-group-append>
                </b-input-group>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <!--/ old password -->
        </b-row>
        <b-row>
          <!-- new password -->
          <b-col md="6">
            <b-form-group
              label-for="account-new-password"
              label="Yeni Şifreniz"
            >
              <validation-provider
                #default="{ errors }"
                name="Şifre"
                rules="required|min:6|confirmed:confirmation"
              >
                <b-input-group class="input-group-merge">
                  <b-form-input
                    id="account-new-password"
                    v-model="newpass"
                    :type="passwordFieldTypeNew"
                    :state="errors.length > 0 ? false : null"
                    name="new-password"
                    placeholder="Yeni Şifreniz "
                  />
                  <b-input-group-append is-text>
                    <feather-icon
                      :icon="passwordToggleIconNew"
                      class="cursor-pointer"
                      @click="togglePasswordNew"
                    />
                  </b-input-group-append>
                </b-input-group>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <!--/ new password -->

          <!-- retype password -->
          <b-col md="6">
            <validation-provider
              #default="{ errors }"
              vid="confirmation"
              name="Şifre Doğrulama"
              rules="required|min:6"
            >
              <b-form-group
                label-for="account-retype-new-password"
                label="Yeni Şifre Doğrulama"
              >
                <b-input-group class="input-group-merge">
                  <b-form-input
                    id="account-retype-new-password"
                    v-model="newpass2"
                    :state="errors.length > 0 ? false : null"
                    :type="passwordFieldTypeRetype"
                    name="retype-password"
                    placeholder="Yeni Şifreniz "
                  />
                  <b-input-group-append is-text>
                    <feather-icon
                      :icon="passwordToggleIconRetype"
                      class="cursor-pointer"
                      @click="togglePasswordRetype"
                    />
                  </b-input-group-append>
                </b-input-group>
                <small class="text-danger">{{ errors[0] }}</small>
              </b-form-group>
            </validation-provider>
          </b-col>
          <!--/ retype password -->

          <!-- buttons -->
          <b-col cols="12">
            <b-button

              variant="primary"
              class="mt-1 mr-1"
              :disabled="invalid"
              @click.prevent="kaydet"
            >
              Değişiklikleri Kaydet
            </b-button>
            <b-button

              type="reset"
              variant="outline-secondary"
              class="mt-1"
              @click.prevent="sifirla"
            >
              Sıfırla
            </b-button>
          </b-col>
          <!--/ buttons -->
        </b-row>
      </b-form>
    </validation-observer>
  </b-card>
</template>

<script>
import axios from "@axios";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";

import { ValidationProvider, ValidationObserver } from "vee-validate";
import {
  BButton,
  BForm,
  BFormGroup,
  BFormInput,
  BRow,
  BCol,
  BCard,
  BInputGroup,
  BInputGroupAppend,
} from "bootstrap-vue";
import Ripple from "vue-ripple-directive";
import { required, email } from "@validations";

export default {
  components: {
    BButton,
    BForm,
    BFormGroup,
    BFormInput,
    BRow,
    BCol,
    BCard,
    BInputGroup,
    BInputGroupAppend,
    ValidationProvider,
    ValidationObserver,
  },
  directives: {
    Ripple,
  },
  props: {
    options: {
      type: Object,
    },
  },
  data() {
    return {
      errors: [],
      oldpass: "",
      newpass: "",
      newpass2: "",
      passwordFieldTypeOld: "password",
      passwordFieldTypeNew: "password",
      passwordFieldTypeRetype: "password",
      required,
    };
  },
  computed: {
    passwordToggleIconOld() {
      return this.passwordFieldTypeOld === "password"
        ? "EyeIcon"
        : "EyeOffIcon";
    },
    passwordToggleIconNew() {
      return this.passwordFieldTypeNew === "password"
        ? "EyeIcon"
        : "EyeOffIcon";
    },
    passwordToggleIconRetype() {
      return this.passwordFieldTypeRetype === "password"
        ? "EyeIcon"
        : "EyeOffIcon";
    },
  },
  methods: {
    togglePasswordOld() {
      this.passwordFieldTypeOld =
        this.passwordFieldTypeOld === "password" ? "text" : "password";
    },
    togglePasswordNew() {
      this.passwordFieldTypeNew =
        this.passwordFieldTypeNew === "password" ? "text" : "password";
    },
    togglePasswordRetype() {
      this.passwordFieldTypeRetype =
        this.passwordFieldTypeRetype === "password" ? "text" : "password";
    },
    sifirla() {
      (this.oldpass = null), (this.newpass = null), (this.newpass2 = null);
    },
    kaydet() {
      var options = null;
      options = JSON.parse(localStorage.getItem("user"));
      axios
        .post("/api/sifreguncelle", {
          id: options.id,
          password: this.oldpass,
          newpass: this.newpass2,
          newpass2: this.newpass2,
        })
        .then((res) =>
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Kullanıcı İşlemleri `,
              icon: "UserIcon",
              variant: "success",
              text: ` İşlem Başarılı.`,
            },
          })
        )
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: "Rapor İşlemleri",
              icon: "FileTextIcon",
              variant: "danger",
              text: " Eski Şifre Yanlış. İşlem Başarısız.",
            },
          });
        });
    },
  },
};
</script>
