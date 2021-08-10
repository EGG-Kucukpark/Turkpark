<template>
  <section class="invoice-preview-wrapper">
    <b-row class="invoice-preview">
      <!-- Col: Left (Invoice Container) -->
      <b-col cols="12" xl="9" md="8">
        <b-card no-body class="invoice-preview-card">
          <!-- Header -->
          <b-card-body class="invoice-padding pb-0">
            <div
              class="
                d-flex
                justify-content-between
                flex-md-row flex-column
                invoice-spacing
                mt-0
              "
            >
              <!-- Header: Left Content -->
              <div>
                <div class="logo-wrapper">
                  <img width="90px" :src="require('/public/images/logo.png')" />
                  <h3 class="text-primary invoice-logo">Türkpark</h3>
                </div>
                <p class="card-text mb-25">
                  Adalet, Haydar Aliyev Cd. D:NO:38 D:10,
                </p>
                <p class="card-text mb-25">35530 Bayraklı/İzmir</p>
                <p class="card-text mb-0">0850 304 0304</p>
              </div>

              <!-- Header: Right Content -->
              <div class="mt-md-0 mt-2">
                <h4 class="invoice-title">
                  Fatura
                  <span class="invoice-number">#{{ fatura[0].id }}</span>
                </h4>
                <div class="invoice-date-wrapper">
                  <p class="invoice-date-title">Başvuru Tarihi:</p>
                  <p class="invoice-date">dsadsadsa</p>
                </div>
                <div class="invoice-date-wrapper">
                  <p class="invoice-date-title">Onay Tarihi:</p>
                  <p class="invoice-date">dsadsadsa</p>
                </div>
              </div>
            </div>
          </b-card-body>

          <!-- Spacer -->
          <hr class="invoice-spacing" />

          <!-- Invoice Client & Payment Details -->
          <b-card-body class="invoice-padding pt-0">
            <b-row class="invoice-spacing">
              <!-- Col: Invoice To -->
              <b-col cols="12" xl="6" class="p-0">
                <h6 class="mb-2">Firma Detayları:</h6>
                <h6 class="mb-25"></h6>
                <p class="card-text mb-25">{{ firma.name }}</p>
                <p class="card-text mb-25">{{ firma.email }}</p>
                <p class="card-text mb-25">{{ firma.telefon }}</p>
                <p class="card-text mb-0">{{ firma.adres }}</p>
              </b-col>

              <!-- Col: Payment Details -->
              <b-col
                xl="6"
                cols="12"
                class="p-0 mt-xl-0 mt-2 d-flex justify-content-xl-end"
              >
                <div>
                  <h6 class="mb-2">Ödeme Detayları:</h6>
                  <table>
                    <tbody>
                      <tr>
                        <td class="pr-1">Toplam Tutar:</td>
                        <td>
                          <span class="font-weight-bold"></span
                          >{{ fatura[0].tutar }} ₺
                        </td>
                      </tr>
                      <tr>
                        <td class="pr-1">Banka ismi:</td>
                        <td>İş Bankası</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </b-col>
            </b-row>
          </b-card-body>

          <!-- Invoice Description: Table -->
          <b-table-lite responsive :items="fatura" :fields="fields">
            <template #cell(tests)>
              <b-card-text
                v-for="item in tests"
                :key="item.id"
                class="font-weight-bold mb-30"
              >
                {{ item }}
              </b-card-text>
            </template>
          </b-table-lite>

          <!-- Invoice Description: Total -->
          <b-card-body class="invoice-padding pb-0">
            <b-row>
              <!-- Col: Total -->
              <b-col
                cols="12"
                md="6"
                class="mt-md-6 d-flex justify-content-end"
                order="1"
                order-md="2"
              >
                <div class="invoice-total-wrapper">
                  <hr class="my-50" />
                  <div class="invoice-total-item">
                    <p class="invoice-total-title">Toplam Tutar:</p>
                    <p class="invoice-total-amount">{{ fatura[0].tutar }} ₺</p>
                  </div>
                </div>
              </b-col>
            </b-row>
          </b-card-body>

          <!-- Spacer -->
          <hr class="invoice-spacing" />

          <!-- Note -->
          <b-card-body class="invoice-padding pt-0">
            <span class="font-weight-bold">Not: </span>
            <span
              >Sizinle ve ekibinizle çalışmak bir zevkti. Gelecekteki projeleriz
              için bizi aklınızda tutacağınızı umuyoruz. Teşekkürler!</span
            >
          </b-card-body>
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
            Mail Adresime Gönder
          </b-button>

          <!-- Button: DOwnload -->


          <!-- Button: Print -->
          <b-button
            v-on:click="print"
            variant="outline-secondary"
            class="mb-75"
            block
          >
            Yazdır
          </b-button>

          <!-- Button: Edit -->

          <!-- Button: Add Payment -->
          <b-button
            v-b-toggle.sidebar-invoice-add-payment
            variant="success"
            class="mb-75"
            block
          >
            Ödeme
          </b-button>
        </b-card>
      </b-col>
    </b-row>
  </section>
</template>

<script>
export default {
  data() {
    return {
      firma: JSON.parse(localStorage.getItem("user")),
      fatura: null,
      tests: null,
      fields: [
        { key: "tests", label: "Testler" },
        { key: "lab", label: "Hizmet Yeri" },
        { key: "adres", label: "Adres" },
      ],
    };
  },

  created() {
    this.$http
      .post("/api/getBill", { id: this.$route.params.id })
      .then((response) => {
        this.fatura = response.data;
        this.tests = JSON.parse(this.fatura[0].tests);
      });
  },

  methods: {
      print(){
          window.print()

      }
  }
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
