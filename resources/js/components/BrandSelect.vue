<template>
  <select
    id="brand-select"
    name="brand-select"
    @change="$emit('onChange', $event.target.value)"
    v-model="localValue"
    class="pl-3 pr-10 uppercase"
  >
    <option
      :value="option.id || option.name"
      v-for="option in options"
      :key="option.name"
      class="uppercase"
    >
      {{ option.name | removeUnderscore }}
    </option>
  </select>
</template>

<script>
export default {
  name: 'BrandSelect',
  props: {
    options: {
      type: Array,
      default: () => [],
    },

    value: {
      type: String,
      default: '',
    },
  },

  data() {
    return {
      localValue: '',
    };
  },

  mounted() {
    if (this.value) {
      this.localValue = this.value;
    }
  },

  watch: {
    value(newValue) {
      console.log('NEW VALUE');
      if (newValue) {
        this.localValue = newValue;
      }
    },
  },

  filters: {
    removeUnderscore(value) {
      return value.replace('_', ' ');
    },
  },
};
</script>
<style lang="scss" scoped>
#brand-select {
  @apply max-w-xl p-4 shadow-sm block w-full border border-gray-400 rounded-md text-body-md;
  @apply bg-secondary font-semibold tracking-wider text-white cursor-pointer;

  &:focus {
    @apply border-tertiary ring-tertiary border-tertiary outline-none;
  }
}
</style>
