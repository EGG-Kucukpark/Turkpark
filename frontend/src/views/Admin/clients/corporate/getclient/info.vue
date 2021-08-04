<template>
  <b-card title="Firma Tüm Bilgiler">
    <validation-observer ref="registerForm">
      <b-form @submit.prevent="update">
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
                  v-model="form.name"
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
                <b-form-input v-model="form.yetkili" id="mc-last-name" />
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </b-form-group>
          </b-col>
          <b-col md="6">
            <b-form-group label="Firma Muhasebe" label-for="mc-last-name">
              <b-form-input v-model="form.muhasebe" id="mc-last-name" />
            </b-form-group>
          </b-col>
          <b-col md="6">
            <b-form-group label="Vergi Numarası" label-for="mc-city">
              <b-form-input v-model="form.vergino" id="mc-city" />
            </b-form-group>
          </b-col>
          <b-col md="6">
            <b-form-group label="SGK Sicil Numarası" label-for="mc-country">
              <b-form-input v-model="form.sgk" id="mc-country" />
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
                  v-model="form.telefon"
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
                <b-form-input v-model="form.vergiad" id="mc-company" />
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
                    v-model="form.email"
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
              <b-form-textarea v-model="form.adres" id="mc-last-name" />
            </b-form-group>
          </b-col>

          <!-- submit and reset -->
          <b-col style="margin: 50px">
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
    </validation-observer>
  </b-card>
</template>


<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import Ripple from "vue-ripple-directive";
import Cleave from "vue-cleave-component";
// eslint-disable-next-line import/no-extraneous-dependencies
import "cleave.js/dist/addons/cleave-phone.us";
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    Cleave,
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
      form: {
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
      },
      error: [],
      options: {
        phone: {
          phone: true,
          phoneRegionCode: "US",
        },
      },
    };
  },

  methods: {
    update() {
      this.$http
        .post("/api/firmaduzenle", this.form)
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
      this.$http.get("/api/firmagoster/" + this.id).then((res) => {
        var firma = res.data;

        this.form = firma;
      });
    },
  },
};
</script>
