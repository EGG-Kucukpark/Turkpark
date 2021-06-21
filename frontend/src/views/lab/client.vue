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
              <div>
                <div>
                  <b-form
                    ref="form"
                    :style="{ height: trHeight }"
                    class="repeater-form"
                    @submit.prevent="repeateAgain"
                  >
                    <!-- Row Loop -->
                    <b-row
                      v-for="(item, index) in items"
                      :id="item.id"
                      :key="item.id"
                      ref="row"
                    >
                      <!-- Item Name -->
                      <b-col md="4">
                        <b-form-select  v-model="rapor">
                          <option disabled value="">
                            Lütfen Seçim Yapınız
                          </option>
                          <option>Rapor A</option>
                        </b-form-select>
                      </b-col>

                      <!-- Cost -->
                      <b-col md="4">
                        <b-form-select v-model="calisanselected">
                          <option disabled value="">
                            Lütfen Seçim Yapınız
                          </option>
                          <option
                            v-bind:value="{
                              name: calisan.name,
                              id: calisan.id,
                            }"
                            v-for="calisan in calisan"
                            :key="calisan.id"
                          >
                            {{ calisan.name }}
                          </option>
                        </b-form-select>
                      </b-col>

                      <!-- Quantity -->
                      <b-col md="4">
                        <b-form-file
                          @change.prevent="change"
                          v-model="file"
                          placeholder=" Bir dosya seçin veya buraya sürükleyin..."
                          drop-placeholder="Drop file here..."
                          accept=".jpg, .png, .pdf, "
                        />
                      </b-col>

                      <!-- Remove Button -->
                      <b-col lg="2" md="3" class="mb-50">
                        <b-button
                          v-ripple.400="'rgba(234, 84, 85, 0.15)'"
                          variant="outline-danger"
                          class="mt-0 mt-md-2"
                          @click="removeItem(index)"
                        >
                          <feather-icon icon="XIcon" class="mr-25" />
                          <span>Kaldır</span>
                        </b-button>
                      </b-col>
                      <b-col cols="12">
                        <hr />
                      </b-col>
                    </b-row>
                  </b-form>
                </div>
                <b-button
                  v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                  variant="primary"
                  @click="repeateAgain"
                >
                  <feather-icon icon="PlusIcon" class="mr-25" />
                  <span>Yeni Ekle</span>
                </b-button>

                <div style="float: right">
                  <b-button variant="success" type="submit">
                    Rapor Ekle
                  </b-button>
                </div>
                <div style="float: right; padding-right: 10px" @click="form()">
                  <b-button variant="danger" @click="form()"> İptal</b-button>
                </div>
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
      file: null,
      show: true,
      searchTerm: "",
      Selected: "",
      firma: [],
      calisanselected: "",
      firmaselected: "",
      calisan: "",
      raporlar: "",
      rapor: "",

      items: [
        {
          id: 1,
          selected: "male",
          selected1: "designer",
          prevHeight: 0,
        },
      ],
      nextTodoId: 2,
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
    refreshStop() {
      setTimeout(() => {
        var email = this.Selected.firma_email;
        this.Selected = {
          firma_email: this.Selected.firma_email,
        };

        axios
          .post("/api/getfile", { firma_email: email })
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

    change(event) {
      this.file = event.target.files[0];
    },

    submit() {
      const formData = new FormData();
      formData.set("file", this.file);
      formData.append("id", this.calisanselected.id);
      formData.append("name", this.calisanselected.name);
      formData.append("firma_email", this.Selected.firma_email);
      formData.append("rapor", this.rapor);
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
      var email = this.Selected.firma_email;
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

    form() {
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
    repeateAgain() {
      this.items.push({
        id: (this.nextTodoId += this.nextTodoId),
      });

      this.$nextTick(() => {
        this.trAddHeight(this.$refs.row[0].offsetHeight);
      });
    },
    removeItem(index) {
      this.items.splice(index, 1);
      this.trTrimHeight(this.$refs.row[0].offsetHeight);
    },
    initTrHeight() {
      this.trSetHeight(null);
      this.$nextTick(() => {
        this.trSetHeight(this.$refs.form.scrollHeight);
      });
    },
  },
};
</script>
