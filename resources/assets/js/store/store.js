import Vue from 'vue';
import Vuex from 'vuex';
import clientModule from './modules/clientModule';
import userModule from './modules/userModule';
import modalModule from './modules/modalModule';
import userTypeModule from './modules/userTypeModule';

Vue.use(Vuex); 

export const store = new Vuex.Store({
    modules:{
        clientModule: clientModule,
        userModule: userModule,
        userTypeModule: userTypeModule,
        modalModule: modalModule
    }
});