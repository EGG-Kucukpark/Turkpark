<template>
  <div class="sidebar-left">
    <div class="sidebar">
      <div class="sidebar-content todo-sidebar">
        <div class="todo-app-menu">
          <div class="add-task">
            <b-button

              variant="primary"
              block
              @click="$emit('update:is-task-handler-sidebar-active', true); $emit('close-left-sidebar')"
            >
              Görev Ekle
            </b-button>
          </div>
          <vue-perfect-scrollbar
            :settings="perfectScrollbarSettings"
            class="sidebar-menu-list scroll-area"
          >
            <!-- Filters -->
            <b-list-group class="list-group-filters">
              <b-list-group-item
                v-for="filter in taskFilters"
                :key="filter.title + $route.path"
                :to="filter.route"
                :active="isDynamicRouteActive(filter.route)"
                @click="$emit('close-left-sidebar')"
              >
                <feather-icon
                  :icon="filter.icon"
                  size="18"
                  class="mr-75"
                />
                <span class="align-text-bottom line-height-1">{{ filter.title }}</span>
              </b-list-group-item>
            </b-list-group>

            <!-- Tags -->




          </vue-perfect-scrollbar>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import { BButton, BListGroup, BListGroupItem } from 'bootstrap-vue'
import { isDynamicRouteActive } from '@core/utils/utils'
import Ripple from 'vue-ripple-directive'

export default {
  directives: {
    Ripple,
  },
  components: {
    BButton,
    BListGroup,
    BListGroupItem,
    VuePerfectScrollbar,
  },
  props: {
    taskTags: {
      type: Array,
      required: true,
    },
  },
  setup() {
    const perfectScrollbarSettings = {
      maxScrollbarLength: 60,
    }

    const taskFilters = [
      { title: 'Görevlerim', icon: 'MailIcon', route: { name: 'apps-todo' } },
      { title: 'Önemli', icon: 'StarIcon', route: { name: 'apps-todo-filter', params: { filter: 'important' } } },
      { title: 'Tamamlanmış', icon: 'CheckIcon', route: { name: 'apps-todo-filter', params: { filter: 'completed' } } },
      { title: 'Çöp Kutusu', icon: 'TrashIcon', route: { name: 'apps-todo-filter', params: { filter: 'deleted' } } },
    ]

    return {
      perfectScrollbarSettings,
      taskFilters,
      isDynamicRouteActive,
    }
  },
}
</script>

<style>

</style>
