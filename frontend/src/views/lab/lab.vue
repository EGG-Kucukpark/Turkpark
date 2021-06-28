<template>
  <div>
    <!-- Alert: No item found -->
    <b-row>
      <b-breadcrumb style="margin: 20px" class="breadcrumb-slash">
        <b-breadcrumb-item to="/">
          <feather-icon icon="HomeIcon" size="25" variant="primary" />
        </b-breadcrumb-item>

        <b-breadcrumb-item style="font-size: 18px" to="/">
          Ana Sayfa
        </b-breadcrumb-item>

        <b-breadcrumb-item style="font-size: 18px" active>
          Sonuçlar
        </b-breadcrumb-item>
      </b-breadcrumb>
    </b-row>
    <b-modal
      hide-header-close
      ok-title="Kaydet"
      :hide-footer="true"
      size="lg"
      ref="firmaekle"
      centered
      title="Firma Ekle"
    >
      <b-card>
        <validation-observer ref="registerForm" #default="{ invalid }">
          <b-form @submit.prevent="submit">
            <b-form-group
              label="İşyeri Ünvanı:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <validation-provider
                #default="{ errors }"
                name="İsim"
                rules="required"
              >
                <b-form-input
                  id="isim"
                  :state="errors.length > 0 ? false : null"
                  v-model="name"
                  placeholder="İş Yeri Adını Giriniz..."
                ></b-form-input>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>

            <b-form-group
              label="Firma Yetkilisi:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="firma_yetkilisi"
                placeholder="Firma Yetkilisinin Adını Giriniz..."
              ></b-form-input>
              <small class="text-danger">{{ errors[0] }}</small>
            </b-form-group>

            <b-form-group
              label="SGK Sicil No:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="sgkno"
                placeholder="SGK Sicil Numarasını Giriniz..."
              ></b-form-input>
              <small class="text-danger">{{ errors[0] }}</small>
            </b-form-group>

            <b-form-group
              label="Vergi Dairesi"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="vergiad"
                placeholder="Vergi Dairesi Adını Giriniz"
              ></b-form-input>
              <small class="text-danger">{{ errors[0] }}</small>
            </b-form-group>

            <b-form-group
              label="Vergi No:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="vergino"
                placeholder="Vergi Numarası"
              ></b-form-input>
              <small class="text-danger">{{ errors[0] }}</small>
            </b-form-group>

            <b-form-group
              label="E-Posta Adresi"
              label-for="email"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="email"
                :state="errors.length > 0 ? false : null"
                v-model="email"
                placeholder="E-posta Adresini Giriniz"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Telefon No:"
              label-for="telefon"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="telefon"
                v-model="telefon"
                placeholder="Firma Telefon Numarası"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Firma Şifresi:"
              label-for="password"
              label-cols-sm="3"
              label-align-sm="right"
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
            </b-form-group>

            <div style="float: right">
              <b-button
                variant="success"
                block
                type="submit"
                :disabled="invalid"
              >
                Tamam
              </b-button>
            </div>
            <div style="float: right; padding-right: 10px">
              <b-button variant="danger" @click="form()"> İptal</b-button>
            </div>
          </b-form>
        </validation-observer>
      </b-card>
    </b-modal>
    <b-card title="Sonuç Seçiniz">
      <b-form-select
        v-model="sonuclar"
        @input="selected"
        style="margin-bottom: 30px"
      >
        <option value="disabled" disabled>Lütfen Bir Seçim Yapınız</option>
        <option value="lab">Laboratuvar</option>
        <option value="asansor">Asansör</option>
        <option value="ölçüm">Ortam Ölçümleri</option>
        <option value="periyodik">Periyodik Kontroller</option>
        <option value="ilkyardim">İlk Yardım</option>
        <option value="egitimler">Eğitimler</option>
      </b-form-select>

      <b-button
        v-if="show"
        variant="success"
        v-on:click="$refs['firmaekle'].show()"
        >Firma Ekle
      </b-button>
    </b-card>

    <template v-if="sonuc === 'lab'">
      <b-tabs v-if="userData" pills>
        <b-tab active>
          <template #title>
            <feather-icon
              icon="BriefcaseIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline"> Firma Sonuçları </span>
          </template>
          <client :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Information -->
        <b-tab v-if="show">
          <template #title>
            <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Bireysel Sonuçlar</span>
          </template>
          <individual :user-data="userData" class="mt-2 pt-75" />
        </b-tab>
      </b-tabs>
    </template>

    <!-- Tab: ÖLÇÜM -->
    <template v-if="sonuc === 'ölçüm'">
      <b-tabs v-if="userData" pills>
        <b-tab active>
          <template #title>
            <feather-icon
              icon="BriefcaseIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline"> Firma Sonuçları </span>
          </template>
          <olcumfirma :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <b-tab v-if="show">
          <template #title>
            <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Bireysel Sonuçlar</span>
          </template>
          <olcumbirey :user-data="userData" class="mt-2 pt-75" />
        </b-tab>
      </b-tabs>
    </template>

    <!-- Tab: Egitimler -->
    <template v-if="sonuc === 'egitimler'">
      <b-tabs v-if="userData" pills>
        <b-tab active>
          <template #title>
            <feather-icon
              icon="BriefcaseIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline"> Firma Sonuçları </span>
          </template>
          <egitimlerirma :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <b-tab v-if="show">
          <template #title>
            <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Bireysel Sonuçlar</span>
          </template>
          <egitimlerirey :user-data="userData" class="mt-2 pt-75" />
        </b-tab>
      </b-tabs>
    </template>

    <template v-if="sonuc === 'asansor'">
      <b-tabs v-if="userData" pills>
        <!-- Tab: Account -->
        <b-tab active>
          <template #title>
            <feather-icon
              icon="BriefcaseIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline"> Firma Sonuçları </span>
          </template>
          <asansorfirma :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Information -->
        <b-tab v-if="show">
          <template #title>
            <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Bireysel Sonuçlar</span>
          </template>
          <asansorbirey :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Social -->
      </b-tabs>
    </template>

    <template v-if="sonuc === 'periyodik'">
      <b-tabs v-if="userData" pills>
        <!-- Tab: Account -->
        <b-tab active>
          <template #title>
            <feather-icon
              icon="BriefcaseIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline"> Firma Sonuçları </span>
          </template>
          <periyodikfirma :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Information -->
        <b-tab v-if="show">
          <template #title>
            <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Bireysel Sonuçlar</span>
          </template>
          <periyodikbirey :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Social -->
      </b-tabs>
    </template>

    <template v-if="sonuc === 'ilkyardim'">
      <b-tabs v-if="userData" pills>
        <!-- Tab: Account -->
        <b-tab active>
          <template #title>
            <feather-icon
              icon="BriefcaseIcon"
              size="16"
              class="mr-0 mr-sm-50"
            />
            <span class="d-none d-sm-inline"> Firma Sonuçları </span>
          </template>
          <ilkyardimfirma :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Information -->
        <b-tab v-if="show">
          <template #title>
            <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Bireysel Sonuçlar</span>
          </template>
          <ilkyardimbirey :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Social -->
      </b-tabs>
    </template>
  </div>
</template>

<script>
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import ripple from "vue-ripple-directive";
import axios from "@axios";

import { ref } from "@vue/composition-api";
import {
  BRow,
  BCard,
  BCol,
  BBreadcrumb,
  BBreadcrumbItem,
  BAlert,
  BLink,
  BTabs,
  BModal,
  BForm,
  BFormInput,
  BTab,
  BButton,
  BFormSelect,
  BInputGroup,
  BInputGroupAppend,
  BFormGroup,
} from "bootstrap-vue";

import { required } from "@validations";
import { togglePasswordVisibility } from "@core/mixins/ui/forms";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import individual from "./individual";
import client from "./client";

import asansorbirey from "./asansor/individual";
import asansorfirma from "./asansor/client";

import egitimlerirey from "./egitimler/individual";
import egitimlerirma from "./egitimler/client";

import periyodikbirey from "./periyodik/individual";
import periyodikfirma from "./periyodik/client";

import olcumbirey from "./measure/individual";
import olcumfirma from "./measure/client";

import ilkyardimbirey from "./ilkyardim/individual";
import ilkyardimfirma from "./ilkyardim/client";
import FeatherIcon from "@/@core/components/feather-icon/FeatherIcon.vue";

export default {
  components: {
    BRow,
    BCol,
    BCard,
    BAlert,
    BModal,
    BLink,
    BBreadcrumb,
    BBreadcrumbItem,
    ValidationProvider,
    ValidationObserver,
    BInputGroup,
    BInputGroupAppend,
    BForm,
    BFormInput,
    BTabs,
    BTab,
    togglePasswordVisibility,
    required,
    BButton,
    BFormSelect,
    ToastificationContent,
    BFormGroup,

    // Local Components

    individual,
    asansorbirey,
    asansorfirma,
    client,
    olcumbirey,
    olcumfirma,
    egitimlerirey,
    egitimlerirma,
    periyodikbirey,
    periyodikfirma,
    ilkyardimbirey,
    ilkyardimfirma,
    FeatherIcon,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      show: true,
      sonuclar: "disabled",
      sonuc: null,
      name: "",
      sgkno: "",
      vergino: "",
      vergiad: "",
      firma_yetkilisi: "",
      email: "",
      role: "",
      telefon: "",
      password: "",
      errors: [],
    };
  },
  created() {
    var user = JSON.parse(localStorage.getItem("user"));
    if (user.role == "Firma") {
      this.show = false;
    }
  },
  setup() {
    const userData = ref(null);
    userData.value = JSON.parse(localStorage.getItem("user"));

    return {
      userData,
    };
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === "password" ? "EyeIcon" : "EyeOffIcon";
    },
  },

  methods: {
    basarili() {
      if (document.getElementById("basarili") === null) {
        this.$toast({
          component: ToastificationContent,
          position: "top-right",
          props: {
            title: `Firma İşlemleri `,
            icon: "BriefCaseIcon",
            variant: "success",
            text: ` İşlem Başarılı.`,
          },
        });
      } else {
        document.getElementById("basarili").value === "firma",
          document.getElementById("basarili").click();
      }
    },

    submit() {
      axios
        .post("/api/firmaekle", {
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          password: this.password,
          vergino: this.vergino,
          vergiad: this.vergiad,
          firma_yetkilisi: this.firma_yetkilisi,
          sgk: this.sgkno,
        })
        .then((res) => this.basarili())
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Firma İşlemleri `,
              icon: "BriefcaseIcon",
              variant: "danger",
              text: ` İşlem Başarısız.`,
            },
          });
        })
        .then(this.form());
    },

    form() {
      this.$refs["firmaekle"].hide();

      (this.name = ""),
        (this.sgkno = ""),
        (this.password = ""),
        (this.vergiad = ""),
        (this.vergino = ""),
        (this.email = ""),
        (this.firma_yetkilisi = ""),
        (this.telefon = "");
    },
    selected() {
      if (this.sonuclar === "lab") {
        this.sonuc = "lab";
        console.log(this.sonuc);
      } else if (this.sonuclar === "ölçüm") {
        this.sonuc = "ölçüm";
        console.log(this.sonuc);
      } else if (this.sonuclar === "asansor") {
        this.sonuc = "asansor";
        console.log(this.sonuc);
      } else if (this.sonuclar === "egitimler") {
        this.sonuc = "egitimler";
        console.log(this.sonuc);
      } else if (this.sonuclar === "periyodik") {
        this.sonuc = "periyodik";
        console.log(this.sonuc);
      } else if (this.sonuclar === "ilkyardim") {
        this.sonuc = "ilkyardim";
        console.log(this.sonuc);
      }
    },
  },
};
</script>

<style>
</style>
