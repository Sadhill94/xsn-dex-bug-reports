<template>
  <div
    class="flex justify-center lg:justify-between items-center lg:items-start flex-wrap"
  >
    <div
      v-for="file in files"
      class="p-3 mb-6 lg:mb-10 w-full lg:w-60 mx-auto lg:m-0"
    >
      <a
        :href="file.file_path"
        target="_blank"
        class="flex items-center flex-col w-80 lg:w-60 mx-auto"
      >
        <img
          v-if="isLogOrTextFile(file.file_path)"
          src="/images/logFile.png"
          class="w-24"
        />
        <img v-else :src="file.file_path" class="w-full h-full lg:h-32" />
        <span class="pt-2 caption-lg text-center">
          {{ file.name | removeTimeStamp }}</span
        >
        <span class="pt-3">View</span>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FilesDisplay',
  props: {
    files: {
      type: Array,
      default: () => [],
    },
  },

  methods: {
    isLogOrTextFile(filePath) {
      return ['log', 'txt'].some((x) => filePath.includes(x));
    },
  },

  filters: {
    removeTimeStamp(value) {
      return value.split('_')[1];
    },
  },
};
</script>
