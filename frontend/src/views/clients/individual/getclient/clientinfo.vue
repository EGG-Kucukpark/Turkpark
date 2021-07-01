<template>
  <b-card title="Kişi Bilgileri">
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
              <h3 class="mb-2">Kişi Adı: {{ userData.name }}</h3>
              <span class="card-text">{{ userData.email }}</span>
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
              <feather-icon icon="MapPinIcon" class="mr-75" />
              <span class="font-weight-bold">Adres</span>
            </th>
            <td class="pb-50 text-capitalize">
              {{ userData.adres }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <feather-icon icon="CreditCardIcon" class="mr-75" />
              <span class="font-weight-bold">TC. Kimlik Numarası</span>
            </th>
            <td class="pb-50">
              {{ userData.tc }}
            </td>
          </tr>
        </table>
      </b-col>
    </b-row>
  </b-card>
</template>

<script>
import { BCard, BButton, BAvatar, BRow, BCol } from "bootstrap-vue";


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
};
</script>

<style>
</style>
