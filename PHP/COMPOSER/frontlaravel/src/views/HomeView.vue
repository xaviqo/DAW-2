<template>
  <div>
    <template>
      <v-row class="pa-12 mr-5">
        <v-col
            v-for="disc in discs"
            :key="disc.id"
            class="d-flex child-flex mt-4"
            cols="2"
        >
          <v-row>
            <v-card elevation="0" tile outlined>
                <v-img
                    :src="`http://127.0.0.1:8000/api/disc/img/${disc.id}`"
                    aspect-ratio="1"
                    class="grey lighten-2"
                    style="border: solid 1px black !important;"
                >
                  <template v-slot:placeholder>
                    <v-row
                        class="fill-height ma-0"
                        align="center"
                        justify="center"
                    >
                      <v-progress-circular
                          indeterminate
                          color="grey lighten-5"
                      ></v-progress-circular>
                    </v-row>
                  </template>
                  <v-row class="fill-height">
                    <v-col class="d-flex justify-start align-end">
                      <v-btn
                          color="white"
                          elevation="1"
                          class="ml-4 pa-2"
                          tile
                          dark
                          style="background-color: rgba(0,0,0,.7) !important; border: 1px solid white; cursor: default !important;"
                      >
                        {{ disc.price }}€
                      </v-btn>
                    </v-col>
                    <v-col class="d-flex justify-end align-end">
                      <v-btn
                          color="white"
                          elevation="1"
                          class="mr-4 pa-2"
                          tile
                          dark
                          style="background-color: rgba(0,0,0,.7) !important; border: 1px solid white"
                          @click="addToCart(disc)"
                      >
                        <v-icon>
                          mdi-cart-arrow-down
                        </v-icon>
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-img>
                <v-card-title style="border: solid 1px black !important;">
                  {{ disc.name }}
                </v-card-title>
            </v-card>
          </v-row>
        </v-col>
      </v-row>
    </template>
    <ShoppingCart :items="cart"></ShoppingCart>
  </div>
</template>
<script>
  import {EventBus} from "@/main";
  import ShoppingCart from "@/components/ShoppingCart.vue";

  export default {
    name: 'Home',
    components: {ShoppingCart},
    data: () => ({
      discs: [],
      cart: []
    }),
    created() {
      this.loadDiscs();
    },
    methods:{
      addToCart(disc){
        this.cart.push(disc);
      },
      async loadDiscs(){
        try {
          const res = await fetch('http://127.0.0.1:8000/api/disc/all-discs',{
            headers: {
              'Content-Type': 'application/json',
              'method': 'POST'
            }
          });
          const data = await res.json();
          if (res.status === 200){
            this.discs = data.discs;
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
      }
    }
  }
</script>
