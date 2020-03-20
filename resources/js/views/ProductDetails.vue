<template>
    <v-app>
        <v-container fluid>
            <v-row v-if="product">
                <v-col cols="12" sm="12" md="6">
                    <v-card
                        class="mx-auto no-border"
                        outlined
                        tile
                    >
                       <v-img :src="'/images/products/'+product.image" aspect-ratio="1.7"></v-img>
                    </v-card>
                </v-col>
                <v-col cols="12" sm="12" md="6">
                    <v-card
                        class="mx-auto no-border"
                        outlined
                        tile
                    >
                        <v-card-text>
                        <h1 class="text--primary font-weight-black">
                            {{product.name}}
                        </h1>

                            <v-rating
                                half-increments
                                v-model="rating"
                                color="yellow"
                            >
                            </v-rating>

                        <h2 class="text--primary font-weight-bold">$ {{product.price}} <small>USD</small></h2>
                        <v-col class="ma-0 pa-0" cols="12" sm="4">
                            <v-select
                            :items="items"
                            label="Quantity"
                            outlined
                            ></v-select>
                        </v-col>

                        <v-card-actions>
                            <v-container class="ma-0 pa-0">
                                <v-btn  tile color="primary">
                                    ADD TO CART
                                    <v-icon right>mdi-plus</v-icon>
                                </v-btn>
                                <v-btn tile outlined color="primary">
                                    CHECKOUT
                                    <v-icon right>mdi-chevron-right</v-icon>
                                </v-btn>
                            </v-container>
                        </v-card-actions>
                        <h5 class="text--primary font-weight-black mt-5 mb-5">
                            100% NO-RISK MONEY BACK GUARANTEE
                        </h5>
                        <h4 class="text--primary font-weight-regular" v-text="product.description">

                        </h4>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>
<script>
  export default {
      name:'product-details',
    data: () => ({
      items: [1, 2, 3, 4,5,6],
      product: null,
    }),

    created() {
        if (this.products.length) {
            this.product = this.product.find((product) => product.slug == this.$route.params.slug);
        } else {
            axios.get('/api/products/'+this.$route.params.slug)
                .then((response) => {
                    this.product = response.data.data
                })
                .catch((error) => {
                    console.log(error.response);
                });
        }
    },
    computed: {
        products() {
            return this.$store.getters.products;
        },
        rating(){
            const min = 0;
            const max = 5;
            return Math.random() * (max - min) + min;
        }
    }
  }
</script>

<style scope>
    .no-border{
        border: none !important;
    }
</style>
