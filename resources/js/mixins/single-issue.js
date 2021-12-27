import { ROUTES } from '@/constant/routes';
import axios from 'axios';

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

    getEditIssueUrl() {
      return ROUTES.web.issue.edit.url.replace('{id}', this.issue.id);
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
        message: 'Issue link copied to the clipboard !',
      });
    },

    isPropertyNullOrEmpty(property) {
      return this.issue[property];
    },

    confirmDeleteIssue() {
      if (confirm(`Confirm your wish to delete issue #${this.issue.id}`)) {
        this.deleteIssue(this.issue.id);
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
