<template>
  <nav>
    <!--    <button-->
    <!--      class="h5 uppercase text-left tracking-wider cursor-not-allowed hover:bg-transparent focus:"-->
    <!--      @click="$emit('onKanbanViewClick', FILTERS_ID.kanban)"-->
    <!--      :class="isActive(FILTERS_ID.kanban) ? 'active' : 'inactive'"-->
    <!--      disabled-->
    <!--    >-->
    <!--      Kanban <span class="pr-6 text-body-xs">- coming soon</span>-->
    <!--    </button>-->
    <button
      class="sidebar-link h5 tracking-wider"
      @click="$emit('onAllViewClick', FILTERS_ID.all)"
      :class="isActive(FILTERS_ID.all) ? 'active' : 'inactive'"
    >
      All
      <span class="absolute right-3 md:right-6">
        {{ totalIssuesNumber }}
      </span>
    </button>
    <div>
      <h6 class="uppercase font-medium border-b pb-1">Types</h6>
      <div class="relative flex items-center py-4">
        <div class="min-w-0 flex-1">
          <label
            for="person-2"
            class="uppercase font-medium select-none text-body-md"
            >Bugs</label
          >
        </div>
        <div class="flex items-center h-6">
          <input
            id="type-1"
            name="type-1"
            type="checkbox"
            value="bug"
            v-model="checkedTypes"
            class="focus:ring-primary h-6 w-6 bg-quaternary text-quaternary border-primary rounded"
          />
        </div>
      </div>
      <div class="relative flex items-center py-4">
        <div class="min-w-0 flex-1">
          <label
            for="type-2"
            class="uppercase font-medium select-none text-body-md"
            >Features</label
          >
        </div>
        <div class="flex items-center h-6">
          <input
            id="type-2"
            name="type-2"
            type="checkbox"
            value="feature"
            v-model="checkedTypes"
            class="focus:ring-primary h-6 w-6 bg-quaternary text-quaternary border-primary rounded"
          />
        </div>
      </div>
    </div>

    <div v-for="(value, key) in filters" :key="key">
      <h6 class="uppercase font-medium border-b pb-1">
        {{ key }}
      </h6>
      <div class="pl-0 space-y-4 pt-4">
        <button
          v-for="subValue in value"
          :key="subValue.name"
          class="sidebar-link text-body-md"
          :class="isActive(subValue.id) ? 'active' : 'inactive'"
          @click="
            $emit('onSubFilterViewClick', {
              filterId: key,
              subFilterId: subValue.id,
              subFilterName: subValue.name,
            })
          "
        >
          {{ subValue.name }}
          <span class="absolute right-3 md:right-6">
            {{ subValue.items.length }}
          </span>
        </button>
      </div>
    </div>
  </nav>
</template>

<script>
import { ALL_FILTER_ID, KANBAN_FILTER_ID } from '@/constant/filtersId';
import { BUG_TYPE_NAME, FEATURE_TYPE_NAME } from '@/constant/common';

export default {
  name: 'NavFiltersList',

  props: {
    filters: {
      type: Object,
      default: () => null,
    },
    currentFilteredView: {
      type: Object,
      required: true,
    },

    totalIssuesNumber: {
      type: Number,
      default: 0,
    },
  },

  data() {
    return {
      checkedTypes: [BUG_TYPE_NAME, FEATURE_TYPE_NAME],
    };
  },

  computed: {
    FILTERS_ID() {
      return {
        all: ALL_FILTER_ID,
        kanban: KANBAN_FILTER_ID,
      };
    },
  },

  watch: {
    checkedTypes: {
      deep: true,
      handler(val) {
        this.$emit('onChangeCheckedTypes', val);
      },
    },
  },

  methods: {
    isActive(id) {
      return (
        this.currentFilteredView.filterId === id ||
        this.currentFilteredView.subFilterId === id
      );
    },
  },
};
</script>
<style lang="scss">
.sidebar-link {
  @apply relative font-medium uppercase block w-full text-left py-3 px-3 md:px-6 rounded-md transition-all duration-100;

  &:hover {
    @apply bg-quaternary #{!important};
  }
  &:focus {
    @apply outline-none ring-2 ring-indigo-400;
  }

  &.active {
    @apply bg-quaternary;
  }
  &.inactive {
    @apply bg-transparent;
  }
}
</style>
