<template>
  <b-card title="Kişi Tüm Bilgiler">
    <b-form @submit.prevent="update">
      <b-row>
        <b-col md="6">
          <b-form-group label="Kişi Adı" label-for="mc-first-name">
            <b-form-input id="mc-first-name" v-model="name" />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="TC. Kimlik Numarası" label-for="mc-last-name">
            <b-form-input id="mc-last-name" v-model="tc" />
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label="Adres" label-for="mc-city">
            <b-form-input id="mc-city" v-model="adres" />
          </b-form-group>
        </b-col>

        <b-col md="6">
          <b-form-group label="Telefon" label-for="mc-company">
            <div class="form-label-group">
              <b-form-input id="mc-company" v-model="telefon" />
            </div>
          </b-form-group>
        </b-col>
        <b-col md="6">
          <b-form-group label-for="mc-email" label="E-Posta">
            <div class="form-label-group">
              <b-form-input id="mc-email" v-model="email" type="email" />
            </div>
          </b-form-group>
        </b-col>

        <!-- submit and reset -->
        <b-col>
          <b-button
            v-ripple.400="'rgba(255, 255, 255, 0.15)'"
            type="submit"
            variant="primary"
            class="mr-1"
          >
            Güncelle
          </b-button>
          <b-button
            v-ripple.400="'rgba(186, 191, 199, 0.15)'"
            variant="outline-secondary"
            @click="reset"
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
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import axios from "@axios";
import {
  BRow,
  BCol,
  BCard,
  BFormGroup,
  BFormInput,
  BFormCheckbox,
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
    userData: {
      type: Object,
      required: true,
    },
  },
  directives: {
    Ripple,
  },

  data() {
    return {
      name: null,
      tc: null,
      telefon: null,
      adres: null,
      email: null,
      id: this.userData.id,
    };
  },
  created() {
    this.reset();
  },

  methods: {
    reset() {
      (this.name = this.userData.name),
        (this.tc = this.userData.tc),
        (this.telefon = this.userData.telefon),
        (this.adres = this.userData.adres),
        (this.email = this.userData.email);
    },
    update() {
      axios
        .post("/api/bireyselduzenle", {
          id: this.id,
          name: this.name,
          email: this.email,
          adres: this.adres,
          tc: this.tc,
          telefon:this.telefon
        })
        .then((res) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Firma Ekleme `,
              icon: "BriefcaseIcon",
              variant: "success",
              text: `Ekleme İşlemi Başarılı.`,
            },
          });
        })
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Kişi Ekleme `,
              icon: "BriefcaseIcon",
              variant: "danger",
              text: ` İşlem Başarısız.`,
            },
          });
        });
    },
  },
};
</script>
