<template>
  <div
    class="mt-5 sm:mt-6 sm:grid sm:grid-cols-4 sm:gap-3 sm:grid-flow-row-dense"
  >
    <div></div>
    <slot />
    <button class="btn btn--small bg-quaternary" @click="$emit('onCancel')">
      Cancel
    </button>
  </div>
</template>

<script>
export default {
  name: 'ModalFooter',
};
</script>
