import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    items: []
  },
  getters: {
    items(state) {
      return state.items
    }
  },
  actions: {
    getItems({commit}) {
      axios
          .get('https://jsonplaceholder.typicode.com/posts')
          .then(response => {
            commit('updateItems', response.data)
          })
    },
    getItemsAuth({commit}) {
      const token = '5frMMCL9JjpDEXulY9sU6SeXKkCvcwfxdSyF6rDDCezWkkVs7RL1uCFVWwRL';
      axios
          .get('/api/items', {headers: {'Authorization': 'Bearer ' + token}})
          .then(response => {
            commit('updateItems', response.data)
          })
    }
  },
  mutations: {
    updateItems(state, items) {
      state.items = items
    }
  }
});
