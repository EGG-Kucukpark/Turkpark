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
          <b-form-group label="Firma Muhasebe" label-for="mc-last-name">
            <b-form-input v-model="muhasebe" id="mc-last-name" />
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

        <b-col md="6">
          <b-form-group label="Adres" label-for="mc-last-name">
            <b-form-textarea v-model="adres" id="mc-last-name" />
          </b-form-group>
        </b-col>

        <!-- submit and reset -->
        <b-col>
          <b-button
            v-ripple.400="'rgba(255, 255, 255, 0.15)'"
            type="submit"
            variant="primary"
            class="mr-1"
            @click="update"
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
import {
  BRow,
  BCol,
  BFormGroup,
  BFormInput,
  BFormCheckbox,
  BCard,
  BFormTextarea,
  BForm,
  BButton,
} from "bootstrap-vue";
import Ripple from "vue-ripple-directive";
import axios from "@axios";
export default {
  components: {
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BFormCheckbox,
    BFormTextarea,
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
      name: this.userData.name,
      email: this.userData.email,
      vergino: this.userData.vergino,
      vergiad: this.userData.vergiad,
      telefon: this.userData.telefon,
      sgk: this.userData.sgk,
      yetkili: this.userData.firma_yetkilisi,
      adres: this.userData.adres,
      id: this.userData.id,
      muhasebe: this.userData.muhasebe,
    };
  },

  methods: {
    update() {
      axios
        .post("/api/firmaduzenle", {
          id: this.id,
          name: this.name,
          email: this.email,
          vergino: this.vergino,
          vergiad: this.vergiad,
          telefon: this.telefon,
          sgk: this.sgk,
          firma_yetkilisi: this.yetkili,
          adres: this.adres,
          muhasebe: this.muhasebe,
        })
        .then((res) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Kullanıcı İşlemleri `,
              icon: "UserIcon",
              variant: "success",
              text: ` İşlem Başarılı.`,
            },
          });

          this.reset();
        })
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Kullanıcı İşlemleri `,
              icon: "UserIcon",
              variant: "danger",
              text: ` İşlem Başarısız.`,
            },
          });
        });
    },

    reset() {
      axios.get("/api/firmagoster/" + this.id).then((res) => {
        var firma = res.data;

        (this.name = firma.name),
          (this.email = firma.email),
          (this.vergino = firma.vergino),
          (this.vergiad = firma.vergiad),
          (this.telefon = firma.telefon),
          (this.sgk = firma.sgk),
          (this.firma_yetkilisi = firma.yetkili),
          (this.adres = firma.adres),
          (this.muhasebe = firma.muhasebe);
      });
    },
  },
};
</script>
