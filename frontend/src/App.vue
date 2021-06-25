<template>
  <div id="app" class="h-100" :class="[skinClasses]">
    <component :is="layout">
      <b-modal
        hide-header-close
        ok-title="Kaydet"
        :hide-footer="true"
        size="lg"
        ref="modal1"
        centered
        title="Firma Ekle"
      >
        <b-card>
          <b-form @submit.prevent="submit">
            <b-form-group
              label="İşyeri Ünvanı:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="name"
                placeholder="İş Yeri Adını Giriniz..."
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Firma Yetkilisi:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="firma_yetkilisi"
                placeholder="Firma Yetkilisinin Adını Giriniz..."
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="SGK Sicil No:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="sgkno"
                placeholder="SGK Sicil Numarasını Giriniz..."
              ></b-form-input>
            </b-form-group>
            <b-form-group
              label="Vergi Dairesi"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="vergiad"
                placeholder="Vergi Dairesi Adını Giriniz"
              ></b-form-input>
            </b-form-group>
            <b-form-group
              label="Vergi No:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="vergino"
                placeholder="Vergi Numarası"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="E-Posta Adresi"
              label-for="email"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="email"
                v-model="email"
                placeholder="E-posta Adresini Giriniz"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Telefon No:"
              label-for="telefon"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="telefon"
                v-model="telefon"
                placeholder="Firma Telefon Numarası"
              ></b-form-input>
            </b-form-group>
            <b-form-group
              label="Firma Şifresi:"
              label-for="password"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="password"
                v-model="password"
                placeholder="Şifre Giriniz"
              ></b-form-input>
            </b-form-group>

            <div style="float: right">
              <b-button variant="success" type="submit" id="firmaekle">
                Tamam
              </b-button>
            </div>
            <div style="float: right; padding-right: 10px">
              <b-button variant="danger" @click="form()"> İptal</b-button>
            </div>
          </b-form>
        </b-card>
      </b-modal>

      <router-view />
    </component>
  </div>
</template>

<script>
// This will be populated in `beforeCreate` hook
import { $themeColors, $themeBreakpoints, $themeConfig } from "@themeConfig";
import { provideToast } from "vue-toastification/composition";
import { watch } from "@vue/composition-api";
import useAppConfig from "@core/app-config/useAppConfig";

import { useWindowSize, useCssVar } from "@vueuse/core";
import { BModal, BButton, BCard } from "bootstrap-vue";
import axios from "@axios";

import store from "@/store";

const LayoutVertical = () => import("@/layouts/vertical/LayoutVertical.vue");
const LayoutHorizontal = () =>
  import("@/layouts/horizontal/LayoutHorizontal.vue");
const LayoutFull = () => import("@/layouts/full/LayoutFull.vue");

export default {
  data() {
    return {
      name: "",
      sgkno: "",
      vergino: "",
      vergiad: "",
      firma_yetkilisi: "",
      email: "",
      role: "",
      telefon: "",
      password: "",
    };
  },
  components: {
    // Layouts
    LayoutHorizontal,
    LayoutVertical,
    LayoutFull,
    BModal,
    BButton,
    BCard,
  },
  // ! We can move this computed: layout & contentLayoutType once we get to use Vue 3
  // Currently, router.currentRoute is not reactive and doesn't trigger any change
  computed: {
    layout() {
      if (this.$route.meta.layout === "full") return "layout-full";
      return `layout-${this.contentLayoutType}`;
    },
    contentLayoutType() {
      return this.$store.state.appConfig.layout.type;
    },
  },
  beforeCreate() {
    // Set colors in theme
    const colors = [
      "primary",
      "secondary",
      "success",
      "info",
      "warning",
      "danger",
      "light",
      "dark",
    ];

    // eslint-disable-next-line no-plusplus
    for (let i = 0, len = colors.length; i < len; i++) {
      $themeColors[colors[i]] = useCssVar(
        `--${colors[i]}`,
        document.documentElement
      ).value.trim();
    }

    // Set Theme Breakpoints
    const breakpoints = ["xs", "sm", "md", "lg", "xl"];

    // eslint-disable-next-line no-plusplus
    for (let i = 0, len = breakpoints.length; i < len; i++) {
      $themeBreakpoints[breakpoints[i]] = Number(
        useCssVar(
          `--breakpoint-${breakpoints[i]}`,
          document.documentElement
        ).value.slice(0, -2)
      );
    }

    // Set RTL
    const { isRTL } = $themeConfig.layout;
    document.documentElement.setAttribute("dir", isRTL ? "rtl" : "ltr");
  },
  setup() {
    const { skin, skinClasses } = useAppConfig();

    // If skin is dark when initialized => Add class to body
    if (skin.value === "dark") document.body.classList.add("dark-layout");

    // Provide toast for Composition API usage
    // This for those apps/components which uses composition API
    // Demos will still use Options API for ease
    provideToast({
      hideProgressBar: true,
      closeOnClick: false,
      closeButton: false,
      icon: false,
      timeout: 2000,
      transition: "Vue-Toastification__fade",
    });

    // Set Window Width in store
    store.commit("app/UPDATE_WINDOW_WIDTH", window.innerWidth);
    const { width: windowWidth } = useWindowSize();
    watch(windowWidth, (val) => {
      store.commit("app/UPDATE_WINDOW_WIDTH", val);
    });

    return {
      skinClasses,
    };
  },

  methods: {
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
          nace: this.nace,
        })
        .then((res) => this.refreshStop())
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
      this.$refs["modal"].hide();
    },
  },
};
</script>
