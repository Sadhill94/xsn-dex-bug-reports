<template>
  <div>
    <div class="sm:hidden max-w-xs mx-auto">
      <label for="tabs" class="sr-only">Select a tab</label>
      <select
        id="tabs"
        name="tabs"
        @change="$emit('onFilterSelect', $event.target.value)"
        class="block w-full pl-3 pr-10 rounded-md uppercase focus:outline-none focus:ring-tertiary focus:border-tertiary"
      >
        <option
          :value="tab.name"
          v-for="tab in tabs"
          :key="`mobile${tab.name}`"
          class="uppercase"
        >
          {{ tab.name | removeUnderscore }}
        </option>
      </select>
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
export default {
  name: 'TabsFilters',

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
#tabs {
  @apply bg-secondary border-white py-4 px-4 text-body-md font-semibold tracking-wider;
}

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
