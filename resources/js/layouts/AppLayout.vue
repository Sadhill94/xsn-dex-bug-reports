<template>
  <div class="flex flex-col min-h-screen">
    <navbar class="mb-12 bg-secondary" />
    <div
      class="pt-6 md:pt-12 lg:pt-20 pb-12 lg:pb-48 flex-grow relative min-height-applied"
    >
      <slot />
    </div>
    <brand-footer />
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import BrandFooter from '@/components/BrandFooter';
import { RolesMixin } from '@/mixins/roles';
export default {
  name: 'AppLayout',

  mixins: [RolesMixin],

  components: { BrandFooter, Navbar },

  mounted() {
    this.setManagerLocalStorageIfNotExist();
    this.setContributorLocalStorageIfNotExist();
  },
};
</script>
<style lang="scss">
.min-height-applied {
  min-height: 45rem;
  @screen sm {
    min-height: 20rem;
  }
}
</style>
