import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

let setJob = function (jobId){

}


const store = new Vuex.Store({
  state: {
    setJob: setJob,
    access_token: localStorage.getItem('access_token') | '',
    expires_in: localStorage.getItem('expires_in') | '',
    token_type: localStorage.getItem('token_type') | '',
    curentUser: localStorage.getItem('curentUser') | {},
    partenaire: localStorage.getItem('partenaire') | {},
    userIsConnect: localStorage.getItem('userIsConnect') | false,
    path: localStorage.getItem('path') | {},
    rolesPermissions: localStorage.getItem('path') | []
  },
  actions: { },
  mutations: { },
  getters: { }
});

export default store;
