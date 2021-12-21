<template>
  <dashboard-layout
    :filters="issuesByFilter"
    :current-filtered-view="currentFilteredView"
    :total-issues-number="allIssues.length"
    @onSubFilterViewClick="handleSubFilterViewClick"
    @onKanbanViewClick="handleKanbanViewClick"
    @onAllViewClick="handleAllViewClick"
  >
    <div class="px-6 md:px-20">
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
        <dashboard-issues-list
          :items="currentIssuesList"
          :key="currentSelectedIssue.id"
          @onOpenCardClick="handleOpenCard"
        />
      </div>
    </div>
    <modal :is-open="isModalOpen" @onClose="handleCloseModal">
      <template #default>
        <modal-body>
          <form-issue
            v-if="currentSelectedIssue.id"
            :key="currentSelectedIssue.id"
            :issue="currentSelectedIssue"
            :categories="categories"
            :statuses="statuses"
            :method="FORM_METHODS.edit"
            :is-on-public-page="false"
            :is-on-manager="true"
            @onEditCardSuccess="refreshData"
          >
            <template #form-header>
              <p>
                Reported on :
                {{ currentSelectedIssue.created_at | humanizeDate }}
              </p>
            </template>
          </form-issue>
        </modal-body>
      </template>

      <template #footer>
        <modal-footer @onCancel="handleCloseModal">
          <button
            class="btn btn--small bg-red-500"
            @click="$emit('confirmDelete', currentSelectedIssue.id)"
          >
            Delete
          </button>
        </modal-footer>
      </template>
    </modal>
  </dashboard-layout>
</template>

<script>
import { ALL_FILTER_ID } from '@/constant/filtersId';

import DashboardLayout from '@/layouts/DashboardLayout';
import DashboardIssuesList from '@/components/Dashboard/DashboardIssuesList';

import Modal from '@/components/Modal/Modal';
import ModalFooter from '@/components/Modal/ModalFooter';
import ModalBody from '@/components/Modal/ModalBody';

import FormIssue from '@/components/FormIssue';
import { FORM_METHODS } from '@/constant/form';
import { ROUTES } from '@/constant/routes';
import { formatDate } from '@/helpers/date';
import axios from 'axios';

export default {
  name: 'DashboardTemplate',
  components: {
    FormIssue,
    ModalBody,
    ModalFooter,
    Modal,
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
      isModalOpen: false,

      issuesByFilter: {},
      allIssues: [],

      currentSelectedIssue: {},
      currentFilteredView: {
        filterId: ALL_FILTER_ID,
        subFilterId: '',
        subFilterName: '',
      },
    };
  },

  mounted() {
    this.issuesByFilter = this.issues_by_filter;
    this.allIssues = this.issues;
  },

  computed: {
    currentIssuesList() {
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

      if (relatedItems.length < 1) {
        return this.allIssues;
      }
      return relatedItems;
    },

    FORM_METHODS() {
      return FORM_METHODS;
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

    handleOpenCard(issue) {
      this.currentSelectedIssue = issue;
      this.isModalOpen = true;
    },

    handleCloseModal() {
      this.isModalOpen = false;
      this.currentSelectedIssue = { id: '' };
    },

    refreshData() {
      axios
        .get(ROUTES.issues.url)
        .then((res) => {
          this.allIssues = res?.data?.issues || [];
          this.issuesByFilter = res?.data?.issues_by_filter || {};
          this.handleCloseModal();
        })
        .catch((err) => {
          this.$displayNotification({
            message: `Error while trying to refresh the data. Retry and in case contact @Sadhill : ${err.response.statusText}`,
            type: 'error',
          });
          console.log('ERROR', err);
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
<style lang="scss">
@screen md {
  .static-sidebar-container {
    width: 24rem;
  }
  .main-content-container {
    padding-left: 24rem;
  }
}
@screen xl {
  .static-sidebar-container {
    width: 30rem;
  }
  .main-content-container {
    padding-left: 30rem;
  }
}
</style>
