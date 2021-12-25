import { ROUTES } from '@/constant/routes';

export const SingleIssueMixin = {
  props: {
    issue: {
      type: Object,
      default: null,
    },
  },

  computed: {
    ROUTES() {
      return ROUTES;
    },
  },

  methods: {
    handleCopyLink() {
      navigator.clipboard.writeText(location.href);
      this.$displayNotification({
        message: 'Issue link copied to the clipboard !',
      });
    },
    isPropertyNullOrEmpty(property) {
      if (this.issue[property]) {
        return this.issue[property] !== 'null';
      }
      return true;
    },
  },
};
