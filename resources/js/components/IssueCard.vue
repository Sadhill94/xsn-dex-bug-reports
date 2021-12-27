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
    <h4 class="leading-9 pt-6 pb-6 font-normal">{{ item.description }}</h4>
    <div :class="isManager || isManagerNotLogged ? 'mt-32' : 'mt-24'">
      <div
        class="text-center w-full mx-auto absolute inset-x-0"
        :class="isManager || isManagerNotLogged ? 'bottom-0 ' : 'bottom-10'"
      >
        <div class="relative">
          <a
            :href="getIssueUrl"
            target="_self"
            class="btn btn--secondary text-body-sm"
          >
            view details
          </a>
        </div>
        <div
          class="mt-10 mb-6 flex justify-around"
          v-show="isManager || isManagerNotLogged"
        >
          <button @click="confirmDelete" class="caption-lg uppercase">
            Delete
          </button>
          <a :href="getEditIssueUrl" target="_self" class="caption-lg uppercase"
            >Edit</a
          >
        </div>
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
