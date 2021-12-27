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
      if (this.issue[property]) {
        return this.issue[property] !== 'null';
      }
      return true;
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
          notification.message = err.response.statusText;
          notification.type = 'error';
        })
        .finally(() => {
          this.$displayNotification(notification);
        });
    },

    deleteFile(fileId) {
      const notification = {};
      axios
        .delete(ROUTES.api.file.delete.url.replace('{id}', fileId))
        .then(() => {
          notification.message = 'Successfully deleted';
          notification.type = 'success';
          this.localIssue.files = this.localIssue.files.filter(
            (file) => file.id !== fileId
          );
        })
        .catch((err) => {
          notification.message = err.response.statusText;
          notification.type = 'error';
        })
        .finally(() => {
          this.$displayNotification(notification);
        });
    },
  },
};
