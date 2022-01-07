<template>
  <dashboard-layout
    :filters="issuesByFilter"
    :current-filtered-view="currentFilteredView"
    :total-issues-number="allIssues.length"
    @onSubFilterViewClick="handleSubFilterViewClick"
    @onKanbanViewClick="handleKanbanViewClick"
    @onAllViewClick="handleAllViewClick"
    @onChangeCheckedTypes="handleChangeCheckedTypes"
  >
    <div class="pt-16 lg:pt-0 px-6 md:px-12 xl:px-20">
      <div
        class="flex flex-col lg:flex-row lg:items-start justify-between px-10 sm:px-32 md:px-0 lg:px-8 flex-wrap"
      >
        <h1 class="text-2xl font-semibold text-white mb-0">Dashboard</h1>
        <div class="max-w-full sm:max-w-md w-full text-left lg:text-right">
          <a
            href="https://github.com/X9Developers/stakenet-light-wallet"
            target="_blank"
            class="h4 mb-0 mt-6 lg:mt-0 inline-flex items-center hover:opacity-80 transition-opacity duration-200"
            >Github repository
            <img
              src="/images/external-link.png"
              alt="external link"
              class="w-8 ml-3"
            />
          </a>
        </div>
      </div>
      <div
        class="flex justify-between items-center mt-4 px-10 sm:px-32 md:px-0 lg:mt-12 lg:px-8"
      >
        <h2
          class="hidden md:inline-block text-white mb-0 uppercase tracking-wider border-b border-quaternary pb-2 text-quaternary"
        >
          {{
            currentFilteredView.subFilterName || currentFilteredView.filterId
          }}
        </h2>

        <search-field
          ref="searchField"
          class="text-left mt-6 lg:mt-8 max-w-lg"
          @onSearch="handleSearch"
        />
      </div>
      <div
        class="sticky pt-6 pb-3 px-10 sm:px-32 -top-2 bg-primary z-10 md:hidden"
      >
        <h4
          class="uppercase tracking-wider text-quaternary"
          v-show="currentFilteredView.filterId"
        >
          {{ currentFilteredView.filterId }}
        </h4>
        <h5
          v-show="currentFilteredView.subFilterName"
          class="uppercase text-body-md tracking-wider text-tertiary"
        >
          -> {{ currentFilteredView.subFilterName }}
        </h5>
      </div>
      <div class="border-t md:border-0">
        <dashboard-issues-list
          :key="currentCheckedTypes.length"
          :items="currentIssuesList"
          :missing-name-props="currentFilteredView.subFilterName"
          :checked-types="currentCheckedTypes"
          @reloadIssues="reloadIssues"
        />
      </div>
    </div>
  </dashboard-layout>
</template>

<script>
import { ALL_FILTER_ID } from '@/constant/filtersId';

import DashboardLayout from '@/layouts/DashboardLayout';
import DashboardIssuesList from '@/components/Dashboard/DashboardIssuesList';
import { BUG_TYPE_NAME, FEATURE_TYPE_NAME } from '@/constant/common';
import SearchField from '@/components/SearchField';

export default {
  name: 'DashboardTemplate',
  components: {
    SearchField,
    DashboardIssuesList,
    DashboardLayout,
  },

  props: {
    issues_by_filter: {
      type: Object,
      default: () => null,
    },
    issues: {
      type: Array,
      default: () => [],
    },
    categories: {
      type: Array,
      default: () => [],
    },
    statuses: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      issuesByFilter: {},
      allIssues: [],

      currentFilteredView: {
        filterId: ALL_FILTER_ID,
        subFilterId: '',
        subFilterName: '',
      },

      currentCheckedTypes: [BUG_TYPE_NAME, FEATURE_TYPE_NAME],

      isSearchActive: false,
      searchResults: [],
    };
  },

  mounted() {
    this.setStateIssues();
  },

  watch: {
    issues: {
      deep: true,
      handler() {
        this.setStateIssues();
      },
    },
  },

  computed: {
    currentIssueListForSearch() {
      const { filterId, subFilterId } = this.currentFilteredView;

      if (this.currentFilteredView.filterId === ALL_FILTER_ID) {
        return this.allIssues;
      }

      let relatedItems = [];
      try {
        relatedItems = this.issuesByFilter[filterId][subFilterId]?.items;
      } catch (err) {
        // eslint-disable-next-line no-console
        console.error(
          'Something went wrong finding the issues with this filters. Contact @Sadhill'
        );
        return [];
      }

      return relatedItems;
    },
    currentIssuesList() {
      if (this.isSearchActive) {
        return this.searchResults;
      }

      const { filterId, subFilterId } = this.currentFilteredView;

      if (this.currentFilteredView.filterId === ALL_FILTER_ID) {
        return this.allIssues;
      }

      let relatedItems = [];
      try {
        relatedItems = this.issuesByFilter[filterId][subFilterId]?.items;
      } catch (err) {
        // eslint-disable-next-line no-console
        console.error(
          'Something went wrong finding the issues with this filters. Contact @Sadhill'
        );
        return [];
      }

      return relatedItems;
    },
  },

  methods: {
    handleSearch(searchInput) {
      if (searchInput) {
        this.isSearchActive = true;
        this.searchResults = this.$searchItems(
          this.currentIssueListForSearch,
          searchInput
        );
      } else {
        this.isSearchActive = false;
        this.searchResults = [];
      }
    },

    reloadIssues() {
      this.$inertia.reload({ preserveState: false });
    },

    setStateIssues() {
      this.issuesByFilter = this.issues_by_filter;
      this.allIssues = this.issues;
    },

    handleSubFilterViewClick(filtersIdObject) {
      this.$refs.searchField.resetSearchText();
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
      this.$refs.searchField.resetSearchText();
      this.currentFilteredView = {
        filterId: allFilterId,
        subFilterId: '',
        subFilterName: '',
      };
    },
    handleChangeCheckedTypes(values) {
      this.currentCheckedTypes = values;
    },
  },
};
</script>
