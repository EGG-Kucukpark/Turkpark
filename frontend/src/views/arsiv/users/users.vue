<template>
  <b-card title="Arşivlenen Kullanıcılar">
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
                variant="success"
                @click="arsivckr(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-success
                title="Arşivden Çıkar"
              >
                <feather-icon icon="ExternalLinkIcon" />
              </b-button>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="warning"
                @click="Modal2(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-warning
                title="Düzenle"
              >
                <feather-icon icon="EditIcon" />
              </b-button>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="danger"


                @click="confirmButtonColor(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-danger
                title="Sil"
              >
                <feather-icon icon="TrashIcon" />
              </b-button>
            </span>
          </template>
        </b-table>
      </b-col>
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
              label="İsim:"
              label-for="İsim"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="İsim"
                v-model="name"
                placeholder=" İsim Giriniz"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="E-posta:"
              label-for="nested-city"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="nested-city"
                v-model="email"
                placeholder="E-posta Adresini Giriniz"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Telefon No:"
              label-for="nested-state"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="nested-state"
                v-model="telefon"
                placeholder="İletişim Numarası"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Yeni Şifre"
              label-for="nested-state"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-input
                id="Şifre"
                v-model="password"
                placeholder=" Şifre Giriniz"
              ></b-form-input>
            </b-form-group>

            <b-form-group
              label="Yetki Seçiniz: "
              label-for="nested-city"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-select aria-placeholder="Sürücü Seçiniz" v-model="role">
                <option disabled value="">Lütfen Seçim Yapınız</option>
                <option>Admin</option>
                <option>Uzman</option>
                <option>Hekim</option>
                <option>Firma</option>
              </b-form-select>
            </b-form-group>
            <b-form-group
              label="Kullanıcı Durumu: "
              label-for="nested-city"
              label-cols-sm="3"
              label-align-sm="right"
            >
              <b-form-select v-model="status">
                <option disabled value="">Lütfen Seçim Yapınız</option>
                <option value="1">Aktif</option>
                <option value="2">Beklemede</option>
                <option value="3">Red</option>
              </b-form-select>
            </b-form-group>

            <div style="float: right">
              <b-button variant="success" type="submit"> Tamam </b-button>
            </div>
            <div style="float: right; padding-right: 10px">
              <b-button variant="danger" @click="form()"> İptal</b-button>
            </div>
          </b-form>
        </b-card>
      </b-modal>

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
  VBTooltip,
  BFormInput,
  BInputGroupAppend,
  BButton,
  BCard,
  BModal,
  BForm,
  BFormFile,
} from "bootstrap-vue";
import axios from "@axios";
import Ripple from 'vue-ripple-directive'
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
    downloadexcel,
    BFormFile,
  },
  directives: {
    "b-tooltip": VBTooltip,
    Ripple,
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
        { key: "name", label: "İsim", sortable: true, filter: true },
        { key: "email", label: "E-Posta", sortable: true, filter: true },
        { key: "role", label: "Rol", sortable: true, filter: true },
        { key: "telefon", label: "Telefon", sortable: true, filter: true },
        { key: "status", label: "Durum", sortable: true, filter: true },
        {
          key: "email_verified_at",
          label: "E-Posta Onay",
          sortable: true,
        },
        {
          key: "created_at",
          label: "Oluşturulma Tarihi",
          sortable: true,
          filter: true,
        },
        { key: "actions", label: "Eylemler" },
      ],
      items: null,
      name: "",
      email: "",
      role: "",
      telefon: "",
      password: "",
      userid: null,
      searchTerm: "",
      excel: null,
      error: "",
      status: null,
      show: false,
    };
  },

  computed: {
    roleVariant() {
      const resolveUserRoleIcon = {
        Admin: "UserIcon",
        Hekim: "HeartIcon",
        Uzman: "UsersIcon",
        Firma: "BriefcaseIcon",
      };
      return (role) => resolveUserRoleIcon[role];
    },
    statusVariant() {
      const statusColor = {
        /* eslint-disable key-spacing */

        1: "light-success",
        0: "light-danger",
        2: "light-warning",

        /* eslint-enable key-spacing */
      };

      return (status) => statusColor[status];
    },
    sortOptions() {
      // Create an options list from our fields
      return this.fields
        .filter((f) => f.sortable)
        .map((f) => ({ text: f.label, value: f.key }));
    },
  },
  created() {
    axios
      .post("/api/users", { status: 7 })
      .then((response) => (this.items = response.data));
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },

  methods: {
    arsivckr(data) {
      axios.post("api/arsivckr", { id: data.id }).then(this.refreshStop());
    },

    refreshStop() {
      setTimeout(() => {
        axios
          .post("/api/users", { status: 7 })
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

    submit() {
      axios
        .post("api/userekle", {
          name: this.name,
          email: this.email,
          role: this.role,
          telefon: this.telefon,
          password: this.password,
        })
        .then((res) => this.refreshStop())
        .catch((error) => {
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
        })
        .then(this.form());
    },

    Modal1() {
      this.$refs["modal1"].show();
    },
    Modal2(row) {
      this.$refs["modal2"].show();

      (this.userid = row.id),
        (this.name = row.name),
        (this.email = row.email),
        (this.telefon = row.telefon),
        (this.role = row.role),
        (this.status = row.status);
    },

    confirmButtonColor(data) {

      this.$swal({
        title: 'Emin misin?',
        text: "Bu işlemi geri alamayacaksın!",
        icon: 'warning',
        showCancelButton: true,
         cancelButtonText:"İptal",
        confirmButtonText: 'Evet, sil!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      }).then(result => {
        if (result.value) {
          this.$swal({
            icon: 'success',
            title: 'Silindi!',
            text: 'Veri Silindi.',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          }),
           axios.post("api/usersil", { id: data.id }).then(this.refreshStop());
        } else if (result.dismiss === 'cancel') {
          this.$swal({
            title: 'İptal',
            text: 'Veri silinmedi',
            icon: 'error',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          })
        }
      })
    },


    update() {
      axios
        .post("api/userupdate", {
          userid: this.userid,
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          role: this.role,
          status: this.status,
          password: this.password,
        })

        .then((res) => this.refreshStop())
        .then(this.form())
        .catch((error) => {
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
        });
    },

    async fetchData() {
      const response = await axios.post("/api/users");

      return response.data;
    },

    form() {
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
