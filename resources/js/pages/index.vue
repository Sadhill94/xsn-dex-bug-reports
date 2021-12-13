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
    </div>
    <div class="brand-container brand-container--xxl lg:pt-24 pb-24">
      <h2 class="mb-8">Where to find your logs</h2>
      <find-logs-info-list />
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/layouts/AppLayout';
import FindLogsInfoList from '@/components/FindLogsInfoList';

export default {
  components: { FindLogsInfoList, AppLayout },
};
</script>
