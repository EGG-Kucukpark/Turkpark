<template>
  <b-card title="Katılımcılar">
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

      <b-button
        class="mb-1"
        style="margin: auto; margin-right: 40px"
        variant="success"
        @click="Modal1"
      >
        <feather-icon size="24" icon="PlusIcon" />
      </b-button>
      <span>
        <!-- Update -->
        <b-modal
          hide-header-close
          ok-title="Kaydet"
          :hide-footer="true"
          size="lg"
          ref="modal2"
          centered
        >
          <b-card>
            <b-form @submit.prevent="update">
              <b-form-group
                label="Katılımcı Adı:"
                label-for="ad"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="ad"
                  v-model="name"
                  placeholder="Katılımcı Adını Giriniz"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                label="E-posta Adresi:"
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
                label="Telefon:"
                label-for="Telefon"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="Telefon"
                  v-model="telefon"
                  placeholder="Telefon Numarasını Giriniz"
                ></b-form-input>
              </b-form-group>

              <b-form-group
                label="Ödeme:"
                label-for="ödeme"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  aria-placeholder="Sürücü Seçiniz"
                  v-model="payed"
                >
                  <option disabled value="">Lütfen Seçim Yapınız</option>
                  <option value="1">Ödeme Yapıldı</option>
                  <option value="0">Ödeme Yapılmadı</option>
                </b-form-select>
              </b-form-group>

              <div style="float: right">
                <b-button
                  variant="success"
                  @click="$emit('submit')"
                  type="submit"
                >
                  Tamam
                </b-button>
              </div>
              <div style="float: right; padding-right: 10px">
                <b-button variant="danger" @click="form()"> İptal</b-button>
              </div>
            </b-form>
          </b-card>
        </b-modal>

        <!--  Yeni Ekle -->
        <b-modal
          hide-header-close
          :hide-footer="true"
          size="lg"
          ref="modal1"
          centered
          title="Katılımcı Ekle"
        >
          <b-card>
            <b-form @submit.prevent="submit">
              <b-form-group
                label="Katılımcı Adı:"
                label-for="ad"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="ad"
                  v-model="name"
                  placeholder="Katılımcı Adını Giriniz"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                label="E-posta Adresi:"
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
                label="Telefon:"
                label-for="Telefon"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="Telefon"
                  v-model="telefon"
                  placeholder="Telefon Numarasını Giriniz"
                ></b-form-input>
              </b-form-group>

              <b-form-group
                label="Ödeme:"
                label-for="ödeme"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select
                  aria-placeholder="Sürücü Seçiniz"
                  v-model="payed"
                >
                  <option disabled value="">Lütfen Seçim Yapınız</option>
                  <option value="1">Ödeme Yapıldı</option>
                  <option value="0">Ödeme Yapılmadı</option>
                </b-form-select>
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
              <b-button
                variant="warning"
                @click="Modal2(data.item)"
                class="btn-icon"
                style="margin: 5px"
                v-b-tooltip.hover.v-warning
                title="Düzenle"
              >
                <feather-icon icon="EditIcon" />
              </b-button>
              <b-button
                variant="danger"
                @click.prevent="arsiv(data.item)"
                class="btn-icon"
                style="margin: 5px"
                v-b-tooltip.hover.v-danger
                title="Arşivle"
              >
                <feather-icon icon="ArchiveIcon" />
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
import router from "@/router";
import {
  BCardHeader,
  BCardBody,
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
  VBTooltip,
  BInputGroupAppend,
  BButton,
  BCard,
  BModal,
  BForm,
  BFormFile,
  BFormDatepicker,
  BFormTimepicker,
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
    VBTooltip,
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
    BFormDatepicker,
    BCardHeader,
    BCardBody,
    BFormTimepicker,
  },

  directives: {
    "b-tooltip": VBTooltip,
  },
  data() {
    return {
      perPage: 10,
      pageOptions: [10, 20, 30],
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
        { key: "Name", label: "Katılımcı Adı", sortable: true, filter: true },
        { key: "email", label: "E-Posta", sortable: true, filter: true },
        {
          key: "telefon",
          label: "Telefon Numarası",
          sortable: true,
          filter: true,
        },


        { key: "actions", label: "Eylemler" },
      ],
      items: null,

      excel: null,
      id: router.currentRoute.params.id,
      name: null,
      email: null,
      telefon: null,
      payed: null,
    };
  },

  created() {
    axios
      .post(`/api/katilimcigetir`, { id: this.id })
      .then((res) => (this.items = res.data));
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },

  methods: {
    error() {
      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Etkinlik İşlemleri `,
          icon: "UserIcon",
          variant: "danger",
          text: ` İşlem Başarısız.`,
        },
      });
    },
    ok() {
      setTimeout(() => {
        axios
          .post("/api/katilimcigetir", { id: router.currentRoute.params.id })
          .then((response) => {
            this.items = response.data;
          })
          .then(
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Etkinlik İşlemleri `,
                icon: "UserIcon",
                variant: "success",
                text: `Etkinlik İşlemi Başarılı.`,
              },
            })
          );
      }, 1000);
    },
    submit() {
      axios
        .post("/api/katilimciekle", {
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          payed: this.payed,
          id: this.id,
        })
        .then((res) => this.ok())
        .catch((error) => {
          this.error();
        })
        .then(this.form());
    },

    update() {
      axios
        .post("/api/katilimciduzenle", {
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          payed: this.payed,
          id: this.id,
        })

        .then((res) => this.ok())
        .then(this.form())
        .catch((error) => {
          this.error();
        });
    },

    Modal1() {
      this.$refs["modal1"].show();
    },

    Modal2(row) {
      this.$refs["modal2"].show();

      (this.id = row.id),
        (this.name = row.Name),
        (this.email = row.email),
        (this.telefon = row.telefon),
        (this.payed = row.payed);
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


    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },
};
</script>
