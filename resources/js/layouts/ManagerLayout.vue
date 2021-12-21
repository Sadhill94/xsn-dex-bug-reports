<template>
  <dashboard-template
    :current-filtered-view="currentFilteredView"
    :total-issues-number="allIssues.length"
  >
  </dashboard-template>
</template>

<script>
import DashboardTemplate from '@/components/Dashboard/DashboardTemplate';

export default {
  name: 'DashboardLayout',
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
};
</script>
