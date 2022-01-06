<template>
  <app-layout>
    <section class="issue-page brand-container brand-container--xxl">
      <div class="issue" v-if="issue">
        <div class="header">
          <div class="informations">
            <actions-section @onCopyClick="handleCopyLink">
              <h3>Details issue #{{ issue.id }}</h3>
              <a
                :href="getEditUrl"
                aria-label="edit"
                v-if="isManager || isManagerNotLogged"
              >
                <img src="/images/edit.png" class="w-7" alt="delete image" />
              </a>
              <button
                @click="confirmDeleteIssue"
                aria-label="delete"
                v-if="isManager"
              >
                <img src="/images/bin.png" class="w-7" alt="delete image" />
              </button>
            </actions-section>
            <dl class="status">
              <div>
                <dt>Status</dt>
                <dd>
                  <span>{{ issue.status.name }}</span>
                </dd>
              </div>
            </dl>
          </div>
        </div>
        <div class="body">
          <details-section>
            <template #type>
              <span class="uppercase tracking-wider">{{
                issue.type.name
              }}</span>
            </template>

            <template #category>
              <span>{{ issue.category.name }}</span>
            </template>

            <template #dex_version v-if="issue.version">
              <span>{{ issue.version }}</span>
            </template>

            <template #trello_ref v-if="isManager || isManagerNotLogged">
              <span>
                {{ issue.trello_ref ? `# ${issue.trello_ref}` : '-' }}
              </span>
            </template>

            <template #short_description>
              <span>{{ issue.description }}</span>
            </template>

            <template #operating_system v-if="issue.os">
              <span>{{ issue.os }} {{ issue.os_distribution }}</span>
            </template>

            <template #assignee>
              <span>{{ issue.assignee || '-' }}</span>
            </template>

            <template #user_discord_id>
              <span>
                {{ issue.user_discord_id ? `# ${issue.user_discord_id}` : '-' }}
              </span>
            </template>

            <template #github_link>
              <span>
                <a
                  v-show="issue.github_link"
                  :href="issue.github_link"
                  target="_blank"
                >
                  View
                </a>
                {{ issue.github_link ? null : '-' }}
              </span>
            </template>
          </details-section>

          <rich-contents-section>
            <template #steps_to_reproduce v-if="issue.steps_to_reproduce">
              <span>
                {{ issue.steps_to_reproduce }}
              </span>
            </template>

            <template #extra_infos>
              <span>
                {{ issue.extra_infos ? issue.extra_infos : 'None provided' }}
              </span>
            </template>
          </rich-contents-section>

          <display-attachments-section
            v-if="hasBasicAccess"
            :files="issue.files"
            @deleteFile="deleteFile($event, true)"
          />
        </div>
      </div>
    </section>
  </app-layout>
</template>
<script>
import { SingleIssueMixin } from '@/mixins/single-issue';
import { RolesMixin } from '@/mixins/roles';
import { FiltersMixin } from '@/mixins/filters';

import DetailsSection from '@/components/Issue/DetailsSection';
import RichContentsSection from '@/components/Issue/RichContentsSection';
import DisplayAttachmentsSection from '@/components/Issue/DisplayAttachmentsSection';
import ActionsSection from '@/components/Issue/ActionsSection';
import AppLayout from '@/layouts/AppLayout';

export default {
  name: 'display',

  components: {
    ActionsSection,
    DetailsSection,
    RichContentsSection,
    DisplayAttachmentsSection,
    AppLayout,
  },

  mixins: [SingleIssueMixin, FiltersMixin, RolesMixin],

  mounted() {
    window.addEventListener('onReloadNeeded', this.handleReload);
  },
  methods: {
    handleReload() {
      this.$inertia.reload();
    },
  },
};
</script>
