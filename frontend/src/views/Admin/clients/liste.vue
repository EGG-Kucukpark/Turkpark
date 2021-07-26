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
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";

import {
  BRow,
  BCard,
  BCol,
  BBreadcrumb,
  BBreadcrumbItem,
  BAlert,
  BLink,
  BTabs,
  BModal,
  BForm,
  BFormInput,
  BTab,
  BButton,
  BFormSelect,
  BInputGroup,
  BInputGroupAppend,
  BFormGroup,
} from "bootstrap-vue";

import { required } from "@validations";
import { togglePasswordVisibility } from "@core/mixins/ui/forms";
import { ValidationProvider, ValidationObserver } from "vee-validate";
import individual from "./individual/individual.vue";
import client from "./corporate/clients.vue";


import router from "@/router";

export default {
  components: {
    BRow,
    BCol,
    BCard,

    BAlert,
    BModal,
    BLink,
    BBreadcrumb,
    BBreadcrumbItem,
    ValidationProvider,
    ValidationObserver,
    BInputGroup,
    BInputGroupAppend,
    BForm,
    BFormInput,
    BTabs,
    BTab,
    togglePasswordVisibility,
    required,
    BButton,
    BFormSelect,

    ToastificationContent,
    BFormGroup,
    router,
    // Local Components

    individual,

    client,
  },


};
</script>

