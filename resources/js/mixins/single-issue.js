import { ROUTES } from '@/constant/routes';
import axios from 'axios';

export const SingleIssueMixin = {
  props: {
    issue: {
      type: Object,
      default: null,
    },
    feature: {
      type: Object,
      default: null,
    },
  },

  data() {
    return {
      item: null,
    };
  },

  mounted() {
    if (this.issue) {
      this.item = this.issue;
    } else {
      this.item = this.feature;
    }
  },

  computed: {
    ROUTES() {
      return ROUTES;
    },

    getEditUrl() {
      if (this.issue) {
        return ROUTES.web.issue.edit.url.replace('{id}', this.issue.id);
      } else {
        return ROUTES.web.feature.edit.url.replace('{id}', this.feature.id);
      }
    },
  },

  methods: {
    isTxtOrLogFile(fileExtension) {
      return ['log', 'txt'].includes(fileExtension);
    },

    handleCopyLink() {
      const readIssuePath = location.href.replace('/edit', '');

      navigator.clipboard.writeText(readIssuePath);
      this.$displayNotification({
        message: 'Link copied to the clipboard !',
      });
    },

    isPropertyNullOrEmpty(property) {
      return this.issue[property];
    },

    confirmDeleteIssue() {
      if (
        confirm(
          `Confirm your wish to delete ${this.issue ? 'issue' : 'feature'} #${
            this.item.id
          }`
        )
      ) {
        this.deleteIssue(this.item.id);
      }
    },

    deleteIssue(issueId) {
      const notification = {};
      axios
        .delete(ROUTES.api.issue.delete.url.replace('{id}', issueId))
        .then(() => {
          notification.message = 'Successfully deleted';
          notification.type = 'success';
          this.$inertia.get(ROUTES.web.dashboard.url);
        })
        .catch((err) => {
          notification.message =
            err?.response?.statusText || 'Something went wrong';
          notification.type = 'error';
        })
        .finally(() => {
          this.$displayNotification(notification);
        });
    },

    deleteFile(fileId, isDisplay = false) {
      const notification = {};
      axios
        .delete(ROUTES.api.file.delete.url.replace('{id}', fileId))
        .then(() => {
          notification.message = 'Successfully deleted';
          notification.type = 'success';

          if (isDisplay) {
            dispatchEvent(new CustomEvent('onReloadNeeded'));
          } else {
            this.localIssue.files = this.localIssue.files.filter(
              (file) => file.id !== fileId
            );
          }
        })
        .catch((err) => {
          notification.message =
            err?.response?.statusText || 'Something went wrong';
          notification.type = 'error';
        })
        .finally(() => {
          this.$displayNotification(notification);
        });
    },
  },
};
