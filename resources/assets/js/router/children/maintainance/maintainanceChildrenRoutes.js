export default [
    {
        path: '',
        component: require('../../../components/alerts/Instructions'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'companies',
        component: require('../../../components/sub-containers/maintainance/CompanyContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'departments',
        component: require('../../../components/sub-containers/maintainance/DepartmentContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'industries',
        component: require('../../../components/sub-containers/maintainance/IndustryContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'iso-certificates',
        component: require('../../../components/sub-containers/maintainance/IsoContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'manpower-types',
        component: require('../../../components/sub-containers/maintainance/ManpowerContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'nationalities',
        component: require('../../../components/sub-containers/maintainance/NationalityContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'positions',
        component: require('../../../components/sub-containers/maintainance/PositionContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'sourcing-practices',
        component: require('../../../components/sub-containers/maintainance/SourcingContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'statuses',
        component: require('../../../components/sub-containers/maintainance/StatusContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'user-types',
        component: require('../../../components/sub-containers/maintainance/UserTypeContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'mode-of-saturations',
        component: require('../../../components/sub-containers/maintainance/SaturationContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'manner-of-confirmations',
        component: require('../../../components/sub-containers/maintainance/ConfirmationContainer'),
        meta: {
            forAuthUsers: true
        },
    }
]