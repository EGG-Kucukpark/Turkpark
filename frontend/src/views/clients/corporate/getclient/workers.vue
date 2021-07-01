<template>
  <b-card title="Çalışanlar">
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

      <span>
        <b-button
          class="mb-1"
          style="margin-right: 50px"
          variant="success"
          v-on:click="$refs['modal'].show()"
          >Yeni Çalışan</b-button
        >
        <b-modal
          hide-header-close
          ok-title="Kaydet"
          :hide-footer="true"
          size="lg"
          ref="modal"
          centered
          title="Çalışan Ekle"
        >
          <b-form @submit.prevent="ekle">
            <b-form-group
              label="İsim:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="name"
                placeholder="İsim Giriniz"
              ></b-form-input>
            </b-form-group>
            <b-form-group
              label="TC. Kimlik Numarası:"
              label-for="isim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="isim"
                v-model="tc"
                placeholder="TC. Kimlik Numarası Giriniz"
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
                placeholder="Kullanıcı Telefon Numarası"
              ></b-form-input>
            </b-form-group>

            <div style="float: right">
              <b-button variant="success" type="submit"> Tamam </b-button>
            </div>
            <div style="float: right; padding-right: 10px">
              <b-button variant="danger" @click="form()"> İptal</b-button>
            </div>
          </b-form>

          <!-- Emulate built in modal footer ok and cancel button actions -->
        </b-modal>
      </span>

      <b-modal
        hide-header-close
        ok-title="Kaydet"
        :hide-footer="true"
        size="lg"
        ref="modal2"
        centered
        title="Çalışan Düzenle"
      >
        <b-form @submit.prevent="duzenle">
          <b-form-group
            label="İsim:"
            label-for="isim"
            label-cols-sm="3"
            label-align-sm="right"
          >
            <b-form-input
              id="isim"
              v-model="name"
              placeholder="İsim Giriniz"
            ></b-form-input>
          </b-form-group>
          <b-form-group
            label="TC. Kimlik Numarası:"
            label-for="isim"
            label-cols-sm="3"
            label-align-sm="right"
          >
            <b-form-input
              id="isim"
              v-model="tc"
              placeholder="TC. Kimlik Numarası Giriniz"
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
              placeholder="Kullanıcı Telefon Numarası"
            ></b-form-input>
          </b-form-group>

          <div style="float: right">
            <b-button variant="success" type="submit"> Tamam </b-button>
          </div>
          <div style="float: right; padding-right: 10px">
            <b-button variant="danger" @click="form()"> İptal</b-button>
          </div>
        </b-form>

        <!-- Emulate built in modal footer ok and cancel button actions -->
      </b-modal>

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
          @row-clicked="tikla"
          :filter-included-fields="filterOn"
          show-empty
          empty-text="Veri Bulunamadı."
          empty-filtered-text="Veri Bulunamadı."
        >
          <p style="text-align: center; width: 100%" show-empty>
            >
            <b> Sonuç Bulunamadı.</b>
          </p>

          <template #cell(actions)="data">
            <span>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="warning"
                @click="Duzenlemodal(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-warning
                title="Düzenle"
              >
                <feather-icon icon="EditIcon" />
              </b-button>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="danger"
                @click.prevent="sil(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-danger
                title="Sil"
              >
                <feather-icon icon="TrashIcon" />
              </b-button>

              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="success"
                :to="{ name: 'calisan-goster', params: { id: data.item.id } }"
                class="btn-icon"
                v-b-tooltip.hover.v-success
                title="Göster"
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
import ripple from "vue-ripple-directive";
import { heightTransition } from "@core/mixins/ui/transition";

import {
  BTable,
  BAvatar,
  BBadge,
  BSpinner,
  BRow,
  BCol,
  BFormGroup,
  BFormSelect,
  BPagination,
  BProgress,
  BInputGroup,
  BFormInput,
  BInputGroupAppend,
  BButton,
  VBTooltip,
  BCard,
  BModal,
  BForm,
  BFormFile,
  BAlert,
} from "bootstrap-vue";
import axios from "@axios";

export default {
  components: {
    BTable,
    BAvatar,
    BBadge,
    BSpinner,
    BRow,
    BCol,
    BFormGroup,
    BFormSelect,
    BPagination,
    BInputGroup,
    BFormInput,
    BProgress,
    VBTooltip,
    BInputGroupAppend,
    BButton,
    BCard,
    BModal,
    ToastificationContent,
    BForm,
    BFormFile,
    ripple,
    heightTransition,
    BAlert,
  },
  directives: {
    "b-tooltip": VBTooltip,
    ripple,
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
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
        { key: "name", label: "Çalışan ismi", sortable: true, filter: true },
        {
          key: "tc",
          label: "TC.Kimlik Numarası",
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
          key: "email",
          label: "E-Posta Adresi",
          sortable: true,
          filter: true,
        },

        { key: "actions", label: "Eylemler" },
      ],
      items: [],
      name: null,
      tc: null,
      email: null,
      telefon: null,
      id: this.userData.id,
      calisan_id: null,
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
    this.veri();
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.files.length;
    }, 500);
  },
  methods: {
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
    veri() {
      axios
        .post("/api/calisanlar", { firma_id: this.id })
        .then((res) => (this.items = res.data));
    },
    ekle() {
      axios
        .post("/api/calisanekle", {
          name: this.name,
          firma_id: this.id,
          telefon: this.telefon,
          email: this.email,
          tc: this.tc,
        })
        .then((res) => this.basarili(), this.veri(), this.form())
        .catch((error) => this.basarisiz);
    },
    Duzenlemodal(row) {
      this.$refs["modal2"].show();
      (this.calisan_id = row.id),
        (this.name = row.name),
        (this.email = row.email),
        (this.tc = row.tc),
        (this.telefon = row.telefon);
    },

     tikla(params) {
      this.$router.push({
        name: "calisan-goster",
        params: { id: params.id },
      });
    },

    duzenle() {
      axios
        .post("/api/calisanduzenle", {
          userid: this.calisan_id,
          name: this.name,
          telefon: this.telefon,
          email: this.email,
          tc: this.tc,
        })
        .then((res) => {this.basarili(), this.veri(), this.form()})
        .catch((error) => this.basarisiz);
    },

    sil(data) {
      axios
        .post("/api/workersil", { id: data.id })
        .then((res) => {
          this.basarili(), this.veri(), this.form();
        })
        .catch((error) => this.basarisiz());
    },

    form() {
      this.$refs["modal"].hide();
      this.$refs["modal2"].hide();
      (this.calisan_id = null),
        (this.name = null),
        (this.tc = null),
        (this.email = null),
        (this.telefon = null);
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
    Filtered(filteredItems) {
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },
};
</script>
<style >
@media screen and (max-width: 374) {
  .iptal {
    margin-top: 10px !important;
  }
}
</style>
