<template>
  <div
    class="flex justify-center md:justify-between items-stretch flex-wrap pt-6 pb-16 md:pb-20 z-0"
  >
    <div
      v-for="issue in items"
      :key="issue.description"
      class="w-full sm:w-9/12 md:w-1/2 xl:w-1/3 p-6 lg:p-8 relative"
    >
      <issue-card
        :item="issue"
        class="h-full"
        @refreshData="$emit('refreshData')"
      />
    </div>
    <div
      v-show="items.length < 1"
      class="flex justify-center items-center w-full"
      style="min-height: 20rem"
    >
      <h4>No issues matching this filter</h4>
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
