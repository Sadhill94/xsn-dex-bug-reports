<template>
  <article class="bg-quaternary rounded-md p-8 relative" v-if="item">
    <div class="text-center border-b border-primary" v-if="item.category">
      <h6 class="tracking-widest text-primary">
        {{ item.category.name }}
      </h6>
    </div>
    <div class="flex justify-between items-center pt-5">
      <p class="capitalize text-body-md font-medium">
        {{ item.created_at | humanizeDate }}
      </p>
      <p v-if="item.status" class="uppercase font-bold">
        {{ item.status.name }}
      </p>
    </div>
    <h4 class="leading-9 pt-6 font-normal">{{ item.description }}</h4>
    <div class="pt-24">
      <div class="text-center w-full mx-auto absolute inset-x-0 bottom-10">
        <a
          :href="getIssueUrl"
          target="_blank"
          class="btn btn--secondary max-w-sm mx-auto text-body-sm"
        >
          view details
        </a>
      </div>
    </div>
  </article>
</template>

<script>
import { formatDate } from '@/helpers/date';

import IssueStatusPill from '@/components/IssueStatusPill';
import { ROUTES } from '@/constant/routes';

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
    getIssueUrl() {
      return ROUTES.web.issue.display.url.replace('{id}', this.item.id);
    },
    hasGithubLink() {
      if (this.item?.github_link) {
        // backend production env has this value
        return this.item.github_link !== 'null';
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
