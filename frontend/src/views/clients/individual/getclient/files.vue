<template>
  <b-card>
    <div style="padding-bottom: 30px">
      <b-form-file
        v-model="file"
        @change="yukle"
        :state="Boolean(file)"
        placeholder="Dosya seçiniz veya sürükleyiniz..."
        drop-placeholder="Buraya Bırak..."
      />
    </div>
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
      :fixed-header="true"
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
        <b> Dosya Bulunamadı.</b>
      </p>
      <!-- Araç Ekleme  -->

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
            <b-button variant="success" @click.prevent="indir(props.row.dosya)">
              İndir
            </b-button>
            <b-button   variant="warning"  @click.prevent="sil(props.row.dosya)" > Sil </b-button>
            <b-button variant="danger" @click.prevent="göster(props.row.dosya)">
              Göster
            </b-button>
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
  </b-card>
</template>

<script>
import BCardCode from "@core/components/b-card-code/BCardCode.vue";
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
  BCard,
  BFormFile,
  BButton,
} from "bootstrap-vue";
import { VueGoodTable } from "vue-good-table";
import store from "@/store/index";
import { codeColumnSearch } from "./code";
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
    BForm,
    BCard,
    BFormFile,
    BButton,
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
          label: "Dosya İsmi",
          field: "dosya",
          filterOptions: {
            enabled: true,
            placeholder: "Araç Ara",
          },
        },
        {
          label: "Tarih",
          field: "created_at",
          filterOptions: {
            enabled: true,
            placeholder: "Search Email",
          },
        },

        {
          label: "Eylemler",
          field: "action",
        },
      ],

      rows: [],
      id: this.userData.id,
      isim: this.userData.name,
      file: null,

      searchTerm: "",
    };
  },
  created() {
    axios
      .post("/api/getfile", { calisan_id: this.userData.id })
      .then((response) => {
        this.rows = response.data;
      });
  },

  methods: {
    refreshStop() {
      setTimeout(() => {
        axios
          .post("/api/getfile", { calisan_id: this.userData.id })
          .then((response) => {
            this.rows = response.data;
          })
          .then(
            this.$toast({
              component: ToastificationContent,
              position: "top-right",
              props: {
                title: `Dosya İşlemleri `,
                icon: "BriefcaseIcon",
                variant: "success",
                text: ` İşlem Başarılı.`,
              },
            })
          );
        this.$refs[cardName].showLoading = false;
      }, 2000);
    },
    yukle(event) {
      this.file = event.target.files[0];
      const formData = new FormData();
      formData.set("file", this.file);
      formData.append("id", this.id);
      formData.append("name", this.isim);
      formData.append("firma_id", this.userData.id);


      axios
        .post("/api/belgeyukle", formData)
        .then((res) => this.refreshStop())
        .catch((error) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: "Dosya İşlemleri",
              icon: "FileIcon",
              variant: "danger",
              text: " İşlem Başarısız.",
            },
          });
        });
    },

    göster(dosya) {
     window.open('/Dosyalar/' + dosya, '_blank' )
    },

    sil(dosya){

        axios.post('/api/dosyasil', {dosya: dosya}).then((res)=> this.refreshStop()).catch()

    },




    indir(dosya) {
      axios
        .post(
          "/api/indir",
          { id: this.id, dosya: dosya },
          { responseType: "blob" }
        )
        .then((response) => {
          var data = response.data;
          const url = window.URL.createObjectURL(new Blob([data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", dosya);
          document.body.appendChild(link);
          link.click();
        });
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
