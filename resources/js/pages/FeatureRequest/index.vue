<template>
  <app-layout>
    <div class="brand-container brand-container--lg">
      <h1>Submit a feature request</h1>

      <p>
        You will find here the form to submit your feature request(s).
        IMPORTANT: Before submitting a new feature request head to the dashboard
        and check if someone has already asked for it, use the search
        functionality to find out.
      </p>
      <p>
        When asking for a feature, please use simple
        <strong>English</strong> and try to be as clear/short as possible.
      </p>
      <p>
        NB: If you think screenshots would be helpful we encourage you to add
        them.
      </p>
      <br />
      <br />
      <br class="hidden lg:block" />
    </div>
    <div class="brand-container brand-container--xxl lg:pt-24">
      <h2>Categories breakdown</h2>
      <div class="flex justify-between items-stretch flex-wrap">
        <div
          v-for="logCategory in logsCategories"
          :key="logCategory.name"
          class="w-full md:w-1/2 lg:w-1/3 pt-10 md:p-8"
        >
          <h3 class="text-tertiary">{{ logCategory.name }}</h3>
          <p class="md:pr-16 lg:pr-8 xl:pr-24">
            {{ logCategory.description }}
          </p>
        </div>
      </div>
    </div>
    <div class="brand-container brand-container--lg lg:pt-24">
      <form-issue
        :categories="categories"
        :form-name="formName"
        :endpoint="formEndpoint"
      />
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/layouts/AppLayout';
import FormIssue from '@/components/FormIssue';
import { FEATURE_FORM_NAME } from '@/constant/form';
import { CATEGORIES_BREAKDOWN } from '@/constant/categoriesBreakdown';
import { ROUTES } from '@/constant/routes';

export default {
  components: { AppLayout, FormIssue },
  props: {
    categories: {
      type: Array,
      default: () => [],
    },
  },
  computed: {
    formName() {
      return FEATURE_FORM_NAME;
    },
    formEndpoint() {
      return ROUTES.api.issue.create_feature.url;
    },

    logsCategories() {
      return CATEGORIES_BREAKDOWN;
    },
  },
};
</script>
