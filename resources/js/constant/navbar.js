import { ROUTES } from '@/constant/routes';

export const NAV_LINKS = [
  {
    name: 'Home',
    ...ROUTES.web.home,
  },
  {
    name: 'Dashboard',
    ...ROUTES.web.dashboard,
  },
  {
    name: 'Report a bug',
    ...ROUTES.web.bugReport,
  },
  {
    name: 'Feature request',
    ...ROUTES.web.featureRequest,
  },

  // {
  //   name: 'Contribute',
  //   ...ROUTES.web.contribute,
  // },
];

export const LOGIN_LINK = {
  name: 'Login',
  ...ROUTES.web.login,
};
