<template>
  <b-card>
    <b-tabs pills>
      <!-- Tab: Account -->
      <b-tab @click="gelsin(tur)" v-for="tur in tur" :key="tur.id" id="tab">
        <template #title>
          <feather-icon icon="BriefcaseIcon" size="16" class="mr-0 mr-sm-50" />
          <span class="d-none d-sm-inline"> {{ tur.name }} </span>
        </template>

        <dosyalar :userData="userData" :giden="Selected" />
      </b-tab>
    </b-tabs>

    <portal to="gelsin">
      <p v-if="send" :data="Selected"></p>
    </portal>
  </b-card>
</template>

<script>
import AppCollapse from "@core/components/app-collapse/AppCollapse.vue";
import AppCollapseItem from "@core/components/app-collapse/AppCollapseItem.vue";
import dosyalar from "./files/results.vue";



export default {
  components: {
    AppCollapse,
    AppCollapseItem,
    dosyalar,
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
    this.$http.post("/api/dosyatur").then((res) => (this.tur = res.data));
  },

  methods: {
    gelsin(data) {
      this.send = true;
      this.Selected = data.name;
    },
  },
};
</script>
