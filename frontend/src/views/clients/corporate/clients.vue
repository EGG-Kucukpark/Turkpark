<template>
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
          >Yeni Firma</b-button
        >

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
              <b-form-group
                label="Firma Şifresi:"
                label-for="password"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-input
                  id="password"
                  v-model="password"
                  placeholder="Şifre Giriniz"
                ></b-form-input>
              </b-form-group>

              <b-form-group
                label="İl Seçiniz: "
                label-for="nested-city"
                label-cols-sm="3"
                label-align-sm="right"
              >
                <b-form-select aria-placeholder="İl Seçiniz" v-model="il">
                  <option disabled value="">Lütfen Seçim Yapınız</option>
                  <option>------</option>
                  <option>Adana</option>
                  <option>Adıyaman</option>
                  <option>Afyonkarahisar</option>
                  <option>Ağrı</option>
                  <option>Amasya</option>
                  <option>Ankara</option>
                  <option>Antalya</option>
                  <option>Artvin</option>
                  <option>Aydın</option>
                  <option>Balıkesir</option>
                  <option>Bilecik</option>
                  <option>Bingöl</option>
                  <option>Bitlis</option>
                  <option>Bolu</option>
                  <option>Burdur</option>
                  <option>Bursa</option>
                  <option>Çanakkale</option>
                  <option>Çankırı</option>
                  <option>Çorum</option>
                  <option>Denizli</option>
                  <option>Diyarbakır</option>
                  <option>Edirne</option>
                  <option>Elazığ</option>
                  <option>Erzincan</option>
                  <option>Erzurum</option>
                  <option>Eskişehir</option>
                  <option>Gaziantep</option>
                  <option>Giresun</option>
                  <option>Gümüşhane</option>
                  <option>Hakkâri</option>
                  <option>Hatay</option>
                  <option>Isparta</option>
                  <option>Mersin</option>
                  <option>İstanbul</option>
                  <option>İzmir</option>
                  <option>Kars</option>
                  <option>Kastamonu</option>
                  <option>Kayseri</option>
                  <option>Kırklareli</option>
                  <option>Kırşehir</option>
                  <option>Kocaeli</option>
                  <option>Konya</option>
                  <option>Kütahya</option>
                  <option>Malatya</option>
                  <option>Manisa</option>
                  <option>Kahramanmaraş</option>
                  <option>Mardin</option>
                  <option>Muğla</option>
                  <option>Muş</option>
                  <option>Nevşehir</option>
                  <option>Niğde</option>
                  <option>Ordu</option>
                  <option>Rize</option>
                  <option>Sakarya</option>
                  <option>Samsun</option>
                  <option>Siirt</option>
                  <option>Sinop</option>
                  <option>Sivas</option>
                  <option>Tekirdağ</option>
                  <option>Tokat</option>
                  <option>Trabzon</option>
                  <option>Tunceli</option>
                  <option>Şanlıurfa</option>
                  <option>Uşak</option>
                  <option>Van</option>
                  <option>Yozgat</option>
                  <option>Zonguldak</option>
                  <option>Aksaray</option>
                  <option>Bayburt</option>
                  <option>Karaman</option>
                  <option>Kırıkkale</option>
                  <option>Batman</option>
                  <option>Şırnak</option>
                  <option>Bartın</option>
                  <option>Ardahan</option>
                  <option>Iğdır</option>
                  <option>Yalova</option>
                  <option>Karabük</option>
                  <option>Kilis</option>
                  <option>Osmaniye</option>
                  <option>Düzce</option>
                </b-form-select>
              </b-form-group>



              <div style="float: right">
                <b-button variant="success" type="submit">
                  Tamam
                </b-button>
              </div>
              <div style="float: right; padding-right: 10px">
                <b-button variant="danger" @click="form()"> İptal</b-button>
              </div>
            </b-form>

            <!-- Emulate built in modal footer ok and cancel button actions -->
          </b-card>
        </b-modal>
      </span>

      <b-col cols="12">
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
          @filtered="onFiltered"
        >
          <template #cell(actions)="data">
            <span>
              <b-button variant="gradient-warning" @click="Modal2(data.item)">
                Düzenle
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

                    <b-form-group
                      label="İl Seçiniz: "
                      label-for="nested-city"
                      label-cols-sm="3"
                      label-align-sm="right"
                    >
                      <b-form-select aria-placeholder="İl Seçiniz" v-model="il">
                        <option disabled value="">Lütfen Seçim Yapınız</option>
                        <option>------</option>
                        <option>Adana</option>
                        <option>Adıyaman</option>
                        <option>Afyonkarahisar</option>
                        <option>Ağrı</option>
                        <option>Amasya</option>
                        <option>Ankara</option>
                        <option>Antalya</option>
                        <option>Artvin</option>
                        <option>Aydın</option>
                        <option>Balıkesir</option>
                        <option>Bilecik</option>
                        <option>Bingöl</option>
                        <option>Bitlis</option>
                        <option>Bolu</option>
                        <option>Burdur</option>
                        <option>Bursa</option>
                        <option>Çanakkale</option>
                        <option>Çankırı</option>
                        <option>Çorum</option>
                        <option>Denizli</option>
                        <option>Diyarbakır</option>
                        <option>Edirne</option>
                        <option>Elazığ</option>
                        <option>Erzincan</option>
                        <option>Erzurum</option>
                        <option>Eskişehir</option>
                        <option>Gaziantep</option>
                        <option>Giresun</option>
                        <option>Gümüşhane</option>
                        <option>Hakkâri</option>
                        <option>Hatay</option>
                        <option>Isparta</option>
                        <option>Mersin</option>
                        <option>İstanbul</option>
                        <option>İzmir</option>
                        <option>Kars</option>
                        <option>Kastamonu</option>
                        <option>Kayseri</option>
                        <option>Kırklareli</option>
                        <option>Kırşehir</option>
                        <option>Kocaeli</option>
                        <option>Konya</option>
                        <option>Kütahya</option>
                        <option>Malatya</option>
                        <option>Manisa</option>
                        <option>Kahramanmaraş</option>
                        <option>Mardin</option>
                        <option>Muğla</option>
                        <option>Muş</option>
                        <option>Nevşehir</option>
                        <option>Niğde</option>
                        <option>Ordu</option>
                        <option>Rize</option>
                        <option>Sakarya</option>
                        <option>Samsun</option>
                        <option>Siirt</option>
                        <option>Sinop</option>
                        <option>Sivas</option>
                        <option>Tekirdağ</option>
                        <option>Tokat</option>
                        <option>Trabzon</option>
                        <option>Tunceli</option>
                        <option>Şanlıurfa</option>
                        <option>Uşak</option>
                        <option>Van</option>
                        <option>Yozgat</option>
                        <option>Zonguldak</option>
                        <option>Aksaray</option>
                        <option>Bayburt</option>
                        <option>Karaman</option>
                        <option>Kırıkkale</option>
                        <option>Batman</option>
                        <option>Şırnak</option>
                        <option>Bartın</option>
                        <option>Ardahan</option>
                        <option>Iğdır</option>
                        <option>Yalova</option>
                        <option>Karabük</option>
                        <option>Kilis</option>
                        <option>Osmaniye</option>
                        <option>Düzce</option>
                      </b-form-select>
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
        { key: "name", label: "İsim", sortable: true, filter: true },
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
          key: "il",
          label: "İl",
          sortable: true,
        },

        { key: "actions", label: "Eylemler" },
      ],
      items: [],
      name: "",
      sgkno: "",
      vergino: "",
      vergiad: "",
      il: "",

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
    axios.post("/api/firmalar").then((response) => {
      this.items = response.data;
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
          il: this.il,
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
        }).then(this.form())
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
        (this.il = row.il),
        (this.telefon = row.telefon);
    },

    update() {
      axios
        .post("/api/firmaduzenle", {
          id:this.id,
          name: this.name,
          email: this.email,
          telefon: this.telefon,
          vergino: this.vergino,
          vergiad: this.vergiad,
          il: this.il,
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
        (this.il = ""),
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
