<template>
  <b-card title="Raporlar">
    <b-form-group
      style="font-size: 18px"
      label="Kişi Seçiniz: "
      label-cols-sm="1"
    >
      <b-form-select @change="select" v-model="Selected">
        <option disabled value="">Lütfen Seçim Yapınız</option>
        <option
          v-bind:value="{ firma: firma }"
          v-for="firma in firma"
          :key="firma.id"
        >
          {{ firma.name }}
        </option>
      </b-form-select>
    </b-form-group>

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
          v-if="show"
          class="mb-1"
          style="margin-right: 50px"
          variant="success"
          @click="modal"
          >  <feather-icon size="20px;" icon="PlusIcon" /></b-button
        >

        <b-modal
          hide-header-close
          :hide-footer="true"
          size="lg"
          ref="modal"
          centered
          title="Rapor Ekle"
        >
          <b-card>
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

              <b-row v-for="(form, index) in form" :key="form.id">
                <b-form-select style="display: none" v-model="form.Selected2">
                  <option
                    v-bind:value="{ firma: firma }"
                    v-for="firma in firma"
                    :key="firma.id"
                  >
                    {{ firma.name }}
                  </option>
                </b-form-select>

                <b-col md="4">
                  <b-form-select v-model="form.rapor">
                    <option disabled v-if="form.Selected2 != null" value="">
                      Lütfen Rapor Tipini Seçiniz
                    </option>
                    <option disabled v-if="form.Selected2 === null" value="">
                      Lütfen Kişi Seçiniz
                    </option>

                    <option v-for="raporlar in raporlar" :key="raporlar.id">
                      {{ raporlar.name }}
                    </option>
                  </b-form-select>
                </b-col>

                <!-- Cost -->
                <b-col md="5">
                  <b-form-file
                    @change.prevent="change"
                    v-model="form.file"
                    name="file"
                    placeholder=" Bir dosya seçin veya buraya sürükleyin..."
                    drop-placeholder="Drop file here..."
                    accept=".jpg, .png, .pdf, "
                  />
                </b-col>

                <b-form-select style="display: none" v-model="form.Selected2">
                  <option
                    v-bind:value="{ firma: firma }"
                    v-for="firma in firma"
                    :key="firma.id"
                  >
                    {{ firma.name }}
                  </option>
                </b-form-select>

                <b-col>
                  <b-button

                    variant="danger"
                    @click.prevent="delField(index)"
                    class="btn-icon"
                    v-b-tooltip.hover.v-danger
                    title="Satırı Kaldır"
                  >
                    <feather-icon icon="DeleteIcon" />
                  </b-button>
                </b-col>
                <b-col cols="12">
                  <hr />
                </b-col>
              </b-row>

              <div style="float: left">
                <span v-if="warn === true">
                  <b-alert variant="danger" show>
                    <div class="alert-body">
                      <span
                        ><strong
                          >En fazla 4 toplu yükleme yapabilirsiniz!</strong
                        >
                      </span>
                    </div>
                  </b-alert>
                </span>
                <b-button

                  variant="info"
                  @click="addField"
                  v-b-tooltip.hover.v-info
                  title="Satır Ekle"
                  class="btn-icon"
                >
                  <feather-icon size="20px;" icon="PlusIcon" />
                </b-button>
              </div>


              <div style="float: right">
                <b-button variant="success" type="submit">
                  Rapor Ekle
                </b-button>
              </div>

              <div style="float: right; padding-right: 10px">
                <b-button variant="danger" @click="formcikis()">
                  iptal</b-button
                >
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
                class="btn-icon" style="margin:5px;"
                v-b-tooltip.hover.v-warning
                title="Göster"
              >
                <feather-icon icon="ImageIcon" />
              </b-button>

              <b-button

                variant="danger"
                @click.prevent="arsivle(data.item)"
                class="btn-icon" style="margin:5px;"
                v-b-tooltip.hover.v-danger
                title="Arşivle"
              >
                <feather-icon icon="ArchiveIcon" />
              </b-button>

              <b-button

                variant="success"
                @click.prevent="indir(data.item.dosya_ad)"
                class="btn-icon" style="margin:5px;"
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
      <button style="display: none" @click="basarili" id="basarili2"></button>
      <button style="display: none" @click="basarisiz" id="basarisiz2"></button>
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
        { key: "id", label: "Rapor Numarası", sortable: true, filter: true },

        { key: "name", label: "ÇALIŞAN İSMİ", sortable: true, filter: true },
        { key: "rapor", label: "Dosya Adı", sortable: true, filter: true },
        { key: "created_at", label: "Tarih", sortable: true, filter: true },

        { key: "actions", label: "Eylemler" },
      ],
      items: [],
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
        { rapor: "", file: "", Selected2: null, dgr: 0, variant: "success" },
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
    axios.post("api/raporlar").then((res) => (this.raporlar = res.data));
    var user = JSON.parse(localStorage.getItem("user"));

    if (user.role === "Client") {
      this.show = false;
      var id = user.id;
      axios
        .post("/api/getfile2", { firma_id: mail, status: 3 })
        .then((res) => (this.rows = res.data));
    } else {
      axios.post("/api/bireyseller").then((response) => {
        this.firma = response.data;
      });
    }
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },
  methods: {
    basarili() {
      this.refreshStop();
    },

    basarisiz() {
      var data = document.getElementById("basarisiz2").value;

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
        var id = this.Selected.firma.id;

        axios
          .post("/api/getfile2", { firma_id: id, status: 3 })
          .then((res) => (this.items = res.data))
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

    change(event) {
      this.file = event.target.files[0];
    },
    arsivle(data) {
      axios.post("api/dosyaarsiv", { id: data.id }).then(this.refreshStop());
    },

    submit() {
      var form = this.form;
      var time = 1000;

      form.forEach(function (form) {
        const formData = new FormData();

        if (form.Selected2 === null) {
          document.getElementById("basarisiz2").value = "Kişi Seçilmedi.";
          document.getElementById("basarisiz2").click();
        } else {
          formData.set("file", form.file);
          formData.append("id", form.Selected2.id);
          formData.append("name", form.Selected2.name);
          formData.append("firma_id", form.Selected2.id);
          formData.append("rapor", form.rapor);
          formData.append('status', '3');
          form.variant = "success";
          form.dgr = 50;

          setTimeout(() => {
            axios
              .post("api/belgeyukle", formData)
              .then(
                (res) => document.getElementById("basarili2").click(),
                (form.dgr = 100)
              )
              .catch((error) => {
                form.dgr = 100;
                form.variant = "danger";
                if (error.response.data.error === undefined) {
                  document.getElementById("basarisiz2").value = "";
                  document.getElementById("basarisiz").click();
                } else {
                  document.getElementById("basarisiz2").value ===
                    error.response.data.error,
                    document.getElementById("basarisiz2").click();
                }
              });
          }, (time += 1000));
        }
      });

      setTimeout(() => {
        this.formcikis();
      }, 6000);
    },
    select() {
      var id = this.Selected.firma.id;

      for (var i = 0; i < this.form.length; i++) {
        this.form[i].Selected2 = this.Selected.firma;
      }

      axios
        .post("/api/calisanlar", { firma_id: id })
        .then((res) => (this.calisan = res.data));
      axios
        .post("/api/getfile2", { firma_id: id, status:3 })
        .then((res) => (this.items = res.data));
    },
    göster(dosya) {
      window.open("/Dosyalar/Firma/" + dosya, "_blank");
    },

    formcikis() {
      this.$refs["modal"].hide();


  for (var i = 0; i < this.form.length; i++) {

          this.form[i].dgr= 0;
          this.form[i].file = null,
          this.form[i].rapor = null
        }


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
    delField(index) {
      this.form.splice(index, 1);
    },
    addField() {
      if (this.form.length === 4) {
        this.warn = true;
      } else {
        this.form.push({
          rapor: "",
          file: "",
          Selected2: this.form[0].Selected2,
          dgr: 0,
          variant: "success",
        });
      }
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
