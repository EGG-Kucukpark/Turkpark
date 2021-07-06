<template>
  <b-card title="Temel Bilgiler">
    <b-form class="mt-2">
      <b-row>
        <b-col v-if="options.role === 'Firma'" sm="6">
          <b-form-group label="Firma Adı" label-for="account-company">
            <b-form-input v-model="name" id="firma" placeholder="Firma Adı" disabled />
          </b-form-group>
        </b-col>

        <b-col v-if="options.role != 'Firma'" sm="6">
          <b-form-group label="İsminiz" label-for="account-username">
            <b-form-input
              v-model="name"
              disabled
              placeholder="Adınızı Giriniz"
              id="isim"
            />
          </b-form-group>
        </b-col>
        <b-col sm="6">
          <b-form-group label="Rol" label-for="account-name">
            <b-form-input v-model="role" id="rol" placeholder="Rol" disabled />
          </b-form-group>
        </b-col>
        <b-col sm="6">
          <b-form-group label="E-Posta Adresiniz" label-for="account-e-mail">
            <b-form-input
              v-model="email"
              id="email"
              disabled
              placeholder="E-Posta Adresinizi Giriniz"
            />
          </b-form-group>
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
import axios from "@axios";

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

  data() {
    return {
      name: null,
      email: null,
      role: null,
      data: null,
    };
  },

  created() {
    axios.post("/api/getuser", { id: this.options.id }).then((res) => {
      this.data = res.data;
      (this.name = this.data[0].name),
        (this.email = this.data[0].email),
        (this.role = this.data[0].role);
    });
  },
};
</script>
