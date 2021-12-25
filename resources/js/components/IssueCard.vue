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
    <div :class="isManager ? 'pt-36' : 'pt-24'">
      <div
        class="text-center w-full mx-auto absolute inset-x-0"
        :class="isManager ? 'bottom-0' : 'bottom-10'"
      >
        <div class="relative">
          <a
            :href="getIssueUrl"
            target="_blank"
            class="btn btn--secondary text-body-sm"
          >
            view details
          </a>
        </div>
        <div class="mt-10 pb-6 flex justify-around" v-show="isManager">
          <button @click="confirmDelete" class="caption-lg uppercase">
            Delete
          </button>
          <a
            :href="getEditIssueUrl"
            target="_blank"
            class="caption-lg uppercase"
            >Edit</a
          >
        </div>
      </div>
    </div>
  </article>
</template>

<script>
import { formatDate } from '@/helpers/date';

import IssueStatusPill from '@/components/IssueStatusPill';
import { ROUTES } from '@/constant/routes';
import axios from 'axios';

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
    isManager() {
      return true;
      return this.$page?.props?.auth?.user;
    },

    getIssueUrl() {
      return ROUTES.web.issue.display.url.replace('{id}', this.item.id);
    },

    getEditIssueUrl() {
      return ROUTES.web.issue.edit.url.replace('{id}', this.item.id);
    },
    hasGithubLink() {
      if (this.item?.github_link) {
        // backend production env has this value
        return this.item.github_link !== 'null';
      }
      return false;
    },
  },
  methods: {
    confirmDelete() {
      if (confirm('Confirm your wish to delete')) {
        this.deleteIssue(this.item.id);
      }
    },

    deleteIssue(issueId) {
      const notification = {};
      axios
        .delete(ROUTES.api.issue.delete.url.replace('{id}', issueId))
        .then(() => {
          notification.message = 'Successfully deleted';
          notification.type = 'success';
          this.$emit('refreshData');
        })
        .catch((err) => {
          notification.message = err.response.statusText;
          notification.type = 'error';
        })
        .finally(() => {
          this.$displayNotification(notification);
        });
    },
  },
  filters: {
    humanizeDate(value) {
      return formatDate(value);
    },
  },
};
</script>
