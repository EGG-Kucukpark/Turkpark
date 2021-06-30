<template>
  <b-card title="Firma Ek Bilgiler">
    <b-form @submit.prevent>
      <b-row>
        <b-col md="6">
          <b-form-group label="Firma Adı" label-for="mc-first-name">
            <b-form-input
              id="mc-first-name"
              v-model="name"
              placeholder="First Name"
            />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Firma Yetkilisi" label-for="mc-last-name">
            <b-form-input v-model="yetkili" id="mc-last-name" />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Vergi Numarası" label-for="mc-city">
            <b-form-input v-model="vergino" id="mc-city" />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="SGK Sicil Numarası" label-for="mc-country">
            <b-form-input v-model="sgk" id="mc-country" />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Telefon Numarası" label-for="mc-country">
            <b-form-input v-model="telefon" id="mc-country" />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Vergi Dairesi" label-for="mc-company">
            <div class="form-label-group">
              <b-form-input v-model="vergiad" id="mc-company" />
            </div>
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label-for="mc-email" label="E-Posta">
            <div class="form-label-group">
              <b-form-input v-model="email" id="mc-email" type="email" />
            </div>
          </b-form-group>
        </b-col>

        <b-col cols="12"> </b-col>

        <!-- submit and reset -->
        <b-col>
          <b-button
            v-ripple.400="'rgba(255, 255, 255, 0.15)'"
            type="submit"
            variant="primary"
            class="mr-1"
          >
            Submit
          </b-button>
          <b-button
            v-ripple.400="'rgba(186, 191, 199, 0.15)'"
            type="reset"
            variant="outline-secondary"
          >
            Reset
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
      vergino: null,
      vergiad: null,
      telefon: null,
      sgk: null,
      yetkili: null,
    };
  },

  created() {
    axios("/api/firmagoster/" + this.options.user_id).then((res) => {
      var firma = res.data;

      this.name === firma.name,
        this.email === firma.email,
        this.vergino === firma.vergino,
        this.vergiad === firma.vergiad,
        this.telefon === firma.telefon,
        this.sg === firma.sgk,
        this.yetkili === firma.firma_yetkilisi

    });
  },

  methods: {},
};
</script>
