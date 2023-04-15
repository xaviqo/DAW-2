<template>
  <div>
    <v-navigation-drawer
        absolute
        expand-on-hover
        right
        style="border-left: 1px solid black"
        clipped
        @transitionend="onTransitionEnd"
    >
          <v-list-item two-line>
              <v-list-item-content>
                <v-list-item-title>
                  <v-icon>mdi-cart</v-icon>
                  Shopping Cart
                </v-list-item-title>
                <v-list-item-subtitle class="mt-1">Total: {{total}}€</v-list-item-subtitle>
              </v-list-item-content>
          </v-list-item>

        <v-divider></v-divider>

        <v-list dense>
          <v-list-item
              v-for="disc in cart"
              :key="disc.id"
          >
            <v-list-item-icon>
              <v-icon>mdi-disc</v-icon>
            </v-list-item-icon>
            <v-list-item-content class="ml-n6">
              <v-row>
                <v-col cols="8">
                  <v-list-item-title>{{ disc.title }}</v-list-item-title>
                  <v-list-item-subtitle>{{ disc.artist }}</v-list-item-subtitle>
                </v-col>
                <v-col cols="4">
                  {{disc.units}} u.
                </v-col>
              </v-row>
            </v-list-item-content>
          </v-list-item>
        </v-list>
        <v-list>
          <v-col cols="12">
            <v-list-item>
              <v-list-item-content>
                <v-col cols="6" class="d-flex justify-center">
                  <v-btn outlined tile @click="emptyCart()" :disabled="disableButtons">
                    Empty
                  </v-btn>
                </v-col>
                <v-col cols="6" class="d-flex justify-center">
                  <v-btn outlined tile :disabled="disableButtons" @click="confirm.open = true">
                    Buy
                  </v-btn>
                </v-col>
              </v-list-item-content>
            </v-list-item>
          </v-col>
        </v-list>
    </v-navigation-drawer>

    <!-- CONFIRM BUY -->

    <template>
      <v-row justify="center">
        <v-dialog
            v-model="confirm.open"
            max-width="1000px"
        >
          <v-card>
            <v-card-title>
              <span class="text-h5">Check your order</span>
            </v-card-title>
            <v-card-text>
              <template>
                <v-simple-table>
                  <template v-slot:default>
                    <thead>
                    <tr>
                      <th class="text-left">
                        Disc
                      </th>
                      <th class="text-left">
                        Units
                      </th>
                      <th class="text-left">
                        Unit price
                      </th>
                      <th class="text-left">
                        Subtotal
                      </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-for="item in cart"
                        :key="item.name"
                    >
                      <td>{{ item.artist }} -  {{ item.title }}</td>
                      <td>{{ item.units }} u.</td>
                      <td>{{ item.price }}€</td>
                      <td>{{ parseFloat((item.price*item.units).toFixed(2)) }}€ </td>
                    </tr>
                    </tbody>
                  </template>
                </v-simple-table>
              </template>
              <div style="width: 95%" class="d-flex justify-end mt-10">
                <strong>TOTAL:</strong>{{total}}€
              </div>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                  color="secondary"
                  text
                  outlined
                  tile
                  @click="confirm.open = false"
              >
                Close
              </v-btn>
              <v-btn
                  color="primary"
                  text
                  outlined
                  tile
                  @click="createOrder()"
              >
                Confirm
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
    </template>


  </div>
</template>

<script>
import {EventBus} from "@/main";
import {roleMixins} from "@/role-mixins";

export default {
  name: "ShoppingCart",
  mixins: [roleMixins],
  props: {
    items: {
      required: true,
      type: Array,
    },
  },
  watch: {
    items: function () {
      this.updateCart();
    }
  },
  data: () => ({
    drawer: false,
    total: 0,
    cart: [],
    disableButtons: true,
    confirm: {
      open: false
    }
  }),
  methods: {
    async createOrder(){
      try {
        const res = await fetch('http://127.0.0.1:8000/api/order/create',{
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+this.getToken()
          },
          method: 'POST',
          body: JSON.stringify(this.cart)
        });
        const data = await res.json();
        if (res.status === 201){
          EventBus.$emit('alert', {
            color: 'success',
            type: 'success',
            msg: data.message
          });
          this.$router.push('/pay/'+data.orderId)
        } else {
          EventBus.$emit('alert', {
            color: 'error',
            type: 'error',
            msg: 'Error creating order'
          });
        }
      } catch (e) {
        console.log(e);
      }
    },
    updateCart(){
      this.total = 0;
      this.items.forEach( disc => {
        this.total+=disc.price;
      });
      this.total = parseFloat(this.total.toFixed(2));

      const lastDisc = this.items[this.items.length -  1];
      const index = this.cart.findIndex(
          disc => disc.id === lastDisc.id
      );

      const titleAndArtist = lastDisc.name.split("-")

      if (index !== -1){
        this.cart[index].units += 1;
      } else {
        this.cart.push({
          units: 1,
          id: lastDisc.id,
          artist: titleAndArtist[0].trim(),
          title: titleAndArtist[1].trim(),
          price: lastDisc.price,
        });
      }
      this.disableButtons = (this.items.length < 1)
    },
    emptyCart(){
      // arreglar items no se vacía
      this.total = 0;
      this.items = [];
      this.cart = [];
      this.disableButtons = true;
    },
    onTransitionEnd(em){
      console.log(em)
    }
  }
}
</script>

<style scoped>

</style>