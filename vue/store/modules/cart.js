import shop from '../../api/shop'

// initial state
// shape: [{ id, quantity }]
const state = {
    items: [],
    checkoutStatus: null
}

// getters
const getters = {
    cartProducts: (state, getters, rootState) => {
        return state.items.map(({id, categoryId, quantity}) => {
            //const product = rootState.products.all.find(product => product.id === id)
            const product = rootState.products.all[categoryId]['B'][id];
            return {
                title: product.N,
                price: product.price,
                quantity
            }
        })
    },

    cartTotalPrice: (state, getters) => {
        return getters.cartProducts.reduce((total, product) => {
            return total + product.price * product.quantity
        }, 0)
    }
}

// actions
const actions = {
    checkout({commit, state}, products) {
        /*const savedCartItems = [...state.items]
        commit('setCheckoutStatus', null)
        // empty cart
        commit('setCartItems', { items: [] })
        shop.buyProducts(
          products,
          () => commit('setCheckoutStatus', 'successful'),
          () => {
            commit('setCheckoutStatus', 'failed')
            // rollback to the cart saved before sending the request
            commit('setCartItems', { items: savedCartItems })
          }
        )*/
    },

    addProductToCart({state, commit}, product) {
        commit('setCheckoutStatus', null)
        console.log(product);
        const cartItem = state.items.find(item => item.id === product.id);
        if (!cartItem) {
            commit('pushProductToCart', product);
        } else {
            if (product.stockCount > cartItem.quantity) {
                commit('incrementItemQuantity', cartItem);
            }
        }
        // remove 1 item from stock
        //commit('products/decrementProductInventory', product, { root: true });
    }
}

// mutations
const mutations = {
    pushProductToCart(state, {id, categoryId}) {
        state.items.push({
            id,
            categoryId,
            quantity: 1
        });
    },

    incrementItemQuantity(state, {id}) {
        const cartItem = state.items.find(item => item.id === id)
        cartItem.quantity++;
    },

    setCartItems(state, {items}) {
        state.items = items
    },

    setCheckoutStatus(state, status) {
        state.checkoutStatus = status
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
