<template>
  <div>
    <navbar class="mb-12" />
    <div class="pt-6 md:pt-12 lg:pt-20">
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
