
export default {
    state:{
        modalTitle:'',
        modalFormType:'',
        form:{},
        modalFormValidation:{
            scope:'',
            errors:{}
        },
        deletionType: {
            scope: '',
            user: {}
        },
        params:'',
    },
    getters:{
        getModalTitle: state => {
            return state.modalTitle;
        },
        getModalFormType: state => {
            return state.modalFormType;
        },
        getModalFormValidation: state => {
            return state.modalFormValidation;
        },
        getForm: state => {
            return state.form;
        },
        getDeletionType: state => {
            return state.deletionType;
        },
        getModalParams: state => {
            return state.params;
        }
    },
    mutations:{
        setModalTitle: (state, payload) => {
            state.modalTitle = payload;
        },
        setModalFormType: (state, payload) => {
            state.modalFormType = payload;
        },
        setModalFormValidation: (state, payload) => {
            state.modalFormValidation.scope = payload.scope;
            state.modalFormValidation.errors = payload.errors;
        },
        setForm: (state, payload) => {
            state.form = payload;
        },
        setDeletionType: (state, payload) => {
            state.deletionType = payload;
        },
        setModalParams: (state, payload) => {
            state.params = payload;
        }
    },
    actions:{
        setModalParams: (context, payload) => {
            return new Promise((resolve, reject) => {
                context.commit('setModalParams', payload);
                resolve();
            });
        },
        setDeletionType: (context, payload) => {
            // const {commit} = context; //using ES6 deconstruction 
            // commit('setDeletionType', payload);
            context.commit('setDeletionType', payload);
        },
        setForm: (context, payload) => {
            context.commit('setForm', payload);
        },
        setModalTitle: (context, payload) => {
            context.commit('setModalTitle', payload);
        },
        setModalFormType: (context, payload) => {
            context.commit('setModalFormType', payload);
        },
        setModalFormValidation: (context, payload) => {
            context.commit('setModalFormValidation', payload);
        },
        showModal: (context, payload) => {
           payload.reset();
           $('#createUserModal').modal('show');
        },
        showConfirmationModal: (context, payload) => {
            $("#deleteConfirmationModal").modal("show");
        },
        closeModal: (context, payload) => {
           
            if(Object.keys(payload.errors).length){
                payload.errors.clear(payload.scope);
            }
            context.commit('clearServerResponse'); // commit clearServerResponse mutation from serverResponseModule
            $("#createUserModal").modal('hide');
            
        },
        closeConfirmationModal: (context, payload) => {
            context.commit('clearServerResponse');
            $("#deleteConfirmationModal").modal("hide");
        }
    }
};