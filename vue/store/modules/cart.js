const state = {
    items: [],
}

// getters
const getters = {
    cartProducts: (state, getters, rootState) => {
        return state.items.map(({id, categoryId, quantity}) => {
            //Перебирем список товаров в корзине, и добираем недостающую информацию
            const product = rootState.products.all[categoryId]['B'][id];
            return {
                id,
                title: product.N,
                price: product.price,
                quantity
            };
        });
    },

    cartTotalPrice: (state, getters) => {
        //счетаем сумму корзины
        return getters.cartProducts.reduce((total, product) => {
            return total + product.price * product.quantity;
        }, 0)
    }
}

// actions
const actions = {
    //ф-ия добавления товара в корзину
    addProductToCart({state, commit}, product) {
        const cartItem = state.items.find(item => item.id === product.id);
        //Проверям наличие товара в корзине
        //если пытаются положить больше товара чем емть на остатках, не даем этого сделать :)
        if (!cartItem) {
            commit('pushProductToCart', product);
        } else {
            if (product.stockCount > cartItem.quantity) {
                commit('incrementItemQuantity', cartItem);
            }
        }
    },

    //ф-ия для установки нового значенияим кол-ва в корзине
    updateQuantity({state, commit, rootState}, {id, quantity}) {
        quantity = parseInt(quantity);
        if (!quantity) {
            return;
        }
        const cartItem = state.items.find(item => item.id === id);
        let product = rootState.products.all[cartItem.categoryId]['B'][id];

        //если вписали цыфру больще чем есть на остатках, обновляем на нее,
        //а потом обратно. На сколько я понимаю, если убрать commit c 59 строки
        //ломается реактивность DOMa т.к. значение в state не меняется.
        //а как отсюда вызвать ту функцию которая в 99.99% случаев говорит о том что что-то не правильно, я так и не понял
        if (product.stockCount < quantity) {
            commit('setItemQuantity', {id, quantity});
            quantity = product.stockCount;
        }

        commit('setItemQuantity', {id, quantity});
    },

    //action на удаление товара из корзины
    removeProductFromCart({state, commit, rootState}, {id}) {
        commit('deleteItem', {id});
    },

}

// mutations
const mutations = {
    //Мутация для добавления записи в state корзины
    pushProductToCart(state, {id, categoryId}) {
        state.items.push({
            id,
            categoryId,
            quantity: 1
        });
    },

    //Увиличение количества на 1
    incrementItemQuantity(state, {id}) {
        const cartItem = state.items.find(item => item.id === id)
        cartItem.quantity++;
    },

    //Удаление товара из корзины
    deleteItem(state, {id}) {
        const cartItem = state.items.find(item => item.id === id)
        let key = state.items.indexOf(cartItem)
        if (key >= 0) {
            state.items.splice(key, 1);
        }
    },

    //Установка тового значения количества
    setItemQuantity(state, {id, quantity}) {
        const cartItem = state.items.find(item => item.id === id)
        cartItem.quantity = quantity;
    },
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
