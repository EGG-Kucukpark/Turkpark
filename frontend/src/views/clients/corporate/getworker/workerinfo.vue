<template>
  <div>
    <b-card title="Çalışan Bilgileri">
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
                <h4 class="mb-0">
                  {{ userData.name }}
                </h4>
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
              <feather-icon
                icon="MailIcon"
                class="mr-75"
              />
              <span class="font-weight-bold">E-Posta</span>
            </th>
            <td class="pb-50">
              {{ userData.email }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <feather-icon
                icon="PhoneIcon"
                class="mr-75"
              />
              <span class="font-weight-bold">Telefon Numarası</span>
            </th>
            <td class="pb-50 text-capitalize">
                {{ userData.telefon }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <feather-icon
                icon="CreditCardIcon"
                class="mr-75"
              />
              <span class="font-weight-bold">TC. Kimlik Numarası</span>
            </th>
            <td class="pb-50 text-capitalize">
              {{ userData.telefon }}
            </td>
          </tr>

        </table>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
import {
  BCard,
  BButton,
  BAvatar,
  BRow,
  BCol,
  BBreadcrumb,
  BBreadcrumbItem,
} from "bootstrap-vue";

export default {
  components: {
    BCard,
    BButton,
    BRow,
    BCol,
    BAvatar,
    BBreadcrumb,
    BBreadcrumbItem,
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  created() {
      document.getElementsByClassName("router-link-active")[3].href === ""
    document
      .getElementsByClassName("router-link-active")[3]
      .addEventListener("click", this.click);

  },
  methods: {
    click() {
      alert("deniz");
      this.$router.go(-1);
    },
  },
};
</script>

<style>
</style>
