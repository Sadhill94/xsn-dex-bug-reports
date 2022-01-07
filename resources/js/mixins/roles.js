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

    hasBasicAccessNotLogged() {
      return [
        this.isManagerNotLogged && !this.isContributor,
        this.isContributorNotLogged && !this.isManager,
      ].some((x) => x);
    },

    hasBasicAccessLogged() {
      return [this.isManager, this.isContributor].some((x) => x);
    },

    isManagerNotLogged() {
      return !!localStorage.getItem('has-manager-access') && !this.isManager;
    },

    isManager() {
      return this.$page?.props?.auth?.user?.role === ROLES.manager;
    },

    isContributorNotLogged() {
      return (
        !!localStorage.getItem('has-contributor-access') && !this.isContributor
      );
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
