<template>
    <div>
        <div class="modal" id="cartModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">My Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li v-for="item in this.$store.state.cart" :key="item.index">
                            <div class="row">
                                <div class="col-md-3">
                                    <v-img
                                        height="80"
                                        :src="'images/products/'+item.image"
                                    ></v-img>
                                </div>
                                <div class="col-md-3">
                                    <p v-text="item.name"></p>
                                </div>
                                <div class="col-md-3">
                                    <p>$ {{item.price}} USD</p>
                                </div>
                                <div class="col-md-3">
                                    <p>Qty: {{item.qty}}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue Shopping</button>
                    <button type="button" class="btn btn-primary" @click="goToCheckout">Checkout</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'cart',

    methods:{
        goToCheckout(){
            $('#cartModal').modal('hide');
            this.$router.push({name: 'checkout'})
        }
    }
}
</script>

