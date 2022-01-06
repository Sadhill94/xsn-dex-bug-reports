import { ROLES } from '@/constant/roles';

export const RolesMixin = {
  computed: {
    hasBasicAccess() {
      return [
        this.isManager,
        this.isContributor,
        this.isManagerNotLogged,
        this.isContributorNotLogged,
      ].some((x) => x);
    },
    isManagerNotLogged() {
      return !!localStorage.getItem('has-manager-access');
    },

    isManager() {
      return this.$page?.props?.auth?.user?.role === ROLES.manager;
    },

    isContributorNotLogged() {
      return !!localStorage.getItem('has-contributor-access');
    },

    isContributor() {
      return this.$page?.props?.auth?.user?.role === ROLES.contributor;
    },
  },
  methods: {
    setManagerLocalStorageIfNotExist() {
      if (!this.isManagerNotLogged && this.isManager) {
        localStorage.setItem('has-manager-access', true);
      }
    },

    setContributorLocalStorageIfNotExist() {
      if (!this.isContributorNotLogged && this.isContributor) {
        localStorage.setItem('has-contributor-access', true);
      }
    },
  },
};
