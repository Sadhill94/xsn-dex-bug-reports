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
        @onSubFilterClick="$emit('onSubFilterClick', $event)"
        @onKanbanClick="$emit('onKanbanClick', $event)"
      />
    </mobile-sidebar>
    <div class="main-content-container flex flex-col flex-1">
      <mobile-dashboard-navbar
        class="md:hidden"
        :is-open="isMobileNavbarOpen"
        @onToggle="isMobileNavbarOpen = !isMobileNavbarOpen"
      />

      <!-- MAIN content -->
      <main class="flex-1">
        <slot />
      </main>
    </div>
  </div>
</template>

<script>
import MobileSidebar from '@/components/MobileSidebar';
import MobileDashboardNavbar from '@/components/MobileDashboardNavbar';
import NavFiltersList from '@/components/NavFiltersList';

export default {
  name: 'DashboardLayout',
  components: {
    NavFiltersList,
    MobileDashboardNavbar,
    MobileSidebar,
  },
  props: {
    filters: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      currentFilter: '',
      isMobileNavbarOpen: false,
    };
  },
};
</script>
