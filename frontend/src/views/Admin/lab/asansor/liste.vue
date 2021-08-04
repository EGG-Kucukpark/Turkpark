  <template>
  <b-tabs v-if="userData" pills>
    <!-- Tab: Account -->
    <b-tab active>
      <template #title>
        <feather-icon icon="BriefcaseIcon" size="16" class="mr-0 mr-sm-50" />
        <span class="d-none d-sm-inline"> Firma Listesi </span>
      </template>

      <client :bilgi="bilgi" :user-data="userData" class="mt-2 pt-75" />
    </b-tab>

    <!-- Tab: Information -->
    <b-tab v-if="show">
      <template #title>
        <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
        <span class="d-none d-sm-inline">Bireysel Listesi</span>
      </template>
      <individual :user-data="userData" class="mt-2 pt-75" />
    </b-tab>

    <!-- Tab: Social -->
  </b-tabs>
</template>
<script>
import individual from "../laboratuvar/bireysel-liste";
import client from "../laboratuvar/firma-liste.vue";

export default {
  components: {
    individual,
    client,
  },

  created() {
    var user = JSON.parse(localStorage.getItem("user"));
    if (user.role === "Firma") {
      this.show = false;
    }
  },

  setup() {
    var user = JSON.parse(localStorage.getItem("user"));

    var userData = ref(null);
    userData.value = user;

    var bilgi = { url: "fasansor-firma", db: "isAsansor" };

    return {
      bilgi,
      userData,
      show: true,
    };
  },
};
</script>

