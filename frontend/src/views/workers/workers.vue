<template>
  <b-card title="Çalışan Raporları">
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
              placeholder="........"
            />
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col cols="12" class="table-responsive">
        <b-table
          striped
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
          @filtered="onFiltered"
          show-empty
          empty-text="Veri Bulunamadı."
          empty-filtered-text="Veri Bulunamadı."
        >
          <template #cell(actions)="data">
            <span>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="warning"
                @click.prevent="göster(data.item.dosya_ad)"
                class="btn-icon"
                v-b-tooltip.hover.v-warning
                title="Göster"
              >
                <feather-icon icon="ImageIcon" />
              </b-button>

              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="success"
                @click.prevent="indir(data.item.dosya_ad)"
                class="btn-icon"
                v-b-tooltip.hover.v-success
                title="İndir"
              >
                <feather-icon icon="DownloadIcon" />
              </b-button>
            </span>
          </template>
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
import ripple from "vue-ripple-directive";

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
  BAlert,
  BProgress,
  BModal,
  BForm,
  VBTooltip,
  BFormFile,
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
    BFormInput,
    BAlert,
    BProgress,
    BInputGroupAppend,
    BButton,
    BCard,
    BModal,
    ToastificationContent,
    BForm,
    VBTooltip,
    BFormFile,
  },
  directives: {
    "b-tooltip": VBTooltip,
    ripple,
  },

  data() {
    return {
      perPage: 10,
      pageOptions: [10, 20, 30],
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
        { key: "id", label: "Rapor Numarası", sortable: true, filter: true },

        { key: "name", label: "Çalışan ismi", sortable: true, filter: true },
        { key: "rapor", label: "Dosya Adı", sortable: true, filter: true },
        { key: "created_at", label: "Tarih", sortable: true, filter: true },

        { key: "actions", label: "Eylemler" },
      ],
      items: [],
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
  created() {
    var user = JSON.parse(localStorage.getItem("user"));

    var mail = user.email;
    axios
      .post("/api/getfile", { firma_email: mail, status: 8 })
      .then((res) => (this.items = res.data));
  },

  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },
  methods: {
    göster(dosya) {
      window.open("/Dosyalar/" + dosya, "_blank");
    },

    indir(dosya) {
      axios
        .post(
          "/api/indir",
          { id: this.id, dosya: dosya },
          { responseType: "blob" }
        )
        .then((response) => {
          var data = response.data;
          const url = window.URL.createObjectURL(new Blob([data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", dosya);
          document.body.appendChild(link);
          link.click();
        });
    },

    modal() {
      this.$refs["modal"].show();
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
