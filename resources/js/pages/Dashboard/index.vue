<template>
  <dashboard-layout
    :filters="issues_by_filter"
    :current-filter-view="currentFilteredView"
    @onSubFilterViewClick="handleSubFilterViewClick"
    @onKanbanViewClick="handleKanbanViewClick"
    @onAllViewClick="handleAllViewClick"
  >
    <div class="px-20">
      <h1 class="text-2xl font-semibold text-tertiary">Dashboard</h1>
      <div>
        <dashboard-issues-list :items="currentIssuesList" />
      </div>
    </div>
  </dashboard-layout>
</template>
<script>
import DashboardLayout from '@/layouts/DashboardLayout';
import DashboardIssuesList from '@/components/DashboardIssuesList';
import { ALL_FILTER_ID } from '@/constant/filtersId';

export default {
  components: { DashboardIssuesList, DashboardLayout },

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
      currentFilteredView: {
        filterId: ALL_FILTER_ID,
        subFilterId: '',
      },
    };
  },

  computed: {
    currentIssuesList() {
      const { filterId, subFilterId } = this.currentFilteredView;

      if (this.currentFilteredView.filterId === ALL_FILTER_ID) {
        return this.issues;
      }

      let relatedItems = [];
      try {
        relatedItems = this.issues_by_filter[filterId][subFilterId]?.items;
      } catch (err) {
        console.error(
          'Something went wrong finding the issues with this filters. Contact @Sadhill'
        );
        return [];
      }

      if (relatedItems.length < 1) {
        return this.issues;
      }
      return relatedItems;
    },
  },

  methods: {
    handleSubFilterViewClick(filtersIdObject) {
      this.currentFilteredView = filtersIdObject;
    },

    handleKanbanViewClick(kanbanFilterId) {
      this.currentFilteredView = { filterId: kanbanFilterId, subFilterId: '' };
    },

    handleAllViewClick(allFilterId) {
      this.currentFilteredView = { filterId: allFilterId, subFilterId: '' };
    },
  },
};
</script>
