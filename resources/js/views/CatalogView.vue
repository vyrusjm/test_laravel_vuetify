<template>
    <v-app>
        <v-container fluid>
            <v-row>
                <v-col
                v-for="product in products" :key="product.id"
                cols="12" sm="12" md="4">
                    <v-hover
                        v-slot:default="{ hover }"
                        open-delay="200"
                    >
                        <v-card
                            :elevation="hover ? 16 : 2"
                            class="mx-auto my-12"
                            max-width="374"
                        >
                            <v-img
                            height="250"
                            :src="'images/products/'+product.image"
                            ></v-img>

                            <v-card-title class="text-capitalize" v-text="product.name"></v-card-title>

                            <v-card-text>
                                <div class="my-4 subtitle">
                                <h4 class="font-weight-black black--text">$ {{product.price}} USD</h4>
                                </div>
                            <v-row
                                align="center"
                                class="mx-0"
                            >
                                <v-rating
                                :value="4.5"
                                color="amber"
                                dense
                                half-increments
                                readonly
                                size="14"
                                ></v-rating>

                                <div class="grey--text ml-4">4.5</div>
                            </v-row>
                            </v-card-text>

                            <v-card-actions>

                            <v-btn
                            small
                            color="primary"
                            class="white--text"
                            @click="addToCart({
                                name: product.name,
                                image: product.image,
                                price: product.price,
                                id: product.id,
                                qty: 1,
                                })"
                            >
                            ADD TO CART
                            <v-icon right x-small>mdi-plus-thick</v-icon>
                            </v-btn>
                            <v-btn
                            small
                            outlined
                            color="primary"
                            :to="{name: 'product', params: {slug: product.slug}}"
                            >
                            PRODUCT DETAILS
                            <v-icon right x-small color="primary">mdi-chevron-right</v-icon>
                            </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-hover>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
  export default {
    data: () => ({

      selection: 1,

    }),
    mounted() {
        this.$store.dispatch('getProducts');
    },

    methods: {
      reserve () {
        this.loading = true;

        setTimeout(() => (this.loading = false), 2000);
      },
      addToCart(data){
          $('#cartModal').modal('show');
          this.$store.commit('addToCart', data);
      },

    },

    computed: {
        products() {
            return this.$store.getters.products.data;
        }
    }
  }
</script>
