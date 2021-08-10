<template>
  <b-card title="Hizmet Geçmişi">
    <b-row>
      <b-col> </b-col>
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
          @row-clicked="tikla"
          show-empty
          empty-text="Veri Bulunamadı."
          empty-filtered-text="Veri Bulunamadı."
        >
          <template #cell(status)="data">
            <b-badge :variant="data.item.status === '0' ? 'warning' : 'success'"
              >{{ data.item.status === "0" ? "Beklemede" : "Onaylandı" }}
            </b-badge>
          </template>

          <template #cell(tutar)="data">
            <p>
              {{
                data.item.status === "0"
                  ? "Lütfen Mail Adresinizi Konrol Ediniz"
                  : data.item.tutar + " ₺"
              }}
            </p>
          </template>
          <template #cell(actions)="data">
            <span>
              <b-button
                variant="warning"
                @click.prevent="göster(data.item.id)"
                class="btn-icon"
                v-b-tooltip.hover.v-warning
                title="Göster"
                style="margin: 5px"
              >
                <feather-icon icon="ImageIcon" />
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
import talep from "../results/talep.vue";
export default {
  components: {
    ToastificationContent,
    talep,
  },

  data() {
    return {
      ...this.$store.state.global.table,
      fields: [
        { key: "lab", label: "Hİzmet", sortable: true, filter: true },
        { key: "id", label: "Fatura Numarası", sortable: true, filter: true },
        { key: "date", label: "Talep TARİHİ", sortable: true, filter: true },
        { key: "sayi", label: "Talep Sayısı", sortable: true, filter: true },

        { key: "status", label: "Durum", sortable: true, filter: true },
        { key: "tutar", label: "Tutar", sortable: true, filter: true },
        { key: "actions", label: "Eylemler" },
      ],
      items: [],
      user: JSON.parse(localStorage.getItem("user")),

      testler: [],
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
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);

    this.veri();
    console.log(this.$route.params);
    if (this.$route.params.status != null) {
      this.$http
        .post(`/api/billupdate`, {
          firma_id: this.user.user_id,
          id: this.$route.params.id,
          status: this.$route.params.status,
        })
        .then((res) => {
          this.veri();
        });
    }
  },

  methods: {
    veri() {
      this.$http
        .post("/api/getHizmet", { id: this.user.user_id })
        .then((res) => {
          this.items = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    tikla(data) {
      if (data.status === "1") {
        this.$router.push({
          name: "hizmet-gecmisi-goster",
          params: { id: data.id },
        });
      }
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
