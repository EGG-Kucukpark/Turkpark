<template>
  <b-card title="Çalışan Sonuçları">
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
          selectable
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
                variant="warning"
                @click.prevent="göster(data.item.dosya_ad)"
                class="btn-icon"
                v-b-tooltip.hover.v-warning
                style="margin: 5px"
                title="Göster"
              >
                <feather-icon icon="ImageIcon" />
              </b-button>

              <b-button
                variant="danger"
                @click.prevent="arsivle(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-danger
                style="margin: 5px"
                title="Arşivle"
              >
                <feather-icon icon="ArchiveIcon" />
              </b-button>

              <b-button
                variant="success"
                @click.prevent="indir(data.item.dosya_ad)"
                class="btn-icon"
                style="margin: 5px"
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
export default {
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      ...this.$store.state.global.table,
      fields: [
        { key: "id", label: "Rapor Numarası", sortable: true, filter: true },
        { key: "name", label: "Çalışan İSMİ", sortable: true, filter: true },
        { key: "rapor", label: "TEST TÜRÜ", sortable: true, filter: true },
        { key: "created_at", label: "Tarİh", sortable: true, filter: true },
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
    this.$http
      .post("/api/getfile", { calisan_id: this.userData.id, status: 9 })
      .then((res) => (this.items = res.data));
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },
  methods: {
    göster(dosya) {
      window.open("/Dosyalar/Firma/" + dosya, "_blank");
    },

    indir(dosya) {
      this.$http
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
