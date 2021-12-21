import { ROUTES } from '@/constant/routes';

export const NAV_LINKS = [
  {
    name: 'Home',
    ...ROUTES.home,
  },
  {
    name: 'Report a bug',
    ...ROUTES.bugReport,
  },
  {
    name: 'Contribute',
    ...ROUTES.contribute,
  },
  {
    name: 'Dashboard',
    ...ROUTES.manager,
  },
];
