<template>
    <div>
        <b-row>
            <b-col sm="2">
                <label for="input-small">Coupon:</label>
                </b-col>
            <b-col sm="10">
                <b-form-input id="input-small" class="form-control" v-model="coupon" @keyup="couponData" size="sm" placeholder="Enter your Coupon"></b-form-input>
            </b-col>
            <b-col sm="12">
                <table class="table table-borderless">
                    <thead>
                        <th>Order</th>
                        <th>Price </th>
                        <th>Tax (12%) </th>
                        <th>Total </th>
                    </thead>
                    <tbody>
                        <tr v-for="(order, index) in orders" :key="index">
                            <td>{{order.name}}</td>
                            <td>{{order.price}}</td>
                            <td>{{order.price | tax}}</td>
                            <td>{{order.price | totalprice}}</td>
                        </tr>
                    </tbody>
                </table>
            </b-col>
        </b-row>
        <hr>
        <b-row>
            <b-col>Total Price<small v-if="coupon == 'GO2018'"> Discouted by 10%</small>: </b-col>
            <b-col>{{totalPrice}}</b-col>
        </b-row>
        <hr>
        <div>
            <b-button variant="danger" class="" @click="order">Place Order</b-button>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        orderData: {
            type: Object,
            require: true
        },
    },
    data() {
        return {
            orders: [],
            totalOrderedPrice: 0,
            totalTax: 0,
            totalOrder: 0,
            coupon: ''
        }
    },
    watch: {
        orderData(oldOrderData, newOrderData) {
            if(oldOrderData != newOrderData) {
                this.totalTax = this.totalTax + (this.orderData.price * 0.12);
                this.totalOrder = this.totalOrder + this.orderData.price;
                return this.orders.push({name: this.orderData.name, price: this.orderData.price}) + this.totalOrder;
            }
        },
    },
    filters: {
        tax(value) {
            let val = value * 0.12;
            return val.toFixed(2);
        },
        totalprice(value) {
            let val = value * 0.12;
            let subtotal = value + val;
            return subtotal.toFixed(2);
        }
    },
    computed: {
        totalPrice() {
            if(this.coupon == 'GO2018') {
                let taxTotal = this.totalTax;
                let subtotal = this.totalOrder;
                let total = subtotal + taxTotal;
                this.totalOrderedPrice = total - (total * 0.10);
                return (this.totalOrderedPrice).toFixed(2)
            }
            else {
                let taxTotal = this.totalTax;
                let subtotal = this.totalOrder;
                let total = subtotal + taxTotal;
                return this.totalOrderedPrice = total.toFixed(2);
            }

        }
    },
    mounted() {

    },
    methods: {
        order() {
            this.$emit("addOrder", this.orders, this.totalOrderedPrice, this.coupon, this.totalTax);
            this.orders = [];
        },
        couponData() {
            if(this.coupon == 'GO2018') {

            }
        }
    },
}
</script>
