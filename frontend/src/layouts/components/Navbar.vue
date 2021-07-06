<template @deneme="deneme($method)">
  <div class="navbar-container d-flex content align-items-center">
    <!-- Nav Menu Toggler -->
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item">
        <b-link class="nav-link" @click="toggleVerticalMenuActive">
          <feather-icon icon="MenuIcon" size="21" />
        </b-link>
      </li>
    </ul>
    <div
      class="bookmark-wrapper align-items-center flex-grow-1 d-none d-lg-flex"
    >
      <router-link to="/apps/calendar">
        <feather-icon
          size="22"
          style="color: #a1a3a6; margin: 10px"
          icon="CalendarIcon"
      /></router-link>

      <portal-target  @change="degisiklik" name="navbar">

      </portal-target>

      <router-link to="/todo">
        <feather-icon
          size="22"
          style="color: #a1a3a6; margin: 10px"
          icon="CheckSquareIcon"
      /></router-link>
      <router-link to="/profil">
        <feather-icon
          size="22"
          style="color: #a1a3a6; margin: 10px"
          icon="SettingsIcon"
      /></router-link>
    </div>
    <!-- Left Col -->

    <b-navbar-nav class="nav align-items-center ml-auto">
      <div
        class="bookmark-wrapper align-items-center flex-grow-1 d-none d-lg-flex"
      >
        <dark-Toggler class="d-none d-lg-block" />
        <search />
      </div>
      <b-nav-item-dropdown
        right
        toggle-class="d-flex align-items-center dropdown-user-link"
        class="dropdown-user"
      >
        <template #button-content>
          <div class="d-sm-flex d-none user-nav">
            <p class="user-name font-weight-bolder mb-0">
              {{ user.name }}
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
    </b-navbar-nav>
  </div>
</template>

<script>
import {
  BLink,
  BNavbarNav,
  BNavItemDropdown,
  BDropdownItem,
  BDropdownDivider,
  BAvatar,
} from "bootstrap-vue";
import DarkToggler from "@core/layouts/components/app-navbar/components/DarkToggler.vue";
import axios from "@axios";
import FeatherIcon from "../../@core/components/feather-icon/FeatherIcon.vue";
import search from "./search.vue";

export default {
  components: {
    BLink,
    BNavbarNav,
    BNavItemDropdown,
    BDropdownItem,
    BDropdownDivider,
    BAvatar,

    // Navbar Components
    DarkToggler,
    search,
    FeatherIcon,
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

      this.user=JSON.parse(localStorage.getItem("user"))
    },
  },
  props: {
    toggleVerticalMenuActive: {
      type: Function,
      default: () => {},
    },
  },
};
</script>
