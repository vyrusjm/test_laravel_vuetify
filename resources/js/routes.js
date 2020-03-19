import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import Home from './views/HomeView'
import Catalog from './views/CatalogView'
import Product from './views/ProductView'
import AdminProducts from './views/AdminProductsView'
import AdminUsers from './views/AdminUsersView'

export default new VueRouter ({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/catalog',
            name: 'catalog',
            component: Catalog
        },
        {
            path: ':slug',
            name: 'product',
            component: Product,
            props: true
        },
        {
            path: '/admin/products',
            name: 'admin-products',
            component: AdminProducts
        },
        {
            path: '/admin/users',
            name: 'admin-users',
            component: AdminUsers
        },
        {
            path: '*',
            component: require('./views/404'),
        },
    ],
    mode:'history'
})
