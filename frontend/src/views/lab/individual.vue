<template>
  <b-card title="Raporlar">
    <b-form-group
      style="font-size: 18px"
      label="Firma Seçiniz: "
      label-cols-sm="1"
    >
      <b-form-select @change="select" v-model="Selected">
        <option disabled value="">Lütfen Seçim Yapınız</option>
        <option
          v-bind:value="{  firma: firma}"
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
              <b-form-group
                style="font-size: 13px"
                label="Rapor: "
                label-cols-sm="1"
              >
                <b-form-file
                  @change.prevent="change"
                  v-model="file"
                  placeholder=" Bir dosya seçin veya buraya sürükleyin..."
                  drop-placeholder="Drop file here..."
                  accept=".jpg, .png, .pdf, "
                />
              </b-form-group>

              <div style="float: right">
                <b-button variant="success" type="submit">
                  Rapor Ekle
                </b-button>
              </div>
              <div style="float: right; padding-right: 10px" @click="form()">
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
  </b-card>
</template>

<script>
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";

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
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      perPage: 5,
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
        { key: "dosya", label: "Dosya Adı", sortable: true, filter: true },
        { key: "created_at", label: "Tarih", sortable: true, filter: true },

        { key: "actions", label: "Eylemler" },
      ],
      items: [],
      id: null,
      file: null,
      show: true,
      searchTerm: "",
      Selected: "",
      firma: [],
      calisanselected: "",
      firmaselected: "",
      calisan: "",
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
    refreshStop() {
      setTimeout(() => {
        var email = this.Selected.firma.email;

        this.Selected = {
          firma: this.Selected.firma
        };

        axios
          .post("/api/getfile", { firma_email: email })
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

    submit() {
      const formData = new FormData();
      formData.set("file", this.file);
      formData.append("id", this.Selected.firma.id);
      formData.append("name", this.Selected.firma.name);
      formData.append("firma_email", this.Selected.firma.email);
      formData.append("status", "0");
      axios
        .post("/api/belgeyukle", formData)
        .then((res) => this.refreshStop())
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: "Rapor İşlemleri",
              icon: "FileTextIcon",
              variant: "danger",
              text: " İşlem Başarısız.",
            },
          });
        })
        .then(this.$refs["modal"].hide());
    },
    select() {
      var email = this.Selected.firma.email;
      console.log(email)
      axios
        .post("/api/calisanlar", { firma_email: email })
        .then((res) => (this.calisan = res.data));
      axios
        .post("/api/getfile", { firma_email: email })
        .then((res) => (this.items = res.data));
    },
    göster(dosya) {
      window.open("/Dosyalar/" + dosya, "_blank");
    },

    form() {
      this.$refs["modal"].hide();
      this.file == null;
      this.firmaselected == null;
      this.calisanselected == null;
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
