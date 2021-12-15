<template>
  <div class="flex justify-center md:justify-between items-stretch flex-wrap">
    <div
      v-for="issue in getCurrentSelectedIssuesStatus"
      :key="issue.id"
      class="w-full md:w-1/2 xl:w-1/3 p-6 lg:p-8"
    >
      <public-issue-card :item="issue" class="h-full" />
    </div>
  </div>
</template>

<script>
import PublicIssueCard from '@/components/PublicIssueCard';

export default {
  name: 'GroupedIssues',

  components: { PublicIssueCard },

  props: {
    items: {
      type: Object,
      default: () => ({
        all: [],
        open: [],
        in_progress: [],
      }),
    },
  },
  data() {
    return {
      currentSelectedStatus: 'all',
    };
  },
  computed: {
    getCurrentSelectedIssuesStatus() {
      if (this.currentSelectedStatus === 'all') {
        return this.items.all || [];
      }
    },
  },
};
</script>
