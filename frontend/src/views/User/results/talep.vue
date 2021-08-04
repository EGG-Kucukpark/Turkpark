<template>
  <div>
    <b-button v-on:click="$refs.modal.show()" variant="success"
      ><b>Hizmet talep et</b></b-button
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
          {{ item }}
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
  props: {
    modal: Function,
  },
  data() {
    return {
      talep: "",
      mesaj: "",
      tests: ["Kan Sayımı", "Korona Testi"],
      labs: ["Mobil Araç", "Laboratuvar"],

      checked: [],

      radio: "Mobil Araç",
    };
  },

  methods: {},
};
</script>
