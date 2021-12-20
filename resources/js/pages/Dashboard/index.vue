<template>
  <dashboard-layout
    :filters="issuesByFilter"
    :current-filtered-view="currentFilteredView"
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
          @onEditCardClick="handleEditCard"
        />
      </div>
    </div>
    <modal :is-open="isModalOpen" @onClose="isModalOpen = false">
      <template #default>
        <modal-body>
          <form-issue
            v-if="currentSelectedIssue.id"
            :key="currentSelectedIssue.id"
            :issue="currentSelectedIssue"
            :categories="categories"
            :method="FORM_METHODS.edit"
          />
        </modal-body>
      </template>

      <template #footer>
        <modal-footer @onCancel="handleCancelEdit">
          <button class="btn btn--small bg-red-500" @click="confirmDelete">
            Delete
          </button>
        </modal-footer>
      </template>
    </modal>
  </dashboard-layout>
</template>
<script>
import axios from 'axios';

import { ALL_FILTER_ID } from '@/constant/filtersId';

import DashboardLayout from '@/layouts/DashboardLayout';
import DashboardIssuesList from '@/components/Dashboard/DashboardIssuesList';

import Modal from '@/components/Modal/Modal';
import ModalFooter from '@/components/Modal/ModalFooter';
import ModalBody from '@/components/Modal/ModalBody';

import FormIssue from '@/components/FormIssue';
import { FORM_METHODS } from '@/constant/form';
import { ROUTES } from '@/constant/routes';

export default {
  components: {
    FormIssue,
    ModalBody,
    ModalFooter,
    Modal,
    DashboardIssuesList,
    DashboardLayout,
  },

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
    categories: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      isModalOpen: false,

      issuesByFilter: {},
      allIssues: [],
      filters: [],

      currentSelectedIssue: {},
      currentFilteredView: {
        filterId: ALL_FILTER_ID,
        subFilterId: '',
        subFilterName: '',
      },
    };
  },

  mounted() {
    this.addDashboardhLinkForAuthorizedPerson();

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

    handleEditCard(issue) {
      this.currentSelectedIssue = issue;
      this.isModalOpen = true;
      // TODO
    },

    handleSaveCard() {
      // TODO
    },

    handleCancelEdit() {
      this.isModalOpen = false;
      // TODO
    },

    confirmDelete() {
      if (confirm('Confirm your wish to delete')) {
        this.deleteIssue();
      }
    },

    deleteIssue() {
      const notification = {
        duration: 1500,
      };
      axios
        .delete(`${ROUTES.issues.url}/${this.currentSelectedIssue.id}`)
        .then((res) => {
          notification.message = 'Successfully deleted';
          notification.type = 'success';
          this.refreshData();
        })
        .catch((err) => {
          notification.message = err.response.statusText;
          notification.type = 'error';
        })
        .finally(() => {
          this.$displayNotification(notification);
        });
    },

    refreshData() {
      axios
        .get(ROUTES.issues.url)
        .then((res) => {
          console.log('RESPONSE THEN', res.data);
        })
        .catch((err) => {
          console.log('ERROR', err);
        });
    },

    addDashboardhLinkForAuthorizedPerson() {
      const hasDashboardAccess = localStorage.getItem('has-dashboard-access');
      if (!hasDashboardAccess) {
        localStorage.setItem('has-dashboard-access', true);
      }
    },
  },
};
</script>
