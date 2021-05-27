<template>
  <b-card>
    <div>
      <!-- types -->
      <app-collapse accordion :type="collapseType">
        <app-collapse-item href="#dene" title="Sonuçlar">

            <sonuclar/>
        </app-collapse-item>

        <app-collapse-item ref="ahmet" title="Risk Raporları">

        </app-collapse-item>

        <app-collapse-item title="Accordion Item 3">

        </app-collapse-item>

        <app-collapse-item title="Accordion Item 4">
          .
        </app-collapse-item>
      </app-collapse>
    </div>
  </b-card>
</template>

<script>
import AppCollapse from "@core/components/app-collapse/AppCollapse.vue";
import AppCollapseItem from "@core/components/app-collapse/AppCollapseItem.vue";
import { BCard, BFormRadioGroup, BFormRadio, BFormGroup } from "bootstrap-vue";

import sonuclar from "./files/results";

export default {
  components: {
    AppCollapse,
    AppCollapseItem,

    BFormRadioGroup,
    BFormRadio,
    BFormGroup,
    sonuclar,

    BCard,
  },
  data: () => ({
    collapseType: "default",
    sonuc: "a",
    rapor: "",
  }),

  methods: {
    tikla() {
      alert("yes");
    },
  },
};
</script>
