<template>
  <b-card title="Sonuçlar">
    <b-row>
      <download-excel :fetch="fetchData">
        <b-button
          variant="flat-success"
          style="height: 50px; margin-left: 20px"
          id="btnclick"
        >
          <img
            width="30px; margin-bottom:10px; "
            src="/images/export.png"
            alt=""
          />
        </b-button>
      </download-excel>

      <b-button
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
        <img src="/images/import.png" alt="" />
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

      <span>
        <b-button
          v-if="show"
          class="mb-1"
          style="margin-right: 50px"
          variant="success"
          @click="modal"
        >
          <feather-icon size="20px;" icon="PlusIcon"
        /></b-button>

        <b-modal
          hide-header-close
          :hide-footer="true"
          size="lg"
          ref="modal"
          centered
          title="Rapor Ekle"
        >
          <b-form @submit.prevent="submit">
            <b-progress
              max="100"
              style="margin: 10px"
              v-for="form in form"
              name="progress"
              :key="form.id"
              :value="form.dgr"
              striped
              animated
              :variant="form.variant"
              class="progress-bar-success"
            />

            <b-row
              style="margin: 12px"
              v-for="(form, index) in form"
              :key="form.id"
            >
              <hr />

              <b-col style="display: none" sm="1">
                <b-form-select v-model="form.Selected2">
                  <option disabled value="">Lütfen Seçim Yapınız</option>
                  <option
                    v-bind:value="{ firma_id: firma.id }"
                    v-for="firma in firma"
                    :key="firma.id"
                  >
                    {{ firma.name }}
                  </option>
                </b-form-select>
              </b-col>

              <b-col md="4">
                <b-form-select v-model="form.calisanselected">
                  <option disabled value="">Lütfen Çalışan Seçiniz</option>

                  <option
                    v-bind:value="{ name: calisan.name, id: calisan.id }"
                    v-for="calisan in calisan"
                    :key="calisan.id"
                  >
                    {{ calisan.name }}
                  </option>
                </b-form-select>
              </b-col>
              <b-col md="4">
                <b-form-select v-model="form.rapor">
                  <option disabled value="">Lütfen Seçim Yapınız</option>
                  <option v-for="raporlar in raporlar" :key="raporlar.id">
                    {{ raporlar.name }}
                  </option>
                </b-form-select>
              </b-col>
              <b-col md="3">
                <b-form-file
                  v-model="form.file"
                  name="file"
                  placeholder=" Bir dosya seçin veya buraya sürükleyin..."
                  drop-placeholder="Drop file here..."
                  accept=".jpg, .png, .pdf, "
                />
              </b-col>

              <b-col md="1">
                <b-button

                  variant="danger"
                  @click.prevent="delField(index)"
                  class="btn-icon"
                >
                  <feather-icon icon="DeleteIcon" />
                </b-button>
              </b-col>
            </b-row>

            <div style="float: left">
              <span v-if="warn === true">
                <b-alert variant="danger" show>
                  <div class="alert-body">
                    <span
                      ><strong>En fazla 4 toplu yükleme yapabilirsiniz!</strong>
                    </span>
                  </div>
                </b-alert>
              </span>
              <b-button

                variant="info"
                @click="addField"
                class="btn-icon"
              >
                <feather-icon size="20px;" icon="PlusIcon" />
              </b-button>
            </div>
            <div style="float: right">
              <b-button variant="success" type="submit"> Rapor Ekle </b-button>
            </div>
            <div id="iptal">
              <div style="float: right; padding-right: 10px">
                <b-button variant="danger" @click="formcikis()">
                  İptal</b-button
                >
              </div>
            </div>
          </b-form>
        </b-modal>
      </span>

      <b-col cols="12" class="table-responsive">
        <b-table
          striped
         hover
          responsive
          selectable
          :per-page="perPage"
          :current-page="currentPage"
          :items="files"
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
          <template #cell(role)="data">
            <div class="text-nowrap">
              <feather-icon
                :icon="roleVariant(data.item.role)"
                size="18"
                class="mr-50"
                style="color: red"
              />
              <span class="align-text-top text-capitalize">{{
                data.item.role
              }}</span>
            </div>
          </template>

          <template #cell(email_verified_at)="data">
            <b-badge
              v-if="data.item.email_verified_at != null"
              variant="light-success"
            >
              <span> Onaylanmış</span>
            </b-badge>

            <b-badge
              v-if="data.item.email_verified_at === null"
              variant="light-danger"
            >
              <span> Onaylanmamış</span>
            </b-badge>
          </template>

          <template #cell(status)="data">
            <b-badge :variant="statusVariant(data.item.status)">
              <span v-if="data.item.status == 1"> Aktif</span>
              <span v-if="data.item.status == 2"> Beklemede</span>
              <span v-if="data.item.status == 0"> Red</span>
            </b-badge>
          </template>

          <p style="text-align: center; width: 100%" show-empty>
            >
            <b> Kullanıcı Bulunamadı.</b>
          </p>

          <template #cell(actions)="data">
            <span>
              <b-button

                variant="warning"
                @click.prevent="göster(data.item.dosya_ad)"
                class="btn-icon"
                style="margin: 5px"
                v-b-tooltip.hover.v-warning
                title="Göster"
              >
                <feather-icon icon="ImageIcon" />
              </b-button>
              <b-button

                variant="danger"
                @click.prevent="arsivle(data.item)"
                class="btn-icon"
                style="margin: 5px"
                v-b-tooltip.hover.v-danger
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

    <button style="display: none" @click="basarili" id="basarili"></button>
    <button style="display: none" @click="basarisiz" id="basarisiz"></button>
  </b-card>
</template>

<script>
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import ripple from "vue-ripple-directive";
import { heightTransition } from "@core/mixins/ui/transition";
import router from "@/router";

import {
  BTable,
  BAvatar,
  BBadge,
  BRow,
  BCol,
  VBTooltip,
  BFormGroup,
  BFormSelect,
  BPagination,
  BInputGroup,
  BProgress,
  BFormInput,
  BInputGroupAppend,
  BButton,
  BCard,
  BModal,
  BForm,
  BFormFile,
  BAlert,
} from "bootstrap-vue";
import axios from "@axios";
import vSelect from "vue-select";
export default {
  components: {
    BTable,
    BAvatar,
    BBadge,
    BRow,
    VBTooltip,
    BProgress,
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
    BFormFile,
    ripple,
    heightTransition,
    BAlert,
    vSelect,
  },
  directives: {
    "b-tooltip": VBTooltip,
    ripple,
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
        { key: "id", label: "Rapor Numarası", sortable: true, filter: true },

        { key: "name", label: "ÇALIŞAN İSMİ", sortable: true, filter: true },
        { key: "rapor", label: "TEST TÜRÜ", sortable: true, filter: true },
        {
          key: "created_at",
          label: "Rapor Oluşturulma",
          sortable: true,
          filter: true,
        },
        {
          key: "created_at",
          label: "Rapor Sonuç",
          sortable: true,
          filter: true,
        },

        { key: "actions", label: "Eylemler" },
      ],
      files: [],
      id: null,

      show: true,
      searchTerm: "",
      Selected: "",
      firma: [],
      warn: false,
      firmaselected: "",
      calisan: "",
      raporlar: "",

      form: [
        {
          calisanselected: "",
          rapor: "",
          file: "",
          Selected2: null,
          dgr: 0,
          variant: "success",
        },
      ],
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
    axios.post("/api/raporlar").then((res) => (this.raporlar = res.data));
    this.Selected = router.currentRoute.params.id;

    var id = this.Selected;
    this.form[0].Selected2 = id;

    axios
      .post("/api/getfile", { firma_id: id, status: 5 })

      .then((res) => (this.files = res.data));

    axios
      .post("/api/calisanlar", { firma_id: id })
      .then((res) => (this.calisan = res.data));
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.files.length;
    }, 500);
  },
  methods: {
    basarili() {
      this.refreshStop();
    },

    basarisiz() {
      var data = document.getElementById("basarisiz").value;

      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Rapor İşlemleri `,
          icon: "FileTextIcon",
          variant: "danger",
          text: data + ` Dosya İşlemi Başarsız`,
        },
      });
    },
    refreshStop() {
      setTimeout(() => {
        var id = this.Selected;
        this.Selected = {
          firma_id: this.Selected,
        };

        axios
          .post("/api/getfile", { firma_id: id, status: 5 })
          .then((res) => (this.files = res.data))
          .then(
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Rapor İşlemleri `,
                icon: "FileTextIcon",
                variant: "success",
                text: ` İşlem Başarılı.`,
              },
            })
          );
      }, 2000);
    },

    addField() {
      if (this.form.length === 4) {
        this.warn = true;
      } else {
        for (var i = 0; i < this.form.length; i++) {
          this.form[i].Selected2 = this.Selected;
        }
        this.form.push({
          calisanselected: "",
          rapor: "",
          file: "",
          Selected2: this.Selected,
          dgr: 0,
          variant: "success",
        });
      }
    },

    delField(index) {
      this.form.splice(index, 1);
    },

    submit(event) {
      var form = this.form;
      var time = 1000;

      form.forEach(function (form) {
        if (form.calisanselected === "") {
          document.getElementById("basarisiz").value = "Çalışan Girilmedi.";

          document.getElementById("basarisiz").click();
        } else {
          let file = event.target.file;

          const formData = new FormData();
          formData.set("file", form.file);
          formData.append("id", form.calisanselected.id);
          formData.append("name", form.calisanselected.name);
          formData.append("firma_id", form.Selected2);
          formData.append("rapor", form.rapor);
          formData.append("status", "5");
          form.variant = "success";
          form.dgr = 50;

          setTimeout(() => {
            axios
              .post("/api/belgeyukle", formData)
              .then(
                (res) => document.getElementById("basarili").click(),
                (form.dgr = 100)
              )
              .catch((error) => {
                form.dgr = 100;
                form.variant = "danger";
                if (error.response.data.error === undefined) {
                  document.getElementById("basarisiz").value = "";
                  document.getElementById("basarisiz").click();
                } else {
                  document.getElementById("basarisiz").value ===
                    error.response.data.error,
                    document.getElementById("basarisiz").click();
                }
              });
          }, (time += 1000));
        }
      });

      setTimeout(() => {
        this.formcikis();
      }, 6000);
    },

    göster(dosya) {
      window.open("/Dosyalar/Firma/" + dosya, "_blank");
    },
    arsivle(data) {
      axios.post("/api/dosyaarsiv", { id: data.id }).then(this.refreshStop());
    },

    formcikis() {
      this.$refs["modal"].hide();
      for (var i = 0; i < this.form.length; i++) {
        this.form[i].dgr = 0;
        (this.form[i].file = null), (this.form[i].rapor = "");
      }
    },
    fetchData() {
      let url = "sertifikagetir";
      this.$store.dispatch("excel_down", { url });

      if (this.$store.state.excel.file === null) {
        setTimeout(() => {
          document.getElementById("btnclick").click();
        }, 1000);
      }

      return this.$store.state.excel.file;
    },

    excelfile(event) {
      let url = "excelimport";
      this.$store.dispatch("excel", { event, url });
    },

    indir(dosya) {
      axios
        .post("/api/indir", { dosya: dosya }, { responseType: "blob" })
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


    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
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
