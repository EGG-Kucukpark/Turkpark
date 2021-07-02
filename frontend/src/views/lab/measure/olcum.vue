  <template>
  <b-tabs v-if="userData" pills>
    <!-- Tab: Account -->
    <b-tab active>
      <template #title>
        <feather-icon icon="BriefcaseIcon" size="16" class="mr-0 mr-sm-50" />
        <span class="d-none d-sm-inline"> Firma Sonuçları </span>
      </template>
      <client :user-data="userData" class="mt-2 pt-75" />
    </b-tab>

    <!-- Tab: Information -->
    <b-tab v-if="show">
      <template #title>
        <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
        <span class="d-none d-sm-inline">Bireysel Sonuçlar</span>
      </template>
      <individual :user-data="userData" class="mt-2 pt-75" />
    </b-tab>

    <!-- Tab: Social -->
  </b-tabs>
</template>
<script>
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";

import axios from "@axios";

import { ref } from "@vue/composition-api";
import {
  BRow,
  BCard,
  BCol,
  BBreadcrumb,
  BBreadcrumbItem,
  BAlert,
  BLink,
  BTabs,
  BModal,
  BForm,
  BFormInput,
  BTab,
  BButton,

  BFormSelect,
  BInputGroup,
  BInputGroupAppend,
  BFormGroup,
} from "bootstrap-vue";

import { required } from "@validations";
import { togglePasswordVisibility } from "@core/mixins/ui/forms";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import individual from "./individual";
import client from "./client";
import Individual from './individual.vue';

export default {
  components: {
    BRow,
    BCol,
    BCard,
    BAlert,
    BModal,
    BLink,
    BBreadcrumb,
    BBreadcrumbItem,
    ValidationProvider,
    ValidationObserver,
    BInputGroup,
    BInputGroupAppend,
    BForm,
    BFormInput,
    BTabs,
    BTab,
    togglePasswordVisibility,
    required,
    BButton,
    BFormSelect,
    ToastificationContent,
    BFormGroup,

    // Local Components

    individual,

    client,


    Individual,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      show: true,
      sonuclar: "disabled",
      sonuc: null,
      name: "",
      sgkno: "",
      vergino: "",
      vergiad: "",
      firma_yetkilisi: "",
      email: "",
      role: "",
      telefon: "",
      password: "",
      errors: [],
    };
  },
  created() {
    var user = JSON.parse(localStorage.getItem("user"));
    if (user.role == "Firma") {
      this.show = false;
    }
  },
  setup() {
    const userData = ref(null);
    userData.value = JSON.parse(localStorage.getItem("user"));

    return {
      userData,
    };
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === "password" ? "EyeIcon" : "EyeOffIcon";
    },
  },

  methods: {
    basarili() {
      if (document.getElementById("basarili") === null) {
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
      } else {
        document.getElementById("basarili").value === "firma",
          document.getElementById("basarili").click();
      }
    },

    submit() {
      axios
        .post("/api/firmaekle", {
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          password: this.password,
          vergino: this.vergino,
          vergiad: this.vergiad,
          firma_yetkilisi: this.firma_yetkilisi,
          sgk: this.sgkno,
        })
        .then((res) => this.basarili())
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Firma İşlemleri `,
              icon: "BriefcaseIcon",
              variant: "danger",
              text: ` İşlem Başarısız.`,
            },
          });
        })
        .then(this.form());
    },

    form() {
      this.$refs["firmaekle"].hide();

      (this.name = ""),
        (this.sgkno = ""),
        (this.password = ""),
        (this.vergiad = ""),
        (this.vergino = ""),
        (this.email = ""),
        (this.firma_yetkilisi = ""),
        (this.telefon = "");
    },
  },
};
</script>

