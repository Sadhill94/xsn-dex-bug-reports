<template>
  <div class="sm:mt-6 text-center pb-6 px-10 sm:px-0">
    <slot />
    <button
      class="btn btn--small bg-quaternary mt-10 sm:mt-4"
      @click="$emit('onCancel')"
    >
      Close
    </button>
  </div>
</template>

<script>
export default {
  name: 'ModalFooter',
};
</script>
