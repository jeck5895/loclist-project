export default {
    state: {
        report_month: {},
        report_months: [],
        report_month_names: []
    },
    getters: {
        getReportMonth: state => {
            return state.report_month;
        },
        getReportMonths: state => {
            return state.report_months;
        },
        getReportMonthNames: state => {
            return state.report_month_names;
        }
    },
    mutations: {
        clearReportMonth: state => {
            state.report_month = {};
        },
        clearReportMonths: state => {
            state.report_months = [];
        },
        clearReportMonthNames: state => {
            state.report_month_names = [];
        },
        setReportMonth: (state, payload) => {
            state.report_month = payload.data;
        },
        setReportMonths: (state, payload) => {
            state.report_months = payload.data;
        },
        setReportMonthNames: (state, payload) => {
            state.report_month_names.push(payload);
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
            commit('setLoadingState', true);
            commit('clearReportMonthNames');
            return new Promise((resolve, reject) => {
                axios.get(payload)
                .then(response => {
                    commit('setReportMonths', response);
                    response.data.map(month => {
                        commit('setReportMonthNames', month.name);
                    });
                    resolve(response);
                    commit('setLoadingState', true);
                })
                .catch(error => {
                    console.log(error.response)
                    commit('setLoadingState', true);
                    reject(error);
                });
            });
        },
    }
}