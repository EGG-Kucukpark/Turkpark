<template>
  <b-card img-alt="Card image cap" img-top no-body>
    <b-modal :hide-footer="true" ref="modal" title="Dosya Türü Ekle" centered>
      <b-form @submit.prevent="Ekle">
        <b-form-group
          label="Dosya Türü:"
          label-for="Kontenjan"
          label-cols-sm="3"
          label-align-sm="right"
        >
          <b-form-input
            id="Kontenjan"
            v-model="name"
            placeholder="Rapor Adını Giriniz"
          >
          </b-form-input>
        </b-form-group>

        <b-button
          style="margin-top: 10px; float: right"
          variant="relief-success"
          type="submit"
          v-on:click="$refs['modal'].hide()"
        >
          Tamam
        </b-button>
      </b-form>
    </b-modal>

    <b-card-body>
      <b-card-title>Dosya Türleri</b-card-title>

      <b-button
        class="mb-1"
        style="margin-bottom: 10px"
        variant="success"
        v-on:click="$refs['modal'].show()"
      >
        <feather-icon size="20px;" icon="PlusIcon"
      /></b-button>

      <b-list-group style="float: left; width: 100%">
        <b-list-group-item v-for="dosya in dosya" :key="dosya.id">
          {{ dosya.name }}

          <b-button
            style="float: right"
            v-ripple.400="'rgba(234, 84, 85, 0.15)'"
            variant="outline-danger"
            @click.prevent="Sil(dosya)"
          >
            Sil
          </b-button>
        </b-list-group-item>
      </b-list-group>
    </b-card-body>
  </b-card>
</template>

<script>
import axios from "@axios";
import ripple from "vue-ripple-directive";
import {
  BListGroup,
  BListGroupItem,
  BCard,
  BButton,
  BModal,
  BForm,
  BFormInput,
  BFormGroup,
  BCardHeader,
  BCardBody,
  BCardTitle,
} from "bootstrap-vue";
export default {
  components: {
    BListGroup,
    BListGroupItem,
    BCard,
    BButton,
    BModal,
    BForm,
    BFormInput,
    BFormGroup,
    BCardHeader,
    BCardBody,
    BCardTitle,
  },
  data() {
    return {
      dosya: null,
      name: null,
    };
  },

  created() {
    this.veri();
  },
  methods: {
    veri() {
      axios.post("api/dosyatur").then((res) => (this.dosya = res.data));
    },

    Ekle() {
      axios.post("api/dosyaturekle", { name: this.name }).then(this.veri());
      this.name = null;
    },

    Sil(data) {
      this.$refs["modal"].hide();
      axios.post("api/dosyatursil", { data: data }).then(this.veri());
    },
  },
};
</script>

<style>
</style>
