<template>
  <nav>
    <h5 class="uppercase">
      <button
        class="h5 font-medium uppercase"
        @click="$emit('onKanbanClick', 'kanban')"
      >
        Kanban
      </button>
    </h5>
    <div v-for="filter in filters" :key="filter.name">
      <h5 class="uppercase font-medium border-b pb-1">
        {{ filter.name }}
      </h5>
      <ul class="pl-4 lg:pl-6 space-y-6 pt-4">
        <li v-for="subFilter in filter.subFilters">
          <button
            class="uppercase font-medium text-body-md hover:text-tertiary transition-colors duration-200"
            @click="$emit('onSubFilterClick', subFilter)"
          >
            {{ subFilter }}
          </button>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'NavFiltersList',
  props: {
    filters: {
      type: Array,
      default: () => [],
    },
  },
};
</script>
