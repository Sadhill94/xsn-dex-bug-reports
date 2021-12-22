<template>
  <div>
    <navbar class="mb-12 bg-secondary" />
    <div class="pt-6 md:pt-12 lg:pt-20 pb-12 lg:pb-48">
      <slot />
    </div>
    <brand-footer />
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
import BrandFooter from '@/components/BrandFooter';
export default {
  name: 'AppLayout',
  components: { BrandFooter, Navbar },
};
</script>
