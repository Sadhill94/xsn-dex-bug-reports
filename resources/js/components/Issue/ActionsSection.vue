<template>
  <div class="actions">
    <button class="h3" @click="$emit('onCopyClick')">
      <img src="/images/link.png" alt="copy link" class="w-7 md:w-9" />
    </button>
    <slot />
  </div>
</template>

<script>
export default {
  name: 'ActionSection',
};
</script>
