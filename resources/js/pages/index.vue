<template>
  <app-layout>
    <div class="brand-container brand-container--lg">
      <h1>Stakenet DEX bug reports</h1>
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
    <div class="brand-container brand-container--lg text-center">
      <a
        href="#open-issues"
        class="p-6 w-full max-w-md rounded-md bg-tertiary text-white"
      >
        See current open issues
      </a>
    </div>
    <br class="lg:hidden" />
    <br />
    <div class="brand-container brand-container--xxl lg:pt-24 pb-24">
      <h2 class="mb-8">Where to find your logs</h2>
      <find-logs-info-list />
    </div>
    <div class="brand-container brand-container--xxl lg:pt-24 pb-24">
      <h2 id="open-issues" class="mb-8">Open issues</h2>
      <div v-for="issue in issues" :key="issue.id">
        <p>{{ issue.description }}</p>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout';
import FindLogsInfoList from '@/components/FindLogsInfoList';

export default {
  components: { FindLogsInfoList, AppLayout },
  props: {
    issues: {
      type: Array,
      default: () => [],
    },
  },
};
</script>
