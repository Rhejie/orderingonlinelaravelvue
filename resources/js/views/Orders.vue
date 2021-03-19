<template>
    <div class="wrapper">
        <b-container>
            <!-- Content here -->
            <b-card title="Order Summary" class="mb-2">
                <b-card class="mb-2" v-for="(order, index) in orders" :key="index">
                    <b-card-text>
                        <b-row>
                            <b-col sm="10">
                                <b-row v-for="(o, index) in JSON.parse(order.order)" :key="index">
                                    <b-col sm="12">
                                        <b-row>
                                            <b-col>
                                                <p><strong>{{o.name}}</strong></p>
                                            </b-col>
                                            <b-col>
                                                <p><strong>Price: </strong>{{o.price}}</p>
                                            </b-col>
                                            <b-col>
                                                <p><strong>Tax (12%): </strong>{{o.price | tax}}</p>
                                            </b-col>
                                        </b-row>
                                    </b-col>
                                </b-row>
                            </b-col>
                            <b-col sm="2">
                                <p><strong>Coupon: </strong> <small>{{order.coupon}}</small></p>
                                <p><strong>Total Tax: </strong><small>{{order.tax}}</small></p>
                                <p><strong>Total price: </strong><small>{{order.price}}</small></p>
                            </b-col>
                        </b-row>
                    </b-card-text>
                </b-card>
            </b-card>
        </b-container>
    </div>
</template>
<script>
import * as order_service from '../services/order_service';
export default {
    name: "Orders",
    data() {
        return {
            orders: []
        }
    },
    filters: {
        tax(value) {
            let val = value * 0.12;
            return val.toFixed(2);
        }
    },
    mounted() {
        this.loadOrders();
    },
    methods: {
        loadOrders: async function() {
            try {
                const response = await order_service.displayOrders();
                this.orders = response.data;
                console.log(response);
            } catch (error) {
                console.log(error)
            }
        }
    },
}
</script>
