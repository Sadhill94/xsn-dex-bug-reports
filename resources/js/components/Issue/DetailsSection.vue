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

        <div class="details-column">
          <dt class="required">Bug category</dt>
          <dd>
            <slot name="bug_category" />
          </dd>
        </div>

        <div class="details-column" v-if="$slots.trello_ref">
          <dt>Trello ref #</dt>
          <dd>
            <slot name="trello_ref" />
          </dd>
        </div>

        <div class="details-column">
          <dt class="required">Dex version</dt>
          <dd>
            <slot name="dex_version" />
          </dd>
        </div>

        <div class="details-column">
          <dt class="required">Short description</dt>
          <dd>
            <slot name="short_description" />
          </dd>
        </div>
      </dl>
    </div>

    <!-- SECOND ROWS-->
    <div class="details-row">
      <dl>
        <div class="details-column">
          <dt class="required">Operating system</dt>
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

        <div class="details-column">
          <dt>Github link</dt>
          <dd>
            <slot name="github_link" />
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
