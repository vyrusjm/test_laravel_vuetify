<template>
   <v-app>
       <v-list>
            <v-list-item
                v-for="item in this.$store.state.cart" :key="item.index"
            >
                <v-row>
                    <v-col cols="12" md="2">
                        <v-list-item-avatar>
                            <v-img height="40" :src="'images/products/'+item.image"></v-img>
                        </v-list-item-avatar>
                    </v-col>
                    <v-col cols="12" md="5">
                        <v-list-item-content>
                            <v-list-item-title v-text="item.name"></v-list-item-title>
                        </v-list-item-content>
                    </v-col>
                    <v-col cols="12" md="2">
                        <h6>Quantity: {{item.qty}}</h6>
                    </v-col>
                    <v-col cols="12" md="2">
                        <h6>Price: $ {{item.price}} USD</h6>
                    </v-col>
                    <v-col cols="12" md="1">
                        <v-btn
                            @click="$store.commit('removeFromCart',item)"
                            icon
                            color="gray">
                            <v-icon left>mdi-delete-forever</v-icon>
                        </v-btn>
                    </v-col>
                </v-row>
            </v-list-item>
            <p>
                Total Price : {{ this.$store.getters.totalPrice }}
            </p>
        </v-list>
   </v-app>
</template>
<script>
export default {
    name:'list-checkout'
}
</script>
