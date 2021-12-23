export const MANAGER_ROUTE_NAME = 'manage';

export const ROUTES = {
  home: {
    routeName: 'home',
    url: '/',
  },

  bugReport: {
    routeName: 'bug-report',
    url: '/report-a-bug',
  },

  dashboard: {
    routeName: 'dashboard',
    url: '/dashboard',
  },

  contribute: {
    routeName: 'contribute',
    url: '/contribute',
  },

  manager: {
    routeName: MANAGER_ROUTE_NAME,
    url: '/manager/dashboard',
  },

  issues: {
    routeName: 'issues',
    url: '/issues',
  },
};
