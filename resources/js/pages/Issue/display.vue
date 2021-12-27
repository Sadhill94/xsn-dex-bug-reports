<template>
  <app-layout>
    <section class="issue-page brand-container brand-container--xxl">
      <div class="issue" v-if="issue">
        <div class="header">
          <div class="informations">
            <actions-section @onCopyClick="handleCopyLink">
              <h3>Details issue #{{ issue.id }}</h3>
              <a
                :href="getEditIssueUrl"
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
            <template #bug_category>
              <span>{{ issue.category.name }}</span>
            </template>

            <template #dex_version>
              <span>{{ issue.version }}</span>
            </template>

            <template #trello_ref v-if="isManager || isManagerNotLogged">
              <span>#{{ issue.trello_ref }}</span>
            </template>

            <template #short_description>
              <span>{{ issue.description }}</span>
            </template>

            <template #operating_system>
              <span>{{ issue.os }} {{ issue.os_distribution }}</span>
            </template>

            <template #assignee>
              <span>{{ issue.assignee || 'none' }}</span>
            </template>

            <template #user_discord_id>
              <span>{{ issue.user_discord_id }}</span>
            </template>

            <template #github_link>
              <span>
                <a
                  v-show="!isPropertyNullOrEmpty('github_link')"
                  :href="issue.github_link"
                  target="_blank"
                >
                  View
                </a>
                {{ isPropertyNullOrEmpty('github_link') ? 'none' : null }}
              </span>
            </template>
          </details-section>

          <rich-contents-section>
            <template #steps_to_reproduce>
              <span>
                {{ issue.steps_to_reproduce }}
              </span>
            </template>

            <template #extra_infos>
              <span>
                {{
                  isPropertyNullOrEmpty('extra_infos')
                    ? 'None provided'
                    : issue.extra_infos
                }}
              </span>
            </template>
          </rich-contents-section>

          <display-attachments-section
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
import { ManagerMixin } from '@/mixins/manager';
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

  mixins: [SingleIssueMixin, FiltersMixin, ManagerMixin],

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
