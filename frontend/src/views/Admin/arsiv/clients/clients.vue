<template>
  <b-card title="Arşivlenen Müşteriler">
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
          @row-clicked="tikla"
          show-empty
          empty-text="Veri Bulunamadı."
          empty-filtered-text="Veri Bulunamadı."
          @filtered="onFiltered"
        >
          <template #cell(actions)="data">
            <span>
              <b-button

                variant="success"
                @click="arsivckr(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-success
                title="Arşivden Çıkar"
              >
                <feather-icon icon="ExternalLinkIcon" />
              </b-button>
              <b-button

                variant="warning"
                @click="Modal2(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-warning
                title="Düzenle"
              >
                <feather-icon icon="EditIcon" />
              </b-button>
              <b-modal
                hide-header-close
                :hide-footer="true"
                size="lg"
                ref="modal2"
                centered
                title="Firma Düzenle"
              >
                <b-card>
                  <b-form @submit.prevent="update">
                    <b-form-group
                      label="İşyeri Ünvanı:"
                      label-for="isim"
                      label-cols-sm="3"
                      label-align-sm="right"
                    >
                      <b-form-input
                        id="isim"
                        v-model="name"
                        placeholder="İş Yeri Adını Giriniz..."
                      ></b-form-input>
                    </b-form-group>
                    <b-form-group
                      label="Firma Yetkilisi:"
                      label-for="isim"
                      label-cols-sm="3"
                      label-align-sm="right"
                    >
                      <b-form-input
                        id="isim"
                        v-model="firma_yetkilisi"
                        placeholder="Firma Yetkilisinin Adını Giriniz..."
                      ></b-form-input>
                    </b-form-group>

                    <b-form-group
                      label="SGK Sicil No:"
                      label-for="isim"
                      label-cols-sm="3"
                      label-align-sm="right"
                    >
                      <b-form-input
                        id="isim"
                        v-model="sgkno"
                        placeholder="SGK Sicil Numarasını Giriniz..."
                      ></b-form-input>
                    </b-form-group>
                    <b-form-group
                      label="Vergi Dairesi"
                      label-for="isim"
                      label-cols-sm="3"
                      label-align-sm="right"
                    >
                      <b-form-input
                        id="isim"
                        v-model="vergiad"
                        placeholder="Vergi Dairesi Adını Giriniz"
                      ></b-form-input>
                    </b-form-group>
                    <b-form-group
                      label="Vergi No:"
                      label-for="isim"
                      label-cols-sm="3"
                      label-align-sm="right"
                    >
                      <b-form-input
                        id="isim"
                        v-model="vergino"
                        placeholder="Vergi Numarası"
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
                        placeholder="Firma Telefon Numarası"
                      ></b-form-input>
                    </b-form-group>

                    <div style="float: right">
                      <b-button variant="success" type="submit">
                        Tamam
                      </b-button>
                    </div>
                    <div style="float: right; padding-right: 10px">
                      <b-button variant="danger" @click="form()">
                        İptal</b-button
                      >
                    </div>
                  </b-form>

                  <!-- Emulate built in modal footer ok and cancel button actions -->
                </b-card>
              </b-modal>

              <b-button

                variant="danger"
                @click="confirmButtonColor(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-danger
                title="Sil"
              >
                <feather-icon icon="TrashIcon" /> </b-button
            ></span>
          </template>
            <template #cell(name)="data">
              <p class="hover" v-b-tooltip.hover.top variant="outline-primary" :title="data.item.name">
                {{ data.item.name }}
              </p>
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
  VBTooltip,
  BCard,
  BModal,
  BForm,
} from "bootstrap-vue";
import axios from "@axios";
import Ripple from "vue-ripple-directive";
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
  },
  directives: {
    "b-tooltip": VBTooltip,
    Ripple,
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
         { key: "id", label: "Firma Kodu", sortable: true, filter: true },
        { key: "email", label: "E-Posta", sortable: true, filter: true },
        { key: "sgk", label: "SGK Numarası", sortable: true, filter: true },
        {
          key: "vergino",
          label: "Vergi Numarası",
          sortable: true,
          filter: true,
        },
        {
          key: "vergiad",
          label: "Vergi Dairesi",
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
          key: "firma_yetkilisi",
          label: "Firma Yetkilisi",
          sortable: true,
        },

        { key: "actions", label: "Eylemler" },
      ],
      items: [],
      name: "",
      sgkno: "",
      vergino: "",
      vergiad: "",
      firma_yetkilisi: "",

      email: "",
      role: "",
      telefon: "",
      password: "",
      id: "",
      searchTerm: "",
      options: "",

      show: false,
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
  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },
  created() {
    axios.post("/api/firmalar", { status: 7 }).then((response) => {
      this.items = response.data;
    });
  },
  confirmButtonColor(data) {
    this.$swal({
      title: "Emin misin?",
      text: "Bu işlemi geri alamayacaksın!",
      icon: "warning",
      showCancelButton: true,
      cancelButtonText: "İptal",
      confirmButtonText: "Evet, sil!",
      customClass: {
        confirmButton: "btn btn-primary",
        cancelButton: "btn btn-outline-danger ml-1",
      },
      buttonsStyling: false,
    }).then((result) => {
      if (result.value) {
        this.$swal({
          icon: "success",
          title: "Silindi!",
          text: "Veri Silindi.",
          customClass: {
            confirmButton: "btn btn-success",
          },
        }),
          axios.post("api/usersil", { id: data.id }).then(this.refreshStop());
      } else if (result.dismiss === "cancel") {
        this.$swal({
          title: "İptal",
          text: "Veri silinmedi",
          icon: "error",
          customClass: {
            confirmButton: "btn btn-success",
          },
        });
      }
    });
  },

  methods: {
    refreshStop() {
      setTimeout(() => {
        axios
          .post("/api/firmalar", { status: 7 })
          .then((response) => {
            this.items = response.data;
          })
          .then(
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Firma İşlemleri `,
                icon: "BriefcaseIcon",
                variant: "success",
                text: ` İşlem Başarılı.`,
              },
            })
          );
      }, 1000);
    },
    tikla(params) {
      this.$router.push({
        name: "firmalar-goster",
        params: { id: params.id },
      });
    },
    submit() {
      axios
        .post("/api/firmaekle", {
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          password: this.password,
          vergino: this.vergino,
          vergiad: this.vergiad,
          firma_yetkilisi: this.firma_yetkilisi,
          sgk: this.sgkno,
          nace: this.nace,
        })
        .then((res) => this.refreshStop())
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Firma İşlemleri `,
              icon: "BriefcaseIcon",
              variant: "danger",
              text: ` İşlem Başarısız.`,
            },
          });
        })
        .then(this.form());
    },

    Modal1() {
      this.$refs["modal1"].show();
    },
    arsivckr(data) {
      axios.post("api/firmaarsvckr", { id: data }).then(this.refreshStop());
    },

    Modal2(row) {
      this.$refs["modal2"].show();
      (this.id = row.id),
        (this.name = row.name),
        (this.sgkno = row.sgk),
        (this.vergiad = row.vergiad),
        (this.vergino = row.vergino),
        (this.email = row.email),
        (this.firma_yetkilisi = row.firma_yetkilisi),
        (this.telefon = row.telefon);
    },

    update() {
      axios
        .post("/api/firmaduzenle", {
          id: this.id,
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          vergino: this.vergino,
          vergiad: this.vergiad,
          firma_yetkilisi: this.firma_yetkilisi,
          sgk: this.sgkno,
        })
        .then((res) => this.refreshStop())
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Firma İşlemleri `,
              icon: "BriefcaseIcon",
              variant: "danger",
              text: `İşlem Başarısız.`,
            },
          });
        })
        .then(this.form());
    },

    confirmButtonColor(data) {
      this.$swal({
        title: "Emin misin?",
        text: "Bu işlemi geri alamayacaksın!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "İptal",
        confirmButtonText: "Evet, sil!",
        customClass: {
          confirmButton: "btn btn-primary",
          cancelButton: "btn btn-outline-danger ml-1",
        },
        buttonsStyling: false,
      }).then((result) => {
        if (result.value) {
          this.$swal({
            icon: "success",
            title: "Silindi!",
            text: "Veri Silindi.",
            customClass: {
              confirmButton: "btn btn-success",
            },
          }),
            axios
              .post("api/firmasil", { id: data.id })
              .then(this.refreshStop());
        } else if (result.dismiss === "cancel") {
          this.$swal({
            title: "İptal",
            text: "Veri silinmedi",
            icon: "error",
            customClass: {
              confirmButton: "btn btn-success",
            },
          });
        }
      });
    },
    form() {
      this.$refs["modal1"].hide(),
        this.$refs["modal2"].hide(),
        (this.id = ""),
        (this.name = ""),
        (this.sgkno = ""),
        (this.vergiad = ""),
        (this.vergino = ""),
        (this.email = ""),
        (this.firma_yetkilisi = ""),
        (this.telefon = "");
    },


    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },
};
</script>
<style>
.hover {
  overflow: hidden;
  width: 100px;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
}
</style>
