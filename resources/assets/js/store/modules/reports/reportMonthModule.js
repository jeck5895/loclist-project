export default {
    state: {
        report_month: {},
        report_months: [],
    },
    getters: {
        getReportMonth: state => {
            return state.report_month;
        },
        getReportMonths: state => {
            return state.report_months;
        },
    },
    mutations: {
        clearReportMonth: state => {
            state.report_month = {};
        },
        clearReportMonths: state => {
            state.report_months = [];
        },
        setReportMonth: (state, payload) => {
            state.report_month = payload.data;
        },
        setReportMonths: (state, payload) => {
            state.report_months = payload.data;
        }
    },
    actions: {
        clearReportMonth: ({commit}) => {
            commit('clearReportMonth');
        },
        clearReportMonths: ({commit}) => {
            commit('clearReportMonths');
        },
        loadReportMonth: ({commit}, payload) => {
            return new Promise((resolve, reject) => {
                axios.get('/api/reports/report-months/' + payload.id)
                .then(response => {
                    commit('setReportMonth', response);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
            });
        },
        loadReportMonths: ({commit}, payload) => {
            return new Promise((resolve, reject) => {
                axios.get(payload)
                .then(response => {
                    commit('setReportMonths', response);
                    resolve(response);
                })
                .catch(error => {
                    console.log(error.response)
                    reject(error);
                });
            });
        },
    }
}