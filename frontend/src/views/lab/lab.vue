<template>
  <div>
    <!-- Alert: No item found -->

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
import ripple from 'vue-ripple-directive'

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
  },
  data() {
    return {
      show: true,
      sonuclar: "disabled",
      sonuc: null,
    };
  },
  created() {
    var user = JSON.parse(localStorage.getItem("user"));
    if (user.role == "Client") {
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

  methods: {
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
