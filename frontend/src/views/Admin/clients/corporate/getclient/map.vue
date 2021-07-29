<template>
  <b-card>
    <gmap-map :center="center" :zoom="16" style="width: 100%; height: 100vh">
      <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"

        @click="center = m.position"
      ></gmap-marker>
    </gmap-map>
  </b-card>
</template>

<script>
import { BCard, BFormInput, BButton, BRow, BCol } from "bootstrap-vue";
import axios from "@axios";
export default {
  components: {
    BCard,
    BFormInput,
    BButton,
    BRow,
    BCol,
  },
  props: {
    userData: Object,
  },
  data() {
    return {
      // default to montreal to keep it simple
      // change this to whatever makes sense
      center: { lat: 45.508, lng: -73.587 },
      markers: [],
      places: [],
      lat: null,
      lng: null,
      currentPlace: null,
      adres: this.userData.adres,
    };
  },

  created() {
    this.addMarker();
  },
  methods: {
    setPlace(place) {
      this.currentPlace = place;
    },
    addMarker() {
      if (this.adres) {
        axios(
          `https://maps.googleapis.com/maps/api/geocode/json?address=${this.adres}&key=AIzaSyBA6gH1LTs7-6RTKi__xXvdaZ4bV78IdOE`
        ).then((res) => {
          this.center.lat = res.data.results[0].geometry.location.lat;
          this.center.lng = res.data.results[0].geometry.location.lng;
        });
        const marker = {
          lat: this.center.lat,
          lng: this.center.lng,
        };
        this.markers.push({ position: marker });
        this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
      }
    },
    geolocate: function () {
      navigator.geolocation.getCurrentPosition((position) => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };
      });
    },
  },
};
</script>

