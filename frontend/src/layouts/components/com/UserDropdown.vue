<template>
  <div>
    <b-nav-item-dropdown
      right
      toggle-class="d-flex align-items-center dropdown-user-link"
      class="dropdown-user"
    >
      <template #button-content>
        <div class="d-sm-flex d-none user-nav">
          <p class="user-name font-weight-bolder mb-0">
            {{ user.name.substring(0, 20) }}
          </p>
          <span class="user-status"> {{ user.role }}</span>
        </div>
        <b-avatar
          size="40"
          variant="light-primary"
          badge
          :src="require('@/assets/images/avatars/13-small.png')"
          class="badge-minimal"
          badge-variant="success"
        />
      </template>

      <b-dropdown-item
        :to="{ path: '/profil' }"
        link-class="d-flex align-items-center"
      >
        <feather-icon size="16" icon="UserIcon" class="mr-50" />
        <span>Profilim</span>
      </b-dropdown-item>

      <b-dropdown-item link-class="d-flex align-items-center">
        <feather-icon size="16" icon="MailIcon" class="mr-50" />
        <span>Inbox</span>
      </b-dropdown-item>

      <b-dropdown-item
        :to="{ path: '/todo' }"
        link-class="d-flex align-items-center"
      >
        <feather-icon size="16" icon="CheckSquareIcon" class="mr-50" />
        <span>Görevlerim</span>
      </b-dropdown-item>

      <b-dropdown-divider />

      <b-dropdown-item
        @click.prevent="logout"
        link-class="d-flex align-items-center"
      >
        <feather-icon size="16" icon="LogOutIcon" class="mr-50" />
        <span>Çıkış</span>
      </b-dropdown-item>
    </b-nav-item-dropdown>

    <portal-target @change="degisiklik" name="navbar"> </portal-target>
  </div>
</template>

<script>
import {
  BNavItemDropdown,
  BDropdownItem,
  BDropdownDivider,
  BAvatar,
  BLink,
} from "bootstrap-vue";

export default {
  components: {
    BNavItemDropdown,
    BDropdownItem,
    BDropdownDivider,
    BAvatar,
    BLink,
  },

  data() {
    return {
      user: JSON.parse(localStorage.getItem("user")),
    };
  },
  created() {},
  methods: {
    logout() {
      localStorage.removeItem("user");
      localStorage.removeItem("token");

      this.$router.push("login");
    },

    degisiklik() {
      this.user = JSON.parse(localStorage.getItem("user"));
    },
  },
};
</script>

