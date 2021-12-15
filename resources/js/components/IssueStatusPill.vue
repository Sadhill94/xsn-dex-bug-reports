<template>
  <div
    class="py-3 px-4 bg-secondary rounded-md caption-sm uppercase text-center"
  >
    {{ name }}
  </div>
</template>

<script>
export default {
  name: 'IssueStatusPill',
  props: {
    name: {
      type: String,
      required: true,
    },
  },
};
</script>
