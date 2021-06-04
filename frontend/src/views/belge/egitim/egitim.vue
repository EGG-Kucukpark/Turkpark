<template>
  <b-card title="Eğitimler">
    <b-card no-body>
      <b-card-header class="pb-50">
        <h5>Filtreler</h5>
      </b-card-header>
      <b-card-body>
        <b-row>
          <b-col cols="12" md="4" class="mb-md-0 mb-2">
            <label>Role</label>
            <v-select />
          </b-col>
          <b-col cols="12" md="4" class="mb-md-0 mb-2">
            <label>Plan</label>
            <v-select />
          </b-col>
          <b-col cols="12" md="4" class="mb-md-0 mb-2">
            <label>Tarih</label>
            <b-form-datepicker
              id="datepicker-valid"
              ref="datepick"
              v-model="sortdate"
            />
          </b-col>
        </b-row>
      </b-card-body>
    </b-card>

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
        >Yeni Etkinlik</b-button
      >
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
                label="Tarih:"
                label-for="Tarih"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-datepicker
                  placeholder="Etkinlik Tarihi"
                  v-model="date"
                />
              </b-form-group>

              <b-form-group
                label="Etkinlik Saati:"
                label-for="Etkinlik Saati"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-timepicker
                  placeholder="Etkinlik Saati"
                  v-model="time"
                />
              </b-form-group>

              <b-form-group
                label="Kategori:"
                label-for="kategori"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select v-model="kategori">
                  <option disabled value="">Lütfen Seçim Yapınız</option>
                  <option>İlk Yardım Eğitimi</option>
                  <option>Yangın Eğitimi</option>
                </b-form-select>
              </b-form-group>

              <b-form-group
                label="Etkinlik Yeri:"
                label-for="yer"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select v-model="etkinlik">
                  <option disabled value="">Lütfen Seçim Yapınız</option>
                  <option>İzmir-Bornova</option>
                  <option>İzmir-Bayraklı</option>
                </b-form-select>
              </b-form-group>
              <b-form-group
                label="Kontenjan:"
                label-for="Kontenjan"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="Kontenjan"
                  v-model="kontenjan"
                  placeholder="Kişi Sayısını Giriniz"
                  type="number"
                ></b-form-input>
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

        <!--  Yeni Ekle -->
        <b-modal
          hide-header-close
          ok-title="Kaydet"
          :hide-footer="true"
          size="lg"
          ref="modal1"
          centered
          title="Araç Ekle"
        >
          <b-card>
            <b-form @submit.prevent="submit">
              <b-form-group
                label="Tarih:"
                label-for="Tarih"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-datepicker
                  placeholder="Etkinlik Tarihi"
                  v-model="date"
                />
              </b-form-group>

              <b-form-group
                label="Etkinlik Saati:"
                label-for="Etkinlik Saati"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-timepicker
                  placeholder="Etkinlik Saati"
                  v-model="time"
                />
              </b-form-group>

              <b-form-group
                label="Kategori:"
                label-for="kategori"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select v-model="kategori">
                  <option disabled value="">Lütfen Seçim Yapınız</option>
                  <option>İlk Yardım Eğitimi</option>
                  <option>Yangın Eğitimi</option>
                </b-form-select>
              </b-form-group>

              <b-form-group
                label="Etkinlik Yeri:"
                label-for="yer"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select v-model="etkinlik">
                  <option disabled value="">Lütfen Seçim Yapınız</option>
                  <option>İzmir-Bornova</option>
                  <option>İzmir-Bayraklı</option>
                </b-form-select>
              </b-form-group>
              <b-form-group
                label="Kontenjan:"
                label-for="Kontenjan"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="Kontenjan"
                  v-model="kontenjan"
                  placeholder="Kişi Sayısını Giriniz"
                  type="number"
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
          <p style="text-align: center; width: 100%" show-empty>
            >
            <b> Kullanıcı Bulunamadı.</b>
          </p>

          <template #cell(actions)="data">
            <span>
              <b-button variant="gradient-warning" @click="Modal2(data.item)">
                Düzenle
              </b-button>

              <b-button variant="gradient-success" @click="egitim(data.item)">
                Eğitimi Görüntüle
              </b-button>

              <b-button variant="gradient-danger" disabled>
                Sil
              </b-button></span
            >
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
        { key: "kota", label: "Kontenjan", sortable: true, filter: true },
        { key: "category", label: "Kategori", sortable: true, filter: true },
        { key: "time", label: "Tarih", sortable: true, filter: true },
        { key: "location", label: "Eğitim Yeri", sortable: true, filter: true },

        { key: "actions", label: "Eylemler" },
      ],
      items: null,

      excel: null,

      date: null,
      time: null,
      kategori: null,
      etkinlik: null,
      kontenjan: null,
      sortdate: null,
      id: null,
    };
  },

  created() {
    axios
      .post("/api/egitimgetir")
      .then((response) => (this.items = response.data));
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
          .post("/api/egitimgetir")
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
      let tarih = this.date;

      let zaman = " " + this.time;

      let etktime = tarih.concat(zaman);
      console.log(etktime);
      axios
        .post("api/egitimekle", {
          date: etktime,
          kategori: this.kategori,
          kontenjan: this.kontenjan,
          etkinlik: this.etkinlik,
        })
        .then((res) => this.ok())
        .catch((error) => {
          this.error();
        })
        .then(this.form());
    },

    egitim(params) {
      this.$router.push({
        name: "egitim-goster",
        params: { id: params.id },
      });
    },

    update() {
      let tarih = this.date;

      let zaman = " " + this.time;

      let etktime = tarih.concat(zaman);

      console.log(etktime)

      axios
        .post("/api/egitimduzenle", {
          id: this.id,
          date: etktime,
          kategori: this.kategori,
          kontenjan: this.kontenjan,
          etkinlik: this.etkinlik,
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

      let clock = row.time;
      var clock2 = clock.slice(11);


        (this.id = row.id),
        (this.date = row.time),
        (this.time = clock2),
        (this.kategori = row.category),
        (this.kontenjan = row.kota),
        (this.etkinlik = row.location);
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
