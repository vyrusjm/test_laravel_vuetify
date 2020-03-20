<template>
  <div>
    <v-app-bar
      color="primary"
      dark
    >
      <v-spacer></v-spacer>

      <v-toolbar-title>Sungalsses</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn class="ma-2" tile color="primary" @click="showMyCart">
        <v-icon left>mdi-cart</v-icon> CART
      </v-btn>

      <v-menu
        left
        bottom
      >
        <template v-slot:activator="{ on }">
          <v-btn icon v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item
            :to="{name:'catalogPage'}"
          >
            <v-list-item-title>Catalog</v-list-item-title>
          </v-list-item>
          <v-list-item
            :to="'/admin/products'"
          >
            <v-list-item-title>Admin Products</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
  </div>

</template>

<script>
export default {
    name:'app-bar',

    methods:{
        showMyCart(){
            $('#cartModal').modal('show');
        }
    }
}
</script>
