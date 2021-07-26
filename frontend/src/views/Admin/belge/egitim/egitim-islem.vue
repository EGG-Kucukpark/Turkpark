<template>
  <b-row>
    <b-modal :hide-footer="true" ref="modal1" title="Kategori Ekle" centered>
      <b-form @submit.prevent="add">
        <b-form-group
          label="Kategori Ekle:"
          label-for="Kontenjan"
          label-cols-sm="3"
          label-align-sm="right"
        >
          <b-form-input
            id="Kontenjan"
            v-model="name"
            placeholder="Kategori Adını Giriniz"
          >
          </b-form-input>
        </b-form-group>

        <b-button
          style="margin-top: 10px; float: right"
          variant="relief-success"
          type="submit"
        >
          Tamam
        </b-button>
      </b-form>
    </b-modal>
    <b-modal :hide-footer="true" ref="modal2" title="Kategori Ekle" centered>
      <b-form @submit.prevent="add2">
        <b-form-group
          label="Kategori Ekle:"
          label-for="Kontenjan"
          label-cols-sm="3"
          label-align-sm="right"
        >
          <b-form-input
            id="Kontenjan"
            v-model="yer"
            placeholder="Yer Adını Giriniz"
          >
          </b-form-input>
        </b-form-group>

        <b-button
          style="margin-top: 10px; float: right"
          variant="relief-success"
          type="submit"
        >
          Tamam
        </b-button>
      </b-form>
    </b-modal>

    <b-col cols="12">
      <b-card-group deck class="mb-0">
        <!-- card 1 -->
        <b-card img-alt="Card image cap" img-top no-body>
          <b-card-body>
            <b-card-title>Kategoriler</b-card-title>
            <b-button
              style="margin-bottom: 10px; float: right"
              variant="relief-success"
              @click.prevent="modal"
            >
              Kategori Ekle
            </b-button>

            <b-list-group style="float: left; width: 100%">
              <b-list-group-item v-for="egitim in egitim" :key="egitim.id">
                {{ egitim.name }}

                <b-button
                  style="float: right"
                  v-ripple.400="'rgba(234, 84, 85, 0.15)'"
                  variant="outline-danger"
                  @click.prevent="del(egitim)"
                >
                  Sil
                </b-button>
              </b-list-group-item>
            </b-list-group>
          </b-card-body>
        </b-card>

        <b-card img-alt="Card image cap" img-top no-body>
          <b-card-body>
            <b-card-title>Eğitim Yerleri</b-card-title>
            <b-button
              style="margin-bottom: 10px; float: right"
              variant="relief-success"
              @click.prevent="modal2"
            >
              Yer Ekle
            </b-button>

            <b-list-group style="float: left; width: 100%">
              <b-list-group-item v-for="yerler in yerler" :key="yerler.id">
                {{ yerler.name }}

                <b-button
                  style="float: right"
                  v-ripple.400="'rgba(234, 84, 85, 0.15)'"
                  variant="outline-danger"
                  @click.prevent="del2(yerler)"
                >
                  Sil
                </b-button>
              </b-list-group-item>
            </b-list-group>
          </b-card-body>
        </b-card>
      </b-card-group>
    </b-col>
  </b-row>
</template>


<script>
import {
  BListGroup,
  BListGroupItem,
  BCard,
  BCardHeader,
  BCol,
  BRow,
  BCardGroup,
  BCardBody,
  BCardTitle,
  BButton,
  BModal,
  BForm,
  BFormInput,
  BFormGroup,
} from "bootstrap-vue";
import axios from "@axios";
import Ripple from "vue-ripple-directive";
export default {
  components: {
    BListGroup,
    BListGroupItem,
    BCard,
    BButton,
    BCol,
    BRow,
    BCardGroup,
    BModal,
    BForm,
    BFormInput,
    BFormGroup,
    BCardHeader,
    BCardBody,
    BCardTitle,
  },
  directives: {
    Ripple,
  },
  created() {
    axios.post("/api/kategorigetir").then((res) => (this.egitim = res.data));
    axios.post("/api/yergetir").then((res) => (this.yerler = res.data));
  },
  data() {
    return {
      egitim: null,
      name: null,
      yerler: null,
      yer: null,
    };
  },

  methods: {
    modal() {
      this.$refs["modal1"].show();
    },
    refresh() {
      axios.post("/api/kategorigetir").then((res) => (this.egitim = res.data));
    },

    add() {
      this.$refs["modal1"].hide();
      axios.post("/api/kategoriekle", { name: this.name }).then(this.refresh());
    },
    del(data) {
      axios.post("/api/kategorisil", { id: data.id }).then(this.refresh());
    },

    modal2() {
      this.$refs["modal2"].show();
    },
    refresh2() {
      axios.post("/api/yergetir").then((res) => (this.yerler = res.data));
    },

    add2() {
      this.$refs["modal2"].hide();
      axios.post("/api/yerekle", { name: this.yer }).then(this.refresh2());
    },
    del2(data) {
      axios.post("/api/yersil", { id: data.id }).then(this.refresh2());
    },
  },
};
</script>
