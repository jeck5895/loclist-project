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
import dataFilteringModule from './modules/dataFiltering/dataFilteringModule';
import statusModule from './modules/maintainance/statusModule';
import clientCallModule from './modules/clients/clientCallModule';
import clientSaturationModule from './modules/clients/clientSaturationModule';
import clientPresentationModule from './modules/clients/clientPresentationModule';
import clientAcquisitionModule from './modules/clients/clientAcquisitionModule';
import saturationModule from './modules/maintainance/saturationModule';
import mannerOfConfirmationModule from './modules/maintainance/mannerOfConfirmationModule';
import modeOfPresentationModule from './modules/maintainance/modeOfPresentationModule';
import presentationStatusModule from './modules/maintainance/presentationStatusModule';
import actionPlanModule from './modules/maintainance/actionPlanModule';
import mannerOfAcquisitionModule from './modules/maintainance/mannerOfAcquisitionModule';

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
        companyModule,
        dataFilteringModule,
        statusModule,
        clientCallModule,
        clientSaturationModule,
        clientPresentationModule,
        clientAcquisitionModule,
        saturationModule,
        mannerOfConfirmationModule,
        modeOfPresentationModule,
        presentationStatusModule,
        actionPlanModule,
        mannerOfAcquisitionModule
    }
});