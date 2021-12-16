<template>
  <app-layout class="pb-24">
    <div class="brand-container brand-container--lg">
      <h1>Report a bug</h1>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
        commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia deserunt
        mollit anim id est laborum
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
      <form-issue :categories="categories" />
    </div>
  </app-layout>
</template>
<script>
import AppLayout from '@/layouts/AppLayout';
import FormIssue from '@/components/FormIssue';

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
      return [
        {
          name: 'LND',
          description:
            'Issues with opening and closing a channel for BTC, LTC and XSN.',
        },
        {
          name: 'SWAPS',
          description:
            'Issues related to the process of manual swaps in the dex tab (not the SSUI).',
        },
        {
          name: 'CONNEXT',
          description:
            'Issues with opening, funding and withdrawing from a channel for ETH and ERC token.',
        },
        {
          name: 'MCLW',
          description:
            'Issues related to the client as a whole (client crash, L1 transactions issues).',
        },
        {
          name: 'UI',
          description: 'Issues relating to visual indicators or text typos.',
        },
        {
          name: 'SSUI',
          description:
            'Issues specifically relating to when the simple swap UI is active.',
        },
      ];
    },
  },
};
</script>
