<template>
    <div class="products">
        <h1>Список товаров</h1>
        <ul>
            <li v-if="category.existsAvailableGoods" v-for="category in products">
                <div>{{category.G}}</div>
                <ol>
                    <li v-for="(product, goodId) in category.B" v-if="product.count">
                        <span>{{product.N}}</span><br>
                        <span>В наличие: {{product.count}}</span><br>
                        <span :class="{'red': product.priceDiff > 0, 'green': product.priceDiff < 0}">Цена {{product.price}}</span>
                    </li>
                </ol>
            </li>
        </ul>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                products: [],
            }
        },
        created() {
            this.loadProductsList();
        },
        methods: {
            loadProductsList() {
                axios
                    .get("/names.json")
                    .then((response) => {
                        let products = response.data;
                        axios
                            .get("/data.json")
                            .then((response) => {
                                let currencyValue = 64.25;

                                this.offers = response.data.Value.Goods;
                                this.offers.forEach((offer) => {
                                    let categoryId = offer.G;
                                    let productId = offer.T;
                                    if (products[categoryId]['B'][productId]) {
                                        products[categoryId]['B'][productId]['count'] = offer.P;
                                        products[categoryId]['B'][productId]['price'] = offer.C * currencyValue;
                                        products[categoryId]['existsAvailableGoods'] = true;
                                    }
                                });

                                this.products = products;
                                setTimeout(() => {
                                    this.loadProductsList()
                                }, 15000);
                            })
                            .catch((error) => {
                                console.log(error)
                            });

                    })
                    .catch(error => console.log(error));
            }
        },
        watch: {
            products: function (newValue, oldValue) {
                Object.keys(newValue).forEach(function (categoryId) {
                    Object.keys(newValue[categoryId]['B']).forEach(function (productId) {
                        let newPrice = newValue[categoryId]['B'][productId]['price'];
                        let oldPrice = oldValue[categoryId]['B'][productId]['price'];
                        newValue[categoryId]['B'][productId]['priceDiff'] = newPrice - oldPrice;
                    });
                })
                //тут дожен быть emit
            },
            deep: true,
            //immediate: false
        }
    }
</script>

<style scoped>
    .products {
        border: 1px solid grey;
        border-radius: 10px;
        margin: 10px;
        padding: 10px;
    }

    .red {
        color: darkred;
    }

    .green {
        color: forestgreen;
    }
</style>