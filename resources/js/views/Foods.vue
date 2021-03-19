<template>
    <div class="wrapper">
        <b-container fluid>
            <!-- Content here -->
            <b-card title="Foods List" class="mb-2">
                <b-row>
                    <b-col md="7" class="foods">
                        <b-row>
                            <b-col sm="12">
                                <h4>Combo meals</h4>
                                <hr>
                            </b-col>
                            <b-col sm="12" class="meals">
                                <b-card class="meal " style="max-width: 400rem; width: 400px" v-for="(meal, index) in ComboMeal_list" :key="index">
                                    <b-card-text>
                                        {{meal.name}}<br/><small>Price: {{meal.price}}</small>
                                    </b-card-text>

                                    <b-button href="#" size="sm" variant="primary" @click="addOrder(meal)">Add</b-button>
                                </b-card>
                            </b-col>
                        </b-row>
                        <b-row>
                            <b-col sm="12">
                                <h4>Burgers</h4>
                                <hr>
                            </b-col>
                            <b-col sm="12" class="meals">
                                <b-card class="meal " style="max-width: 400rem; width: 400px" v-for="(burger, index) in burger_list" :key="index">
                                    <b-card-text>
                                        {{burger.name}}<br/><small>Price: {{burger.price}}</small>
                                    </b-card-text>

                                    <b-button href="#" size="sm" variant="primary" @click="addOrder(burger)">Add</b-button>
                                </b-card>
                            </b-col>
                        </b-row>
                        <b-row>
                            <b-col sm="12">
                                <h4>Beverages</h4>
                                <hr>
                            </b-col>
                            <b-col sm="12" class="meals">
                                <b-card class="meal " style="max-width: 400rem; width: 400px" v-for="(beverage, index) in beverages_list" :key="index">
                                    <b-card-text>
                                        {{beverage.name}}<br/><small>Price: {{beverage.price}}</small>
                                    </b-card-text>

                                    <b-button href="#" size="sm" variant="primary" @click="addOrder(beverage)">Add</b-button>
                                </b-card>
                            </b-col>
                        </b-row>
                    </b-col>
                    <b-col>
                        <h5>Total Order</h5>
                        <Receipt :orderData = "orderData"  @addOrder="createOrder" />
                    </b-col>
                </b-row>
            </b-card>
        </b-container>
    </div>
</template>
<script>
import * as order_service from '../services/order_service.js';
import Receipt from '../components/Receipt';
export default {
    name: "Foods",
    components: {
        Receipt
    },
    data() {
        return {
             ComboMeal_list: [],
             burger_list: [],
             beverages_list: [],
             orderData: {
                name: '',
                price: 0
            },

        }
    },
    mounted() {
        this.loadComboMeal();
        this.loadBurger();
        this.loadBeverages();
    },
    methods: {
        loadComboMeal: async function() {
            try {
                const response = await order_service.getComboMeal();
                this.ComboMeal_list = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        loadBurger: async function() {
            try {
                const response = await order_service.getBurger();
                this.burger_list = response.data;
            } catch (error) {
                console.log(error);
            }
        },
        loadBeverages: async function() {
            try {
                const response = await order_service.getBeverages();
                this.beverages_list = response.data;
            } catch (error) {
                console.log(error)
            }
        },
        addOrder(data) {
            this.orderData = {
                name: data.name,
                price: data.price
            }
        },
        createOrder: async function(orders, totalPrice, coupon, tax) {
            console.log(orders);
            console.log(totalPrice);
            console.log(tax);
            let fromData = new FormData();
            fromData.append('order', JSON.stringify(orders));
            fromData.append('price', totalPrice);
            fromData.append('coupon', coupon);
            fromData.append('tax', tax);
            try {
                const response = await order_service.createOrder(fromData);
                this.flashMessage.success({
                    message: 'Order Created Successfully!'
                });
                console.log(response);
            } catch (error) {
                switch (error.response.status) {
                    case 500:
                        this.flashMessage.error({
                                message: 'Invalid coupon!'
                            });
                        break;
                    case 422:
                        this.flashMessage.error({
                                message: 'Please Add Order'
                            });
                        break;
                    default:
                        this.flashMessage.error({
                            message: "Some error occured!",
                            time: 4000,
                        });
                        break;
                }
            }
        }
    },
}
</script>
