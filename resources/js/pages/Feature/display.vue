<template>
  <app-layout>
    <section class="issue-page brand-container brand-container--xxl">
      <div class="issue" v-if="item">
        <div class="header">
          <div class="informations">
            <actions-section @onCopyClick="handleCopyLink">
              <h3>Details feature #{{ item.id }}</h3>
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
                  <span>{{ item.status.name }}</span>
                </dd>
              </div>
            </dl>
          </div>
        </div>
        <div class="body">
          <details-section>
            <template #type>
              <span class="uppercase tracking-wider">{{ item.type.name }}</span>
            </template>

            <template #category>
              <span>{{ item.category.name }}</span>
            </template>

            <template #trello_ref v-if="isManager || isManagerNotLogged">
              <span>
                {{ item.trello_ref ? `# ${item.trello_ref}` : '-' }}
              </span>
            </template>

            <template #short_description>
              <span>{{ item.description }}</span>
            </template>

            <template #assignee>
              <span>{{ item.assignee || '-' }}</span>
            </template>

            <template #user_discord_id>
              <span>
                {{ item.user_discord_id ? `# ${item.user_discord_id}` : '-' }}
              </span>
            </template>
          </details-section>

          <rich-contents-section>
            <template #extra_infos>
              <span>
                {{ item.extra_infos ? item.extra_infos : 'None provided' }}
              </span>
            </template>
          </rich-contents-section>

          <display-attachments-section
            :files="item.files"
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
