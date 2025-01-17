<template>
  <app-layout>
    <div class="brand-container brand-container--lg">
      <h1>Stakenet DEX Feedbacks</h1>

      <p>
        Welcome to the Stakenet DEX feedbacks community website. Here you will
        be able to see the status of currently known issues or features requests
        and submit any new bugs or some particular feature you would like to see
        implemented on the dex.
      </p>
      <p>
        On the home page you will see a general view of all known feedbacks and
        how to correctly report, and find the related files (logs) when
        reporting a bug. You will as well see pending feature requests. On the
        Dashboard page, you will be able to apply filters to sort by status,
        category, type of feedbacks or view them all.
      </p>
      <p>
        You can see more about a particular feedback by clicking on the
        <i>Details</i> button on a card, where all details are provided.
      </p>
      <div class="mt-6">
        <h6 class="mb-0">DISCLAIMER</h6>
        <p class="mb-0">
          <strong>
            This is not an official website of the project! It is made and
            maintained by community members.
          </strong>
        </p>
        <p>
          Go to the official site here:
          <a
            href="https://stakenet.io/"
            target="_blank"
            class="text-tertiary hover:text-white transition-colors duration-200"
            >Stakenet.io</a
          >
        </p>
      </div>
      <br />
      <br />
      <br class="hidden lg:block" />
    </div>
    <div class="brand-container brand-container--lg text-center">
      <div
        class="flex flex-col md:flex-row items-center md:justify-between max-w-2xl md:max-w-5xl mx-auto space-y-8 md:space-y-0 md:space-x-32"
      >
        <a href="#reported-feedbacks" class="btn btn--tertiary btn--large">
          See reported feedbacks
        </a>
        <Link :href="route('bug-report')" class="btn btn--danger btn--large">
          Report a bug
        </Link>
      </div>
    </div>
    <br class="lg:hidden" />
    <br />
    <div class="brand-container brand-container--xxl lg:pt-24 pb-24">
      <h2 class="mb-8">Where to find your logs</h2>
      <find-logs-info-list />
    </div>
    <div class="brand-container brand-container--xxl pb-12 lg:pt-24">
      <h2 id="reported-feedbacks" class="mb-8">Reported feedbacks</h2>
      <search-field
        ref="searchField"
        class="text-left mt-6 lg:mt-8 max-w-lg"
        @onSearch="handleSearch"
      />
      <grouped-issues
        :items="currentIssuesList"
        :tabs="getTabs"
        :current-selected-status="currentSelectedStatus"
        @onTabChange="handleTabChange"
      />
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout';
import FindLogsInfoList from '@/components/FindLogsInfoList';
import GroupedIssues from '@/components/GroupedIssues';
import SearchField from '@/components/SearchField';

export default {
  components: { AppLayout, FindLogsInfoList, GroupedIssues, SearchField },

  props: {
    items: {
      type: Object,
      default: () => ({
        all: [],
        open: [],
        in_progress: [],
        in_review: [],
        closed: [],
      }),
    },
  },

  data() {
    return {
      isSearchActive: false,
      currentSelectedStatus: 'open',
      searchResults: [],
    };
  },

  computed: {
    getTabs() {
      return Object.keys(this.items).map((x) => {
        return { name: x, length: this.items[x].length };
      });
    },

    getCurrentSelectedIssuesStatus() {
      const filteredIssues = this.items[this.currentSelectedStatus];

      if (!filteredIssues) {
        return this.items.all;
      }
      return filteredIssues;
    },

    currentIssuesList() {
      if (this.isSearchActive) {
        return this.searchResults;
      }

      const filteredIssues = this.items[this.currentSelectedStatus];
      if (!filteredIssues) {
        return this.items.all;
      }
      return filteredIssues;
    },
  },

  methods: {
    handleTabChange(tabKey) {
      this.currentSelectedStatus = tabKey;
      this.$refs.searchField.resetSearchText();
    },

    handleSearch(searchInput) {
      if (searchInput) {
        this.isSearchActive = true;
        this.searchResults = this.$searchItems(
          this.items[this.currentSelectedStatus],
          searchInput
        );
      } else {
        this.isSearchActive = false;
        this.searchResults = [];
      }
    },
  },
};
</script>
