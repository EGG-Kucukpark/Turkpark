<template>
  <b-card title="Firma Tüm Bilgiler">
    <validation-observer ref="registerForm">
      <b-form @submit.prevent>
        <b-row>
          <b-col md="6">
            <b-form-group label="Firma Adı" label-for="mc-first-name">
              <validation-provider
                #default="{ errors }"
                name="Firma Adı"
                rules="required"
              >
                <b-form-input
                  id="mc-first-name"
                  v-model="name"
                  placeholder="First Name"
                />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <b-col md="6">
            <b-form-group label="Firma Yetkilisi" label-for="mc-last-name">
              <validation-provider
                #default="{ errors }"
                name="Firma Yetkilisi"
                rules="required"
              >
                <b-form-input v-model="yetkili" id="mc-last-name" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
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
            <b-form-group label="Telefon Numaranız:">
              <validation-provider
                #default="{ errors }"
                name="Telefon"
                rules="required"
              >
                <cleave
                  id="phone"
                  v-model="telefon"
                  class="form-control"
                  :raw="false"
                  :state="errors.length > 0 ? false : null"
                  :options="options.phone"
                  placeholder="555 555 55 55"
                />

                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
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
                <validation-provider
                  #default="{ errors }"
                  name="E-Posta"
                  rules="required|email"
                >
                  <b-form-input
                    :class="errors.length > 0 ? 'is-invalid' : null"
                    v-model="email"
                    id="mc-email"
                    type="email"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
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
    </validation-observer>
  </b-card>
</template>


<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import { required, email } from "@validations";
import BCardActions from "@core/components/b-card-actions/BCardActions.vue";
import axios from "@axios";
import Cleave from "vue-cleave-component";
import {
  BRow,
  BCol,
  BFormGroup,
  BFormInput,
  BFormTextarea,
  BFormCheckbox,
  BCard,
  BForm,
  BButton,
} from "bootstrap-vue";
import Ripple from "vue-ripple-directive";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
export default {
  components: {
    BRow,
    BCol,
    BFormTextarea,
    BFormGroup,
    BFormInput,
    BFormCheckbox,
    BForm,
    BCard,
    Cleave,
    BButton,
    ValidationProvider,
    ValidationObserver,
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
      data: false,
      vergino: null,
      vergiad: null,
      telefon: null,
      sgk: null,
      id: this.options.user_id,
      yetkili: null,
      muhasebe: null,
      adres: null,
    };
  },

  created() {
    this.reset();
  },

  methods: {
    reset() {
      axios("/api/firmagoster/" + this.options.user_id).then((res) => {
        var firma = res.data;

        (this.name = firma.name),
          (this.email = firma.email),
          (this.vergino = firma.vergino),
          (this.vergiad = firma.vergiad),
          (this.telefon = firma.telefon),
          (this.sg = firma.sgk),
          (this.yetkili = firma.firma_yetkilisi),
          (this.adres = firma.adres);
        this.muhasebe = firma.muhasebe;
      });
    },
    update() {
      this.data = true;
      axios
        .post("/api/bireyselduzenle", {
          id: this.id,
          name: this.name,
          vergino: this.vergino,
          vergiad: this.vergiad,
          telefon: this.telefon,
          sgk: this.sgk,
          firma_yetkilisi: this.yetkili,
          adres: this.adres,
          muhasebe: this.muhasebe,
          email: this.email,
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

      var user = JSON.parse(localStorage.getItem("user"));
      user.name = this.name;
      localStorage.setItem("user", JSON.stringify(user));
    },
  },
};
</script>
