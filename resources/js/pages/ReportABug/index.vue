<template>
  <app-layout>
    <div class="brand-container brand-container--lg">
      <h1>Report a bug</h1>
      <p>
        You will find here the form to submit your bug(s). IMPORTANT: Before
        submitting a new bug head to the dashboard and check if your problem is
        already reported, use the search functionality to find out.
      </p>

      <p>
        When reporting a bug, please try to be as clear as possible and please
        use simple <strong>English</strong>.
      </p>
      <p>
        When submitting your logs with the report, please submit
        <strong>CLEAN log files</strong>. Clean logs significantly help the
        teams locate the problem. Thanks
      </p>

      <p>
        NB: Try to submit logs file related to your bug, do not submit lnd logs
        files if you're having an UI issue.
      </p>
      <div>
        <h5>How to clean my logs ?</h5>
        <p>
          Head to your logs files (see on the home page where to find them), and
          delete them or open them and empty their content.
        </p>
        <h6>
          Last but not least, Thank you for taking the time to report your
          bug(s), we really appreciate it !
        </h6>
      </div>
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
      <form-issue :categories="categories" />
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/layouts/AppLayout';
import FormIssue from '@/components/FormIssue';
import { CATEGORIES_BREAKDOWN } from '@/constant/categoriesBreakdown';

export default {
  components: { AppLayout, FormIssue },
  props: {
    categories: {
      type: Array,
      default: () => [],
    },
  },
  computed: {
    logsCategories() {
      return CATEGORIES_BREAKDOWN;
    },
  },
};
</script>
