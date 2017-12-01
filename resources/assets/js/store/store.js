import Vue from 'vue';
import Vuex from 'vuex';
import clientModule from './modules/clientModule';
import userModule from './modules/userModule';
import modalModule from './modules/modalModule';
import userTypeModule from './modules/userTypeModule';
import serverResponseModule from './modules/serverResponseModule';
import industryModule from './modules/industryModule';
import nationalityModule from './modules/nationalityModule';
import isoCertificateModule from './modules/isoCertificateModule';
import sourcingModule from './modules/sourcingModule';
import departmentModule from './modules/departmentModule';
import positionModule from './modules/positionModule';
import manpowerModule from './modules/manpowerModule';

Vue.use(Vuex); 

export const store = new Vuex.Store({
    modules:{
        serverResponseModule: serverResponseModule,
        clientModule: clientModule,
        userModule: userModule,
        userTypeModule: userTypeModule,
        modalModule: modalModule,
        industryModule: industryModule,
        nationalityModule: nationalityModule,
        isoCertificateModule,
        sourcingModule,
        departmentModule,
        positionModule,
        manpowerModule
    }
});