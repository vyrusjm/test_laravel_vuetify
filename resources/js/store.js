import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state:{
        users:[],
        products: [],
        cart:[]

    },
    getters:{
        products(state) {
            return state.products;
        },
        users(state) {
            return state.users;
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
        }
    },
    actions:{

        getProducts(context) {
            axios.get('/api/products')
            .then((response) => {
                context.commit('updateProducts', response.data);
            })
        },
        getUsers(context) {
            axios.get('/api/users')
            .then((response) => {
                context.commit('updateUsers', response.data);
            })
        }

    }
})

export default store
