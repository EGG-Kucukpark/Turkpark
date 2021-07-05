<template>
  <b-card title="Bireysel Müşteriler">
    <b-row>
      <b-col>
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
              placeholder="Kişi Ara..."
            />
          </b-input-group>
        </b-form-group>
      </b-col>



      <b-col cols="12">
        <b-table
          striped
          small
          hover
          responsive
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
          @filtered="onFiltered"
          show-empty
          empty-text="Veri Bulunamadı."
          empty-filtered-text="Veri Bulunamadı."
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
</template>

<script>
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import Ripple from "vue-ripple-directive";
import {
  BTable,
  BAvatar,
  BBadge,
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
  VBTooltip,
  BForm,
} from "bootstrap-vue";
import axios from "@axios";

export default {
  components: {
    BTable,
    BAvatar,
    BBadge,
    BRow,
    BCol,
    BFormGroup,
    BFormSelect,
    BPagination,
    BInputGroup,
    VBTooltip,
    BFormInput,
    BInputGroupAppend,
    BButton,
    BCard,
    BModal,
    ToastificationContent,
    BForm,
  },
  directives: {
    "b-tooltip": VBTooltip,
    Ripple,
  },
  data() {
    return {
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
        { key: "name", label: "İSİM", sortable: true },
        { key: "email", label: "E-Posta", sortable: true },
        { key: "adres", label: "Adres", sortable: true },
        { key: "tc", label: "TC. Kİmlİk Numarası", sortable: true },
        { key: "telefon", label: "Telefon", sortable: true },


      ],
      items: [],
      name: "",
      email: "",
      telefon: "",
      id: "",

      show: false,
    };
  },

  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter((f) => f.sortable)
        .map((f) => ({ text: f.label, value: f.key }));
    },
  },
  mounted() {
    // Set the initial number of items
    this.totalRows = this.items.length;
  },
  created() {
    axios.post("/api/bireyseller").then((response) => {
      this.items = response.data;
    });
  },

  methods: {
    refreshStop() {
      setTimeout(() => {
        axios
          .post("/api/bireyseller")
          .then((response) => {
            this.items = response.data;
          })
          .then(
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Bireysel İşlemler `,
                icon: "BriefcaseIcon",
                variant: "success",
                text: ` İşlem Başarılı.`,
              },
            })
          );
      }, 1000);
    },
    arsiv(data) {
      axios
        .post("/api/indarsiv", { id: data.id })
        .then((res) => {
          this.refreshStop();
        })
        .catch((error) => {
          this.hata();

        });
    },

    hata() {
      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Bireysel İşlemler `,
          icon: "BriefcaseIcon",
          variant: "danger",
          text: ` İşlem Başarısız.`,
        },
      });
    },

    tikla(params) {
     this.$emit('id', params.id)
    },

    submit() {
      axios
        .post("/api/bireyselekle", {
          name: this.name,
          email: this.email,
          telefon: this.telefon,
        })
        .then((res) => this.refreshStop())
        .catch((error) => {
          this.hata();
        })
        .then(this.form());
    },

    update() {
      axios
        .post("/api/bireyselduzenle", {
          id: this.id,
          name: this.name,
          email: this.email,
          telefon: this.telefon,
        })
        .then((res) => this.refreshStop())
        .catch((error) => this.hata())
        .then(this.form());
    },

    Modal1() {
      this.$refs["modal1"].show();
    },

    modal2(row) {
      (this.id = row.id),
        (this.name = row.name),
        (this.email = row.email),
        (this.telefon = row.telefon);
    },

    form() {
      this.$refs["modal1"].hide(),
        this.$refs["modal2"].hide(),
        (this.name = ""),
        (this.email = ""),
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
