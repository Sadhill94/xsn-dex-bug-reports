<template>
  <div class="rich-contents">
    <dl class="rich-contents-row">
      <div
        class="rich-contents-column"
        :class="!$slots.steps_to_reproduce && 'is-single'"
      >
        <dt>Description</dt>
        <dd>
          <slot name="description" />
        </dd>
      </div>

      <div class="rich-contents-column" v-if="$slots.steps_to_reproduce">
        <dt>Steps to reproduce</dt>
        <dd>
          <slot name="steps_to_reproduce" />
        </dd>
      </div>
    </dl>
  </div>
</template>

<script>
export default {
  name: 'RichContentsSection',
};
</script>
