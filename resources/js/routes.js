import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import Catalog from './views/CatalogView'
import Product from './views/ProductDetails'
import AdminUsers from './views/admin/AdminUsersView'
import AdminProducts from './views/admin/products/Main'
import ProductsList from './views/admin/products/List'


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
