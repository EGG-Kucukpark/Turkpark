<template>
  <b-card img-alt="Card image cap" img-top no-body>
    <b-modal :hide-footer="true" ref="modal" title="Eğitim Türü" centered>
      <b-form @submit.prevent="Ekle">
        <b-form-group
          label="Eğitim Türü:"
          label-for="Kontenjan"
          label-cols-sm="3"
          label-align-sm="right"
        >
          <b-form-input
            id="Kontenjan"
            v-model="name"
            placeholder="Eğitim Adını Giriniz"
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
      <b-card-title>Eğitim Türleri</b-card-title>

         <b-button

          class="mb-1"
           style="margin-bottom: 10px;"
          variant="success"
           v-on:click="$refs['modal'].show()"
          >  <feather-icon size="20px;" icon="PlusIcon" /></b-button
        >

      <b-list-group style="float: left; width: 100%">
        <b-list-group-item v-for="Eğitim in Eğitim" :key="Eğitim.id">
          {{ Eğitim.name }}

          <b-button
            style="float: right"
            v-ripple.400="'rgba(234, 84, 85, 0.15)'"
            variant="outline-danger"
            @click.prevent="Sil(Eğitim)"
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
      Eğitim: null,
      name: null,
    };
  },

  created() {
    axios.post("api/Eğitimlar").then((res) => (this.Eğitim = res.data));
  },
  methods: {
    data() {
      axios.post("api/Eğitimlar").then((res) => (this.Eğitim = res.data));
    },

    Ekle() {
      axios.post("api/Eğitimekle", { name: this.name }).then(this.data());
      this.name = null;
    },

    Sil(data) {
      this.$refs["modal"].hide();
      axios.post("api/Eğitimsil", { id: data.id }).then(this.data());
    },
  },
};
</script>

<style>
</style>
