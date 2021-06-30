<template>
  <b-card title=" Ek Bilgiler">
    <b-form @submit.prevent>
      <b-row>
        <b-col md="6">
          <b-form-group label="Adınız" label-for="mc-first-name">
            <b-form-input
              id="mc-first-name"
              v-model="name"
              placeholder="First Name"
            />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label-for="mc-email" label="E-Posta">
            <div class="form-label-group">
              <b-form-input v-model="email" id="mc-email" type="email" />
            </div>
          </b-form-group>
        </b-col>

        <b-col md="6">
          <b-form-group label="Telefon Numarası" label-for="mc-country">
            <b-form-input v-model="telefon" id="mc-country" />
          </b-form-group>
        </b-col>

        <b-col cols="12"> </b-col>

        <!-- submit and reset -->
        <b-col>
          <b-button
            v-ripple.400="'rgba(255, 255, 255, 0.15)'"
            type="submit"
            variant="primary"
            @click="update"
            class="mr-1"
          >
            Güncelle
          </b-button>
          <b-button
            v-ripple.400="'rgba(186, 191, 199, 0.15)'"
            @click="reset"
            variant="outline-secondary"
          >
            Sıfırla
          </b-button>
        </b-col>
      </b-row>
    </b-form>
  </b-card>
</template>


<script>
import BCardActions from "@core/components/b-card-actions/BCardActions.vue";
import axios from "@axios";
import {
  BRow,
  BCol,
  BFormGroup,
  BFormInput,
  BFormCheckbox,
  BCard,
  BForm,
  BButton,
} from "bootstrap-vue";
import Ripple from "vue-ripple-directive";

export default {
  components: {
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BFormCheckbox,
    BForm,
    BCard,
    BButton,
    BCardActions,
  },
  props: {
    options: {
      type: Object,
    },
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      name: null,
      email: null,
      id: null,
      telefon: null,
    };
  },

  created() {
    axios.post("/api/getuser", { id: this.options.id }).then((res) => {
      var user = res.data[0];
      this.id = user.id;

      this.name = user.name;
      this.email = user.email;
      this.telefon = user.telefon;
    });
  },

  methods: {
    update() {

      axios
        .post("/api/userupdate", {
          userid: this.id,
          name: this.name,
          email: this.email,
          telefon: this.telefon,
        })
        .then((res) => this.reset());
    },
    reset() {
      axios.post("/api/getuser", { id: this.options.id }).then((res) => {
        var user = res.data[0];

        (this.name = user.name),
          (this.email = user.email),
          (this.telefon = user.telefon);
      });
    },
  },
};
</script>
