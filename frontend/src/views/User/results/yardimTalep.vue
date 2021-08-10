<template>
  <div>
    <b-button v-on:click="$refs.modal.show()" variant="success"
      ><b>Hizmet Talep Et</b></b-button
    >
    <b-modal
      hide-header-close
      ok-title="Kaydet"
      :hide-footer="true"
      size="lg"
      centered
      title="Hizmet Formu"
      ref="modal"
    >
      <b-form @submit.prevent="submit">
        <b-form-group label-cols-sm="2" label="Kişi Sayısı" label-for="talep">
          <b-form-spinbutton
            id="demo-sb"
            @change="setMoney"
            style="width:210px;"
            v-model="form.sayi"
            min="1"
            max="100"
          />
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Eğitim Yeri" label-for="talep">
          <b-form-radio
            v-model="form.Selected"
            v-for="item in userSelect"
            :key="item.id"
            :value="item"
            @change="date != null ? date : (attributes.dates = [])"
            class="custom-control-success"
          >
            {{ item }}
          </b-form-radio>
        </b-form-group>

        <b-form-group
          v-if="form.Selected === 'Türkpark'"
          label-cols-sm="2"
          label="Eğitim Yeri"
          label-for="talep"
        >
          <b-form-radio
            v-model="form.checked"
            v-for="item in yerler"
            :key="item.id"
            :value="item"
            @change="getDates(item), (showDate = true)"
            class="custom-control-success"
          >
            {{ item }}
          </b-form-radio>
        </b-form-group>

        <b-form-group
          v-if="form.Selected != 'Türkpark'"
          label-cols-sm="2"
          label="Adreslerim"
          label-for="talep"
        >
          <b-form-radio
            v-model="form.selectedAdres"
            v-for="item in adresler"
            :key="item.id"
            :value="item"
            class="custom-control-success"
          >
            {{ item.title }} / {{ item.text }}
          </b-form-radio>
        </b-form-group>

        <b-form-group
          v-if="showDate"
          label-cols-sm="2"
          label="Eğitim Tarihi"
          label-for="talep"
        >
          <v-date-picker
            @input="setTime"
            :min-date="new Date()"
            locale="tr"
            :attributes="attributes"
            v-model="date"
          >
            <template v-slot="{ inputValue, inputEvents }">
              <input
                label-cols-sm="2"
                class="bg-white border px-2 py-1 rounded"
                :value="inputValue"
                v-on="inputEvents"
              />
            </template>
          </v-date-picker>
        </b-form-group>

        <b-form-group v-if="showDate" label-cols-sm="2" label="Eğitim Saati">
          <b-form-select @change="setMoney" v-model="form.selectedTime">
            <option value="" disabled hidden>Lütfen Tarih Seçiniz</option>
            <option v-for="item in times" :key="item.id">{{ item }}</option>
          </b-form-select>
        </b-form-group>

        {{ form.toplamTutar }}
        <b-form-group label-cols-sm="2" label="Mesaj">
          <b-form-textarea
            id="mesaj"
            v-model="form.mesaj"
            class="mb-2"
          ></b-form-textarea>
        </b-form-group>

        <div style="float: right">
          <b-button variant="success" type="submit"> Fiyat İste </b-button>
        </div>
        <div style="float: right; padding-right: 10px">
          <b-button variant="danger" @click="$refs.modal.hide()">
            İptal</b-button
          >
        </div>
      </b-form>
    </b-modal>
  </div>
</template>
<script>
import ToastificationContent from "@core/components/toastification/ToastificationContent.vue";
export default {
  props: ["userData"],
  data() {
    return {
      attributes: [
        {
          highlight: "green",
          popover: {
            label: "Eğitim",
          },
          dates: [],
        },
      ],

      userSelect: ["Türkpark", "Kendi Yerim"],
      show: true,
      showDate: false,
      yerler: [],
      adresler: null,
      date: new Date(),
      times: [],

      form: {
        checked: "",
        Selected: "Türkpark",
        selectedAdres: null,
        selectedTime: "",
        parsedDate: null,
        sayi: 1,
        mesaj: "",
        email: "",
        name: "",
        id: "",
        toplamTutar: 0,
      },
    };
  },

  created() {
    this.$http("/api/firmagoster/" + this.userData.user_id).then((res) => {
      this.adresler = JSON.parse(res.data.adres);

      this.form.email = res.data.email;
      this.form.name = res.data.name;
      this.form.id = res.data.id;
    });

    this.$http.post("/api/egitimgetir").then((res) => {
      this.tutar = res.data;

      const set = new Set();
      for (let i = 0; i < res.data.length; i++) {
        this.yerler = set.add(res.data[i].location);
      }
    });
  },

  methods: {
    getDates(data) {
      this.attributes[0].dates = [];
      this.$http.post("/api/egitimgetir", { loc: data }).then((res) => {
        for (let i = 0; i < res.data.length; i++) {
          this.attributes[0].dates.push(res.data[i].date);
        }
      });
    },

    submit() {
      this.form.parsedDate =
        this.date.getUTCFullYear() +
        "-" +
        this.date.getMonth() +
        "-" +
        this.date.getDate();

      this.$http
        .post("/api/ilkyardimBill", this.form)
        .then((res) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `İleti Gönderildi. `,
              icon: "UserIcon",
              variant: "success",
              text: `Lütfen Mail Adresinizi Kontrol Ediniz.`,
            },
          });
        })
        .catch((err) => {
          this.$toast({
            component: ToastificationContent,
            position: "top-right",
            props: {
              title: `Etkinlik İşlemleri `,
              icon: "UserIcon",
              variant: "success",
              text: ` İşlem Başarısız.`,
            },
          });
        });
    },
    setTime() {
      let month = this.date.getMonth() + 1;
      var newDate =
        this.date.getUTCFullYear() +
        "-" +
        0 +
        month +
        "-" +
        this.date.getDate();
      this.times = [];
      for (let i = 0; i < this.tutar.length; i++) {
        if (this.tutar[i].date == newDate) {
          this.times.push(this.tutar[i].time);
        }
      }
    },

    setMoney() {
      let month = this.date.getMonth() + 1;
      var newDate =
        this.date.getUTCFullYear() +
        "-" +
        0 +
        month +
        "-" +
        this.date.getDate();

      for (let i = 0; i < this.tutar.length; i++) {
        if (
          this.tutar[i].date === newDate &&
          this.tutar[i].time === this.form.selectedTime
        ) {
          this.form.toplamTutar = this.tutar[i].tutar * this.form.sayi;
        }
      }
    },
  },
};
</script>
