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
            :title="status ? 'Firma Ekle' : 'Firma Düzenle'"
          >
            <validation-observer ref="registerForm" #default="{ invalid }">
              <b-form @submit.prevent="submit(status)">
                <b-form-group
                  label="İşyeri Ünvanı:"
                  label-for="isim"
                  label-cols-sm="2"
                >
                  <validation-provider
                    #default="{ errors }"
                    name="İsim"
                    rules="required|"
                  >
                    <b-form-input
                      id="isim"
                      :state="errors.length > 0 ? false : null"
                      v-model="form.name"
                      placeholder="İş Yeri Adını Giriniz..."
                    ></b-form-input>
                    <small class="text-danger">{{ errors[0] }}</small>
                  </validation-provider>
                </b-form-group>

                <b-form-group
                  label="Firma Yetkilisi:"
                  label-for="isim"
                  label-cols-sm="2"
                >
                  <b-form-input
                    id="isim"
                    v-model="form.firma_yetkilisi"
                    placeholder="Firma Yetkilisinin Adını Giriniz..."
                  ></b-form-input>
                  <small class="text-danger">{{ errors[0] }}</small>
                </b-form-group>

                <b-form-group
                  label="SGK Sicil No:"
                  label-for="isim"
                  label-cols-sm="2"
                >
                  <b-form-input
                    id="isim"
                    v-model="form.sgkno"
                    placeholder="SGK Sicil Numarasını Giriniz..."
                  ></b-form-input>
                </b-form-group>

                <b-form-group
                  label="Vergi Dairesi"
                  label-for="isim"
                  label-cols-sm="2"
                >
                  <b-form-input
                    id="isim"
                    v-model="form.vergiad"
                    placeholder="Vergi Dairesi Adını Giriniz"
                  ></b-form-input>
                  <small class="text-danger">{{ errors[0] }}</small>
                </b-form-group>

                <b-form-group
                  label="Vergi No:"
                  label-for="isim"
                  label-cols-sm="2"
                >
                  <b-form-input
                    id="isim"
                    v-model="form.vergino"
                    placeholder="Vergi Numarası"
                  ></b-form-input>
                  <small class="text-danger">{{ errors[0] }}</small>
                </b-form-group>

                <b-form-group
                  label="E-Posta Adresi"
                  label-for="email"
                  label-cols-sm="2"
                >
                  <b-form-input
                    id="email"
                    :state="errors.length > 0 ? false : null"
                    v-model="form.email"
                    placeholder="E-posta Adresini Giriniz"
                  ></b-form-input>
                </b-form-group>

                <b-form-group
                  label="Telefon No:"
                  label-for="telefon"
                  label-cols-sm="2"
                >
                  <b-form-input
                    id="telefon"
                    v-model="form.telefon"
                    placeholder="Firma Telefon Numarası"
                  ></b-form-input>
                </b-form-group>
                <small class="text-danger">{{ errors[0] }}</small>
                <b-form-group
                  label="Firma Şifresi:"
                  label-for="password"
                  label-cols-sm="2"
                >
                  <b-input-group
                    class="input-group-merge"
                    :class="errors.length > 0 ? 'is-invalid' : null"
                  >
                    <b-form-input
                      v-model="form.Şifre"
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
                  <b-button variant="danger" @click="clear()"> İptal</b-button>
                </div>
              </b-form>
            </validation-observer>

            <!-- Emulate built in modal footer ok and cancel button actions -->
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
            @row-clicked="tikla"
            show-empty
            empty-text="Veri Bulunamadı."
            empty-filtered-text="Veri Bulunamadı."
            @filtered="onFiltered"
            ><template #head(id)>
              <span v-b-tooltip.hover.v-dark title="Firma Kodu">F.K</span>
            </template>

            <template #cell(ds)="data">
              <span v-for="sayi in sayi" :key="sayi.id">
                <span v-if="data.item.id === sayi.firma_id">
                  <span> {{ sayi.sayi }} </span>
                </span>
              </span>
            </template>

            <template #head(ds)>
              <span v-b-tooltip.hover.v-dark title="Dosya Sayısı">D.S</span>
            </template>
            <template #cell(actions)="data">
              <span>
                <b-button

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
            <template #cell(ks)>
              <span v-b-tooltip.hover.v-dark title="Firma Kodu">F.K</span>
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
import Ripple from "vue-ripple-directive";
import VBTooltip from "bootstrap-vue";
import { required } from "@validations";
import { togglePasswordVisibility } from "@core/mixins/ui/forms";
import { ValidationProvider, ValidationObserver } from "vee-validate";
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    togglePasswordVisibility,
    ToastificationContent,
    VBTooltip,
    required,
  },
  mixins: [togglePasswordVisibility],
  directives: {
    "b-tooltip": VBTooltip,
    Ripple,
  },
  props: {
    bilgi: {
      type: Object,
    },
  },
  data() {
    return {
      ...this.$store.state.global.table,
      fields: [
        { key: "name", label: "FİRMA ADI", sortable: true, filter: true },
        { key: "id", label: "Firma Kodu", sortable: true, filter: true },
        { key: "ds", label: "DOSYA SAYISI", sortable: true, filter: true },
        { key: "email", label: "E-Posta", sortable: true, filter: true },

        {
          key: "telefon",
          label: "Telefon Numarası",
          sortable: true,
          filter: true,
        },

        {
          key: "firma_yetkilisi",
          label: "Fİrma Yetkİlİsİ",
          sortable: true,
        },

        { key: "actions", label: "Eylemler" },
      ],
      items: [],
      errors: [],
      form: {
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
      },
      searchTerm: "",
      options: "",
      sayi: null,
      show: false,
      status: true,
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
    this.$http.post("/api/firmalar").then((response) => {
      this.items = response.data;
    });

    this.$http
      .post("/api/calisandosyasayi", { db: this.bilgi.db })
      .then((res) => {
        this.sayi = res.data;
      });
  },

  methods: {
    refreshStop() {
      setTimeout(() => {
        this.$http
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
        name: this.bilgi.url,
        params: { id: params.id },
      });
    },
    arsiv(data) {
      this.$http
        .post("api/arsivfirma", { id: data.id })
        .then(this.refreshStop());
    },
    submit(data) {
      if (data) {
        this.$http
          .post("/api/firmaekle", this.form)
          .then((res) => this.refreshStop())
          .catch((error) => {
            this.hata();
          })
          .then(this.clear());
      } else {
        this.$http
          .post("/api/firmaduzenle", this.form)
          .then((res) => this.refreshStop())
          .catch((error) => {
            this.hata();
          })
          .then(this.clear());
        this.status = true;
      }
    },

    Modal1() {
      this.$refs["modal1"].show();
    },

    Modal2(row) {
      this.status = false;
      this.$refs["modal1"].show();
      this.form = row;
    },

    clear() {
      this.$refs["modal1"].hide();
      this.form = "";
    },

    hata() {
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
    },


    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },
};
</script><style>
.hover {
  overflow: hidden;
  width: 100px;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
}
</style>

