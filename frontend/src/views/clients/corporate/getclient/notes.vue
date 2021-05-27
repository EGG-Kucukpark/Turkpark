
<template>
  <b-card title="Firma Notu">
    <b-form-textarea
      id="textarea-rows"
      v-model="not"
      placeholder="Not giriniz"
      rows="2"
      style="background: #fffcdc"
      @keydown.native="ekle"
    />

    <b-list-group style="padding-top: 30px" title="Notlar">
      <b-list-group-item v-for="notlar in notlar" :key="notlar.id">
        {{ notlar.not }}

        <span>
          <span style="float: right; margin: 20px">
            <b-button variant="warning" @click.prevent="düzenle(notlar)">
              Düzenle
            </b-button>
            <b-button variant="danger" @click.prevent="sil(notlar)">
              Sil
            </b-button>
          </span>
        </span>
      </b-list-group-item>
    </b-list-group>

    <b-modal
      id="modal-warning"
      :hide-footer="true"
      ref="modal"
      ok-variant="warning"
      modal-class="modal-warning"
      centered
      title="Not Düzenle"
    >
      <b-form @submit.prevent="edit">
        <b-form-textarea
          id="textarea-rows"
          v-model="not"
          placeholder="Not giriniz"
          rows="2"
          style="background: #fffcdc"
        />

        <div style="padding-top: 20px; float: right">
          <b-button variant="warning" type="submit"> Düzenle </b-button>
        </div>
        <div style="padding-top: 20px; float: right; padding-right: 10px">
          <b-button variant="danger" @click="form()"> İptal</b-button>
        </div>
      </b-form>
    </b-modal>
  </b-card>
</template>

<script>
import {
  BFormTextarea,
  BCard,
  BListGroup,
  BListGroupItem,
  BButton,
  BForm,
} from "bootstrap-vue";
import axios from "@axios";

export default {
  components: {
    BFormTextarea,
    BCard,
    BListGroup,
    BListGroupItem,
    BButton,
    BForm,
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      not: null,
      notlar: [],
      id: this.userData.id,
      notid: null,
    };
  },

  created() {
    axios
      .post("/api/firmanot", { id: this.userData.id })
      .then((response) => (this.notlar = response.data));
  },

  methods: {
    data() {
      axios
        .post("/api/firmanot", { id: this.userData.id })
        .then((res) => (this.notlar = res.data));
    },
    ekle(event) {
      if (event.which === 13) {
        axios
          .post("/api/firmanotekle", { id: this.userData.id, not: this.not })
          .then((response) => (this.notlar = response.data))
          .then(this.data(), (this.not = null));
      }
    },

    düzenle(row) {
      this.$refs["modal"].show();
      this.not = row.not;
      this.notid = row.id;
    },
    edit() {
      axios
        .post("/api/firmanotduzenle", { id: this.notid, not: this.not })
        .then(this.data(), (this.not = null), this.$refs["modal"].hide());
    },

    form() {
      this.$refs["modal"].hide();
      this.not = null;
    },

    sil(row) {
      axios
        .post("/api/firmanotsil", { id: row.id })
        .then((res) => (this.notlar = res.data))
        .then(this.data());
    },
  },
};
</script>
