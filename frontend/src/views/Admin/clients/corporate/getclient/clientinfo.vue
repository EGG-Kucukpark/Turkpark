<template>
  <b-card>
    <validation-observer ref="registerForm">
      <b-row>
        <b-col
          cols="21"
          xl="6"
          class="d-flex justify-content-between flex-column"
        >
          <!-- User Avatar & Action Buttons -->
          <div class="d-flex justify-content-start">
            <div class="d-flex flex-column ml-1">
              <div class="mb-1">
                <h3 class="mb-2" v-show="show != true">
                  Firma Adı: {{ form.name }}
                </h3>

                <label v-show="show" for="">Firma Adı:</label>
                <b-form-input v-show="show" type="text" v-model="form.name" />
              </div>
            </div>
          </div>

          <!-- User Stats -->
          <div class="d-flex align-items-center mt-2">
            <div class="d-flex align-items-center mr-2">
              <b-avatar variant="light-primary" rounded>
                <feather-icon icon="UserIcon" size="18" />
              </b-avatar>
              <div class="ml-1">
                <h5 v-for="sayi in sayi" :key="sayi.id" class="mb-0">
                  <span v-if="userData.id === sayi.firma_id">
                    <span> {{ sayi.sayi }} </span>
                  </span>
                </h5>
                <small>Çalışan Sayısı</small>
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

              <validation-provider
                #default="{ errors }"
                name="E-Posta"
                rules="required|email"
              >
                <td class="pb-50">
                  <span v-show="show != true"> {{ form.email }} </span>

                  <b-form-input
                    style="width: 220px"
                    v-show="show"
                    type="text"
                    v-model="form.email"
                  />
                </td>
                <small class="text-danger">{{ errors[0] }}</small>
              </validation-provider>
            </tr>
            <tr>
              <th class="pb-50">
                <feather-icon icon="PhoneIcon" class="mr-75" />
                <span class="font-weight-bold">Telefon Numarası</span>
              </th>
              <td class="pb-50 text-capitalize">
                <span v-show="show != true"> {{ form.telefon }}</span>
                <validation-provider
                  #default="{ errors }"
                  name="Telefon"
                  rules="required"
                >
                  <cleave
                    id="phone"
                    v-model="form.telefon"
                    v-show="show"
                    style="width: 220px"
                    class="form-control"
                    :raw="false"
                    :state="errors.length > 0 ? false : null"
                    :options="options.phone"
                    placeholder="555 555 55 55"
                  />

                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </td>
            </tr>
            <tr>
              <th class="pb-50">
                <feather-icon icon="SlackIcon" class="mr-75" />
                <span class="font-weight-bold">Vergi Numarası</span>
              </th>
              <td class="pb-50 text-capitalize">
                <span v-show="show != true"> {{ form.vergino }}</span>
                <b-form-input
                  style="width: 220px"
                  v-show="show"
                  type="text"
                  v-model="form.vergino"
                />
              </td>
            </tr>
            <tr>
              <th class="pb-50">
                <feather-icon icon="BriefcaseIcon" class="mr-75" />
                <span class="font-weight-bold">Vergi Dairesi</span>
              </th>
              <td class="pb-50">
                <span v-show="show != true"> {{ form.vergiad }}</span>
                <b-form-input
                  style="width: 220px"
                  v-show="show"
                  type="text"
                  v-model="form.vergiad"
                />
              </td>
            </tr>
            <tr>
              <th>
                <feather-icon icon="MapPinIcon" class="mr-75" />
                <span class="font-weight-bold">İl</span>
              </th>
              <td>
                <span v-show="show != true">{{ form.il }}</span>
                <b-form-input
                  style="width: 220px"
                  v-show="show"
                  type="text"
                  v-model="form.il"
                />
              </td>
            </tr>
          </table>
        </b-col>
      </b-row>
    </validation-observer>

    <portal-target
      name="duzenle"
      v-on:change="
        show = !show;
        update();
      "
    ></portal-target>
  </b-card>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import Cleave from "vue-cleave-component";
import "cleave.js/dist/addons/cleave-phone.us";

export default {
  components: {
    ValidationProvider,
    Cleave,
    ValidationObserver,
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      options: {
        phone: {
          phone: true,
          phoneRegionCode: "US",
        },
      },
      errors: [],
      calisan: "",
      form: {
        name: null,
        email: null,
        telefon: null,
        vergino: null,
        vergiad: null,
        il: null,
        id: null,
      },
      sayi: null,
      show: false,
    };
  },
  created() {
    this.$http("/api/workersayi").then((res) => {
      this.sayi = res.data;
    });

    setTimeout(() => {
      this.form = this.userData
    }, 500);
  },
  methods: {
    update() {
      if (this.show === false) {
        this.$http.post("/api/firmaduzenle", this.form);
      }
    },
  },
};
</script>

<style>
</style>
