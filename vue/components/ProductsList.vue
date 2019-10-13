<template>
    <div class="products">
        <h1>Список товаров</h1>
        <ul>
            <li v-if="category.existsAvailableGoods" v-for="category in products">
                <div>{{category.G}}</div>
                <ol>
                    <li v-for="(product, goodId) in category.B" v-if="product.count">{{product.N}} ({{product.count}})</li>
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
                                this.offers = response.data.Value.Goods;
                                this.offers.forEach((offer) => {
                                    let categoryId = offer.G;
                                    let productId = offer.T;
                                    if(products[categoryId]){
                                        products[categoryId]['B'][productId]['count'] = offer.P;
                                        products[categoryId]['B'][productId]['price'] = offer.C;
                                        products[categoryId]['existsAvailableGoods'] = true;
                                    }
                                });

                                this.products = products;
                                console.log(this.products);
                            })
                            .catch((error) => {
                                console.log(error)
                            });

                    })
                    .catch(error => console.log(error));
            }
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
</style>