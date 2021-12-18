<template>
  <div class="static-sidebar-container md:flex-col md:fixed md:inset-y-0">
    <div
      class="flex-1 flex flex-col min-h-0 bg-secondary pl-6 lg:pl-12 pr-2 lg:pr-6"
    >
      <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DesktopSidebar',
};
</script>
