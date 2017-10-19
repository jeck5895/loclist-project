
export default {
    state:{
        modalTitle:'',
        modalFormType:'',
        form:{},
        modalFormValidation:{
            scope:'',
            errors:{}
        }
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
        }
    },
    actions:{
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
        closeModal: (context, payload) => {
            if(payload){
                payload.errors.clear(payload.scope);
            }
            context.commit('clearServerResponse'); // commit clearServerResponse mutation from userModule
            $("#createUserModal").modal('hide');
            
        }
    }
}