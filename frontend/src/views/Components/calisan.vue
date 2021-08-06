<template>
  <span>
    <b-button
      class="mb-1"
      style="margin-right: 50px"
      variant="success"
      v-on:click="$refs['modal'].show()"
    >
      Çalışan Ekle
    </b-button>
    <b-modal
      hide-header-close
      ok-title="Kaydet"
      :hide-footer="true"
      size="lg"
      ref="modal"
      centered
      title="Çalışan Ekle"
    >
      <validation-observer ref="registerForm" #default="{ invalid }">
        <b-form ref="submit" @submit.prevent="ekle">
          <b-form-group label="İsim:" label-for="isim" label-cols-sm="2">
            <validation-provider #default="{ errors }" name="İsim">
              <b-form-input
                id="isim"
                :state="errors.length > 0 ? false : true"
                v-model="form.name"
                placeholder="İş Yeri Adını Giriniz..."
              ></b-form-input>
              <small class="text-danger">{{ errors[0] }}</small>
            </validation-provider>
          </b-form-group>
          <b-form-group
            label="TC. Kimlik Numarası:"
            label-for="isim"
            label-cols-sm="2"
          >
            <b-form-input
              id="isim"
              v-model="form.tc"
              placeholder="TC. Kimlik No Giriniz"
            ></b-form-input>
          </b-form-group>

          <b-form-group
            label="E-Posta Adresi"
            label-for="email"
            label-cols-sm="2"
          >
            <b-form-input
              id="email"
              v-model="form.email"
              placeholder="E-posta Adresini Giriniz"
            ></b-form-input>
          </b-form-group>

          <b-form-group
            label="Telefon No:"
            label-for="telefon"
            label-cols-sm="2"
          >
            <b-form-input
              id="telefon"
              v-model="form.telefon"
              placeholder="Kullanıcı Telefon Numarası"
            ></b-form-input>
          </b-form-group>

          <div style="float: right">
            <b-button variant="success" type="submit" :disabled="invalid">
              Tamam
            </b-button>
          </div>
          <div style="float: right; padding-right: 10px">
            <b-button variant="danger" @click="$refs.modal.hide()">
              İptal</b-button
            >
          </div>
        </b-form>
      </validation-observer>

      <!-- Emulate built in modal footer ok and cancel button actions -->
    </b-modal>
  </span>
</template>
<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import { required } from "@validations";
export default {
  props: {
    userData: Object,
    calisanlar: Function,
  },
  components: {
    ToastificationContent,
    ValidationProvider,
    ValidationObserver,
    required,
  },
  data() {
    return {
      form: {
        name: null,
        tc: null,
        email: null,
        telefon: null,
        id: this.userData.id,
        calisan_id: null,
      },

      errors: [],
    };
  },

  methods: {
    ekle() {
        this.$refs.modal.hide();
      this.$http
        .post("/api/calisanekle", this.form)
        .then((res) => {
          this.basarili();
          this.calisanlar(this.form.id);
        })
        .catch((error) => {
          this.basarisiz();
        });
    },
    basarili() {
      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Firma İşlemleri `,
          icon: "BriefCaseIcon",
          variant: "success",
          text: ` İşlem Başarılı.`,
        },
      });
    },
    basarisiz() {
      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Firma İşlemleri `,
          icon: "BriefCaseIcon",
          variant: "danger",
          text: ` İşlem Başarısız.`,
        },
      });
    },
  },
};
</script>
