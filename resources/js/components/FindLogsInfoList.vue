<template>
  <div
    class="flex flex-col xl:flex-row justify-between items-stretch space-y-12 xl:space-y-0 xl:space-x-12"
  >
    <div
      v-for="os in osList"
      :key="os.name"
      class="w-full bg-secondary rounded-md pb-6 md:pb-12"
    >
      <div class="bg-tertiary p-8 text-center rounded-t-md mb-6">
        <h4 class="tracking-widest mb-0">
          {{ os.name }}
        </h4>
      </div>
      <div class="space-y-6 px-4 md:px-8">
        <div
          v-for="(file, index) in os.paths"
          :key="file.name"
          class="p-4"
          :class="index < os.paths.length - 1 && 'border-b border-secondary'"
        >
          <div class="flex justify-start items-center mb-3">
            <button @click="copyPath(file.path)">
              <img class="w-8 h-auto" src="/images/copy.png" alt="Workflow" />
            </button>
            <h6 class="mb-0 pl-3">{{ file.name }}</h6>
          </div>
          <p
            tabindex="0"
            class="cursor-pointer break-words hover:text-tertiary"
            @click="copyPath(file.path)"
          >
            {{ file.path }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { POSITION } from 'vue-toastification';
import { OS_LIST } from '@/constant/osList';

export default {
  name: 'FindLogsInfoList',
  computed: {
    osList() {
      return OS_LIST;
    },
  },
  methods: {
    copyPath(path) {
      navigator.clipboard.writeText(path);
      this.$displayNotification({
        message: 'Copied to clipboard!',
      });
    },
  },
};
</script>
