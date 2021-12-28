import { ROUTES } from '@/constant/routes';

export const NAV_LINKS = [
  {
    name: 'Home',
    ...ROUTES.web.home,
  },
  {
    name: 'Report a bug',
    ...ROUTES.web.bugReport,
  },
  {
    name: 'Dashboard',
    ...ROUTES.web.dashboard,
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
