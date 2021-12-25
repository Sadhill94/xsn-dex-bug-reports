export const ROUTES = {
  web: {
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
    issue: {
      display: {
        routeName: 'display-issue',
        url: '/issues/{id}',
      },
      edit: {
        routeName: 'display-edit-issue',
        url: '/issues/edit/{id}',
      },
    },
  },
  api: {
    issue: {
      list: {
        routeName: 'list-issues',
        url: '/api/issues/list',
      },
      create: {
        routeName: 'create-issue',
        url: '/api/issues/create',
      },
      edit: {
        routeName: 'edit-issue',
        url: '/api/issues/edit',
      },
      delete: {
        routeName: 'delete-issue',
        url: '/api/issues/{id}',
      },
    },
    file: {
      download: {
        routeName: '',
        irl: '/api/files/download/{id}',
      },
    },
  },
};
