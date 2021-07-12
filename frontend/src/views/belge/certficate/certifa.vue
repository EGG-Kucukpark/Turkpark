<template>
  <b-card title="Kursiyerler">
    <b-row>
      <button hidden id="hata" @click.prevent="hata"></button>
      <button hidden id="basarili" @click.prevent="basarili"></button>

      <download-excel :fetch="fetchData">
        <b-button
          v-ripple.400="'rgba(40, 199, 111, 0.15)'"
          variant="flat-success"
          style="height: 50px; margin-left: 20px"
        >
          <img
            width="30px; margin-bottom:10px; "
            src="images/export.png"
            alt=""
          />
        </b-button>
      </download-excel>

      <b-button
        v-ripple.400="'rgba(40, 199, 111, 0.15)'"
        variant="flat-success"
        style="height: 50px; margin-left: 20px"
        @click="$refs.refInputEl.click()"
      >
        <input
          ref="refInputEl"
          type="file"
          class="d-none"
          @input="excelfile"
          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
        />
        <img src="images/import.png" alt="" />
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
          ref="add"
          centered
          title="Sertifika Ekle"
        >
          <b-card>
            <b-form @submit.prevent="add">
              <b-form-group
                label="Ad Soyad: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input v-model="name" />
              </b-form-group>

              <b-form-group
                label="Tc. Kimlik Numarası: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input v-model="tc" />
              </b-form-group>
              <b-form-group
                label="Eğitim Türü: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input v-model="egitim" />
              </b-form-group>
              <b-form-group
                label="Geçerlilik Tarihi: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-datepicker
                  id="example-datepicker"
                  v-model="tarih"
                  class="mb-1"
                  placeholder="Tarih Seçiniz"
                />
              </b-form-group>
              <b-form-group
                label="Sonuç: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select v-model="sonuc">
                  <option value="1">Başarılı</option>
                  <option value="0">Başarısız</option>
                </b-form-select>
              </b-form-group>

              <b-form-group
                label="Sertifika Url: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input v-model="qr" />
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

        <b-modal
          hide-header-close
          ok-title="Kaydet"
          :hide-footer="true"
          size="lg"
          ref="updatemodal"
          centered
          title="Kursiyer Düzenle"
        >
          <b-card>
            <b-form @submit.prevent="update">
              <b-form-group
                label="Ad Soyad: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input v-model="name" />
              </b-form-group>

              <b-form-group
                label="Tc. Kimlik Numarası: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input v-model="tc" />
              </b-form-group>
              <b-form-group
                label="Eğitim Türü: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input v-model="egitim" />
              </b-form-group>
              <b-form-group
                label="Geçerlilik Tarihi: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-datepicker
                  id="example-datepicker"
                  v-model="tarih"
                  class="mb-1"
                  placeholder="Tarih Seçiniz"
                />
              </b-form-group>
              <b-form-group
                label="Sonuç: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select v-model="sonuc">
                  <option value="1">Başarılı</option>
                  <option value="0">Başarısız</option>
                </b-form-select>
              </b-form-group>

              <b-form-group
                label="Sertifika Url: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input v-model="qr" />
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

          <template #cell(sonuc)="data">
            <b-badge :variant="sonucVariant(data.item.sonuc)">
              <span v-if="data.item.sonuc == 1"> Başarılı</span>
              <span v-if="data.item.sonuc == 0"> Başarısız</span>
            </b-badge>
          </template>

          <template #cell(actions)="data">
            <b-button
              variant="success"
              class="btn-icon"
              style="margin: 5px"
              v-b-tooltip.hover.v-success
              title="Yazdır"
            >
              <feather-icon icon="PrinterIcon" />
            </b-button>
            <b-button
              variant="warning"
              class="btn-icon"
              @click="updatemodal(data.item)"
              style="margin: 5px"
              v-b-tooltip.hover.v-warning
              title="Düzenle"
            >
              <feather-icon icon="EditIcon" />
            </b-button>
            <b-button
              variant="danger"
              class="btn-icon"
              style="margin: 5px"
              v-b-tooltip.hover.v-danger
              title="Arşivle"
            >
              <feather-icon icon="ArchiveIcon" />
            </b-button>
          </template>
          <template #cell(qr)="data">
            <vue-qrcode :value="data.item.qr" />
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

import VueQrcode from "vue-qrcode";
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
  VBTooltip,
  BFormInput,
  BInputGroupAppend,
  BFormDatepicker,
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
    VueQrcode,
    BFormGroup,
    VBTooltip,
    BFormSelect,
    BPagination,
    BInputGroup,
    BFormInput,
    BInputGroupAppend,
    BButton,
    BCard,
    BFormDatepicker,
    BModal,
    ToastificationContent,
    BForm,
    downloadexcel,
    BFormFile,
    vSelect,
  },
  directives: {
    "b-tooltip": VBTooltip,
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
        { key: "name", label: "Ad - Soyad", sortable: true, filter: true },
        {
          key: "egitim_tur",
          label: "EĞİTİM TÜRÜ",
          sortable: true,
          filter: true,
        },
        {
          key: "tc",
          label: "Tc.KİMLİK NUMARASI",
          sortable: true,
          filter: true,
        },
        {
          key: "gecerli_trh",
          label: "GEÇERLİLİK TARİHİ",
          sortable: true,
          filter: true,
        },
        {
          key: "sonuc",
          label: "SINAV SONUCU",
          sortable: true,
          filter: true,
        },
        { key: "qr", label: "QR", sortable: true, filter: true },

        { key: "actions", label: "Eylemler" },
      ],
      items: null,
      name: null,
      tarih: null,
      tc: null,
      egitim: null,
      sonuc: null,
      id: null,
      qr: null,
      options: [],
    };
  },

  computed: {
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter((f) => f.sortable)
        .map((f) => ({ text: f.label, value: f.key }));
    },

    sonucVariant() {
      const sonucColor = {
        /* eslint-disable key-spacing */

        1: "light-success",
        0: "light-danger",

        /* eslint-enable key-spacing */
      };

      return (sonuc) => sonucColor[sonuc];
    },
  },
  created() {
    let ckeditor = document.createElement("script");
    ckeditor.setAttribute(
      "src",
      "//cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"
    );
    document.head.appendChild(ckeditor);
    axios.post("/api/sertifikagetir").then((res) => (this.items = res.data));
    axios.post("/api/firmalar").then((res) => (this.options = res.data));
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },
  methods: {
    hata() {
      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Kursiyer İşlemleri `,
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

    updatemodal(data) {
      this.$refs.updatemodal.show();
      (this.id = data.id),
        (this.name = data.name),
        (this.tc = data.tc),
        (this.tarih = data.gecerli_trh),
        (this.sonuc = data.sonuc),
        (this.qr = data.qr);
      this.egitim = data.egitim_tur;
      //axios.post("/api/sertifikaduzenle");
    },
    add() {
      axios
        .post("/api/sertifikaekle", {
          egitim: this.egitim,
          tarih: this.tarih,
          name: this.name,
          qr: this.qr,
          tc: this.tc,
          sonuc: this.sonuc,
        })
        .then((res) => this.refreshStop())
        .catch((error) => this.hata());

      this.form();
    },
    update() {
      axios
        .post("/api/sertifikaduzenle", {
          egitim: this.egitim,
          tarih: this.tarih.slice(0, 9),
          name: this.name,
          sonuc: this.sonuc,
          qr: this.qr,
          tc: this.tc,
          id: this.id,
        })
        .then((res) => {
          this.refreshStop(), this.form();
        })
        .catch(this.hata(), this.form());
    },
    refreshStop() {
      setTimeout(() => {
        axios
          .post("/api/sertifikagetir")
          .then((response) => {
            this.items = response.data;
          })
          .then(
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Kursiyer İşlemleri `,
                icon: "UserIcon",
                variant: "success",
                text: ` İşlem Başarılı.`,
              },
            })
          );
      }, 1000);
    },

    Modal1() {
      this.$refs.add.show();
    },

    basarili() {
      this.refreshStop();
    },
    async fetchData() {
      const response = await axios.post("/api/sertifikagetir");

      return response.data;
    },
    excelfile(event) {
      var file = event.target.files[0];
      const reader = new FileReader();

      reader.onload = function (hata, basarili) {
        let data = reader.result;

        try {
          var workbook = XLSX.read(data, { type: "binary" });
        } catch (err) {
          document.getElementById("hata").click();
        }

        workbook.SheetNames.forEach((sheet) => {
          let rowObject = XLSX.utils.sheet_to_row_object_array(
            workbook.Sheets[sheet],
            { raw: false }
          );

          this.excel = rowObject;
        });

        axios
          .post("/api/excelimport", { data: this.excel })
          .then((res) => {
            document.getElementById("basarili").click();
          })
          .catch((error) => {
            document.getElementById("hata").click();
          });
      };

      reader.readAsBinaryString(file);
    },

    form() {
      this.$refs.add.hide(),
        this.$refs.updatemodal.hide(),
        (this.name = ""),
        (this.tc = ""),
        (this.qr = ""),
        (this.tarih = ""),
        (this.egitim = "");
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
