import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state:{
        products: [],

    },
    getters:{
        products(state) {
            return state.products;
        },
    },
    mutations: {
        updateProducts(state, payload) {
            state.products = payload;
        },
    },
    actions:{

        getProducts(context) {
            axios.get('/api/products')
            .then((response) => {
                context.commit('updateProducts', response.data);
            })
        },

    }
})

export default store
