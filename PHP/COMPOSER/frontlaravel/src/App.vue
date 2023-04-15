<template>
  <v-app>
    <v-app-bar
      app
      color="white"
      elevation="0"
      style="border-bottom: 1px solid black !important;"
      de
    >
      <v-alert width="20%" :type="alert.type"
               :color="alert.color"
               outlined
               light
               text
               transition="slide-y-transition"
               style="position: absolute; right: 6%; top: 150%; z-index:20001; border: solid 1px black !important;"
               v-model="alert.show"
                tile>
        <v-row>
          <span style="color: black" class="pa-2">{{ alert.msg }}</span>
        </v-row>
      </v-alert>
      <v-col cols="4">
        <v-icon large class="mb-6" style="color: black">
          fa-solid fa-wave-square
        </v-icon>
        <span class="text-h1 ml-4" style="font-size: 2.8em !important; letter-spacing: 5px !important;">
          <strong id="logo">SIGNAL</strong>
        </span>
      </v-col>
      <v-spacer></v-spacer>
      <v-btn class="mx-3 app-btn" text tile x-large to="/connection" v-if="!connected">
        sign up
      </v-btn>
      <v-btn class="mx-3 app-btn" text tile x-large @click="deleteSession" v-else>
        log out
      </v-btn>
    </v-app-bar>
    <v-main>
      <router-view/>
    </v-main>
  </v-app>
</template>
<style lang="scss">
@import "./scss/variables.scss";
v-app {
  font-family: $body-font-family !important;
}
#logo:hover {
  color: gray;
  transition: 0.5s;
  cursor: default;
}
.app-btn{
  border-left: 1px solid transparent;
  border-right: 1px solid transparent;
}
.app-btn:hover {
  border-left: 1px solid black;
  border-right: 1px solid black;
  transition: 0.5s;
  cursor: crosshair;
}
</style>
<script>
import {EventBus} from "@/main";
import {roleMixins} from "@/role-mixins";

export default {
  name: 'App',
  mixins: [roleMixins],
  data: () => ({
    alert: {
      color: null,
      show: false,
      type: null,
      msg: ''
    },
    connected: false
  }),
  mounted() {
    EventBus.$on('alert', model => {
      this.showAlert(model);
    });
    EventBus.$on('changeUserStatus', model => {
      this.changeUserStatus();
    });
  },
  created() {
    this.changeUserStatus();
  },
  methods: {
    showAlert(model){
      this.alert = {
        color: model.color,
        type: model.type,
        msg: model.msg,
        show: true
      }
      setTimeout(() => this.alert.show = false, 2200);
    },
    deleteSession(){
      localStorage.removeItem('SIGNAL');
      window.location.reload();
    },
    changeUserStatus(){
      this.connected = (this.getToken() != null);

    }
  }
};
</script>
