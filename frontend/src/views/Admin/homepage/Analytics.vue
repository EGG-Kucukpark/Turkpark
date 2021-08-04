<template>
  <section id="dashboard-analytics">
    <b-row class="match-height">
      <b-col
        lg="6"
        md="12"
      >
        <analytics-congratulation :data="data" />
      </b-col>

       <b-col
        lg="6"
        md="12"
      >
        <CardAnalyticGoalOverview :data="data" />
      </b-col>


    </b-row>






  </section>
</template>

<script>

import CardAnalyticGoalOverview from './CardAnalyticGoalOverview.vue'
import { kFormatter } from '@core/utils/filter'

import AnalyticsCongratulation from './AnalyticsCongratulation.vue'


export default {
  components: {
  StatisticCardWithAreaChart,
    AnalyticsCongratulation,
    CardAnalyticGoalOverview,


  },
  data() {
    return {
      data: {},
    }
  },
  created() {
    const eles = document.getElementsByClassName("nav-item has-sub");
    setTimeout(() => {
        eles[0].getElementsByTagName("a")[0].click();
    }, 600);




    this.data = JSON.parse(localStorage.getItem('user'))
  },
  methods: {
    kFormatter,
  },
}
</script>
