<template>
  <div class="sidebar-wrapper d-flex justify-content-between flex-column flex-grow-1">
    <div class="p-2">
      <b-button
        v-ripple.400="'rgba(255, 255, 255, 0.15)'"
        aria-controls="sidebar-add-new-event"
        :aria-expanded="String(isEventHandlerSidebarActive)"
        variant="primary"
        block
        @click="$emit('update:isEventHandlerSidebarActive', true)"
      >
        Etkinlik Oluştur
      </b-button>
      <div class="mt-9">



      </div>
      <b-img style="padding-top:580px;" :src="require('@/assets/images/pages/calendar-illustration.png')" />
    </div>

  </div>
</template>

<script>
import {
  BButton, BFormGroup, BFormCheckboxGroup, BFormCheckbox, BImg,
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import useCalendarSidebar from './useCalendarSidebar'

export default {
  directives: {
    Ripple,
  },
  components: {
    BButton,
    BImg,
    BFormCheckbox,
    BFormGroup,
    BFormCheckboxGroup,
  },
  props: {
    isEventHandlerSidebarActive: {
      type: Boolean,
      require: true,
    },
  },
  setup() {
    const {
      calendarOptions,
      selectedCalendars,
      checkAll,
    } = useCalendarSidebar()

    return {
      calendarOptions,
      selectedCalendars,
      checkAll,
    }
  },
}
</script>

<style>

</style>
