import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state:{
        count:0
    },
    getters:{

    },
    mutations: {
       incement(state) {
           state.count++
       } ,

       decremente(state){
           state.count--
       }
    },
    actions:{}
})

export default store
