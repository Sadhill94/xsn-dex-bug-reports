<template>
  <div class="fixed inset-0 flex z-20" role="dialog" aria-modal="true">
    <transition
      enter-active-class="transition ease-out duration-100"
      enter-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition-opacity ease-linear duration-300"
      leave-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="isOpen"
        class="fixed inset-0 bg-gray-800 bg-opacity-75"
        aria-hidden="true"
      ></div>
    </transition>

    <transition
      enter-active-class="transition ease-in-out duration-300 transform"
      enter-class="-translate-x-full"
      enter-to-class="translate-x-0"
      leave-active-class="transition ease-in-out duration-300 transform"
      leave-class="translate-x-0"
      leave-to-class="-translate-x-full"
    >
      <div
        class="relative flex-1 flex flex-col max-w-md md:max-w-sm w-full bg-primary"
        style="z-index: 99"
        v-show="isOpen"
      >
        <transition
          enter-active-class="transition ease-out duration-300"
          enter-class="opacity-0"
          enter-to-class="opacity-100"
          leave-active-class="transition-opacity ease-linear duration-300"
          leave-class="opacity-100"
          leave-to-class="opacity-0"
        >
        </transition>

        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
          <div class="flex-shrink-0 flex items-center px-4 pb-6">
            <Link :href="route('home')">
              <img
                class="h-auto w-16"
                src="/images/xsn-logo.png"
                alt="xsn logo"
              />
            </Link>
            <Link
              v-show="isOpen"
              :href="route('home')"
              class="uppercase text-tertiary border-b border-tertiary ml-4"
              style="z-index: 9999"
              >Back to home page</Link
            >
          </div>
          <slot />
        </div>
      </div>
    </transition>

    <div class="flex-shrink-0 w-14">
      <!-- Force sidebar to shrink to fit close icon -->
    </div>
  </div>
</template>

<script>
export default {
  name: 'MobileSidebar',
  props: {
    isOpen: {
      type: Boolean,
      default: false,
    },
  },
};
</script>

<style scoped></style>
