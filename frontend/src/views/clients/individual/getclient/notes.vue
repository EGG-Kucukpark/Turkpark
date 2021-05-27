
<template>
  <b-card title="Firma Notu">
    <b-form-textarea
      id="textarea-rows"
      v-model="not"
      placeholder="Not giriniz"
      rows="2"
      style="background: #fffcdc"
    />

    <b-list-group style="padding-top: 30px" title="Notlar">
      <b-list-group-item>{{ not }}</b-list-group-item>
    </b-list-group>
  </b-card>
</template>

<script>
import {
  BFormTextarea,
  BCard,
  BListGroup,
  BListGroupItem,
} from "bootstrap-vue";

export default {
  components: {
    BFormTextarea,
    BCard,
    BListGroup,
    BListGroupItem,
  },

  data() {
    return {
      not: "",
    };
  },
};
</script>
