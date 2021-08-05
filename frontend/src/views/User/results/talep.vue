<template>
  <div>
    <b-button v-on:click="$refs.modal.show()" variant="success"
      ><b>Hizmet Talep Et</b></b-button
    >
    <b-modal
      hide-header-close
      ok-title="Kaydet"
      :hide-footer="true"
      size="lg"
      centered
      ref="modal"
    >
      <b-form-group label-cols-sm="2" label="Kişi Sayısı" label-for="talep">
        <b-form-input
          id="talep"
          v-model="talep"
          type="number"
          class="mb-1"
        ></b-form-input>
      </b-form-group>

      <b-form-group label-cols-sm="2" label="Test Türü" label-for="talep">
        <b-form-checkbox
          v-model="checked"
          v-for="item in tests"
          :key="item"
          :value="item"
          class="custom-control-success"
        >
          {{ item.title }}
        </b-form-checkbox>
      </b-form-group>
      <b-form-group label-cols-sm="2" label="Test Türü" label-for="talep">
        <b-form-radio
          v-model="radio"
          v-for="item in labs"
          :key="item"
          :value="item"
          class="custom-control-success"
        >
          {{ item }}
        </b-form-radio>
      </b-form-group>

      <b-form-group
        v-show="radio === 'Mobil Araç'"
        label-cols-sm="2"
        label="Adreslerim"
        label-for="talep"
      >
        <b-form-radio
          v-model="radio"
          v-for="item in adresler"
          :key="item"
          :value="item"
          class="custom-control-success"
        >
          {{ item.title }} / {{ item.text }}
        </b-form-radio>
      </b-form-group>

      <b-form-group
        v-show="radio != 'Mobil Araç'"
        label-cols-sm="2"
        label="Laboratuvarlar"
        label-for="talep"
      >
        <b-form-radio
          v-model="radio"
          v-for="item in yerler"
          :key="item"
          :value="item"
          class="custom-control-success"
        >
          {{ item }}
        </b-form-radio>
      </b-form-group>

      <b-form-group label-cols-sm="2" label="Mesaj">
        <b-form-textarea
          id="mesaj"
          v-model="mesaj"
          class="mb-2"
        ></b-form-textarea>
      </b-form-group>
    </b-modal>
  </div>
</template>
<script>
export default {
  props: ["data"],
  data() {
    return {
      talep: "",
      mesaj: "",
      tests: [
        { title: "Kan Sayımı", money: 30 },
        { title: "Korona Testi", money: 30 },
      ],
      yerler: ["Bayraklı", "Bornova"],
      labs: ["Mobil Araç", "Laboratuvar"],
      checked: [],
      adresler: null,
      radio: "Mobil Araç",
    };
  },

  created() {
    this.$http("/api/firmagoster/" + this.data.user_id).then((res) => {
      this.adresler = JSON.parse(res.data.adres);
    });
  },

  methods: {},
};
</script>
