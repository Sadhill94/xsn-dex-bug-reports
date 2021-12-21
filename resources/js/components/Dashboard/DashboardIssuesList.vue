<template>
  <div
    v-if="items.length > 0"
    class="flex justify-center md:justify-between items-stretch flex-wrap pt-6 z-0"
  >
    <div
      v-for="(issue, index) in items"
      :key="issue.id"
      data-aos="fade-up"
      data-aos-duration="500"
      :data-aos-delay="index * 150"
      class="w-full lg:w-1/2 xl:w-1/3 p-6 lg:p-8"
    >
      <issue-card :item="issue" class="h-full">
        <div class="text-center pt-6 w-32 mx-auto">
          <button
            class="btn btn--small btn--quaternary"
            @click="$emit('onOpenCardClick', issue)"
          >
            edit
          </button>
        </div>
      </issue-card>
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
