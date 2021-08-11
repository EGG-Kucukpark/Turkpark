<template>
  <div>
    <v-select
      @search="search"
      :filterable="false"
      placeholder="Lütfen Seçim Yapınız"
      :options="options"
    >
      <template slot="no-options"> Sonuç Bulunamadı... </template>

      <template #option="option">
        <div class="d-center">
          {{ option.name }}
        </div>
      </template>

      <template slot="selected-option" slot-scope="option">
        <span>{{ option.name }}</span>
      </template>
    </v-select>
  </div>
</template>
<script>
export default {
  props: {
    url: String,
    item: Array,
    setID: Number,
  },

  data() {
    return {
      options: [],d
    };
  },

  created() {
    this.$http.post(this.url, { id: this.setID }).then((response) => {
      this.options = response.data;
    });
  },

  methods: {
    search(search, loading) {
      if (search.length) {
        loading(true);
      }

      this.$http.post(this.url, { id: this.setID, q: search }).then((res) => {
        this.options = res.data;
        loading(false);
      });
    },
  },
};
</script>
<style lang="scss">
@import "@core/scss/vue/libs/vue-select.scss";
</style>
