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
    name: 'Contribute',
    ...ROUTES.contribute,
  },
  {
    name: 'DEX Dashboard',
    ...ROUTES.manager,
  },
];
