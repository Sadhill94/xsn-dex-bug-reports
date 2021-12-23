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
    name: 'Dashboard',
    ...ROUTES.dashboard,
  },
  {
    name: 'DEX Dashboard',
    ...ROUTES.manager,
  },
  {
    name: 'Contribute',
    ...ROUTES.contribute,
  },
];
