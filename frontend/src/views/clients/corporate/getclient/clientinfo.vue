<template>
  <b-card>
    <b-row>
      <!-- User Info: Left col -->
      <b-col
        cols="21"
        xl="6"
        class="d-flex justify-content-between flex-column"
      >
        <!-- User Avatar & Action Buttons -->
        <div class="d-flex justify-content-start">
          <div class="d-flex flex-column ml-1">
            <div class="mb-1">
              <h3 class="mb-2">Firma Adı: {{ userData.name }}</h3>
              <span class="card-text">{{ userData.email }}</span>
            </div>
          </div>
        </div>

        <!-- User Stats -->
        <div class="d-flex align-items-center mt-2">
          <div class="d-flex align-items-center mr-2">
            <b-avatar variant="light-primary" rounded>
              <feather-icon icon="UserIcon" size="18" />
            </b-avatar>
            <div class="ml-1">
              <h5 v-for="sayi in sayi" :key="sayi.id" class="mb-0">
                <span v-if="userData.id === sayi.firma_id">
                  <span> {{ sayi.sayi }} </span>
                </span>
              </h5>
              <small>Çalışan Sayısı</small>
            </div>
          </div>
        </div>
      </b-col>

      <!-- Right Col: Table -->
      <b-col cols="12" xl="6">
        <table class="mt-2 mt-xl-0 w-100">
          <tr>
            <th class="pb-20">
              <feather-icon icon="MailIcon" class="mr-75" />
              <span class="font-weight-bold">E-Posta</span>
            </th>
            <td class="pb-50">
              {{ userData.email }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <feather-icon icon="PhoneIcon" class="mr-75" />
              <span class="font-weight-bold">Telefon Numarası</span>
            </th>
            <td class="pb-50 text-capitalize">
              {{ userData.telefon }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <feather-icon icon="SlackIcon" class="mr-75" />
              <span class="font-weight-bold">Vergi Numarası</span>
            </th>
            <td class="pb-50 text-capitalize">
              {{ userData.vergino }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <feather-icon icon="BriefcaseIcon" class="mr-75" />
              <span class="font-weight-bold">Vergi Dairesi</span>
            </th>
            <td class="pb-50">
              {{ userData.vergiad }}
            </td>
          </tr>
          <tr>
            <th>
              <feather-icon icon="MapPinIcon" class="mr-75" />
              <span class="font-weight-bold">İl</span>
            </th>
            <td>
              {{ userData.il }}
            </td>
          </tr>
        </table>
      </b-col>
    </b-row>
  </b-card>
</template>

<script>
import { BCard, BButton, BAvatar, BRow, BCol } from "bootstrap-vue";
import axios from "@axios";

export default {
  components: {
    BCard,
    BButton,
    BRow,
    BCol,
    BAvatar,
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      calisan: "",
      sayi: null,
    };
  },
  created() {
    axios("/api/workersayi").then((res) => {
      this.sayi = res.data;
    });
  },
  setup() {
    return {};
  },
};
</script>

<style>
</style>
