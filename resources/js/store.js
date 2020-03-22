import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

let cart = window.localStorage.getItem('cart');

const store = new Vuex.Store({
    state:{
        users:[],
        products: [],
        cart: cart ? JSON.parse(cart) : [],

    },
    getters:{
        products(state) {
            return state.products;
        },
        users(state) {
            return state.users;
        },
        totalPrice: state => {
            let total = 0;
            state.cart.filter((item) => {
                total += (item.price * item.qty);
            });
            return total;
        }
    },
    mutations: {
        updateProducts(state, payload) {
            state.products = payload;
        },
        updateUsers(state, payload) {
            state.users = payload;
        },
        addToCart(state, item){
            let found = state.cart.find(product => product.id == item.id);
            if(found){
                found.qty++;
            }else{
                state.cart.push(item);
            }
            this.commit('saveData');
        },
        saveData(state){
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
        },
        removeFromCart(state, item){
            let index = state.cart.indexOf(item);
            state.cart.splice(index,1);
            this.commit('saveData');
        },
    },
    actions:{
        getProducts(context) {
            axios.get('/api/products')
            .then((response) => {
                context.commit('updateProducts', response.data);
            }).catch((error) => {
                console.log(error.response);
            });
        },
        getUsers(context) {
            axios.get('/api/users')
            .then((response) => {
                context.commit('updateUsers', response.data);
            }).catch((error) => {
                console.log(error.response);
            });
        }
    }
})

export default store
