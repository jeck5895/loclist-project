import Vue from 'vue';
import Vuex from 'vuex';
import clientModule from './modules/clients/clientModule';
import userModule from './modules/users/userModule';
import modalModule from './modules/modal/modalModule';
import userTypeModule from './modules/maintainance/userTypeModule';
import serverResponseModule from './modules/server/serverResponseModule';
import industryModule from './modules/maintainance/industryModule';
import nationalityModule from './modules/maintainance/nationalityModule';
import isoCertificateModule from './modules/maintainance/isoCertificateModule';
import sourcingModule from './modules/maintainance/sourcingModule';
import departmentModule from './modules/maintainance/departmentModule';
import positionModule from './modules/maintainance/positionModule';
import manpowerModule from './modules/maintainance/manpowerModule';
import companyModule from './modules/companies/companyModule';

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
        manpowerModule,
        companyModule
    }
});