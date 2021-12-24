<template>
  <dashboard-template
    :issues_by_filter="issues_by_filter"
    :issues="issues"
    :categories="categories"
    :statuses="statuses"
    :is-read-only="false"
  >
    <template #delete>
      <button class="btn btn--small btn--danger sm:mt-4" @click="confirmDelete">
        Delete prout
      </button>
    </template>
  </dashboard-template>
</template>
<script>
import axios from 'axios';
import DashboardTemplate from '@/components/Dashboard/DashboardTemplate';
import { ROUTES } from '@/constant/routes';

export default {
  components: {
    DashboardTemplate,
  },

  props: {
    issues_by_filter: {
      type: Object,
      default: () => null,
    },
    issues: {
      type: Array,
      default: () => [],
    },
    categories: {
      type: Array,
      default: () => [],
    },
    statuses: {
      type: Array,
      default: () => [],
    },
  },

  mounted() {
    this.addDashboardLinkForAuthorizedPerson();
  },

  methods: {
    addDashboardLinkForAuthorizedPerson() {
      const hasDashboardAccess = localStorage.getItem('has-dashboard-access');
      if (!hasDashboardAccess) {
        localStorage.setItem('has-dashboard-access', true);
      }
    },

    confirmDelete(issueId) {
      console.log('confirm');
      if (confirm('Confirm your wish to delete')) {
        this.deleteIssue(issueId);
      }
    },

    deleteIssue(issueId) {
      console.log('issue id', issueId);
      const notification = {};
      axios
        .delete(`${ROUTES.issues.url}/${issueId}`)
        .then(() => {
          notification.message = 'Successfully deleted';
          notification.type = 'success';
          this.refreshData();
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
</script>
