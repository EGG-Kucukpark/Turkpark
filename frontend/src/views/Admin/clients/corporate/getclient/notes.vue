
<template>
  <b-card title="Özel Not">
    <b-button
      v-b-toggle.notekle
      v-ripple.400="'rgba(113, 102, 240, 0.15)'"
      size="sm"
      variant="outline-primary"
      v-b-tooltip.hover.v-info
      title="Not Ekle"
    >
      <feather-icon size="20px;" icon="PlusIcon" />
    </b-button>

    <b-collapse id="notekle">
      <b-form-textarea
        id="textarea-rows"
        v-model="not"
        placeholder="Not giriniz"
        rows="2"
        style="background: #fffcdc; margin-top: 10px"
      />

      <b-button
        style="margin: 10px"
        v-ripple.400="'rgba(113, 102, 240, 0.15)'"
        size="md"
        variant="outline-success"
        v-b-toggle.notekle
        @click="ekle"
      >
        Ekle
      </b-button>
    </b-collapse>

    <b-list-group style="margin-top: 10px">
      <b-list-group-item
        v-for="not in notlar"
        :key="not.id"
        class="flex-column align-items-start"
      >
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1 text-white"></h5>
          <small class="text-secondary">{{ not.time }}</small>
        </div>
        <b-card-text class="mb-1">
          {{ not.not }}
        </b-card-text>
        <small class="text-secondary">{{ not.kisi_name }}</small>

        <b-button
          style="margin: 10px; float: right"
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          size="md"
          variant="outline-danger"
          v-if="not.kisi_id == user.id"
          @click="sil(not.id)"
        >
          Sil
        </b-button>
      </b-list-group-item>
    </b-list-group>
  </b-card>
</template>

<script>
import AppTimeline from "@core/components/app-timeline/AppTimeline.vue";
import AppTimelineItem from "@core/components/app-timeline/AppTimelineItem.vue";
import Ripple from "vue-ripple-directive";
import axios from "@axios";
import {
  BFormTextarea,
  BCard,
  BImg,
  BAvatar,
  BMedia,
  BRow,
  BButton,
  BCollapse,
  VBToggle,
  BListGroup,
  BListGroupItem,
  BAvatarGroup,
  BBadge,
  BCardText,
  VBTooltip,
} from "bootstrap-vue";
import FeatherIcon from "@/@core/components/feather-icon/FeatherIcon.vue";

export default {
  components: {
    BFormTextarea,

    BCard,
    BCardText,

    BImg,
    BAvatar,
    AppTimelineItem,
    AppTimeline,
    BMedia,
    BRow,
    BButton,
    BCollapse,
    VBToggle,
    BListGroup,
    BListGroupItem,
    BAvatarGroup,
    BBadge,
    VBTooltip,
    FeatherIcon,
  },
  props: {
    userData: {
      type: Object,
      required: true,
    },
  },
  directives: { "b-toggle": VBToggle, "b-tooltip": VBTooltip, Ripple },

  data() {
    return {
      not: "",
      notlar: [],
      id: this.userData.id,
      user: JSON.parse(localStorage.getItem("user")),
    };
  },

  created() {
    this.veri();
  },
  methods: {
    veri() {
      axios
        .post("/api/firmanot", { id: this.id })
        .then((res) => (this.notlar = res.data));
    },
    ekle() {
      axios
        .post("/api/firmanotekle", {
          id: this.id,
          not: this.not,
          kisi_id: this.user.id,
          kisi_name: this.user.name,
        })
        .then(this.veri(), (this.not = null));
    },
    sil(data) {
      axios.post("/api/firmanotsil", { id: data }).then(this.veri());
    },
  },
};
</script>
