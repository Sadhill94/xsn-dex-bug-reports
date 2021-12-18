<template>
  <nav>
    <h5 class="uppercase">
      <button
        class="h5 font-medium uppercase"
        @click="$emit('onKanbanViewClick', FILTERS_ID.kanban)"
      >
        Kanban <span class="pr-6 text-body-xs">- coming soon</span>
      </button>
    </h5>
    <h5>
      <button
        class="h5 font-medium uppercase"
        @click="$emit('onAllViewClick', FILTERS_ID.all)"
      >
        All
      </button>
    </h5>
    <div v-for="(value, key) in filters" :key="key">
      <h5 class="uppercase font-medium border-b pb-1">
        {{ key }}
      </h5>
      <ul class="pl-4 lg:pl-6 space-y-6 pt-4">
        <li v-for="subValue in value">
          <button
            class="uppercase font-medium text-body-md hover:text-tertiary transition-colors duration-200"
            @click="
              $emit('onSubFilterViewClick', {
                filterId: key,
                subFilterId: subValue.id,
              })
            "
          >
            {{ subValue.name }}
          </button>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { ALL_FILTER_ID, KANBAN_FILTER_ID } from '@/constant/filtersId';

export default {
  name: 'NavFiltersList',

  props: {
    filters: {
      type: Object,
      default: () => null,
    },
  },
  computed: {
    FILTERS_ID() {
      return {
        all: ALL_FILTER_ID,
        kanban: KANBAN_FILTER_ID,
      };
    },
  },
};
</script>
