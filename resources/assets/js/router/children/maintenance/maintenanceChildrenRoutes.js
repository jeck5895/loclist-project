export default [
    {
        path: '',
        component: require('../../../components/alerts/Instructions'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if(to.matched.some(record => record.meta.forAdmin)){
                if(typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1){
                    window.location = window.location.origin;
                }   
                else{
                    console.log('qqqq')
                    next();
                }   
            }
            else{
                next();
            }
        }
    },
    {
        path: 'reports',
        component: require('../../../components/sub-containers/maintenance/ReportContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'companies',
        component: require('../../../components/sub-containers/maintenance/CompanyContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'departments',
        component: require('../../../components/sub-containers/maintenance/DepartmentContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'industries',
        component: require('../../../components/sub-containers/maintenance/IndustryContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'iso-certificates',
        component: require('../../../components/sub-containers/maintenance/IsoContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'manpower-types',
        component: require('../../../components/sub-containers/maintenance/ManpowerContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'nationalities',
        component: require('../../../components/sub-containers/maintenance/NationalityContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'positions',
        component: require('../../../components/sub-containers/maintenance/PositionContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'sourcing-practices',
        component: require('../../../components/sub-containers/maintenance/SourcingContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'statuses',
        component: require('../../../components/sub-containers/maintenance/StatusContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'user-types',
        component: require('../../../components/sub-containers/maintenance/UserTypeContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'mode-of-saturations',
        component: require('../../../components/sub-containers/maintenance/SaturationContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'manner-of-confirmations',
        component: require('../../../components/sub-containers/maintenance/ConfirmationContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'manner-of-acquisitions',
        component: require('../../../components/sub-containers/maintenance/AcquisitionContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'mode-of-presentations',
        component: require('../../../components/sub-containers/maintenance/ModeOfPresentationsContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'presentation-statuses',
        component: require('../../../components/sub-containers/maintenance/PresentationStatusesContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    },
    {
        path: 'action-plans',
        component: require('../../../components/sub-containers/maintenance/ActionPlansContainer'),
        meta: {
            forAuthUsers: true,
            forAdmin: true
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some(record => record.meta.forAdmin)) {
                if (typeof Vue.auth.getter() != "undefined" && Vue.auth.getter().userType != 1) {
                    window.location = window.location.origin;
                }
                else {
                    console.log('qqqq')
                    next();
                }
            }
            else {
                next();
            }
        }
    }
]