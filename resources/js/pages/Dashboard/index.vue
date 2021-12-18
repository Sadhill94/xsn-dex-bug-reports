<template>
  <dashboard-layout
    :filters="issues_by_filter"
    :current-filtered-view="currentFilteredView"
    @onSubFilterViewClick="handleSubFilterViewClick"
    @onKanbanViewClick="handleKanbanViewClick"
    @onAllViewClick="handleAllViewClick"
  >
    <div class="px-20">
      <h1 class="text-2xl font-semibold text-tertiary mb-0">Dashboard</h1>
      <div class="sticky pt-6 pb-3 top-0 bg-primary z-10 md:hidden">
        <h4 class="uppercase tracking-wider">
          {{ currentFilteredView.filterId }}
        </h4>
        <h5
          v-if="currentFilteredView.subFilterName"
          class="uppercase text-body-md tracking-wider text-tertiary"
        >
          -> {{ currentFilteredView.subFilterName }}
        </h5>
      </div>
      <div class="border-t md:border-0">
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
    // eslint-disable-next-line camelcase
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
        subFilterName: '',
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
        // eslint-disable-next-line no-console
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
      this.currentFilteredView = {
        filterId: kanbanFilterId,
        subFilterId: '',
        subFilterName: '',
      };
    },

    handleAllViewClick(allFilterId) {
      this.currentFilteredView = {
        filterId: allFilterId,
        subFilterId: '',
        subFilterName: '',
      };
    },
  },
};
</script>
