<template>
  <div>
    <b-card title="Kullanıcılar">
      <b-row>
        <button hidden id="hata" @click.prevent="hata"></button>
        <button hidden id="basarili" @click.prevent="basarili"></button>
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
        <b-button
          class="mb-1"
          style="margin: auto"
          variant="success"
          @click="Modal1"
        >
          <feather-icon size="20px;" icon="PlusIcon"
        /></b-button>
        <span>
          <b-modal
            hide-header-close
            ok-title="Kaydet"
            :hide-footer="true"
            size="lg"
            ref="modal1"
            centered
            :title="status ? 'Kullanıcı Ekle' : 'Kullanıcı Düzenle'"
          >
            <b-card>
              <b-form @submit.prevent="submit(stat)">
                <b-form-group
                  label="İsim:"
                  label-for="isim"
                  label-cols-sm="3"
                  label-align-sm="right"
                >
                  <b-form-input
                    id="isim"
                    v-model="form.name"
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
                    v-model="form.email"
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
                    v-model="form.telefon"
                    placeholder="Kullanıcı Telefon Numarası"
                  ></b-form-input>
                </b-form-group>
                <b-form-group
                  label="Kullanıcı Şifresi:"
                  label-for="password"
                  label-cols-sm="3"
                  label-align-sm="right"
                >
                  <b-form-input
                    id="password"
                    v-model="form.password"
                    placeholder="Şifre Giriniz"
                  ></b-form-input>
                </b-form-group>

                <b-form-group
                  label="Rol Seçiniz: "
                  label-for="nested-city"
                  label-cols-sm="3"
                  label-align-sm="right"
                >
                  <b-form-select
                    aria-placeholder="Sürücü Seçiniz"
                    v-model="form.role"
                  >
                    <option disabled value="">Lütfen Seçim Yapınız</option>
                    <option>Admin</option>
                    <option>Yetkili</option>
                    <option value="Firma">Kurumsal Kullanıcı</option>
                    <option value="Bireysel">Biresel Kullanıcı</option>
                  </b-form-select>
                </b-form-group>

                <div style="float: right">
                  <b-button variant="success" type="submit"> Tamam </b-button>
                </div>
                <div style="float: right; padding-right: 10px">
                  <b-button variant="danger" @click="clear()"> İptal</b-button>
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
            small
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
                  @click.prevent="tikla"
                  class="btn-icon"
                  v-b-tooltip.hover.v-success
                  style="margin: 5px"
                  title="Göster"
                >
                  <feather-icon icon="ImageIcon" />
                </b-button>
                <b-button
                  v-ripple.400="'rgba(255, 255, 255, 0.15)'"
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
                  v-ripple.400="'rgba(255, 255, 255, 0.15)'"
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

            <template #cell(name)="data">
              <p
                class="hover"
                v-b-tooltip.hover.top
                variant="outline-primary"
                :title="data.item.name"
              >
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
  </div>
</template>
<script>
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
import { VBTooltip } from "bootstrap-vue";
import Ripple from "vue-ripple-directive";
export default {
  components: {
    VBTooltip,
    ToastificationContent,
  },

  directives: {
    "b-tooltip": VBTooltip,
    Ripple,
  },
  data() {
    return {
      ...this.$store.state.global.table,
      fields: [
        { key: "name", label: "İSİM", sortable: true, filter: true },
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
          label: "OluŞturulma Tarİhİ",
          sortable: true,
          filter: true,
        },
        { key: "actions", label: "Eylemler" },
      ],
      form: {
        name: "",
        email: "",
        role: "",
        telefon: "",
        password: "",
        userid: null,
      },

      items: null,
      searchTerm: "",
      excel: null,
      error: "",
      status: null,
      show: false,
      stat: true,
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
      return this.fieldsBa
        .filter((f) => f.sortable)
        .map((f) => ({ text: f.label, value: f.key }));
    },
  },
  created() {
    this.$http
      .post("/api/users")
      .then((response) => (this.items = response.data));
    let ckeditor = document.createElement("script");
    ckeditor.setAttribute(
      "src",
      "//cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"
    );
    document.head.appendChild(ckeditor);
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.items.length;
    }, 500);
  },
  methods: {
    submit(data) {
      if (data) {
        this.$http
          .post("api/userekle", this.form)
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
          .then(this.clear());
      } else {
        this.$http
          .post("api/userupdate", this.form)

          .then((res) => this.refreshStop())
          .then(this.clear())
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
        this.stat = true;
      }
    },
    update() {},

    arsiv(data) {
      this.$http.post("api/arsivuser", data).then(this.refreshStop());
    },

    Modal1() {
      this.$refs["modal1"].show();
    },
    Modal2(row) {
      this.$refs["modal1"].show();
      this.stat = false;
      this.form = row;
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

    basarili() {
      this.refreshStop();
    },
    hata() {
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
    },

    clear() {
      this.$refs["modal1"].hide();
      this.form = "";
    },

    refreshStop() {
      setTimeout(() => {
        this.$http
          .post("/api/users")
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
<style>
.hover {
  overflow: hidden;
  width: 100px;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
}
</style>
