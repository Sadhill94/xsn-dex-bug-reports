<template>
  <dashboard-layout
    :filters="issues_by_filter"
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
        <modal-footer @onSave="handleSaveCard" @onCancel="handleCancelEdit" />
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
  },

  computed: {
    currentIssuesList() {
      const { filterId, subFilterId } = this.currentFilteredView;

      if (this.currentFilteredView.filterId === ALL_FILTER_ID) {
        return this.issues;
      }

      let relatedItems = [];
      try {
        relatedItems = this.issues_by_filter[filterId][subFilterId]?.items;
      } catch (err) {
        // eslint-disable-next-line no-console
        console.error(
          'Something went wrong finding the issues with this filters. Contact @Sadhill'
        );
        return [];
      }

      if (relatedItems.length < 1) {
        return this.issues;
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

    addDashboardhLinkForAuthorizedPerson() {
      const hasDashboardAccess = localStorage.getItem('has-dashboard-access');
      if (!hasDashboardAccess) {
        localStorage.setItem('has-dashboard-access', true);
      }
    },
  },
};
</script>
