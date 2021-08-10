 <style>
@font-face {
  font-family: "govde";
  src: url("govde.ttf") format("truetype");
}

* {
  margin: 0;
  padding: 0;
}

#sertifika-container {
  font-family: govde, Arial;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
}
#sertifika-container .bg-img {
  width: 25.7cm;
  height: 17cm;
}

.sertifika-content {
  width: 834px;
  height: 510px;
  position: absolute;
  left: calc(25.7cm-100vw);
}

.govde {
  width: 100%;
  height: calc(510px - 175px);
  font-size: 16pt;
  margin-top: 170px;
}

.bold {
  font-weight: 600;
}
.baslik {
  float: left;
  font-size: 22pt;
  text-align: center;
  width: 100%;
}
.no-baslik {
  float: left;
  padding-left: 18px;
  width: 200px;
}
.no {
  float: left;
}

.isim {
  padding-top: 20px;
  width: 100%;
  float: left;
  text-align: center;
}

.aciklama {
  padding-top: 50px;
  text-align: left;
  padding-left: 30px;
  padding-right: 30px;
}

.sol-alt {
  width: 50%;
  height: 130px;
  float: left;
}

.imza-sol {
  float: left;
  width: 200px;
  height: auto;
  text-align: center;
  padding-top: 10px;
  margin-left: 30px;
}

.imza-sag {
  float: right;
  width: 200px;
  height: auto;
  text-align: center;
  padding-top: 10px;
  margin-right: 34px;
}

.imza-isim {
  padding-top: 5px;
}
</style>
<template>
  <section class="invoice-preview-wrapper">
    <!-- Alert: No item found -->

    <b-row class="invoice-preview">
      <!-- Col: Left (Invoice Container) -->
      <b-col cols="12" xl="9" md="8">
        <b-card no-body class="invoice-preview-card">
          <div id="sertifika-container">
            <img
              class="bg-img"
              :src="require('/public/images/bg2.png')"
              height="100%"
              alt=""
            />
            <div class="sertifika-content">
              <div class="govde">
                <h1 class="baslik">İLKYARDIMCI BELGESİ</h1>
                <div class="bold">
                  <div class="no-baslik">Belge No</div>
                  <div class="no">:</div>
                  <div>&nbsp;SB.20172273.01</div>
                  <div class="no-baslik">Belge Geçerlilik Tarihi</div>
                  <div class="no">:</div>
                  <div>&nbsp;{{calisan.gecerli_trh}}</div>
                </div>
                <div class="isim bold">Sayın; {{ calisan.name }},</div>
                <div class="aciklama">
                  İlk yardım yönetmeliği kapsamında 8.06.2021 tarihinde,
                  <b class="bold">TÜRKPARK İLKYARDIM EĞİTİM MERKEZİ</b>
                  tarafından düzenlenen ilkyardım
                  <strong class="bold">GÜNCELLEME ve OED</strong> eğitim
                  programlarına katılarak ilkyardımcı belgesi süresi
                  uzatılmıştır.
                </div>

                <div class="sol-alt">
                  <div class="imza-sol bold">
                    <p class="imza-baslik">Mesul Müdür</p>
                    <p class="imza-isim">Dilek AŞKAR</p>
                  </div>
                </div>

                <div class="sag-alt">
                  <div class="imza-sag bold">
                    <p class="imza-baslik">Erkan GÜVENÇ</p>
                    <p class="imza-isim">sadasdsa asdasdas</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </b-card>
      </b-col>

      <!-- Right Col: Card -->
      <b-col cols="12" md="4" xl="3" class="invoice-actions">
        <b-card>
          <b-button
            variant="success"
            class="mb-75"
            block
            @click="printInvoice"
          >
            Yazdır
          </b-button>
        </b-card>
      </b-col>
    </b-row>
  </section>
</template>

<script>
import router from "@/router";

export default {
  data() {
    return {
      calisan: null,
    };
  },
  created() {
    var id = router.currentRoute.params.id;

    this.$http(`/api/sertifikagoster/${id}`).then(
      (res) => (this.calisan = res.data)
    );
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
