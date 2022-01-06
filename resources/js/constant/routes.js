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
    featureRequest: {
      routeName: 'feature-request',
      url: '/feature-request',
    },
    dashboard: {
      routeName: 'dashboard',
      url: '/dashboard',
    },
    contribute: {
      routeName: 'contribute',
      url: '/contribute',
    },
    login: {
      routeName: 'login',
      url: '/login',
    },
    logout: {
      routeName: 'logout',
      url: '/logout',
    },
    feature: {
      display: {
        routeName: 'display-feature',
        url: '/features/{id}',
      },
      edit: {
        routeName: 'display-edit-feature',
        url: '/features/edit/{id}',
      },
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
      create_bug: {
        routeName: 'create-bug',
        url: '/api/issues/bug/create',
      },
      create_feature: {
        routeName: 'create-feature',
        url: '/api/issues/feature/create',
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
        routeName: 'download-file',
        url: '/api/files/download/{id}',
      },
      delete: {
        routeName: 'delete-file',
        url: '/api/files/{id}',
      },
      addSingle: {
        routeName: 'add-single-file',
        url: '/api/files',
      },
    },
  },
};
