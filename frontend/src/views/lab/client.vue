<template>
  <b-card title="Sonuçlar">
    <b-form-group
      style="font-size: 18px"
      label="Firma Seçiniz: "
      label-cols-sm="1"
    >
      <b-form-select @change="select" v-model="Selected">
        <option disabled value="">Lütfen Seçim Yapınız</option>
        <option
          v-bind:value="{ firma_email: firma.email }"
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
          class="mb-1"
          style="margin-right: 50px"
          variant="success"
          @click="modal"
          >Yeni Rapor</b-button
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
              <div v-for="form in form" :key="form.id">
                <hr />
                <b-form-group style="display: none" label-cols-sm="1">
                  <b-form-select v-model="form.Selected2">
                    <option disabled value="">Lütfen Seçim Yapınız</option>
                    <option
                      v-bind:value="{ firma_email: firma.email }"
                      v-for="firma in firma"
                      :key="firma.id"
                    >
                      {{ firma.name }}
                    </option>
                  </b-form-select>
                </b-form-group>

                <b-form-group style="font-size: 13px" label-cols-sm="1">
                  <b-form-select v-model="form.calisanselected">
                    <option disabled value="">Lütfen Seçim Yapınız</option>
                    <option
                      v-bind:value="{ name: calisan.name, id: calisan.id }"
                      v-for="calisan in calisan"
                      :key="calisan.id"
                    >
                      {{ calisan.name }}
                    </option>
                  </b-form-select>
                </b-form-group>
                <b-form-group style="font-size: 13px" label-cols-sm="1">
                  <b-form-select v-model="form.rapor">
                    <option disabled value="">Lütfen Seçim Yapınız</option>
                    <option>Rapor Tipi A</option>
                  </b-form-select>
                </b-form-group>

                <b-form-group style="font-size: 13px" label-cols-sm="1">
                  <b-form-file

                    v-model="form.file"
                    name="file"
                    placeholder=" Bir dosya seçin veya buraya sürükleyin..."
                    drop-placeholder="Drop file here..."
                    accept=".jpg, .png, .pdf, "
                  />
                </b-form-group>
              </div>

              <div style="float: left">
                <b-button @click="addField" variant="info"> +1 </b-button>
              </div>
              <div style="float: right">
                <b-button variant="success" type="submit">
                  Rapor Ekle
                </b-button>
              </div>
              <div style="float: right; padding-right: 10px">
                <b-button variant="danger" @click="formcikis()">
                  İptal</b-button
                >
              </div>
            </b-form>
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
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="warning"
                @click.prevent="göster(data.item.dosya_ad)"
                class="btn-icon"
              >
                <feather-icon icon="ImageIcon" />
              </b-button>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="danger"
                @click.prevent="indir(data.item.dosya_ad)"
                class="btn-icon"
              >
                <feather-icon icon="ArchiveIcon" />
              </b-button>

              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="success"
                @click.prevent="indir(data.item.dosya_ad)"
                class="btn-icon"
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
import { heightTransition } from "@core/mixins/ui/transition";
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
  BForm,
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
    BInputGroupAppend,
    BButton,
    BCard,
    BModal,
    ToastificationContent,
    BForm,
    BFormFile,
    Ripple,
    heightTransition,
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

        { key: "name", label: "Çalışan ismi", sortable: true, filter: true },
        { key: "rapor", label: "Rapor Tipi", sortable: true, filter: true },
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

      firmaselected: "",
      calisan: "",
      raporlar: "",

      form: [{ calisanselected: "", rapor: "", file: "", Selected2: null }],
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

    if (user.role === "Client") {
      this.show = false;
      var mail = user.email;
      axios
        .post("/api/getfile", { firma_email: mail })
        .then((res) => (this.rows = res.data));
    } else {
      axios.post("/api/firmalar").then((response) => {
        this.firma = response.data;
      });
    }
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.files.length;
    }, 500);
    this.initTrHeight();
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
        var email = this.Selected.firma_email;
        this.Selected = {
          firma_email: this.Selected.firma_email,
        };

        axios
          .post("/api/getfile", { firma_email: email })
          .then((res) => this.files = res.data)
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
      this.form.push({
        calisanselected: "",
        rapor: "",
        file: "",
        Selected2: this.Selected.firma_email,
      });
    },

    submit(event) {
      var form = this.form;
      var time = 1000;

      form.forEach(function (form) {
        let file = event.target.file;

        const formData = new FormData();
        formData.set("file", form.file);
        formData.append("id", form.calisanselected.id);
        formData.append("name", form.calisanselected.name);
        formData.append("firma_email", form.Selected2);
        formData.append("rapor", form.rapor);
        formData.append("status", "0");

        setTimeout(() => {
          axios
            .post("api/belgeyukle", formData)
            .then((res) => document.getElementById("basarili").click())
            .catch((error) => {
              (document.getElementById("basarisiz").value =
                error.response.data.error),
                console.log(document.getElementById("basarisiz").value),
                document.getElementById("basarisiz").click();
            });
        }, (time += 1000));
      });

      this.formcikis();
    },

    select() {
      var email = this.Selected.firma_email;

      this.form[0].Selected2 = this.Selected.firma_email;

      console.log(this.form[0].Selected2);

      axios
        .post("/api/getfile", { firma_email: email })

        .then((res) => (this.files = res.data));

      axios
        .post("/api/calisanlar", { firma_email: email })
        .then((res) => (this.calisan = res.data));
    },
    göster(dosya) {
      window.open("/Dosyalar/" + dosya, "_blank");
    },

    formcikis() {
      this.$refs["modal"].hide();
      this.file == null;
      this.firmaselected == null;
      this.calisanselected == null;
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
