<template>
  <dashboard-template
    :issues_by_filter="issues_by_filter"
    :issues="issues"
    :categories="categories"
    :statuses="statuses"
  >
  </dashboard-template>
</template>
<script>
import DashboardTemplate from '@/components/Dashboard/DashboardTemplate';

export default {
  components: {
    DashboardTemplate,
  },

  mounted() {
    console.log('contribute issues', this.issues_by_filter);
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
