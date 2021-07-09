<template>
  <b-card title="Kursiyerler">


    <b-row>

      <button hidden id="hata" @click.prevent="hata"></button>
      <button hidden id="basarili" @click.prevent="basarili"></button>
      <h4 style="margin: 10px">Excel İşlemleri:</h4>
      <download-excel :fetch="fetchData">
        <b-button variant="success" class="btn-icon" style="height: 40px">
          <feather-icon size="24" icon="ArrowDownCircleIcon" />
        </b-button>
      </download-excel>

      <b-button
        variant="success"
        class="btn-icon"
        style="margin-left: 5px; height: 40px"
        @click="$refs.refInputEl.click()"
      >
        <input
          ref="refInputEl"
          type="file"
          class="d-none"
          @input="excelfile"
          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
        />
        <feather-icon size="24" icon="ArrowUpCircleIcon" />
      </b-button>

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
      <b-button
        class="mb-1"
        style="margin: auto; margin-right: 20px"
        variant="success"
        @click="Modal1"
        >Yeni Sertifika</b-button
      >
      <span>
        <b-modal
          hide-header-close
          ok-title="Kaydet"
          :hide-footer="true"
          size="lg"
          ref="modal1"
          centered
          title="Sertifika Ekle"
        >
          <b-card>
            <b-form>
              <b-form-group
                label="Firma Seçiniz: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <v-select
                  :options="options"
                  label="Firmalar"
                  v-model="selected_firma"
                  @search="firmasearch"
                  @input="firma"
                  :filterable="false"
                  class="select-size-sm"
                >
                  <template slot="no-options"> Sonuç yok. </template>
                  <template #option="options">
                    <p>{{ options.name }}</p>
                  </template>
                  <template #selected-option="options">
                    <p>{{ options.name }}</p>
                  </template>
                </v-select>
              </b-form-group>

              <b-form-group
                label="Çalışan Seçiniz: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <v-select
                  :options="calisan"
                  label="Firmalar"
                  v-model="selected_calisan"
                  @search="calisansearch"
                  :filterable="false"
                  class="select-size-sm"
                >
                  <template slot="no-options"> Sonuç yok. </template>
                  <template #option="calisan">
                    <p>{{ calisan.name }}</p>
                  </template>
                  <template #selected-option="calisan">
                    <p>{{ calisan.name }}</p>
                  </template>
                </v-select>
              </b-form-group>

              <div style="float: right">
                <b-button variant="success" type="submit"> Tamam </b-button>
              </div>
              <div style="float: right; padding-right: 10px">
                <b-button variant="danger" @click="form()"> İptal</b-button>
              </div>
            </b-form>

            <!-- Emulate built in modal footer ok and cancel button actions -->
          </b-card>
        </b-modal>
      </span>

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
          show-empty
          empty-text="Veri Bulunamadı."
          empty-filtered-text="Veri Bulunamadı."
        >
          <p style="text-align: center; width: 100%" show-empty>
            >
            <b> Kullanıcı Bulunamadı.</b>
          </p>

          <template #cell(actions)="data">
            <span>
              <b-button variant="gradient-warning" @click="Modal2(data.item)">
                Düzenle
              </b-button>
                  <b-button variant="gradient-success" @click="sertifika(data.item)">
                Sertifika Görüntüle
              </b-button>

              <b-modal
                hide-header-close
                ok-title="Kaydet"
                :hide-footer="true"
                size="lg"
                centered
                title="Kullanıcı Düzenle"
                ref="modal2"
              >
                <b-card> </b-card>
              </b-modal>
              <b-button variant="gradient-danger" disabled>
                Sil
              </b-button></span
            >
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
import downloadexcel from "vue-json-excel";

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
  BForm,
  BFormFile,
} from "bootstrap-vue";
import axios from "@axios";
import vSelect from "vue-select";

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
    BInputGroupAppend,
    BButton,
    BCard,
    BModal,
    ToastificationContent,
    BForm,
    downloadexcel,
    BFormFile,
    vSelect,
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
        { key: "name", label: "İsim", sortable: true, filter: true },
        { key: "email", label: "E-Posta", sortable: true, filter: true },
        { key: "telefon", label: "Telefon", sortable: true, filter: true },
        { key: "kategori", label: "Kategori", sortable: true, filter: true },
        {
          key: "created_at",
          label: "Oluşturulma Tarihi",
          sortable: true,
          filter: true,
        },
        { key: "actions", label: "Eylemler" },
      ],
      items: null,
      calisan: [],
      options: [],
      selected_firma: null,
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

    let ckeditor = document.createElement("script");
    ckeditor.setAttribute(
      "src",
      "//cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"
    );
    document.head.appendChild(ckeditor);
    axios.post('/api/sertifikagetir').then((res) => this.items = res.data)
    axios.post("/api/firmalar").then((res) => (this.options = res.data));
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },
  methods: {
    failed() {
      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Kullanıcı İşlemleri `,
          icon: "UserIcon",
          variant: "danger",
          text: ` İşlem Başarısız.`,
        },
      });
    },
      sertifika(params) {


      this.$router.push({
        name: "sertifika-goster",
        params: { id: params.id },
      });
    },
    refreshStop() {
      setTimeout(() => {
        axios
          .post("/api/users")
          .then((response) => {
            this.items = response.data;
          })
          .then(
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Kullanıcı İşlemleri `,
                icon: "UserIcon",
                variant: "success",
                text: `Kullanıcı İşlemi Başarılı.`,
              },
            })
          );
      }, 1000);
    },

    firma() {
      axios
        .post("/api/calisanlar", { firma_email: this.selected_firma.email })
        .then((res) => (this.calisan = res.data, this.items = res.data));
    },

    calisansearch(search) {
      axios
        .post("/api/calisanlar", {
          firma_email: this.selected_firma.email,
          q: search,
        })
        .then((res) => (this.calisan = res.data));
    },

    firmasearch(search, loading) {

      axios
        .post("/api/firmalar", { q: search })
        .then((res) => (this.options = res.data))
    },



    Modal1() {
      this.$refs["modal1"].show();
    },
    Modal2(row) {
      this.$refs["modal2"].show();
    },









    async fetchData() {
      const response = await axios.post("/api/users");

      return response.data;
    },




    basarili() {
      this.refreshStop();
    },
    hata() {
      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Kullanıcı İşlemleri `,
          icon: "UserIcon",
          variant: "danger",
          text: ` İşlem Başarısız.`,
        },
      });
    },

    excelfile(event) {
      var file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = function () {
        let data = reader.result;

        try {
          var workbook = XLSX.read(data, { type: "binary" });
        } catch (err) {
          document.getElementById("hata").click();
        }

        workbook.SheetNames.forEach((sheet) => {
          let rowObject = XLSX.utils.sheet_to_row_object_array(
            workbook.Sheets[sheet], {raw:false}
          );

          this.excel = rowObject;
        });

        setTimeout(() => {
          axios
            .post("/api/excelsertifika", { data: this.excel })
        }, 500);
      };

      reader.readAsBinaryString(file);
    },

    form() {
      this.$refs["modal1"].hide(),
        this.$refs["modal2"].hide(),
        (this.name = ""),
        (this.email = ""),
        (this.role = ""),
        (this.telefon = ""),
        (this.password = "");
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
