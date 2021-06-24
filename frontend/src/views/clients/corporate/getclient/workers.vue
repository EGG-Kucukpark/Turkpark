<template>
  <b-card-actions
    ref="cardAction"
    @refresh="refreshStop('cardAction')"
    title="Kullanıcı Listesi"
  >
    <!-- input search -->
    <div class="custom-search d-flex justify-content-end">
      <b-form-group>
        <div class="d-flex align-items-center">
          <label class="mr-1">Arama:</label>
          <b-form-input
            v-model="searchTerm"
            placeholder="Ara"
            type="text"
            class="d-inline-block"
          />
        </div>
      </b-form-group>
    </div>

    <!-- table -->
    <vue-good-table
      :line-numbers="true"
      :columns="columns"
      :rows="rows"
      theme="polar-bear"
      :rtl="direction"
      :search-options="{
        enabled: true,

        externalQuery: searchTerm,
      }"
      :pagination-options="{
        enabled: true,
        perPage: pageLength,
      }"
    >
      <p style="text-align: center; width: 100%" slot="emptystate">
        <b> Çalışan Bulunamadı.</b>
      </p>
      <!-- Araç Ekleme  -->
      <div slot="table-actions" style="margin: 10px">
        <b-button variant="success" @click="Modal1">Yeni Çalışan</b-button>

        <b-modal
          hide-header-close
          ok-title="Kaydet"
          :hide-footer="true"
          size="lg"
          ref="modal1"
          centered
          title="Firma Ekle"
        >
          <b-card>
            <b-form @submit.prevent="submit">
              <b-form-group
                label="İsim:"
                label-for="isim"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="isim"
                  v-model="name"
                  placeholder="İsim Giriniz"
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
                  placeholder="Kullanıcı Telefon Numarası"
                ></b-form-input>
              </b-form-group>

              <div style="float: right">
                <b-button variant="success" @click="form()" type="submit">
                  Çalışan Ekle
                </b-button>
              </div>
              <div style="float: right; padding-right: 10px">
                <b-button variant="danger" @click="form()"> İptal</b-button>
              </div>
            </b-form>

            <!-- Emulate built in modal footer ok and cancel button actions -->
          </b-card>
        </b-modal>
      </div>

      <template slot="table-row" slot-scope="props">
        <!--  Araç Ekleme Bitiş-->

        <!-- Column: Name -->
        <div v-if="props.column.field === 'name'" class="text-nowrap">
          <b-avatar :src="props.row.avatar" class="mx-1" />
          <span class="text-nowrap">{{ props.row.name }}</span>
        </div>

        <span v-else-if="props.column.field === 'role'">
          <div class="text-nowrap">
            <feather-icon
              :icon="roleVariant(props.row.role)"
              size="18"
              class="mr-50"
              style="color: red"
            />
            <span class="align-text-top text-capitalize">{{
              props.row.role
            }}</span>
          </div>
        </span>
        <!-- Column: Status -->

        <!-- Column: Action -->

        <span v-else-if="props.column.field === 'action'">
          <span>
            <b-dropdown
              variant="link"
              toggle-class="text-decoration-none"
              no-caret
            >
              <template v-slot:button-content>
                <feather-icon
                  icon="MoreVerticalIcon"
                  size="16"
                  class="text-body align-middle mr-25"
                />
              </template>
              <b-dropdown-item
                :to="{ name: 'calisan-goster', params: { id: props.row.id } }"
              >
                <feather-icon icon="TrashIcon" class="mr-50" />
                <span>Göster</span>
              </b-dropdown-item>
              <b-dropdown-item @click="Modal2(props.row)">
                <feather-icon icon="Edit2Icon" class="mr-50" />
                <span>Düzenle</span>
              </b-dropdown-item>

              <b-modal
                hide-header-close
                ok-title="Kaydet"
                :hide-footer="true"
                size="lg"
                centered
                title="Araç Düzenle"
                ref="modal2"
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
                      label="Yetki Seçiniz: "
                      label-for="nested-city"
                      label-cols-sm="3"
                      label-align-sm="right"
                    >
                      <b-form-select
                        aria-placeholder="Sürücü Seçiniz"
                        v-model="role"
                      >
                        <option disabled value="" v-if="form.Selected2 === null">
                      Lütfen Firma Seçiniz
                    </option>
                    <option disabled value="" v-if="form.Selected2 != null ">
                      Lütfen Çalışan Seçiniz
                    </option>
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
                        <option disabled value="" v-if="form.Selected2 === null">
                      Lütfen Firma Seçiniz
                    </option>
                    <option disabled value="" v-if="form.Selected2 != null ">
                      Lütfen Çalışan Seçiniz
                    </option>
                        <option value="1">Aktif</option>
                        <option value="2">Beklemede</option>
                        <option value="3">Red</option>
                      </b-form-select>
                    </b-form-group>

                    <div style="float: right">
                      <b-button variant="success" type="submit" @click="form()">
                        Düzenle
                      </b-button>
                    </div>
                    <div style="float: right; padding-right: 10px">
                      <b-button variant="danger" @click="form()">
                        İptal</b-button
                      >
                    </div>
                  </b-form>
                </b-card>
              </b-modal>

              <b-dropdown-item @click="deleteRow(props.row.id)">
                <feather-icon icon="TrashIcon" class="mr-50" />
                <span>Sil</span>
              </b-dropdown-item>
            </b-dropdown>
          </span>
        </span>

        <!-- Column: Common -->
        <span v-else>
          {{ props.formattedRow[props.column.field] }}
        </span>
      </template>

      <!-- pagination -->
      <template slot="pagination-bottom" slot-scope="props">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-center mb-0 mt-1">
            <span class="text-nowrap"> Showing 1 to </span>
            <b-form-select
              v-model="pageLength"
              :options="['10', '20', '30', '40', '50,']"
              class="mx-1"
              @input="
                (value) => props.perPageChanged({ currentPerPage: value })
              "
            />
            <span class="text-nowrap"> of {{ props.total }} entries </span>
          </div>
          <div>
            <b-pagination
              :value="1"
              :total-rows="props.total"
              :per-page="pageLength"
              first-number
              last-number
              align="right"
              prev-class="prev-item"
              next-class="next-item"
              class="mt-1 mb-0"
              @input="(value) => props.pageChanged({ currentPage: value })"
            >
              <template #prev-text>
                <feather-icon icon="ChevronLeftIcon" size="18" />
              </template>
              <template #next-text>
                <feather-icon icon="ChevronRightIcon" size="18" />
              </template>
            </b-pagination>
          </div>
        </div>
      </template>
    </vue-good-table>

    <template #code>
      {{ codeColumnSearch }}
    </template>
  </b-card-actions>
</template>

<script>
import BCardCode from "@core/components/b-card-code/BCardCode.vue";
import BCardActions from "@core/components/b-card-actions/BCardActions.vue";
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";

import {
  BAvatar,
  BForm,
  BBadge,
  BPagination,
  BFormGroup,
  BFormInput,
  BFormSelect,
  BDropdown,
  BDropdownItem,
  BButton,
  BCard,
} from "bootstrap-vue";
import { VueGoodTable } from "vue-good-table";
import store from "@/store/index";
import { codeColumnSearch } from "../code";
import axios from "@axios";

export default {
  components: {
    BCardCode,
    VueGoodTable,
    BAvatar,
    BBadge,
    BPagination,
    BFormGroup,
    BFormInput,
    BFormSelect,
    BDropdown,
    BDropdownItem,
    BCardActions,
    BButton,
    BForm,
    BCard,
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      pageLength: 10,
      dir: false,
      codeColumnSearch,
      columns: [
        {
          label: "İsim",
          field: "name",
          filterOptions: {
            enabled: true,
            placeholder: "Araç Ara",
          },
        },
        {
          label: "E-Posta",
          field: "email",
          filterOptions: {
            enabled: true,
            placeholder: "Search Email",
          },
        },

        {
          label: "Telefon",
          field: "telefon",
          filterOptions: {
            enabled: true,
            placeholder: "Search GsmNo",
          },
        },

        {
          label: "Eylemler",
          field: "action",
        },
      ],

      rows: [],
      name: "",
      email: "",
      role: "",
      telefon: "",
      status: null,
      password: "",
      id: this.userData.id,
      searchTerm: "",

      show: false,
    };
  },
  created() {
      console.log(this.userData)


    axios
      .post("/api/calisanlar", { firma_email: this.userData.email })
      .then((response) => {
        this.rows = response.data;
      });
  },

  methods: {
    refreshStop(cardName) {
      setTimeout(() => {
        axios
          .post("/api/calisanlar", { firma_email: this.userData.email })
          .then((response) => {
            this.rows = response.data;
          })
          .then(
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Firma Ekleme `,
                icon: "BriefcaseIcon",
                variant: "success",
                text: `Ekleme İşlemi Başarılı.`,
              },
            })
          );
        this.$refs[cardName].showLoading = false;
      }, 500);
    },

    submit() {


      axios
        .post("/api/calisanekle", {
          firma_email: this.userData.email,
          name: this.name,
          email: this.email,
          telefon: this.telefon,
        })
        .then((res) => this.refreshStop())
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Firma Ekleme `,
              icon: "BriefcaseIcon",
              variant: "danger",
              text: `Ekleme İşlemi Başarısız.`,
            },
          });
        });
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

    update() {
      axios
        .post("api/userupdate", {
          userid: this.userid,
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          role: this.role,
          status: this.status,
        })
        .then(
          axios.post("/api/users").then((response) => {
            this.rows = response.data;
          })
        )
        .then(
          this.$refs["modal2"].hide(),
          (this.Arac_ismi = ""),
          (this.Model = ""),
          (this.Plaka = ""),
          (this.GsmNo = ""),
          (this.Arac_Tipi = ""),
          (this.DeviceName = ""),
          (this.surucuadi = "")
        );
    },

    form() {
      this.$refs["modal1"].hide(),
        this.$refs["modal2"].hide(),
        (this.Name = ""),
        (this.TC = ""),
        (this.Telefon = ""),
        (this.S_No = ""),
        (this.Selected = ""),
        (this.Sk_No = ""),
        (this.id = ""),
        (this.Arac_ismi = ""),
        (this.Model = ""),
        (this.Plaka = ""),
        (this.GsmNo = ""),
        (this.Arac_Tipi = ""),
        (this.DeviceName = ""),
        (this.surucuadi = "");
    },
  },

  computed: {
    direction() {
      if (store.state.appConfig.isRTL) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.dir = true;
        return this.dir;
      }
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.dir = false;
      return this.dir;
    },
  },
};
</script>
