import shop from '../../api/shop'

const state = {
  all: []
}

// getters
const getters = {}

// actions
const actions = {
  //action на запуски "импорта"
  getAllProducts ({ commit }) {
    shop.getProducts(products => {
      commit('setProducts', products);
    });
  }
}

// mutations
const mutations = {
  //Установка списка полученого внутри getAllProducts в state
  setProducts (state, products) {
    state.all = products;
  },
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
