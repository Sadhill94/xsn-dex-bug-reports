<template>
  <modal-wrapper :is-open="isOpen" @onClose="$emit('onClose')">
    <div
      v-show="isOpen"
      class="relative inline-block align-bottom bg-secondary rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle w-11/12 md:w-2/3 xl:w-6/12 sm:p-6"
    >
      <div class="absolute text-white top-10 left-12">
        <button @click="$emit('onClose')">
          <svg
            class="h-10 w-10"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>
      <slot />
      <div class="sm:mt-4">
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

  /**
   * Avoid the body to be scrollable when the modal is open
   */
  watch: {
    isOpen() {
      document.querySelector('body').classList.toggle('lg:overflow-hidden');
    },
  },
};
</script>
