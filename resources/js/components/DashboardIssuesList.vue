<template>
  <div>
    <div v-for="item in items" :key="item.id">
      <issue-card class="h-full" :item="item" />
    </div>
  </div>
</template>

<script>
import IssueCard from '@/components/IssueCard';

export default {
  name: 'DashboardIssuesList',

  components: { IssueCard },

  props: {
    items: {
      type: Array,
      default: () => [],
    },
  },
};
</script>
