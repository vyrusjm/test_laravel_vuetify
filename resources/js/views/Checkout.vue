<template>
    <v-app>
        <v-parallax
            height="300"
            src="https://cdn.vuetifyjs.com/images/parallax/material2.jpg"
        >
            <v-row
            align="center"
            justify="center"
            >
                <v-col class="text-center" cols="12">
                    <h1 class="display-1 font-weight-thin mb-4">Checkout Page</h1>
                </v-col>
            </v-row>

        </v-parallax>
        <v-container fluid>
            <v-stepper v-model="e6" vertical>
                <v-stepper-step :complete="e6 > 1" step="1">
                Confirm yours items
                </v-stepper-step>

                <v-stepper-content step="1">
                <v-card class="mb-12" height="500px">
                    <v-list>
                        <v-list-item
                            v-for="item in this.$store.state.cart" :key="item.index"
                        >
                            <v-list-item-avatar>
                                <v-img height="40" :src="'images/products/'+item.image"></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title v-text="item.name"></v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-content>
                                <h6>Quantity: {{item.qty}}</h6>
                            </v-list-item-content>
                            <v-spacer></v-spacer>
                            <v-list-item-content>
                                <h6>Price Uni: $ {{item.price}} USD</h6>
                            </v-list-item-content>
                            <v-list-item-content>
                                <h6>Price total: $ {{item.price}} USD</h6>
                            </v-list-item-content>

                        </v-list-item>
                    </v-list>


                </v-card>
                <v-btn color="primary" @click="e6 = 2">Continue</v-btn>
                <v-btn text>Cancel</v-btn>
                </v-stepper-content>

                <v-stepper-step :complete="e6 > 2" step="2">Shipping address</v-stepper-step>

                <v-stepper-content step="2">
                <v-card class="mb-12" height="320px">
                    <v-row>
                        <v-col
                        cols="12"
                        md="12"
                        >
                        <v-text-field
                            v-model="streetOne"
                            label="Street 1"
                            required
                        ></v-text-field>
                        </v-col>
                        <v-col
                        cols="12"
                        md="12"
                        >
                        <v-text-field
                            v-model="streetTwo"
                            label="Street 2"
                            required
                        ></v-text-field>
                        </v-col>
                        <v-col
                        cols="12"
                        md="4"
                        >
                        <v-text-field
                            v-model="state"
                            label="State"
                            required
                        ></v-text-field>
                        </v-col>
                        <v-col
                        cols="12"
                        md="4"
                        >
                        <v-text-field
                            v-model="door"
                            label="Door"
                            required
                        ></v-text-field>
                        </v-col>
                        <v-col
                        cols="12"
                        md="4"
                        >
                        <v-text-field
                            v-model="zip"
                            label="Zip"
                            required
                        ></v-text-field>
                        </v-col>
                    </v-row>

                </v-card>
                <v-btn color="primary" @click="e6 = 3">Continue</v-btn>
                <v-btn text @click="e6 = 1">Back</v-btn>
                </v-stepper-content>

                <v-stepper-step :complete="e6 > 3" step="3">Payment methods</v-stepper-step>

                <v-stepper-content step="3">
                <v-card class="mb-12" height="200px">
                     <v-row>
                        <v-col
                        cols="12"
                        md="6"
                        >
                        <v-text-field
                            v-model="cardName"
                            label="Name in card"
                            required
                        ></v-text-field>
                        </v-col>
                        <v-col
                        cols="12"
                        md="6"
                        >
                        <v-text-field
                            v-model="cardNumber"
                            label="Number"
                            required
                        ></v-text-field>
                        </v-col>
                        <v-col
                        cols="12"
                        md="4"
                        >
                        <v-text-field
                            v-model="cardDate"
                            label="Year"
                            required
                        ></v-text-field>
                        </v-col>
                        <v-col
                        cols="12"
                        md="4"
                        >
                        <v-text-field
                            v-model="cardCV"
                            label="CV"
                            required
                        ></v-text-field>
                        </v-col>

                    </v-row>
                </v-card>
                <v-btn color="primary" @click="e6 = 4">Continue</v-btn>
                <v-btn text @click="e6 = 2">Back</v-btn>
                </v-stepper-content>

                <v-stepper-step step="4">Confirm Order</v-stepper-step>
                <v-stepper-content step="4">
                <v-card class="mb-12" height="600px">
                    <v-row>
                        <v-col cols="12">
                            <h4>Items</h4>
                        </v-col>
                        <v-col cols="12">
                            <v-list>
                        <v-list-item
                            v-for="item in this.$store.state.cart" :key="item.index"
                        >
                            <v-list-item-avatar>
                                <v-img height="40" :src="'images/products/'+item.image"></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title v-text="item.name"></v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-content>
                                <h6>Quantity: {{item.qty}}</h6>
                            </v-list-item-content>
                            <v-spacer></v-spacer>
                            <v-list-item-content>
                                <h6>Price Uni: $ {{item.price}} USD</h6>
                            </v-list-item-content>
                            <v-list-item-content>
                                <h6>Price total: $ {{item.price}} USD</h6>
                            </v-list-item-content>

                            </v-list-item>
                        </v-list>
                        </v-col>
                        <v-col cols="12">
                            <h4>Shipping address</h4>
                        </v-col>
                        <v-col cols="12" md="6">
                            <p>Street One: {{streetOne}}</p>
                        </v-col>
                        <v-col cols="12" md="6">
                            <p>Street Two: {{streetTwo}}</p>
                        </v-col>
                        <v-col cols="12" md="4">
                            <p>State: {{state}}</p>
                        </v-col>
                        <v-col cols="12" md="4">
                            <p>Door: {{door}}</p>
                        </v-col>
                        <v-col cols="12" md="4">
                            <p>Zip: {{zip}}</p>
                        </v-col>
                        <v-col cols="12">
                            <h4>Payment methods</h4>
                        </v-col>
                        <v-col cols="12" md="6">
                            <p>Name: {{cardName}}</p>
                        </v-col>
                        <v-col cols="12" md="6">
                            <p>Number: {{cardNumber}}</p>
                        </v-col>
                        <v-col cols="12" md="4">
                            <p>Year: {{cardDate}}</p>
                        </v-col>
                        <v-col cols="12" md="4">
                            <p>Zip: {{cardCV}}</p>
                        </v-col>
                    </v-row>



                </v-card>
                <v-btn color="primary" >Process payment</v-btn>
                <v-btn text @click="e6 = 3">Back</v-btn>
                </v-stepper-content>
            </v-stepper>
        </v-container>
    </v-app>
</template>
<script>
  export default {
      name:'checkout',
    data () {

      return {
        e6: 1,
        streetOne: '',
        streetTwo: '',
        state:'',
        door:'',
        zip:'',
        cardName:'',
        cardNumber:'',
        cardDate:'',
        cardCV:'',
      }
    },
  }
</script>
