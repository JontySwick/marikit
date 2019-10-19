<template>
    <div class="products">
        <h1>Список товаров</h1>
        <ul>
            <!--Перебираем наш список, показываем только те разделы в которых есть товары в наличие-->
            <li v-if="category.existsAvailableGoods" v-for="(category, categoryId) in products">
                <div>{{category.G}}</div>
                <ol>
                    <li v-for="(product, productId) in category.B" v-if="product.stockCount">
                        <span>{{product.N}}</span><br>
                        <span>В наличие: {{product.stockCount}}</span><br>
                        <span :class="{'red': product.priceDiff > 0, 'green': product.priceDiff < 0}">Цена {{product.price | currency}}</span>
                        <br>
                        <button
                                @click="addProductToCart({id: productId, categoryId, stockCount: product.stockCount})">
                            В корзину
                        </button>
                    </li>
                </ol>
            </li>
        </ul>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex'

    export default {
        computed: mapState({
            products: state => state.products.all
        }),
        methods: mapActions('cart', [
            'addProductToCart'
        ]),
        watch: {
            //Следим за изменениями нашего списка
            //при изменениях сравниваем цены товаров и записываем разницу в priceDiff
            products: function (newValue, oldValue) {
                Object.keys(newValue).forEach(function (categoryId) {
                    if(!oldValue[categoryId]){
                        return
                    }
                    Object.keys(newValue[categoryId]['B']).forEach(function (productId) {
                        let newPrice = newValue[categoryId]['B'][productId]['price'];
                        let oldPrice = oldValue[categoryId]['B'][productId]['price'];
                        newValue[categoryId]['B'][productId]['priceDiff'] = newPrice - oldPrice;
                    });
                })
            },
            deep: true,
            immediate: false,
        },
        created() {
            //При создание компонента вызываем из модуля функцию получения товаров
            this.$store.dispatch('products/getAllProducts')
        }
    }
</script>

<style>
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
