import {http} from "./http_service";

export function getComboMeal(){
    return http().get('/combomeals');
}

export function getBurger() {
    return http().get("/burgers");
}

export function getBeverages() {
    return http().get("/beverages");
}

export function createOrder(data) {
    return http().post(`/createOrder`, data);
}

export function displayOrders() {
    return http().get('/orders');
}
