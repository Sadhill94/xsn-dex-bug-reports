<template>
  <article class="bg-tertiary rounded-md p-6 lg:p-8" v-if="item">
    <div class="text-center border-b border-primary" v-if="item.category">
      <h6 class="tracking-widest text-primary">
        {{ item.category.name }}
      </h6>
    </div>
    <h5 class="leading-9 pt-3">{{ item.description }}</h5>
    <div class="flex items-center justify-between pt-2">
      <div>
        <p class="capitalize">{{ item.created_at | humanizeDate }}</p>
        <p class="font-semibold pt-1">{{ item.os }}</p>
      </div>
      <issue-status-pill
        v-if="item.status"
        :name="item.status.name"
        class="w-44 lg:w-56"
      />
    </div>
    <div class="text-center pt-5" v-if="hasGithubLink">
      <a
        :href="item.github_link"
        target="_blank"
        rel="noreferrer noopener"
        class="inline-flex justify-center items-center hover:opacity-50 transition-opacity duration-200"
        >View in Github
        <img src="/images/external-link.png" class="w-6 ml-3" />
      </a>
    </div>
    <div>
      <slot />
    </div>
  </article>
</template>

<script>
import { formatDate } from '@/helpers/date';

import IssueStatusPill from '@/components/IssueStatusPill';

export default {
  name: 'IssueCard',

  components: { IssueStatusPill },

  props: {
    item: {
      type: Object,
      default: null,
    },
  },

  computed: {
    hasGithubLink() {
      if (this.issue.github_link) {
        // backend production env has this value
        return this.issue.github_link !== 'null';
      }
      return false;
    },
  },

  filters: {
    humanizeDate(value) {
      return formatDate(value);
    },
  },
};
</script>
