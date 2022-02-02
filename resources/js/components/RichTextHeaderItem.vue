<template>
  <button
    class="menu-item"
    type="button"
    :class="{ 'is-active': isActive ? isActive() : null }"
    @click="action"
    :title="title"
  >
    <i :class="`ri-${icon}`"></i>
  </button>
</template>

<script>
export default {
  props: {
    icon: {
      type: String,
      required: true,
    },

    title: {
      type: String,
      required: true,
    },

    action: {
      type: Function,
      required: true,
    },

    isActive: {
      type: Function,
      default: null,
    },
  },
};
</script>

<style lang="scss">
.menu-item {
  @apply w-10 h-10 bg-transparent text-tertiary rounded-sm;
  border: none;
  padding: 0.25rem;
  margin-right: 0.25rem;

  &.is-active,
  &:hover {
    @apply text-quaternary;
    @apply bg-secondary;
  }
}
</style>
