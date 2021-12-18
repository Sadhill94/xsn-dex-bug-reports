<template>
  <div class="sticky top-0 pr-8 pt-4 pb-2 bg-transparent text-right z-50">
    <div class="text-right">
      <button
        type="button"
        @click="$emit('onToggle')"
        class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-white hover:text-tertiary focus:outline-none focus:ring-2 focus:ring-inset focus:ring-tertiary"
      >
        <span class="sr-only">{{
          isOpen ? 'Close sidebar' : 'Open sidebar'
        }}</span>
        <!-- Heroicon name: outline/menu -->
        <svg
          class="h-10 w-10"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          aria-hidden="true"
        >
          <!-- close -->
          <path
            v-if="isOpen"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />

          <!-- hamburger -->
          <path
            v-else
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"
          />
        </svg>
      </button>
    </div>

    <transition
      enter-active-class="transition ease-out duration-200 delay-200"
      enter-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition-opacity ease-linear duration-100"
      leave-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <Link
        v-show="isOpen"
        :href="route('home')"
        class="uppercase fixed top-8 left-24 text-tertiary border-b border-tertiary"
        style="z-index: 9999"
        >Back to home page</Link
      >
    </transition>
  </div>
</template>

<script>
export default {
  name: 'MobileDashboardNavbar',
  props: {
    isOpen: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
