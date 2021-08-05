<template>
  <section class="invoice-preview-wrapper">
    <!-- Alert: No item found -->

    <b-row class="invoice-preview">
      <!-- Col: Left (Invoice Container) -->
      <b-col cols="12" xl="9" md="8">
        <b-card no-body class="invoice-preview-card">

        </b-card>
      </b-col>

      <!-- Right Col: Card -->
      <b-col cols="12" md="4" xl="3" class="invoice-actions">
        <b-card>
          <!-- Button: Send Invoice -->
          <b-button

            v-b-toggle.sidebar-send-invoice
            variant="primary"
            class="mb-75"
            block
          >
            Send Invoice
          </b-button>

          <!-- Button: DOwnload -->
          <b-button

            variant="outline-secondary"
            class="mb-75"
            block
          >
            Download
          </b-button>

          <!-- Button: Print -->
          <b-button

            variant="outline-secondary"
            class="mb-75"
            block
            @click="printInvoice"
          >
            Print
          </b-button>

          <!-- Button: Edit -->

          <!-- Button: Add Payment -->
          <b-button
            v-b-toggle.sidebar-invoice-add-payment

            variant="success"
            class="mb-75"
            block
          >
            Add Payment
          </b-button>

          <b-button
            v-b-toggle.sidebar-invoice-add-payment

            variant="success"
            class="mb-75"
            block
          >
            Qr Kod indir
          </b-button>
        </b-card>


      </b-col>
    </b-row>
  </section>
</template>

<script>
import router from "@/router";
import {
  BRow,
  BCol,
  BCard,
  BCardBody,
  BTableLite,
  BCardText,
  BButton,
  BAlert,
  BLink,
  VBToggle,
} from "bootstrap-vue";
import axios from "@axios";

import Ripple from "vue-ripple-directive";

export default {
  directives: {
    Ripple,
    "b-toggle": VBToggle,
  },
  components: {
    BRow,
    BCol,
    BCard,
    BCardBody,
    BTableLite,
    BCardText,
    BButton,
    BAlert,
    BLink,
  },
  data() {
    return {
      calisan: null,
    };
  },
  created() {
    var id = router.currentRoute.params.id;

    axios
      .get(`/api/sertifikagoster/${id}`)
      .then((res) => (this.calisan = res.data));
  },

  methods: {
    printInvoice() {
      window.print();
    },
  },
};
</script>

<style lang="scss" scoped>
@import "~@core/scss/base/pages/app-invoice.scss";
</style>

<style lang="scss">
@media print {
  // Global Styles
  body {
    background-color: transparent !important;
  }
  nav.header-navbar {
    display: none;
  }
  .main-menu {
    display: none;
  }
  .header-navbar-shadow {
    display: none !important;
  }
  .content.app-content {
    margin-left: 0;
    padding-top: 2rem !important;
  }
  footer.footer {
    display: none;
  }
  .card {
    background-color: transparent;
    box-shadow: none;
  }
  .customizer-toggle {
    display: none !important;
  }

  // Invoice Specific Styles
  .invoice-preview-wrapper {
    .row.invoice-preview {
      .col-md-8 {
        max-width: 100%;
        flex-grow: 1;
      }

      .invoice-preview-card {
        .card-body:nth-of-type(2) {
          .row {
            > .col-12 {
              max-width: 50% !important;
            }

            .col-12:nth-child(2) {
              display: flex;
              align-items: flex-start;
              justify-content: flex-end;
              margin-top: 0 !important;
            }
          }
        }
      }
    }

    // Action Right Col
    .invoice-actions {
      display: none;
    }
  }
}
</style>
