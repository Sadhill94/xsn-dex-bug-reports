<template>
  <app-layout>
    <div class="brand-container brand-container--lg">
      <h1>Stakenet DEX bug reports</h1>

      <p>
        Welcome to the Stakenet DEX bug reports community website. Here you will
        be able to see the status of currently known issues and submit any new
        bugs.
      </p>
      <p>
        On the home page you will see a general view of all known issues and how
        to correctly report, and find the related files (logs) when reporting a
        bug. On the Dashboard page, you will be able to apply filters to sort by
        status, category or view all issues.
      </p>
      <p>
        You can see more about a particular issue by clicking on the
        <i>View details</i> button for the bug report where all details are
        provided. If required, you will be able to see and download all relevant
        attachments provided during the report.
      </p>
      <div class="mt-6">
        <h6 class="mb-0">DISCLAIMER</h6>
        <p class="mb-0">
          <strong>
            This is not an official website of the project! It is made and
            maintained by community members.
          </strong>
        </p>
        <p>
          Go to the official site here:
          <a
            href="https://stakenet.io/"
            target="_blank"
            class="text-tertiary hover:text-white transition-colors duration-200"
            >Stakenet.io</a
          >
        </p>
      </div>
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
