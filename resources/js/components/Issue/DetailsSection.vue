<template>
  <div class="details">
    <!-- FIRST ROWS -->
    <div class="details-row">
      <dl>
        <div class="details-column" v-if="$slots.status">
          <dt class="required">Status</dt>
          <dd>
            <slot name="status" />
          </dd>
        </div>

        <div class="details-column" v-if="$slots.type">
          <dt class="required">Type</dt>
          <dd>
            <slot name="type" />
          </dd>
        </div>

        <div class="details-column">
          <dt class="required">Category</dt>
          <dd>
            <slot name="category" />
          </dd>
        </div>

        <div class="details-column" v-if="$slots.dex_version">
          <dt>Dex version</dt>
          <dd>
            <slot name="dex_version" />
          </dd>
        </div>

        <div class="details-column">
          <dt class="required">Title</dt>
          <dd>
            <slot name="title" />
          </dd>
        </div>
      </dl>
    </div>

    <!-- SECOND ROWS-->
    <div class="details-row">
      <dl>
        <div class="details-column" v-if="$slots.trello_ref">
          <dt>Trello ref #</dt>
          <dd>
            <slot name="trello_ref" />
          </dd>
        </div>

        <div class="details-column" v-if="$slots.operating_system">
          <dt>Operating system</dt>
          <dd>
            <slot name="operating_system" />
          </dd>
        </div>

        <div class="details-column" v-if="$slots.os_distribution">
          <dt>OS distribution</dt>
          <dd>
            <slot name="os_distribution" />
          </dd>
        </div>

        <div class="details-column">
          <dt>Assignee</dt>
          <dd>
            <slot name="assignee" />
          </dd>
        </div>

        <div class="details-column">
          <dt>Reported by</dt>
          <dd>
            <slot name="user_discord_id" />
          </dd>
        </div>
      </dl>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DetailsSection',
};
</script>
