<template>
    <v-app>
        <v-container fluid>
            <v-row>
                <v-col cols="12">
                    <v-card
                        :loading="loading"
                        class="mx-auto my-12"
                        max-width="374"
                    >
                        <v-img
                        height="250"
                        src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
                        ></v-img>

                        <v-card-title>Cafe Badilico</v-card-title>

                        <v-card-text>
                            <div class="my-4 subtitle">
                                $59.95 USD
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

                            <div class="grey--text ml-4">4.5 (413)</div>
                        </v-row>
                        </v-card-text>

                        <v-card-actions>

                        <v-btn
                        color="success"
                        class="white--text"
                        >
                        ADD TO CART
                        <v-icon right x-small>mdi-plus-thick</v-icon>
                        </v-btn>
                        <v-btn
                        outlined
                        color="success"
                        :to="{name:'home'}"
                        >
                        PRODUCT DETAILS
                        <v-icon right x-small color="success">mdi-chevron-right</v-icon>
                        </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
  export default {
    data: () => ({
      loading: false,
      selection: 1,
    }),

    methods: {
      reserve () {
        this.loading = true

        setTimeout(() => (this.loading = false), 2000)
      },
    },
  }
</script>
