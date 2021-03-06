import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import Catalog from './views/CatalogView'
import Product from './views/ProductDetails'
import AdminUsers from './views/admin/users/Main'
import UsersList from './views/admin/users/List'
import AdminProducts from './views/admin/products/Main'
import ProductsList from './views/admin/products/List'
import Checkout from './views/Checkout'


export default new VueRouter ({
    routes: [
        {
            path: '/',
            name: 'catalogPage',
            component: Catalog,
        },
        {
            path: '/product-details/:slug',
            name: 'product',
            component: Product,
            props: true
        },
        {
            path: '/admin/products',
            component: AdminProducts,
            children: [
                {
                    path: '/',
                    name:'list-products',
                    component: ProductsList
                },
            ]
        },
        {
            path: '/admin/users',
            component: AdminUsers,
            children: [
                {
                    path: '/',
                    name:'list-users',
                    component: UsersList
                },
            ]
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout
        },
        {
            path: '*',
            component: require('./views/404'),
        },
    ],
    mode:'history'
})
