<template>
  <b-card title="Adreslerim">
    <b-form-row align-v="center">
      <b-col sm="12">
        <b-form-group
          v-for="item in adresler"
          :key="item.id"
          :label="item.title"
          label-for="mc-last-name"
        >
          <b-form-input
            class="mb-1"
            placeholder="Adres Başlığı"
            id="mc-last-name"
            v-model="item.title"
          />
          <b-form-textarea
            v-model="item.text"
            placeholder="Adres Açıklaması"
            id="mc-last-name"
          />
        </b-form-group>
      </b-col>

      <b-col sm="12" align-v="center">
        <b-button
          variant="flat-success"
          class="btn-icon ml-10 col-sm-12 mb-2"
          @click="ekle"
        >
          <feather-icon icon="PlusIcon" />
        </b-button>
      </b-col>

      <b-col sm="12">
        <b-button @click="kaydet" type="submit" variant="primary" class="mr-1">
          Güncelle
        </b-button>
        <b-button variant="outline-secondary" @click="reset">
          Sıfırla
        </b-button>
      </b-col>
    </b-form-row>
  </b-card>
</template>
<script>
export default {
  props: ["options"],
  data() {
    return {
      adresler: [{ title: "", text: "" }],
    };
  },
  created() {
    this.reset();
  },

  methods: {
    reset() {
      this.$http("/api/firmagoster/" + this.options.user_id).then((res) => {
        if (res.data.adres) {
          this.adresler = JSON.parse(res.data.adres);
        }
      });
    },

    kaydet() {
      this.$http.post("/api/updateadres", {
        id: this.options.user_id,
        adres: this.adresler,
      });
    },

    ekle() {
      if (this.adresler.length > 1) {
        alert("Sadece 2 adres ekleyebilirsiniz");
      } else {
        this.adresler.push({ title: "", text: "" });
        console.log(this.adresler);
      }
    },
  },
};
</script>
