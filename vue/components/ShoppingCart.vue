<template>
    <div class="cart">
        <h2>Корзина</h2>
        <p v-show="!products.length"><i>Корзина пуста</i></p>
        <ul>
            <li
                    v-for="product in products"
                    :key="product.id">
                {{ product.title }} - {{ product.price | currency }} x <input type="number" v-model="product.quantity"
                                                                              @input="updateQuantity({id: product.id, quantity: product.quantity})">
                <button type="button" @click="removeProductFromCart({id: product.id})">Удалить</button>
            </li>
        </ul>
        <p>Итого: {{ total | currency }}</p>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        computed: {
            //с помощью геттеров модуля корзины записываем вычисляемые значения
            ...mapGetters('cart', {
                products: 'cartProducts',
                total: 'cartTotalPrice'
            })
        },
        //Получаем экшины из модуля корзины
        methods: mapActions('cart', [
            'updateQuantity',
            'removeProductFromCart'
        ])
    }
</script>
