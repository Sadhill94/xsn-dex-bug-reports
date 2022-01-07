<template>
  <div>
    <mobile-sidebar
      class="lg:hidden"
      v-if="isMobileNavbarOpen"
      :is-open="isMobileNavbarOpen"
      @onToggle="isMobileNavbarOpen = !isMobileNavbarOpen"
    >
      <nav-filters-list
        class="mt-5 px-10 md:px-12 lg:px-6 space-y-8"
        :filters="filters"
        :current-filtered-view="currentFilteredView"
        :total-issues-number="totalIssuesNumber"
        @onChangeCheckedTypes="$emit('onChangeCheckedTypes', $event)"
        @onSubFilterViewClick="
          $emit('onSubFilterViewClick', $event);
          isMobileNavbarOpen = false;
        "
        @onKanbanViewClick="
          $emit('onKanbanViewClick', $event);
          isMobileNavbarOpen = false;
        "
        @onAllViewClick="
          $emit('onAllViewClick', $event);
          isMobileNavbarOpen = false;
        "
      />
    </mobile-sidebar>

    <desktop-sidebar class="hidden lg:flex">
      <div class="absolute">
        <Link :href="route('home')">
          <img
            class="block lg:hidden w-28 h-auto"
            src="/images/xsn-logo.png"
            alt="xsn logo"
          />
        </Link>
      </div>
      <nav-filters-list
        class="justify-center flex flex-col flex-1 px-2 space-y-16"
        :filters="filters"
        :current-filtered-view="currentFilteredView"
        :total-issues-number="totalIssuesNumber"
        @onSubFilterViewClick="$emit('onSubFilterViewClick', $event)"
        @onKanbanViewClick="$emit('onKanbanViewClick', $event)"
        @onAllViewClick="$emit('onAllViewClick', $event)"
        @onChangeCheckedTypes="$emit('onChangeCheckedTypes', $event)"
      />
    </desktop-sidebar>
    <div class="main-content-container flex flex-col flex-1">
      <mobile-dashboard-navbar
        class="lg:hidden"
        :is-open="isMobileNavbarOpen"
        @onToggle="isMobileNavbarOpen = !isMobileNavbarOpen"
      />

      <!-- MAIN content -->
      <main class="flex-1 min-h-screen">
        <navbar class="hidden lg:block mb-12 bg-primary" :on-dashboard="true" />
        <slot />
      </main>
      <brand-footer />
    </div>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import DesktopSidebar from '@/components/Dashboard/DesktopSidebar';
import MobileSidebar from '@/components/Dashboard/MobileSidebar';
import MobileDashboardNavbar from '@/components/Dashboard/MobileDashboardNavbar';
import NavFiltersList from '@/components/Dashboard/NavFiltersList';
import BrandFooter from '@/components/BrandFooter';
import { RolesMixin } from '@/mixins/roles';

export default {
  name: 'DashboardLayout',

  mixins: [RolesMixin],

  components: {
    BrandFooter,
    NavFiltersList,
    MobileDashboardNavbar,
    MobileSidebar,
    DesktopSidebar,
    Navbar,
  },

  props: {
    currentFilteredView: {
      type: Object,
      required: true,
    },
    filters: {
      type: Object,
      default: () => null,
    },
    totalIssuesNumber: {
      type: Number,
      default: 0,
    },
  },

  data() {
    return {
      isMobileNavbarOpen: false,
    };
  },

  mounted() {
    this.setManagerLocalStorageIfNotExist();
    this.setContributorLocalStorageIfNotExist();
  },
};
</script>
<style lang="scss">
@screen lg {
  .static-sidebar-container {
    width: 30rem;
  }
  .main-content-container {
    padding-left: 30rem;
  }
}
@screen xxl {
  .static-sidebar-container {
    width: 30rem;
  }
  .main-content-container {
    padding-left: 30rem;
  }
}
</style>
