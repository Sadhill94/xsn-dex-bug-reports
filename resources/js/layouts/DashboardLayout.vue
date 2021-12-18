<template>
  <div>
    <mobile-sidebar
      class="md:hidden"
      :is-open="isMobileNavbarOpen"
      @onToggle="isMobileNavbarOpen = !isMobileNavbarOpen"
    >
      <nav-filters-list
        class="mt-5 px-6 space-y-8"
        :filters="filters"
        :current-filtered-view="currentFilteredView"
        @onSubFilterViewClick="$emit('onSubFilterViewClick', $event)"
        @onKanbanViewClick="$emit('onKanbanViewClick', $event)"
        @onAllViewClick="$emit('onAllViewClick', $event)"
      />
    </mobile-sidebar>

    <desktop-sidebar class="hidden md:flex">
      <nav-filters-list
        class="justify-center flex flex-col flex-1 px-2 space-y-16"
        :filters="filters"
        :current-filtered-view="currentFilteredView"
        @onSubFilterViewClick="$emit('onSubFilterViewClick', $event)"
        @onKanbanViewClick="$emit('onKanbanViewClick', $event)"
        @onAllViewClick="$emit('onAllViewClick', $event)"
      />
    </desktop-sidebar>
    <div class="main-content-container flex flex-col flex-1">
      <mobile-dashboard-navbar
        class="md:hidden"
        :is-open="isMobileNavbarOpen"
        @onToggle="isMobileNavbarOpen = !isMobileNavbarOpen"
      />

      <!-- MAIN content -->
      <main class="flex-1">
        <navbar class="hidden md:block mb-12 bg-primary" />
        <slot />
      </main>
    </div>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import DesktopSidebar from '@/components/Dashboard/DesktopSidebar';
import MobileSidebar from '@/components/Dashboard/MobileSidebar';
import MobileDashboardNavbar from '@/components/Dashboard/MobileDashboardNavbar';
import NavFiltersList from '@/components/Dashboard/NavFiltersList';

export default {
  name: 'DashboardLayout',
  components: {
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
  },
  data() {
    return {
      isMobileNavbarOpen: false,
    };
  },
};
</script>
<style lang="scss">
@screen md {
  .static-sidebar-container {
    width: 24rem;
  }
  .main-content-container {
    padding-left: 24rem;
  }
}
@screen xl {
  .static-sidebar-container {
    width: 30rem;
  }
  .main-content-container {
    padding-left: 30rem;
  }
}
</style>
