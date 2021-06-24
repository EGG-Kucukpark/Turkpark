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
              <b-row v-for="(form, index) in form" :key="form.id">
                <!-- Item Name -->
                <b-col md="4">
                 <b-form-select v-model="form.calisanselected">
                    <option disabled value="" v-if="form.Selected2 != null">Lütfen Çalışan Seçiniz</option>
                    <option disabled value="" v-if="form.Selected2 === null">Lütfen Firma Seçiniz</option>
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

                <b-col >
                  <b-button
                    v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                    variant="danger"
                    @click.prevent="delField(index)"
                    class="btn-icon"
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
                  v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                  variant="info"
                  @click="addField"
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
                @click.prevent="arsivle(data.item)"
                class="btn-icon"
              >
                <feather-icon icon="TrashIcon" />
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
      <button style="display: none" @click="basarili" id="basarili2"></button>
      <button style="display: none" @click="basarisiz" id="basarisiz2"></button>
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
        { key: "id", label: "Rapor Numarası", sortable: true, filter: true },

        { key: "name", label: "Çalışan ismi", sortable: true, filter: true },
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

      form: [{ rapor: "", file: "", Selected2: "" }],
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
        .post("/api/getfile2", { firma_email: mail, status:5 })
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




        var email = this.Selected.firma.email;


        axios
          .post("/api/getfile2", { firma_email: email, status:5 })
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
    arsivle(data){
        axios.post('api/dosyasil', {id: data.id}).then(this.refreshStop())
    },


    submit() {
      var form = this.form;
      var time = 1000;

      form.forEach(function (form) {
        const formData = new FormData();
        formData.set("file", form.file);
        formData.append("id", form.Selected2.id);
        formData.append("name", form.Selected2.name);
        formData.append("firma_email", form.Selected2.email);
        formData.append("rapor", form.rapor);
        formData.append("status", "5");


        setTimeout(() => {
          axios
            .post("api/belgeyukle", formData)
            .then((res) => document.getElementById("basarili2").click())
            .catch((error) => {
              (document.getElementById("basarisiz").value =
                error.response.data.error),
                console.log(document.getElementById("basarisiz2").value),
                document.getElementById("basarisiz").click();
            });
        }, (time += 1000));
      });

      this.formcikis();
    },
    select() {
      var email = this.Selected.firma.email;

      this.form[0].Selected2 = this.Selected.firma;

      axios
        .post("/api/calisanlar", { firma_email: email })
        .then((res) => (this.calisan = res.data));
      axios
        .post("/api/getfile2", { firma_email: email, status:5})
        .then((res) => (this.items = res.data));
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
          Selected2: this.Selected.firma,
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
