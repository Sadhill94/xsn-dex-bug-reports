export const ManagerMixin = {
  computed: {
    isManagerNotLogged() {
      return !!localStorage.getItem('has-access');
    },

    isManager() {
      return this.$page?.props?.auth?.user;
    },
  },
  methods: {
    setManagerLocalStorageIfNotExist() {
      if (!this.isManagerNotLogged && this.isManager) {
        localStorage.setItem('has-access', true);
      }
    },
  },
};
