<template>
    <v-app>
        <v-container fluid>
            <router-view></router-view>
        </v-container>
        <app-cart></app-cart>
    </v-app>
</template>
<script>
    export default {
        name: 'admin-users'
    }
</script>
