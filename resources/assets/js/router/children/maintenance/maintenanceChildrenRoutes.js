export default [
    {
        path: '',
        component: require('../../../components/alerts/Instructions'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'reports',
        component: require('../../../components/sub-containers/maintenance/ReportContainer'),
        meta: {
            forAuthUsers: true
        }
    },
    {
        path: 'companies',
        component: require('../../../components/sub-containers/maintenance/CompanyContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'departments',
        component: require('../../../components/sub-containers/maintenance/DepartmentContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'industries',
        component: require('../../../components/sub-containers/maintenance/IndustryContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'iso-certificates',
        component: require('../../../components/sub-containers/maintenance/IsoContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'manpower-types',
        component: require('../../../components/sub-containers/maintenance/ManpowerContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'nationalities',
        component: require('../../../components/sub-containers/maintenance/NationalityContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'positions',
        component: require('../../../components/sub-containers/maintenance/PositionContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'sourcing-practices',
        component: require('../../../components/sub-containers/maintenance/SourcingContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'statuses',
        component: require('../../../components/sub-containers/maintenance/StatusContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'user-types',
        component: require('../../../components/sub-containers/maintenance/UserTypeContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'mode-of-saturations',
        component: require('../../../components/sub-containers/maintenance/SaturationContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'manner-of-confirmations',
        component: require('../../../components/sub-containers/maintenance/ConfirmationContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'manner-of-acquisitions',
        component: require('../../../components/sub-containers/maintenance/AcquisitionContainer'),
        meta: {
            forAuthUsers: true
        },
    },
    {
        path: 'mode-of-presentations',
        component: require('../../../components/sub-containers/maintenance/ModeOfPresentationsContainer'),
        meta: {
            forAuthUsers: true
        }
    },
    {
        path: 'presentation-statuses',
        component: require('../../../components/sub-containers/maintenance/PresentationStatusesContainer'),
        meta: {
            forAuthUsers: true
        }
    },
    {
        path: 'action-plans',
        component: require('../../../components/sub-containers/maintenance/ActionPlansContainer'),
        meta: {
            forAuthUsers: true
        }
    }
]