<template>
  <section>
    <div class="pt-4">
      <tabs-filters
        @onFilterSelect="$emit('onTabChange', $event)"
        :tabs="tabs"
        :active-tab="currentSelectedStatus"
      />
    </div>
    <div class="grouped-issues-container" :class="items.length < 1 && 'h-px'">
      <div
        v-if="items.length > 0"
        class="flex justify-center md:justify-between items-stretch flex-wrap pt-6"
      >
        <div
          v-for="item in items"
          :key="item.id"
          class="w-full md:w-1/2 xl:w-1/3 p-6 lg:p-8"
        >
          <issue-card :item="item" class="h-full" />
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
      type: Array,
      default: () => [],
    },

    tabs: {
      type: Array,
      default: () => [],
    },

    currentSelectedStatus: {
      type: String,
      default: 'open',
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
