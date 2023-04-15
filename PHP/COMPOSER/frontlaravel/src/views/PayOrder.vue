<template>
  <v-row class="d-flex align-center" style="height: 50%">
    <v-col cols="8">
      <v-card class="pa-10" elevation="0">
        <v-card-title>
          <span class="text-h5">Order invoice #SIG_{{order.id}}</span>
        </v-card-title>
        <v-card-text>
          <template>
            <v-simple-table >
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
                    v-for="line in lines"
                    :key="line.id"
                >
                  <td>{{ line.name }}</td>
                  <td>{{ line.quantity }} u.</td>
                  <td>{{ line.disc_price }}€</td>
                  <td>{{ line.subtotal }}€ </td>
                </tr>
                </tbody>
              </template>
            </v-simple-table>
          </template>
          <div style="width: 92%" class="d-flex justify-end mt-10">
            <strong class="mr-2">TOTAL:</strong>{{order.total}}€
          </div>
        </v-card-text>
      </v-card>
    </v-col>
    <v-col cols="4">
      <v-card tile class="pa-10 mr-10" outlined style="border: solid 1px black">
        <v-row class="fill-height d-flex justify-center">
            <v-container>
                <template>
                    <div class="mt-3">
                        <stripe-element-card
                                ref="stripeRef"
                                :hidePostalCode="true"
                                :pk="stripeApiKeyPub"
                                @token="tokenCreated"
                        />
                    </div>
                </template>
                <v-btn @click="pay()">PAY</v-btn>
            </v-container>
        </v-row>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import { StripeElementCard } from '@vue-stripe/vue-stripe';
import {EventBus} from "@/main";
import {roleMixins} from "@/role-mixins";
const stripeApiKeyPub = process.env.VUE_APP_STRIPE_PUB;
export default {
  name: "PayOrder",
  components: {
    StripeElementCard,
  },
  mixins: [roleMixins],
  data() {
      return {
          stripeToken: null,
          stripeApiKeyPub: stripeApiKeyPub,
          order: {},
          lines: []
      }
  },
  mounted() {
      //this.stripe = this.$refs.stripe.elements;
  },
  created() {
    this.checkOrder(this.$route.params.orderId);
  },
  methods: {
    tokenCreated(token) {
        console.log("se ha generado el tkn")
        console.log(token)
      this.stripeToken = token;
    },
    async checkOrder(orderId){
      try {
        const res = await fetch('http://127.0.0.1:8000/api/order/check/'+orderId,{
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+this.getToken()
          },
          method: 'GET'
        });
        const data = await res.json();
        console.log(data)
        if (res.status === 200){
          this.order = data.order;
          this.lines = data.lines;
        } else {
          EventBus.$emit('alert', {
            color: 'error',
            type: 'error',
            msg: data.message
          });
          await this.$router.push("/");
        }
      } catch (e) {
        console.log(e);
        await this.$router.push("/");
      }
    },
    pay(){
        console.log("se ha pulsado pagar")
        this.$refs.stripeRef.submit();
    }
  }
}
</script>

<style scoped>

</style>