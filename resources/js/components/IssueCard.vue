<template>
  <article
    class="flex flex-col bg-secondary rounded-md relative shadow-lg"
    v-if="item"
  >
    <div class="p-10 flex-none">
      <div
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-8 space-y-2 sm:space-y-0"
      >
        <div class="flex justify-start items-start md:items-center space-x-2">
          <h6 class="card-header-title">
            {{ item.type.name }}
          </h6>
          <h6 class="card-header-title">#{{ item.id }}</h6>
          <h6 class="card-header-title">
            <span class="hidden sm:inline-block mr-2">-</span
            >{{ item.category.name }}
          </h6>
        </div>

        <div class="flex-none w-44 lg:w-48 sm:text-right">
          <p
            class="inline-block mb-0 uppercase font-semibold font-heading text-quaternary border-b-2 border-quaternary tracking-wider"
          >
            {{ item.status.name }}
          </p>
        </div>
      </div>
      <h4 class="leading-10 font-medium pr-12 md:pr-24 font-body mb-0">
        {{ item.description }}
      </h4>
    </div>
    <div class="flex flex-grow items-end">
      <div class="flex flex-grow border-t py-7">
        <div class="px-10 flex justify-between items-center w-full h-full">
          <p class="mb-0">{{ item.created_at | humanizeDate }}</p>
          <a
            :href="getIssueUrl"
            target="_self"
            class="btn btn--quaternary text-body-sm w-32 text-center rounded-full p-2 sm:p-4"
          >
            Details
          </a>
        </div>
      </div>
    </div>
    <div
      class="w-full flex items-stretch"
      v-if="isManager || isManagerNotLogged"
    >
      <button
        @click="confirmDelete"
        class="caption-lg uppercase w-1/2 bg-danger h-full rounded-bl-md"
      >
        Delete
      </button>
      <div class="flex items-center w-1/2 h-full bg-quaternary rounded-br-md">
        <a
          :href="getEditIssueUrl"
          target="_self"
          class="caption-lg uppercase block w-full text-center"
          >Edit</a
        >
      </div>
    </div>
  </article>
</template>

<script>
import IssueStatusPill from '@/components/IssueStatusPill';
import { ROUTES } from '@/constant/routes';
import axios from 'axios';
import { FiltersMixin } from '@/mixins/filters';
import { ManagerMixin } from '@/mixins/manager';

export default {
  name: 'IssueCard',

  mixins: [FiltersMixin, ManagerMixin],

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

    getEditIssueUrl() {
      return ROUTES.web.issue.edit.url.replace('{id}', this.item.id);
    },
  },
  methods: {
    confirmDelete() {
      if (confirm(`Confirm your wish to delete issue #${this.item.id}`)) {
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
          this.$emit('onIssueDeleted');
        })
        .catch((err) => {
          notification.message =
            err?.response?.statusText || 'Something went wrong';
          notification.type = 'error';
        })
        .finally(() => {
          this.$displayNotification(notification);
        });
    },
  },
};
</script>
<style lang="scss">
.card-header-title {
  @apply mb-0 uppercase font-bold tracking-widest font-body;
}
</style>
