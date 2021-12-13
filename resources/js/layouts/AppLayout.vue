<template>
  <div>
    <navbar class="mb-12" />
    <div class="brand-container brand-container--xxl pt-20">
      <slot />
    </div>
  </div>
</template>

<script>
import Navbar from '@/components/Navbar';
export default {
  name: 'AppLayout',
  components: { Navbar },
};
</script>
