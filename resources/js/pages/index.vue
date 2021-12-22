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
      <div
        class="flex flex-col md:flex-row items-center md:justify-between max-w-2xl md:max-w-5xl mx-auto space-y-8 md:space-y-0 md:space-x-32"
      >
        <a href="#reported-issues" class="btn btn--tertiary btn--large">
          See reported issues
        </a>
        <Link :href="route('bug-report')" class="btn btn--danger btn--large">
          Report a bug
        </Link>
      </div>
    </div>
    <br class="lg:hidden" />
    <br />
    <div class="brand-container brand-container--xxl lg:pt-24 pb-24">
      <h2 class="mb-8">Where to find your logs</h2>
      <find-logs-info-list />
    </div>
    <div class="brand-container brand-container--xxl pb-12 lg:pt-24">
      <h2 id="reported-issues" class="mb-8">Reported issues</h2>
      <grouped-issues :items="issues" />
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout';
import FindLogsInfoList from '@/components/FindLogsInfoList';
import GroupedIssues from '@/components/GroupedIssues';

export default {
  components: { AppLayout, FindLogsInfoList, GroupedIssues },
  props: {
    issues: {
      type: Object,
      default: null,
    },
  },
};
</script>
