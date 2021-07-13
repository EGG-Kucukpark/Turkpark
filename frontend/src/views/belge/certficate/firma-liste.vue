<template>
  <div>
    <b-card title="Kurumsal Müşteriler">
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
            @click="Modal1"
          >
            <feather-icon size="20px;" icon="PlusIcon"
          /></b-button>

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
              <validation-observer ref="registerForm" #default="{ invalid }">
                <b-form @submit.prevent="submit">
                  <b-form-group
                    label="İşyeri Ünvanı:"
                    label-for="isim"
                    label-cols-sm="3"
                    label-align-sm="right"
                  >
                    <validation-provider
                      #default="{ errors }"
                      name="İsim"
                      rules="required|"
                    >
                      <b-form-input
                        id="isim"
                        :state="errors.length > 0 ? false : null"
                        v-model="name"
                        placeholder="İş Yeri Adını Giriniz..."
                      ></b-form-input>
                      <small class="text-danger">{{ errors[0] }}</small>
                    </validation-provider>
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
                    <small class="text-danger">{{ errors[0] }}</small>
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
                    <small class="text-danger">{{ errors[0] }}</small>
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
                    <small class="text-danger">{{ errors[0] }}</small>
                  </b-form-group>

                  <b-form-group
                    label="E-Posta Adresi"
                    label-for="email"
                    label-cols-sm="3"
                    label-align-sm="right"
                  >
                    <b-form-input
                      id="email"
                      :state="errors.length > 0 ? false : null"
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
                  <small class="text-danger">{{ errors[0] }}</small>
                  <b-form-group
                    label="Firma Şifresi:"
                    label-for="password"
                    label-cols-sm="3"
                    label-align-sm="right"
                  >
                    <b-input-group
                      class="input-group-merge"
                      :class="errors.length > 0 ? 'is-invalid' : null"
                    >
                      <b-form-input
                        v-model="Şifre"
                        class="form-control-merge"
                        :type="passwordFieldType"
                        :state="errors.length > 0 ? false : null"
                        placeholder="············"
                      />
                      <b-input-group-append is-text>
                        <feather-icon
                          :icon="passwordToggleIcon"
                          class="cursor-pointer"
                          @click="togglePasswordVisibility"
                        />
                      </b-input-group-append>
                    </b-input-group>
                  </b-form-group>

                  <div style="float: right">
                    <b-button
                      variant="success"
                      block
                      type="submit"
                      :disabled="invalid"
                    >
                      Tamam
                    </b-button>
                  </div>
                  <div style="float: right; padding-right: 10px">
                    <b-button variant="danger" @click="form()"> İptal</b-button>
                  </div>
                </b-form>
              </validation-observer>

              <!-- Emulate built in modal footer ok and cancel button actions -->
            </b-card>
          </b-modal>

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
                  label="Firma Şifresi"
                  label-for="isim"
                  label-cols-sm="3"
                  label-align-sm="right"
                >
                  <b-form-input
                    id="isim"
                    v-model="password"
                    placeholder="........"
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
            @row-clicked="tikla"
            show-empty
            empty-text="Veri Bulunamadı."
            empty-filtered-text="Veri Bulunamadı."
            @filtered="onFiltered"
          >
            <template #head(id)>
              <span v-b-tooltip.hover.v-dark title="Firma Kodu">F.K</span>
            </template>
            <template #head(ks)>
              <span v-b-tooltip.hover.v-dark title="Kursiyer Sayısı">K.S</span>
            </template>
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
                  v-b-tooltip.hover.v-warning
                  style="margin: 5px"
                  title="Düzenle"
                >
                  <feather-icon icon="EditIcon" />
                </b-button>

                <b-button
                  v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                  variant="danger"
                  @click.prevent="arsiv(data.item)"
                  style="margin: 5px"
                  v-b-tooltip.hover.v-danger
                  title="Arşivle"
                  class="btn-icon"
                >
                  <feather-icon icon="ArchiveIcon" /> </b-button
              ></span>
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

            <template #cell(ks)="data">
              <div v-for="sayi in sayi" :key="sayi.id">
                <span v-if="data.item.id === sayi.firma_id">
                  <span v-if="sayi.sayi === 0"> 0</span>
                  <span v-if="sayi.sayi != 0"> {{sayi.sayi}}</span>
                </span>
              </div>
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
import Ripple from "vue-ripple-directive";

import {
  BTable,
  BAvatar,
  BBreadcrumb,
  BBreadcrumbItem,
  BBadge,
  VBTooltip,
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
} from "bootstrap-vue";
import axios from "@axios";
import { required } from "@validations";
import { togglePasswordVisibility } from "@core/mixins/ui/forms";
import { ValidationProvider, ValidationObserver } from "vee-validate";
export default {
  components: {
    BTable,
    BAvatar,
    BBadge,
    BRow,
    VBTooltip,
    BCol,
    BBreadcrumb,
    BBreadcrumbItem,
    BFormGroup,
    BFormSelect,
    BPagination,
    BInputGroup,
    BFormInput,
    BInputGroupAppend,
    BButton,
    BCard,
    ValidationProvider,
    ValidationObserver,
    togglePasswordVisibility,
    BModal,
    ToastificationContent,
    BForm,
    required,
  },
  mixins: [togglePasswordVisibility],
  directives: {
    "b-tooltip": VBTooltip,
    Ripple,
  },
  data() {
    return {
      errors: [],
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
        { key: "ks", label: "Kursiyer Sayisi", sortable: true, filter: true },
        { key: "email", label: "E-Posta", sortable: true, filter: true },

        {
          key: "telefon",
          label: "Telefon Numarası",
          sortable: true,
          filter: true,
        },
        { key: "sgk", label: "SGK Numarası", sortable: true, filter: true },

        {
          key: "firma_yetkilisi",
          label: "Fİrma Yetkİlİsİ",
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
      sayi: null,

      show: false,
    };
  },

  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === "password" ? "EyeIcon" : "EyeOffIcon";
    },
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
    axios.post("/api/firmalar").then((response) => {
      this.items = response.data;
    });

    axios("/api/workersayi").then((res) => {
      this.sayi = res.data;
    });
  },

  methods: {
    refreshStop() {
      setTimeout(() => {
        axios
          .post("/api/firmalar")
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
        name: "kursiyer-firma",
        params: { id: params.id },
      });
    },
    arsiv(data) {
      console.log(data.id);

      axios.post("api/arsivfirma", { id: data.id }).then(this.refreshStop());
    },

    kurs_sayi(data) {
      this.$store.dispatch("kursiyer_sayi", { data });
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

