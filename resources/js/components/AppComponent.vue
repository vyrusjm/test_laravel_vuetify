<template>
<div>

    <v-toolbar app>

    <ul class="d-flex">
        <li class="text-uppercase"><router-link :to="{name:'home'}" >Home</router-link></li>
        <li class="text-uppercase"><router-link :to="{name:'catalog'}" >Products</router-link></li>
        <li class="text-uppercase"><router-link :to="{name:'home'}" >Blog</router-link></li>
        <li class="text-uppercase"><router-link :to="{name:'home'}" >Contact</router-link></li>
    </ul>

      <v-toolbar-title>Title</v-toolbar-title>

      <v-spacer></v-spacer>




      <v-btn icon>
        <v-icon>mdi-cart</v-icon>
      </v-btn>
    </v-toolbar>


    <router-view></router-view>

</div>
</template>


