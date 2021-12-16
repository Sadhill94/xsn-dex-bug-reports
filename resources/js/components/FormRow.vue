<template>
  <div
    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-400 pt-5 sm:py-8"
  >
    <label class="block font-heading font-bold text-white sm:mt-px">
      <slot name="label" />
    </label>

    <div class="mt-3 sm:mt-0 sm:col-span-2">
      <div class="max-w-xl flex rounded-md shadow-sm">
        <slot name="inputs" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FormRow',
};
</script>

<style scoped></style>
