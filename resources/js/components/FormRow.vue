<template>
  <div
    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-400 pt-5 sm:py-8"
  >
    <label class="block font-heading font-bold text-white sm:mt-px">
      <slot name="label" />
      <div class="lg:pr-10">
        <p
          v-for="info in additionalInfos"
          :key="info"
          class="text-body-sm font-medium mb-1"
        >
          {{ info }}.
        </p>
      </div>
    </label>

    <div class="mt-8 sm:mt-0 sm:col-span-2">
      <div class="max-w-xl flex rounded-md shadow-sm">
        <slot name="inputs" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FormRow',
  props: {
    additionalInfos: {
      type: Array,
      default: () => [],
    },
  },
};
</script>
