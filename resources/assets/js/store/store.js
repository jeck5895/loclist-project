import Vue from 'vue';
import Vuex from 'vuex';
import clientModule from './modules/clients/clientModule';
import userModule from './modules/users/userModule';
import modalModule from './modules/modal/modalModule';
import userTypeModule from './modules/maintenance/userTypeModule';
import serverResponseModule from './modules/server/serverResponseModule';
import industryModule from './modules/maintenance/industryModule';
import nationalityModule from './modules/maintenance/nationalityModule';
import isoCertificateModule from './modules/maintenance/isoCertificateModule';
import sourcingModule from './modules/maintenance/sourcingModule';
import departmentModule from './modules/maintenance/departmentModule';
import positionModule from './modules/maintenance/positionModule';
import manpowerModule from './modules/maintenance/manpowerModule';
import companyModule from './modules/companies/companyModule';
import dataFilteringModule from './modules/dataFiltering/dataFilteringModule';
import statusModule from './modules/maintenance/statusModule';
import clientCallModule from './modules/clients/clientCallModule';
import clientSaturationModule from './modules/clients/clientSaturationModule';
import clientPresentationModule from './modules/clients/clientPresentationModule';
import clientAcquisitionModule from './modules/clients/clientAcquisitionModule';
import saturationModule from './modules/maintenance/saturationModule';
import mannerOfConfirmationModule from './modules/maintenance/mannerOfConfirmationModule';
import modeOfPresentationModule from './modules/maintenance/modeOfPresentationModule';
import presentationStatusModule from './modules/maintenance/presentationStatusModule';
import actionPlanModule from './modules/maintenance/actionPlanModule';
import mannerOfAcquisitionModule from './modules/maintenance/mannerOfAcquisitionModule';
import targetListModule from './modules/reports/targetListModule';
import reportMonthModule from './modules/reports/reportMonthModule';
 
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
        mannerOfAcquisitionModule,
        targetListModule,
        reportMonthModule,
    }
});