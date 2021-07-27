<template>
  <b-card >
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
              <h3 class="mb-2">Eğitim Kategorisi: {{ egitim.title }}</h3>
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
              <h5 class="mb-0">
                {{ egitim.kota }}
              </h5>
              <small>Kontenjan Sayısı</small>
            </div>
          </div>

          <div class="d-flex align-items-center">
            <b-avatar variant="light-success" rounded>
              <feather-icon icon="UserIcon" size="18" />
            </b-avatar>
            <div class="ml-1">
              <h5 class="mb-0">
                {{ items.length }}
              </h5>
              <small>Güncel Kontenjan Sayısı</small>
            </div>
          </div>
        </div>
      </b-col>

      <!-- Right Col: Table -->
      <b-col cols="12" xl="6">
        <table class="mt-2 mt-xl-0 w-100">
          <tr>
            <th class="pb-50">
              <feather-icon icon="ClockIcon" class="mr-75" />
              <span class="font-weight-bold">Tarih ve Saat Bilgisi</span>
            </th>
            <td class="pb-50">
              {{ egitim.date }}
            </td>
          </tr>
          <tr>
            <th>
              <feather-icon icon="MapPinIcon" class="mr-75" />
              <span class="font-weight-bold">İl</span>
            </th>
            <td>
              {{ egitim.location }}
            </td>
          </tr>
        </table>
      </b-col>
    </b-row>
  </b-card>
</template>

<script>
import router from "@/router";
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

  data() {
    return {
      egitim: "",
      items: "",
    };
  },

  created() {
    var id = router.currentRoute.params.id;

    axios
      .get(`/api/egitimgoster/${id}`)
      .then((res) => (this.egitim = res.data));
    axios
      .post(`/api/katilimcigetir`, { id: id })
      .then((res) => (this.items = res.data));
  },
};
</script>


