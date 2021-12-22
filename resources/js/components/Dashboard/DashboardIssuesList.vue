<template>
  <div
    class="flex justify-center md:justify-between items-stretch flex-wrap pt-6 z-0"
  >
    <div
      v-for="(issue, index) in items"
      :key="issue.id"
      class="w-full lg:w-1/2 xl:w-1/3 p-6 lg:p-8 relative"
    >
      <issue-card :item="issue" class="h-full">
        <div class="text-center pt-24 lg:pt-20 w-full mx-auto">
          <button
            class="btn btn--small btn--quaternary absolute left-0 right-0 max-w-sm mx-auto bottom-14"
            @click="$emit('onOpenCardClick', issue)"
          >
            {{ canEdit ? 'edit' : 'view details' }}
          </button>
        </div>
      </issue-card>
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
    canEdit: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
