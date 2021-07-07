<template>
  <b-card>
    <b-form-select @change="gelsin" v-model="Selected">
      <option v-for="tur in tur" :key="tur.id">{{ tur.name }}</option>
    </b-form-select>
    <dosyalar :userData="userData" :giden="Selected"  />

    <portal to="gelsin">
    <p v-if="send"     :data="Selected"  > </p>
    </portal>
  </b-card>
</template>

<script>
import AppCollapse from "@core/components/app-collapse/AppCollapse.vue";
import AppCollapseItem from "@core/components/app-collapse/AppCollapseItem.vue";
import dosyalar from "./files/results.vue";
import {
  BCard,
  BFormRadioGroup,
  BFormRadio,
  BFormGroup,
  BFormSelect,
  BTable,
} from "bootstrap-vue";
import axios from "@axios";

export default {
  components: {
    BTable,
    AppCollapse,
    AppCollapseItem,
    BFormRadioGroup,
    BFormRadio,
    dosyalar,
    BFormGroup,
    BFormSelect,

    BCard,
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      Selected: null,
      tur: null,
      send: false,
      giden: null,
    };
  },
  created() {
    axios.post("/api/dosyatur").then((res) => (this.tur = res.data));
  },

  methods: {
    gelsin() {
      this.send = true;
      this.giden = this.Selected;
      axios
        .post("/api/dbgetir", { name: this.Selected, id: this.userData.id })
        .then((res) => (this.items = res.data));
    },
  },
};
</script>
