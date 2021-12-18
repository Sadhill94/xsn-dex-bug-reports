<template>
  <div class="sticky top-0 pr-8 pt-4 pb-2 bg-transparent text-right">
    <button
      type="button"
      @click="$emit('onToggle')"
      class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-white hover:text-tertiary focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
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
