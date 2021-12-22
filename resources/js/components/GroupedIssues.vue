<template>
  <section>
    <div class="pt-4">
      <tabs-filters
        @onFilterSelect="currentSelectedStatus = $event"
        :tabs="getTabs"
        :active-tab="currentSelectedStatus"
      />
    </div>
    <div class="grouped-issues-container h-px">
      <div
        v-if="getCurrentSelectedIssuesStatus.length > 0"
        class="flex justify-center md:justify-between items-stretch flex-wrap pt-6"
      >
        <div
          v-for="(issue, index) in getCurrentSelectedIssuesStatus"
          :key="issue.id"
          class="w-full md:w-1/2 xl:w-1/3 p-6 lg:p-8"
        >
          <issue-card :item="issue" class="h-full" />
        </div>
      </div>
      <div
        v-else
        class="h-full flex flex-grow items-center text-center justify-center"
      >
        <h5 class="tracking-wider">
          No issues reported yet
          <span class="tracking-wider" v-show="currentSelectedStatus !== 'all'"
            >for this filter</span
          >
        </h5>
      </div>
    </div>
  </section>
</template>

<script>
import IssueCard from '@/components/IssueCard';
import TabsFilters from '@/components/TabsFilters';

export default {
  name: 'GroupedIssues',

  components: { TabsFilters, IssueCard },

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
      const filteredIssues = this.items[this.currentSelectedStatus];

      if (!filteredIssues) {
        return this.items.all;
      }
      return filteredIssues;
    },
    getTabs() {
      return Object.keys(this.items).map((x) => {
        return { name: x, length: this.items[x].length };
      });
    },
  },
};
</script>
<style lang="scss">
.grouped-issues-container {
  min-height: 10rem;

  @screen md {
    min-height: 20rem;
  }

  @screen xl {
    min-height: 46rem;
  }
}
</style>
