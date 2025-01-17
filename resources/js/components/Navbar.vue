<template>
  <nav>
    <div
      class="brand-container brand-container--xxl"
      :class="onDashboard && 'navbar--dashboard'"
    >
      <div class="relative flex items-center justify-between h-24 lg:h-32">
        <div class="absolute inset-y-0 left-0 flex items-center lg:hidden">
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
          class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start xl:px-20"
        >
          <div class="flex-shrink-0 flex items-center">
            <Link :href="route('home')">
              <img
                class="hidden xl:block w-28 h-auto"
                src="/images/xsn-logo.png"
                alt="xsn logo"
              />
            </Link>
          </div>
          <div class="hidden lg:flex items-center xl:ml-12">
            <ul class="flex space-x-3 xl:space-x-14">
              <li v-for="link in links" :key="link.name">
                <Link
                  :href="route(link.routeName)"
                  class="nav-link"
                  :class="{ active: $page.url === link.url }"
                  >{{ link.name }}</Link
                >
              </li>
              <li
                v-if="hasBasicAccessLogged"
                class="w-10 h-full bg-quaternary rounded-xl flex items-center justify-center font-bold"
              >
                <span v-show="isManager">M</span>
                <span v-show="isContributor">C</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="lg:hidden" id="mobile-menu" v-show="isMenuOpen">
      <div class="brand-container brand-container--xxl pt-2 pb-10">
        <ul class="space-y-5">
          <li v-for="link in links" :key="link.name">
            <Link
              :href="route(link.routeName)"
              class="nav-link"
              :class="{ 'active-mobile': $page.url === link.url }"
              >{{ link.name }}</Link
            >
          </li>
          <li
            v-if="hasBasicAccessLogged"
            class="ml-3 w-10 h-full bg-quaternary rounded-xl flex items-center justify-center font-bold text-center"
          >
            <span v-show="isManager">M</span>
            <span v-show="isContributor">C</span>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { LOGIN_LINK, LOGOUT_LINK, NAV_LINKS } from '@/constant/navbar';
import { RolesMixin } from '@/mixins/roles';

export default {
  name: 'Navbar',

  mixins: [RolesMixin],

  props: {
    onDashboard: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      isMenuOpen: false,
    };
  },

  computed: {
    links() {
      if (this.hasBasicAccessNotLogged) {
        return [...NAV_LINKS, LOGIN_LINK];
      } else if (this.hasBasicAccessLogged) {
        return [...NAV_LINKS, LOGOUT_LINK];
      }
      return NAV_LINKS;
    },
  },
};
</script>
<style lang="scss" scoped>
.navbar--dashboard {
  @apply px-4;
}
#mobile-menu {
  ul li {
    @apply block;
  }
}
.nav-link {
  @apply p-3 rounded-md text-white uppercase tracking-widest font-body bg-transparent transition-colors;
  @screen lg {
    @apply px-6 normal-case tracking-wider font-heading;
  }
}
.active {
  @apply bg-tertiary;
}
.active-mobile {
  @apply text-tertiary font-bold underline;
}
</style>
