<template>
  <b-card title="Çalışanlar">
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
          v-on:click="$refs['modal'].show()"
          ><feather-icon size="20" icon="PlusIcon"
        /></b-button>
        <b-modal
          hide-header-close
          ok-title="Kaydet"
          :hide-footer="true"
          size="lg"
          ref="modal"
          centered
          :title="status ? 'Çalışan Ekle' : 'Çalışan Düzenle'"
        >
          <validation-observer ref="registerForm" #default="{ invalid }">
            <b-form ref="submit" @submit.prevent="ekle(status)">
              <b-form-group label="İsim:" label-for="isim" label-cols-sm="2">
                <validation-provider #default="{ errors }" name="İsim">
                  <b-form-input
                    id="isim"
                    :state="errors.length > 0 ? false : true"
                    v-model="form.name"
                    placeholder="İş Yeri Adını Giriniz..."
                  ></b-form-input>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <b-form-group
                label="TC. Kimlik Numarası:"
                label-for="isim"
                label-cols-sm="2"
              >
                <b-form-input
                  id="isim"
                  v-model="form.tc"
                  placeholder="TC. Kimlik No Giriniz"
                ></b-form-input>
              </b-form-group>

              <b-form-group
                label="E-Posta Adresi"
                label-for="email"
                label-cols-sm="2"
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
                label-cols-sm="2"
              >
                <b-form-input
                  id="telefon"
                  v-model="form.telefon"
                  placeholder="Kullanıcı Telefon Numarası"
                ></b-form-input>
              </b-form-group>

              <div style="float: right">
                <b-button variant="success" type="submit" :disabled="invalid">
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
          @row-clicked="tikla"
          :filter-included-fields="filterOn"
          show-empty
          empty-text="Veri Bulunamadı."
          empty-filtered-text="Veri Bulunamadı."
        >
          <p style="text-align: center; width: 100%" show-empty>
            >
            <b> Sonuç Bulunamadı.</b>
          </p>

          <template #cell(actions)="data">
            <span>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="warning"
                @click="Duzenlemodal(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-warning
                title="Düzenle"
              >
                <feather-icon icon="EditIcon" />
              </b-button>
              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="danger"
                @click.prevent="sil(data.item)"
                class="btn-icon"
                v-b-tooltip.hover.v-danger
                title="Sil"
              >
                <feather-icon icon="TrashIcon" />
              </b-button>

              <b-button
                v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                variant="success"
                :to="{ name: 'calisan-goster', params: { id: data.item.id } }"
                class="btn-icon"
                v-b-tooltip.hover.v-success
                title="Göster"
              >
                <feather-icon icon="ImageIcon" />
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
import ripple from "vue-ripple-directive";
import { VBTooltip } from "bootstrap-vue";
import { required } from "@validations";

import { ValidationProvider, ValidationObserver } from "vee-validate";
export default {
  components: {
    VBTooltip,
    ToastificationContent,
    ripple,
    ValidationProvider,
    ValidationObserver,
    required,
  },
  directives: {
    "b-tooltip": VBTooltip,
    ripple,
  },
  data() {
    return {
      ...this.$store.state.global.table,
      fields: [
        { key: "name", label: "ÇALIŞAN İSMİ", sortable: true, filter: true },
        {
          key: "tc",
          label: "TC.Kimlik Numarası",
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
          key: "email",
          label: "E-Posta Adresi",
          sortable: true,
          filter: true,
        },

        { key: "actions", label: "Eylemler" },
      ],
      items: [],
      form: {
        name: null,
        tc: null,
        email: null,
        telefon: null,
        id: null,
        calisan_id: null,
      },
      status: true,
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
    this.form.id = user.user_id;
    this.veri();
  },
  mounted() {
    setTimeout(() => {
      this.totalRows = this.files.length;
    }, 500);
  },
  methods: {
    basarili() {
      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Firma İşlemleri `,
          icon: "BriefCaseIcon",
          variant: "success",
          text: ` İşlem Başarılı.`,
        },
      });
    },
    basarisiz() {
      this.$toast({
        component: ToastificationContent,
        position: "top-right",
        props: {
          title: `Firma İşlemleri `,
          icon: "BriefCaseIcon",
          variant: "danger",
          text: ` İşlem Başarısız.`,
        },
      });
    },
    veri() {
      this.$http
        .post("/api/calisanlar", { firma_id: this.form.id })
        .then((res) => (this.items = res.data));
    },
    ekle(data) {
      if (data) {
        this.$http
          .post("/api/calisanekle", this.form)
          .then((res) => this.basarili(), this.veri(), this.clear())
          .catch((error) => this.basarisiz);
      } else {
        this.$http
          .post("/api/calisanduzenle", this.form)
          .then((res) => {
            this.basarili(), this.veri(), this.clear();
          })
          .catch((error) => this.basarisiz);
      }
    },
    Duzenlemodal(row) {
      this.$refs["modal"].show();
      this.form = row;
    },

    tikla(params) {
      this.$router.push({
        name: "calisan-goster",
        params: { id: params.id },
      });
    },



    sil(data) {
      this.$http
        .post("/api/workersil", { id: data.id })
        .then((res) => {
          this.basarili(), this.veri(), this.clear();
        })
        .catch((error) => this.basarisiz());
    },

    clear() {
      this.$refs["modal"].hide();
      this.form = "";
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
    Filtered(filteredItems) {
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
  },
};
</script>
<style >
@media screen and (max-width: 374) {
  .iptal {
    margin-top: 10px !important;
  }
}
</style>
