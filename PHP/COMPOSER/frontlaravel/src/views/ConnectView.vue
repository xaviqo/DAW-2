<template>
  <v-row >

    <v-col cols="12" class="d-flex justify-center align-start login-container">
      <v-card max-width="40vw" elevation="0" class="mt-12">
        <v-tabs
            v-model="tab"
            background-color="transparent"
            color="basil"
            grow
        >
          <v-tab
              v-for="item in items"
              :key="item"
          >
            {{ item }}
          </v-tab>
        </v-tabs>
        <v-tabs-items v-model="tab">
          <template v-if="tab === 0">
            <v-form>
              <v-container>
                <v-row>
                  <v-col
                      cols="12"
                  >
                    <v-text-field
                        v-model="loginReq.email"
                        label="E-mail"
                        type="email"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="loginReq.password"
                        label="Password"
                        type="password"
                        required
                    ></v-text-field>
                  </v-col>
                  <v-col>
                    <v-checkbox
                        v-model="loginReq.admin"
                        label="Admin"
                    ></v-checkbox>
                  </v-col>
                </v-row>
                <v-row class="d-flex justify-center">
                  <v-btn outlined text tile
                         @click="login"
                  >
                    {{ items[tab] }}
                  </v-btn>
                </v-row>
              </v-container>
            </v-form>
          </template>
          <template v-if="tab === 1">
            <v-form>
              <v-container>
                <v-row>
                  <v-col
                      cols="12"
                  >
                    <v-text-field
                        v-model="signupReq.name"
                        label="Name"
                        type="text"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="signupReq.email"
                        label="E-mail"
                        type="email"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="signupReq.password"
                        label="Password"
                        type="password"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="signupReq.street"
                        label="Street"
                        type="text"
                        required
                    ></v-text-field>
                    <v-text-field
                        v-model="signupReq.phone"
                        label="Phone"
                        type="text"
                        required
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row class="d-flex justify-center">
                  <v-btn outlined text tile
                         @click="signup"
                  >
                    {{ items[tab] }}
                  </v-btn>
                </v-row>
              </v-container>
            </v-form>
          </template>
        </v-tabs-items>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
import {EventBus} from "@/main";
import {roleMixins} from "@/role-mixins";

export default {
  name: "ConnectView",
  mixins: [roleMixins],
  data: () => ({
    tab: null,
    items: [
      'Log In', 'Sign Up'
    ],
    loginReq: {
      email: '',
      password: '',
      admin: false
    },
    signupReq: {
      name: '',
      email: '',
      password: '',
      street: '',
      phone: ''
    }
  }),
  methods: {
    async login(){
      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(this.loginReq)
      };
      try {
        const res = await fetch('http://127.0.0.1:8000/api/auth/log-in',options);
        const data = await res.json();
        if (res.status === 200){
          localStorage.setItem('SIGNAL',JSON.stringify(data));
          EventBus.$emit('alert',{
            color: 'green',
            type: 'success',
            msg: 'Login correcto'
          });
          this.connected(data.role,this.loginReq.admin);
        } else {
          EventBus.$emit('alert',{
            color: 'error',
            type: 'error',
            msg: data.message
          });
        }
      } catch (e) {
        EventBus.$emit('alert',{
          color: 'white',
          type: 'success',
          msg: 'Error en login'
        });
      }
    },
    async signup(){
      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(this.signupReq)
      };
      try {
        const res = await fetch('http://127.0.0.1:8000/api/auth/sign-up',options);
        const data = await res.json();
        if (res.status === 201){
          EventBus.$emit('alert',{
            color: 'green',
            type: 'success',
            msg: data.message
          });
          this.tab = 0;
        } else {
          EventBus.$emit('alert', {
            color: 'error',
            type: 'error',
            msg: data.message
          });
        }
      } catch (e) {
        console.log(e);
      }
    },
    connected(role,adminReq){
      setTimeout( () => {
        let where = '/';
        if (adminReq && role === 'ADMIN') where = '/admin-panel';
        EventBus.$emit('changeUserStatus');
        this.$router.push(where);
      },2000);
    }
  }
}
</script>

<style scoped>
.login-container {
  min-height: 50vh;
}
</style>