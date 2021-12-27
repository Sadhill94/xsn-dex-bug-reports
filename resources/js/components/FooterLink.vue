<template>
  <a
    :target="target"
    class="text-tertiary hover:text-white transition-colors duration-100"
  >
    <slot />
  </a>
</template>

<script>
export default {
  name: 'FooterLink',
  props: {
    target: {
      type: String,
      default: '_blank',
    },
  },
};
</script>
