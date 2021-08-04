  <template>
  <b-tabs  pills>
    <!-- Tab: Account -->
    <b-tab active>
      <template #title>
        <feather-icon icon="BriefcaseIcon" size="16" class="mr-0 mr-sm-50" />
        <span class="d-none d-sm-inline"> Kurumsal Müşteriler </span>
      </template>

      <client  class="mt-2 pt-75" />
    </b-tab>

    <!-- Tab: Information -->
    <b-tab>
      <template #title>
        <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
        <span class="d-none d-sm-inline">Bireysel Müşteriler</span>
      </template>
      <individual  class="mt-2 pt-75" />
    </b-tab>

    <!-- Tab: Social -->
  </b-tabs>
</template>
<script>



import individual from "./individual/individual.vue";
import client from "./corporate/clients.vue";



export default {
  components: {


    individual,
    client,
  },


};
</script>

