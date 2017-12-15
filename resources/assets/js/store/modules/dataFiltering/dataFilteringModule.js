export default {
    state: {
        columns: [],
        client_query: {
            search_keyword: '',
            order_by: 'desc',
            per_page: 10,
            sort_column: 'created_at',
            from_date:'',
            to_date:'',
            location:'',
            industry:''
        },
        user_query: {
            search_keyword: '',
            order_by: 'desc',
            per_page: 10,
            sort_column: 'created_at',
        },
        page_display:[10, 20, 30, 40, 50],
    },
    getters: {
        getClientApiQuery: state => {
            return state.client_query;
        },
        getUserApiQuery: state => {
            return state.user_query;
        },
        getColumns: state => {
            return state.columns;
        },
        getPageDisplay: state => {
            return state.page_display;
        }
    },
    mutations: {
        setColumns: (state, payload) => {
            state.columns = payload;
        },
        setClientApiQuery: (state, payload) => {
            state.client_query = payload;
        },
        setUserApiQuery: (state, payload) => {
            state.user_query = payload;
        },
        setSearchKeyword: (state, payload) => {
            state.client_query.search_keyword = payload;
        },
        setOrderBy: (state, payload) => {
            state.client_query.order_by = payload;
        },
        setPerPage: (state, payload) => {
            state.client_query.per_page = payload;
        },
        setSortColumn: (state, payload) => {
            state.client_query.sort_column = payload;
        },
    },
    actions:{
        setClientApiQuery: (context, payload) => {
            context.commit('setClientApiQuery', payload);
        },
        setUserApiQuery: (context, payload) => {
            context.commit('setUserApiQuery', payload);
        },
        setColumns: (context, payload) => {
            context.commit('setColumns', payload);
        },
        setSearchKeyword: (state, payload) => {
            state.client_query.search_keyword = payload;
        },
        setOrderBy: (context, payload) => {
            context.commit('setOrderBy', payload);
        },
        setPerPage: (context, payload) => {
            context.commit('setPerPage', payload);
        },
        setSortColumn: (context, payload) => {
            context.commit('setSortColumn', payload);
        },
    }
}