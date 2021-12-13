<template>
  <nav class="bg-secondary">
    <div class="brand-container brand-container--xxl">
      <div class="relative flex items-center justify-between h-24 md:h-32">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button
            type="button"
            class="inline-flex items-center justify-center p-2 rounded-md text-tertiary focus:outline-none focus:ring-2 focus:ring-inset focus:ring-tertiary"
            aria-controls="mobile-menu"
            aria-expanded="false"
            @click="isMenuOpen = !isMenuOpen"
          >
            <span class="sr-only">Open main menu</span>
            <svg
              v-show="!isMenuOpen"
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
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
            <svg
              class="h-10 w-10"
              v-show="isMenuOpen"
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
        <div
          class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start"
        >
          <div class="flex-shrink-0 flex items-center">
            <img
              class="block lg:hidden w-24 h-auto"
              src="/images/xsn-logo.png"
              alt="xsn logo"
            />
            <img
              class="hidden lg:block w-32 h-auto"
              src="/images/xsn-logo.png"
              alt="xsn logo"
            />
          </div>
          <div class="hidden sm:flex items-center sm:ml-12">
            <div class="flex space-x-12">
              <a
                href=""
                @click="$inertia.visit('/')"
                class="text-white block px-3 py-2"
                aria-current="page"
                >Home</a
              >

              <a
                href=""
                @click="$inertia.get('/report-a-bug')"
                class="block px-3 py-2"
                >Report a bug</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" v-show="isMenuOpen">
      <div class="px-2 pt-2 pb-3 space-y-6">
        <a
          href=""
          @click="$inertia.visit('/')"
          class="text-white block px-3 py-2"
          aria-current="page"
          >Home</a
        >

        <a
          href=""
          @click="$inertia.get('/report-a-bug')"
          class="block px-3 py-2"
          >Report a bug</a
        >
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',
  data() {
    return {
      isMenuOpen: false,
    };
  },
};
</script>
