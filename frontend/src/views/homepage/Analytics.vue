<template>
  <section id="dashboard-analytics">
    <b-row class="match-height">
      <b-col
        lg="6"
        md="12"
      >
        <analytics-congratulation :data="data" />
      </b-col>


    </b-row>






  </section>
</template>

<script>
import { BRow, BCol } from 'bootstrap-vue'

import StatisticCardWithAreaChart from '@core/components/statistics-cards/StatisticCardWithAreaChart.vue'
import { kFormatter } from '@core/utils/filter'

import AnalyticsCongratulation from './AnalyticsCongratulation.vue'


export default {
  components: {
    BRow,
    BCol,
    AnalyticsCongratulation,


  },
  data() {
    return {
      data: {},
    }
  },
  created() {
    // data
    this.data = JSON.parse(localStorage.getItem('user'))
  },
  methods: {
    kFormatter,
  },
}
</script>
