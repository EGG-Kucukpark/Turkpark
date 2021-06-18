<template>
  <b-card title="Temel Bilgiler">
    <b-form class="mt-2">
      <b-row>
        <b-col v-if="options.role === 'Firma'" sm="6">
          <b-form-group label="Firma Adı" label-for="account-company">
            <b-form-input
              v-model="options.name"
              id="firma"
              placeholder="Firma Adı"
            />
          </b-form-group>
        </b-col>

        <b-col v-if="options.role != 'Firma'" sm="6">
          <b-form-group label="İsminiz" label-for="account-username">
            <b-form-input
              v-model="options.name"
              placeholder="Adınızı Giriniz"
              id="isim"
            />
          </b-form-group>
        </b-col>
        <b-col sm="6">
          <b-form-group label="Rol" label-for="account-name">
            <b-form-input
              v-model="options.role"
              id="rol"
              placeholder="Rol"
              disabled
            />
          </b-form-group>
        </b-col>
        <b-col sm="6">
          <b-form-group label="E-Posta Adresiniz" label-for="account-e-mail">
            <b-form-input
              v-model="options.email"
              id="email"
              placeholder="E-Posta Adresinizi Giriniz"
            />
          </b-form-group>
        </b-col>

        <b-col cols="12">
          <b-button
            v-ripple.400="'rgba(255, 255, 255, 0.15)'"
            variant="primary"
            class="mt-2 mr-1"
          >
            Değişiklikleri Kaydet
          </b-button>
          <b-button
            v-ripple.400="'rgba(186, 191, 199, 0.15)'"
            variant="outline-secondary"
            type="reset"
            class="mt-2"
            @click.prevent="resetForm"
          >
            Sıfırla
          </b-button>
        </b-col>
      </b-row>
    </b-form>
  </b-card>
</template>

<script>
import {
  BFormFile,
  BButton,
  BForm,
  BFormGroup,
  BFormInput,
  BRow,
  BCol,
  BAlert,
  BCard,
  BCardText,
  BMedia,
  BMediaAside,
  BMediaBody,
  BLink,
  BImg,
} from "bootstrap-vue";
import Ripple from "vue-ripple-directive";

export default {
  components: {
    BButton,
    BForm,
    BImg,
    BFormFile,
    BFormGroup,
    BFormInput,
    BRow,
    BCol,
    BAlert,
    BCard,
    BCardText,
    BMedia,
    BMediaAside,
    BMediaBody,
    BLink,
  },
  directives: {
    Ripple,
  },
  props: {
    options: {
      type: Object,
    },
  },
  methods: {
    resetForm() {
      if (this.options.role === "Firma") {
        document.getElementById("firma").value = "";

        document.getElementById("email").value = "";
      }
      document.getElementById("isim").value = "";

      document.getElementById("email").value = "";
    },
  },
};
</script>
