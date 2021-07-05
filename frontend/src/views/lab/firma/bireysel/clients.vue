<template>
  <div>
    <b-card>
      <b-row>
        <b-col>
            <h3>Firma Listesi</h3>
          <b-form-group
            label-cols-sm="7"
            label-align-sm="left"
            label-size="sm"
            label-for="filterInput"
            class="mb-1"
          >
            <b-input-group>
              <b-form-input
                id="filterInput"
                v-model="filter"
                type="search"
                placeholder="Firma Ara..."
              />
            </b-input-group>
          </b-form-group>
        </b-col>


        <b-col cols="12" class="table-responsive">
          <b-table
            striped
            hover
            small
            responsive
            tableVariant="light"
            :per-page="perPage"
            :current-page="currentPage"
            :items="items"
            :fields="fields"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            :sort-direction="sortDirection"
            :filter="filter"
            :filter-included-fields="filterOn"
            @row-clicked="tikla"
            show-empty
            empty-text="Veri Bulunamadı."
            empty-filtered-text="Veri Bulunamadı."
            @filtered="onFiltered"
          >

          </b-table>
        </b-col>

        <b-col md="2" sm="4" class="my-1">
          <b-form-group class="mb-0">
            <b-form-select
              id="perPageSelect"
              v-model="perPage"
              size="sm"
              :options="pageOptions"
              class="w-50"
            />
          </b-form-group>
        </b-col>

        <b-col cols="12">
          <b-pagination
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            align="center"
            size="sm"
            class="my-0"
          />
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import Ripple from "vue-ripple-directive";

import {
  BTable,
  BAvatar,
  BBreadcrumb,
  BBreadcrumbItem,
  BBadge,
  VBTooltip,
  BRow,
  BCol,
  BFormGroup,
  BFormSelect,
  BPagination,
  BInputGroup,
  BFormInput,
  BInputGroupAppend,
  BButton,
  BCard,
  BModal,
  BForm,
} from "bootstrap-vue";
import axios from "@axios";
import { required } from "@validations";
import { togglePasswordVisibility } from "@core/mixins/ui/forms";
import { ValidationProvider, ValidationObserver } from "vee-validate";
export default {
  components: {
    BTable,
    BAvatar,
    BBadge,
    BRow,
    VBTooltip,
    BCol,
    BBreadcrumb,
    BBreadcrumbItem,
    BFormGroup,
    BFormSelect,
    BPagination,
    BInputGroup,
    BFormInput,
    BInputGroupAppend,
    BButton,
    BCard,
    ValidationProvider,
    ValidationObserver,
    togglePasswordVisibility,
    BModal,
    ToastificationContent,
    BForm,
    required,
  },
  mixins: [togglePasswordVisibility],
  directives: {
    "b-tooltip": VBTooltip,
    Ripple,
  },
  data() {
    return {
      errors: [],
      perPage: 10,
      pageOptions: [3, 5, 10],
      totalRows: 1,
      currentPage: 1,
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: [],
      infoModal: {
        id: "info-modal",
        title: "",
        content: "",
      },
      fields: [
        { key: "name", label: "İsim", sortable: true, filter: true },
        { key: "email", label: "E-Posta", sortable: true, filter: true },
        { key: "sgk", label: "SGK Numarası", sortable: true, filter: true },
        {
          key: "vergino",
          label: "Vergİ Numarası",
          sortable: true,
          filter: true,
        },
        {
          key: "vergiad",
          label: "Vergİ Daİresİ",
          sortable: true,
          filter: true,
        },
        {
          key: "telefon",
          label: "Telefon Numarası",
          sortable: true,
          filter: true,
        },
        {
          key: "firma_yetkilisi",
          label: "Fİrma Yetkİlİsİ",
          sortable: true,
        },


      ],
      items: [],
      name: "",
      sgkno: "",
      vergino: "",
      vergiad: "",
      firma_yetkilisi: "",

      email: "",
      role: "",
      telefon: "",
      password: "",
      id: "",
      searchTerm: "",
      options: "",

      show: false,
    };
  },

  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === "password" ? "EyeIcon" : "EyeOffIcon";
    },
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter((f) => f.sortable)
        .map((f) => ({ text: f.label, value: f.key }));
    },
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },
  created() {
    axios.post("/api/firmalar").then((response) => {
      this.items = response.data;
    });
  },

  methods: {
    refreshStop() {
      setTimeout(() => {
        axios
          .post("/api/firmalar")
          .then((response) => {
            this.items = response.data;
          })
          .then(
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Firma İşlemleri `,
                icon: "BriefcaseIcon",
                variant: "success",
                text: ` İşlem Başarılı.`,
              },
            })
          );
      }, 1000);
    },
    tikla(params) {
        this.$emit("id", params.id);

    },
    arsiv(data) {
      console.log(data.id);

      axios.post("api/arsivfirma", { id: data.id }).then(this.refreshStop());
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

    Modal1() {
      this.$refs["modal1"].show();
    },

    Modal2(row) {
      this.$refs["modal2"].show();
      (this.id = row.id),
        (this.name = row.name),
        (this.sgkno = row.sgk),
        (this.vergiad = row.vergiad),
        (this.vergino = row.vergino),
        (this.email = row.email),
        (this.firma_yetkilisi = row.firma_yetkilisi),
        (this.telefon = row.telefon);
    },

    update() {
      axios
        .post("/api/firmaduzenle", {
          id: this.id,
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          vergino: this.vergino,
          vergiad: this.vergiad,
          firma_yetkilisi: this.firma_yetkilisi,
          sgk: this.sgkno,
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
              text: `İşlem Başarısız.`,
            },
          });
        })
        .then(this.form());
    },

    form() {
      this.$refs["modal1"].hide(),
        this.$refs["modal2"].hide(),
        (this.id = ""),
        (this.name = ""),
        (this.sgkno = ""),
        (this.vergiad = ""),
        (this.vergino = ""),
        (this.email = ""),
        (this.firma_yetkilisi = ""),
        (this.telefon = "");
    },

    info(item, index, button) {
      this.infoModal.title = `Row index: ${index}`;
      this.infoModal.content = JSON.stringify(item, null, 2);
      this.$root.$emit("bv::show::modal", this.infoModal.id, button);
    },
    resetInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },
};
</script>
