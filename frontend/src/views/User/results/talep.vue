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
      <b-form @submit.prevent="send">
        <b-form-group label-cols-sm="2" label="Kişi Sayısı" label-for="talep">
          <b-form-spinbutton
            id="demo-sb"
            style="width:210px;"
            @change="setMoney"
            v-model="sayi"
            min="1"
            max="100"
          />
        </b-form-group>

        <b-form-group label-cols-sm="2" label="Tarih" label-for="talep">
          <v-date-picker :attributes="attributes" v-model="date">
            <template v-slot="{ inputValue, inputEvents }">
              <input
                class="bg-white border px-2 py-1 rounded"
                :value="inputValue"
                v-on="inputEvents"
              />
            </template>
          </v-date-picker>
        </b-form-group>

        <b-form-group label-cols-sm="2" label="Test Türü" label-for="talep">
          <b-form-checkbox
            v-model="checked"
            v-for="item in tests"
            :key="item.id"
            :value="item"
            ref="checked"
            class="custom-control-success"
          >
            {{ item.title }}
          </b-form-checkbox>
        </b-form-group>
        <b-form-group
          label-cols-sm="2"
          label="Laboratuvar Türü"
          label-for="talep"
        >
          <b-form-radio
            v-model="radio"
            v-for="item in labs"
            :key="item.id"
            :value="item"
            class="custom-control-success"
          >
            {{ item.title }}
          </b-form-radio>
        </b-form-group>

        <b-form-group
          v-show="radio.title === 'Mobil Araç'"
          label-cols-sm="2"
          label="Adreslerim"
          label-for="talep"
        >
          <b-form-radio
            v-model="selectedAdres"
            v-for="item in adresler"
            :key="item.id"
            :value="item"
            class="custom-control-success"
          >
            {{ item.title }} / {{ item.text }}
          </b-form-radio>
        </b-form-group>

        <b-form-group
          v-show="radio.title != 'Mobil Araç'"
          label-cols-sm="2"
          label="Laboratuvarlar"
          label-for="talep"
        >
          <b-form-radio
            v-model="yer"
            v-for="item in yerler"
            :key="item.id"
            :value="item"
            class="custom-control-success"
          >
            {{ item }}
          </b-form-radio>
        </b-form-group>

        <b-form-group label-cols-sm="2" label="Mesaj">
          <b-form-textarea
            id="mesaj"
            v-model="mesaj"
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

      kisi: "",
      mesaj: "",
      tests: [
        { title: "Kan Sayımı", money: 30 },
        { title: "Korona Testi", money: 30 },
      ],
      yerler: ["Bayraklı", "Bornova"],
      labs: [
        { title: "Mobil Araç", money: 30 },
        { title: "Laboratuvar", money: 30 },
      ],
      adresler: null,
      checked: [],
      radio: "Mobil Araç",
      selectedAdres: null,
      yer: null,
      para: 0,
      email: null,
      name: null,
      status: false,
      id: null,
      arry: [],
      date: null,
    };
  },

  created() {
    this.$http("/api/firmagoster/" + this.userData.user_id).then((res) => {
      this.adresler = JSON.parse(res.data.adres);

      this.email = res.data.email;
      this.name = res.data.name;
      this.id = res.data.id;
    });

    this.$http.post("/api/egitimgetir").then((res) => {
      for (let i = 0; i < res.data.length; i++) {
        this.attributes[0].dates.push(res.data[i].date);
      }
    });
  },

  methods: {
    testsMoney(data) {
      this.status ? (this.para += data.money) : (this.para -= data.money);
    },
    send() {
      this.$refs["modal"].hide();

      for (let i = 0; i < this.checked.length; i++) {
        this.para += this.checked[i].money;
      }
      this.para += this.radio.money;

      for (let i = 0; i < this.checked.length; i++) {
        this.arry.push(this.checked[i].title);
      }

      this.$http.post("/api/bill", {
        id: this.id,

        tests: this.arry,
        email: this.email,
        name: this.name,
        mesaj: this.mesaj,
        tutar: this.para,
        labTürü: this.radio.title,
        adres: this.selectedAdres,
        testler: this.checked,
        labYer: this.yer,
        kisi: this.kisi,
      });

      this.para = 0;
      this.arry = [];
    },
  },
};
</script>
