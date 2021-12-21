<template>
  <div
    class="sm:mt-6 sm:grid sm:grid-cols-4 sm:gap-3 text-center pb-6 px-10 sm:px-0"
  >
    <div class="hidden sm:block"></div>
    <slot />
    <button
      class="btn btn--small bg-quaternary mt-10 sm:mt-4"
      @click="$emit('onCancel')"
    >
      Cancel
    </button>
  </div>
</template>

<script>
export default {
  name: 'ModalFooter',
};
</script>
