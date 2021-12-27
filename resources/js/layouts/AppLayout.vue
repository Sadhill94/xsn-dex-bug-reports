<template>
  <div class="flex flex-col min-h-screen">
    <navbar class="mb-12 bg-secondary" />
    <div class="pt-6 md:pt-12 lg:pt-20 pb-12 lg:pb-48 flex-grow relative">
      <slot />
    </div>
    <brand-footer />
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import BrandFooter from '@/components/BrandFooter';
import { ManagerMixin } from '@/mixins/manager';
export default {
  name: 'AppLayout',

  mixins: [ManagerMixin],

  components: { BrandFooter, Navbar },

  mounted() {
    this.setManagerLocalStorageIfNotExist();
  },
};
</script>
