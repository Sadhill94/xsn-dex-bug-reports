<template>
  <dashboard-layout
    :filters="filters"
    @onSubFilterClick="handleSubFilterClick"
    @onKanbanClick="handleKanbanDisplay"
  >
    <div class="px-20">
      <h1 class="text-2xl font-semibold text-tertiary">Dashboard</h1>
    </div>
  </dashboard-layout>
</template>
<script>
import DashboardLayout from '@/layouts/DashboardLayout';

export default {
  components: { DashboardLayout },

  props: {
    issues_by_filter: {
      type: Object,
      default: () => null,
    },
    issues: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      filters: [],
    };
  },

  mounted() {
    this.setFilters();
  },

  methods: {
    /**
     * Extract each filters name and sub-filters name from the payload issues_by_filters
     * Example of payload fomr issues_by_filters
     * issues_by_filters: {
     *  statuses: {
     *    open: [],
     *    in_progress: []
     *  }
     * }
     *
     * After looping through the key of issues_by_filters, we create an object and set the filter property key as filter name
     * as the current key in the loop (in our case statuses) and create the array property subFilters
     * We then loop through all keys that statuses has and push them through subFilters,
     * Example of result
     * filters = [
     *  {
     *    name: statuses,
     *    subFilters: ['open','in_progress',...]
     *  }
     * ]
     */
    setFilters() {
      const filters = [];

      if (this.issues_by_filter) {
        Object.keys(this.issues_by_filter).forEach((filter) => {
          const currentFilter = {
            name: filter,
            subFilters: [],
          };

          Object.keys(this.issues_by_filter[filter]).forEach((category) => {
            currentFilter.subFilters.push(category);
          });

          filters.push(currentFilter);
        });
      }
      this.filters = filters;
    },

    handleSubFilterClick(subFilter) {
      // TODO handle
    },

    handleKanbanDisplay() {
      // TODO handle
    },
  },
};
</script>
