  <template>
  <b-tabs pills>
    <!-- Tab: Account -->
    <b-tab active>
      <template #title>
        <feather-icon icon="BriefcaseIcon" size="16" class="mr-0 mr-sm-50" />
        <span class="d-none d-sm-inline"> Test Sonuçları </span>
      </template>
      <files :user-data="userData" class="mt-2 pt-75" />
    </b-tab>

    <!-- Tab: Information -->
    <b-tab>
      <template #title>
        <feather-icon icon="InfoIcon" size="16" class="mr-0 mr-sm-50" />
        <span class="d-none d-sm-inline">Eğitim Sonuçları</span>
      </template>
      <egitim :user-data="userData" class="mt-2 pt-75" />
    </b-tab>

    <!-- Tab: Social -->
  </b-tabs>
</template>
<script>
import files from "./workerfiles.vue";
import egitim from "./workerEgitim.vue";

export default {
  props: ["userData"],
  components: {
    files,
    egitim,
  },
};
</script>

