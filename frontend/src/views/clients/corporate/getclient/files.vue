<template>
  <b-card>
    <div>
      <!-- types -->
      <app-collapse accordion :type="collapseType">
        <app-collapse-item v-for="tur in tur" :key="tur.id" :title="tur.name">
        </app-collapse-item>
      </app-collapse>
    </div>
  </b-card>
</template>

<script>
import AppCollapse from "@core/components/app-collapse/AppCollapse.vue";
import AppCollapseItem from "@core/components/app-collapse/AppCollapseItem.vue";
import { BCard, BFormRadioGroup, BFormRadio, BFormGroup } from "bootstrap-vue";
import axios from '@axios'

export default {
  components: {
    AppCollapse,
    AppCollapseItem,

    BFormRadioGroup,
    BFormRadio,
    BFormGroup,

    BCard,
  },
  data: () => ({
    collapseType: "default",
    tur: null,
  }),
  created() {
    axios.post("/api/dosyatur").then((res) => (this.tur = res.data));
  },

  methods: {},
};
</script>
