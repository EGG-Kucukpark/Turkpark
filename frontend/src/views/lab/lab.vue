<template>
  <div>
    <!-- Alert: No item found -->

    <b-card title="Sonuç Seçiniz">
      <b-form-select
        v-model="sonuclar"
        @input="selected"
        style="margin-bottom: 30px"
      >
        <option value="lab">Laboratuvar</option>
        <option>Asansör</option>
        <option value="ölçüm">Ortam Ölçümleri</option>
        <option>Periyodik Kontroller</option>
        <option>İlkyardım</option>
        <option>Eğitimler</option>
      </b-form-select>
    </b-card>

    <b-alert variant="danger" v-if="sonuc === null">
      <h4 class="alert-heading">Veri Çekilemedi</h4>
      <div class="alert-body">
        Gösterilecek sonuç yok. Lütfen Yukarıdan sonuç tipini seçiniz.
      </div>
    </b-alert>

    <template v-if="sonuc === 'lab'">
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

        <!-- Tab: Social -->
      </b-tabs>
    </template>

    <template v-if="sonuc === 'ölçüm'">
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
          <olcumfirma :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Information -->
        <b-tab v-if="show">
          <template #title>
            <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
            <span class="d-none d-sm-inline">Bireysel Sonuçlar</span>
          </template>
          <olcumbirey :user-data="userData" class="mt-2 pt-75" />
        </b-tab>

        <!-- Tab: Social -->
      </b-tabs>
    </template>
  </div>
</template>

<script>
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";

import { ref } from "@vue/composition-api";
import {
  BRow,
  BCard,
  BCol,
  BAlert,
  BLink,
  BTabs,
  BTab,
  BButton,
  BFormSelect,
  BFormGroup,
} from "bootstrap-vue";
import individual from "./individual";
import client from "./client";

import olcumbirey from "./measure/individual";
import olcumfirma from "./measure/client";

export default {
  components: {
    BRow,
    BCol,
    BCard,
    BAlert,
    BLink,
    BTabs,
    BTab,
    BButton,
    BFormSelect,
    ToastificationContent,
    BFormGroup,

    // Local Components

    individual,
    client,
    olcumbirey,
    olcumfirma,
  },
  data() {
    return {
      show: true,
      sonuclar: null,
      sonuc: null,
    };
  },
  created() {
    var user = JSON.parse(localStorage.getItem("user"));
    if (user.role == "Client") {
      this.show = false;
    }

    this.$toast({
      component: ToastificationContent,
      position: "top-right",
      props: {
        title: `Sonuç İşlemleri `,
        icon: "FileTextIcon",
        variant: "success",
        text: ` Lütfen Sonuç Tipini Seçiniz`,
      },
    });
  },
  setup() {
    const userData = ref(null);
    userData.value = JSON.parse(localStorage.getItem("user"));

    return {
      userData,
    };
  },

  methods: {
    selected() {
      if (this.sonuclar === "lab") {
        this.sonuc = "lab";
        console.log(this.sonuc);
      } else if (this.sonuclar === "ölçüm") {
        this.sonuc = "ölçüm";
        console.log(this.sonuc);
      }
    },
  },
};
</script>

<style>
</style>
