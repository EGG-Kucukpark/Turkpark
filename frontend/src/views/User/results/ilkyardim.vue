<template>
  <b-card title="İlkyardım Raporları">
    <b-row>
      <b-col>
        <talep :userData="user" />
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
          @row-clicked="tikla"
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
                title="Göster"
                style="margin: 5px"
              >
                <feather-icon icon="ImageIcon" />
              </b-button>

              <b-button
                variant="success"
                @click.prevent="indir(data.item.dosya_ad)"
                class="btn-icon"
                v-b-tooltip.hover.v-success
                title="İndir"
                style="margin: 5px"
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
import talep from "./yardimTalep.vue";

export default {
  components: {
    ToastificationContent,
    talep,
  },

  data() {
    return {
      ...this.$store.state.global.table,
      fields: [
        { key: "id", label: "Rapor Numarası", sortable: true, filter: true },
        { key: "name", label: "ÇALIŞAN İSMİ", sortable: true, filter: true },
        {
          key: "egitim_tur",
          label: "EĞİTİM TÜRÜ",
          sortable: true,
          filter: true,
        },
        {
          key: "gecerli_trh",
          label: "GEÇERLİLİK Tarİhİ",
          sortable: true,
          filter: true,
        },
        { key: "actions", label: "Eylemler" },
      ],
      items: [],
      user: JSON.parse(localStorage.getItem("user")),
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
      .post(`/api/sertifikagetir`, { id: this.user.user_id })
      .then((response) => {
        this.items = response.data;
      });
  },

  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },
  methods: {
    tikla(params) {
      this.$router.push({
        name: "sertifika-goster",
        params: { id: params.id },
      });
    },


    onFiltered(filteredItems) {

      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },
};
</script>
