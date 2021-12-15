<template>
  <article class="bg-tertiary rounded-md p-6 lg:p-8">
    <h5 class="leading-9">{{ item.description }}</h5>
    <div class="flex items-center justify-between pt-2">
      <div>
        <p>Dec 12, 2021</p>
        <p class="font-semibold pt-1">Linux</p>
      </div>
      <issue-status-pill :name="item.status.name" class="w-44 lg:w-56" />
    </div>
    <div class="text-center pt-5" v-if="item.github_link">
      <a href="" class="font-bold hover:text-secondary">View in Github</a>
    </div>
  </article>
</template>

<script>
import IssueStatusPill from '@/components/IssueStatusPill';
export default {
  name: 'IssueCard',
  components: { IssueStatusPill },
  props: {
    item: {
      type: Object,
      default: null,
    },
  },
};
</script>
