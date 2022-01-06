<template>
  <div
    class="flex justify-center md:justify-between items-stretch flex-wrap pt-6 pb-16 md:pb-20 z-0 md:-mx-8 lg:-mx-0"
  >
    <div
      v-for="issue in itemsToDisplay"
      :key="issue.description"
      class="w-full sm:w-9/12 md:w-1/2 lg:w-full xl:w-1/2 xxl:w-1/3 p-6 sm:px-0 md:px-6 lg:p-8 relative"
    >
      <issue-card
        :item="issueWithCategoryAndStatus(issue)"
        class="h-full"
        @onIssueDeleted="$emit('reloadIssues')"
      />
    </div>
    <div
      v-show="itemsToDisplay.length < 1"
      class="flex justify-center items-center w-full"
      style="min-height: 20rem"
    >
      <h4>No issues matching this filter</h4>
    </div>
  </div>
</template>

<script>
import _ from 'lodash';

import IssueCard from '@/components/IssueCard';
import { BUG_TYPE_NAME, FEATURE_TYPE_NAME } from '@/constant/common';
export default {
  name: 'DashboardIssuesList',

  components: { IssueCard },

  props: {
    items: {
      type: Array,
      default: () => [],
    },
    checkedTypes: {
      type: Array,
      default: () => [BUG_TYPE_NAME, FEATURE_TYPE_NAME],
    },
    missingNameProps: {
      type: String,
      default: '',
    },
  },
  computed: {
    itemsToDisplay() {
      if (this.checkedTypes.length < 2) {
        return this.items.filter((item) =>
          this.checkedTypes.includes(item?.type?.name)
        );
      }
      return this.items;
    },
  },

  methods: {
    issueWithCategoryAndStatus(issue) {
      const item = _.cloneDeep(issue);
      if (!item.category) {
        const category = {
          name: this.missingNameProps,
        };
        return { ...item, category };
      } else if (!item.status) {
        const status = {
          name: this.missingNameProps,
        };
        return { ...item, status };
      }
      return item;
    },
  },
};
</script>
