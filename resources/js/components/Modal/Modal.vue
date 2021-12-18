<template>
  <modal-wrapper :is-open="isOpen" @onClose="$emit('onClose')">
    <div
      v-show="isOpen"
      class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle md:w-2/3 xl:w-7/12 sm:p-6"
    >
      <slot />
      <div class="mt-12">
        <slot name="footer" />
      </div>
    </div>
  </modal-wrapper>
</template>

<script>
import ModalWrapper from '@/components/Modal/ModalWrapper';
import ModalFooter from '@/components/Modal/ModalFooter';
export default {
  name: 'Modal',
  components: { ModalFooter, ModalWrapper },
  props: {
    isOpen: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
