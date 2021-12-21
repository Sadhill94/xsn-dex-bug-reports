<template>
  <div>
    <div class="sm:hidden max-w-xs mx-auto">
      <label class="sr-only">Select a tab</label>
      <brand-select
        :options="tabs"
        :value="tabs[0].name"
        class="w-full"
        @onChange="$emit('onFilterSelect', $event)"
      />
    </div>
    <div class="hidden sm:block">
      <div class="border-b border-tertiary">
        <nav class="-mb-px flex space-x-8 text-center" aria-label="Tabs">
          <button
            v-for="tab in tabs"
            :key="tab.name"
            class="tab__title uppercase"
            :class="activeTab === tab.name && 'active'"
            @click="$emit('onFilterSelect', tab.name)"
          >
            {{ tab.name | removeUnderscore }}
            <span class="tab__count">{{ tab.length || 0 }}</span>
          </button>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import BrandSelect from '@/components/BrandSelect';
export default {
  name: 'TabsFilters',
  components: { BrandSelect },
  props: {
    tabs: {
      type: Array,
      default: () => [],
    },
    activeTab: {
      type: String,
      default: 'all',
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
.tab {
  &__title {
    @apply border-transparent text-gray-500 whitespace-nowrap flex py-4 px-1 border-b-2 font-medium w-full flex justify-center items-center;

    &:hover {
      @apply text-gray-700 border-gray-200;
    }

    &.active {
      @apply border-white text-white font-semibold;
    }
  }

  &__count {
    @apply bg-gray-100 text-gray-900 hidden ml-6 py-2 px-4 rounded-full font-medium;

    @screen md {
      @apply inline-block;
    }
    &.active {
      @apply bg-indigo-100 text-indigo-600;
    }
  }
}
</style>
