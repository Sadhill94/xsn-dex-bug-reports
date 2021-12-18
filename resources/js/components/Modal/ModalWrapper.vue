<template>
  <div
    v-show="isOpen"
    class="fixed inset-0 z-10 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true"
  >
    <div
      class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <transition
        enter-active-class="transition ease-out duration-300"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity ease-in duration-200"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          v-show="isOpen"
          class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          :aria-hidden="!isOpen"
          @click="$emit('onClose')"
        ></div>
      </transition>

      <div v-show="isOpen" class="h-full w-full">
        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >
        <transition
          enter-active-class="ease-out duration-300"
          enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="ease-in duration-200"
          leave-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <slot />
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalWrapper',
  props: {
    isOpen: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
