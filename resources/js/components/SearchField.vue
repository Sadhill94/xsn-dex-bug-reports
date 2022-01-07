<template>
  <div class="flex flex-col w-full text-left">
    <label for="search-field" class="font-semibold">Search</label>
    <input
      id="search-field"
      class="border border-gray-500 rounded-md bg-secondary p-5 text-body-md mt-2 placeholder-gray-500"
      type="text"
      placeholder="Write something to find a ticket"
      v-model.trim="searchText"
    />
    <div class="text-center mt-5 lg:mt-3">
      <button
        class="caption-sm inline-flex w-auto justify-center text-quaternary underline"
        :class="searchText ? 'visible' : 'invisible'"
        @click="searchText = ''"
      >
        clear search
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SearchField',
  data() {
    return {
      searchText: '',
    };
  },
  watch: {
    searchText(newValue) {
      if (newValue.length > 1) {
        this.$emit('onSearch', newValue);
      } else if (!newValue) {
        this.$emit('onSearch', '');
      }
    },
  },
};
</script>
