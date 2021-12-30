<template>
  <app-layout>
    <div class="brand-container brand-container--lg">
      <h1>Submit a feature request</h1>
      <p>
        You will find here the form to submit your bug(s). IMPORTANT: Before
        submitting a new bug head to the dashboard and check if your problem is
        already reported*.
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
        <p class="caption-lg italic">
          *The search issue feature is on it's way, but for now there is nothing
          to help you find your issue in the reported list, i apologize for the
          inconvenience.
        </p>
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
      <form-issue :categories="categories" :form-name="FEATURE_FORM_NAME" />
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/layouts/AppLayout';
import FormIssue from '@/components/FormIssue';
import { FEATURE_FORM_NAME } from '@/constant/form';

export default {
  components: { AppLayout, FormIssue },
  props: {
    categories: {
      type: Array,
      default: () => [],
    },
  },
  computed: {
    FEATURE_FORM_NAME() {
      return FEATURE_FORM_NAME;
    },

    logsCategories() {
      return [
        {
          name: 'LND',
          description: 'Opening and closing a channel for BTC, LTC and XSN.',
        },
        {
          name: 'SWAPS',
          description:
            'Related to the process of manual swaps in the dex tab (not the SSUI).',
        },
        {
          name: 'CONNEXT',
          description:
            'Opening, funding and withdrawing from a channel for ETH and ERC token.',
        },
        {
          name: 'MCLW',
          description:
            'Related to the client as a whole (client, L1 transactions).',
        },
        {
          name: 'UI',
          description: 'Related to visual indicators or text typos.',
        },
        {
          name: 'SSUI',
          description:
            'Specifically relating to when the simple swap UI is active.',
        },
      ];
    },
  },
};
</script>
