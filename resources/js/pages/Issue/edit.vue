<template>
  <app-layout>
    <section
      id="edit-issue-page"
      class="issue-page brand-container brand-container--xxl"
    >
      <div class="issue" v-if="issue">
        <div class="header">
          <div class="informations">
            <share-section @onCopyClick="handleCopyLink">
              <h3 class="mb-0">Edit issue #{{ issue.id }}</h3>
              <button @click="confirmDeleteIssue" aria-label="delete">
                <img src="/images/bin.png" class="w-7" alt="delete image" />
              </button>
            </share-section>
          </div>
        </div>

        <div class="body">
          <details-section>
            <template #status>
              <brand-select
                :options="statuses"
                :value="localIssue.status_id"
                class="input"
                @onChange="localIssue.status_id = $event.toString()"
              />
            </template>
            <template #bug_category>
              <brand-select
                :options="categories"
                :value="localIssue.category_id"
                class="input"
                @onChange="localIssue.category_id = $event.toString()"
              />
            </template>

            <template #dex_version>
              <input
                type="text"
                class="input"
                v-model.trim="localIssue.version"
              />
            </template>
            <template #short_description>
              <input
                type="text"
                class="input"
                v-model.trim="localIssue.description"
              />
            </template>

            <template #operating_system>
              <brand-select
                :options="OS_OPTIONS"
                :value="localIssue.os"
                class="input"
                @onChange="localIssue.os = $event.toString()"
              />
            </template>

            <template #os_distribution>
              <input
                type="text"
                class="input"
                v-model.trim="localIssue.os_distribution"
              />
            </template>

            <template #assignee>
              <input
                type="text"
                class="input"
                v-model.trim="localIssue.assignee"
              />
            </template>
            <template #user_discord_id>
              <input
                type="text"
                class="input"
                v-model.trim="localIssue.user_discord_id"
              />
            </template>
            <template #github_link>
              <input
                type="text"
                class="input"
                v-model.trim="localIssue.github_link"
              />
            </template>
          </details-section>

          <rich-contents-section>
            <template #steps_to_reproduce>
              <textarea
                rows="8"
                class="input"
                v-model.trim="localIssue.steps_to_reproduce"
              ></textarea>
            </template>

            <template #extra_infos>
              <textarea
                rows="8"
                class="input"
                v-model.trim="localIssue.extra_infos"
              ></textarea>
            </template>
          </rich-contents-section>
          <attachments-section
            :files="localIssue.files"
            @deleteFile="deleteFile"
          />
        </div>
      </div>
    </section>
  </app-layout>
</template>
<script>
import _ from 'lodash';

import AppLayout from '@/layouts/AppLayout';
import BrandSelect from '@/components/BrandSelect';

import { ISSUE_BLUEPRINT } from '@/constant/form';
import { OS_OPTIONS } from '@/constant/os';

import { SingleIssueMixin } from '@/mixins/single-issue';
import { FiltersMixin } from '@/mixins/filters';
import AttachmentsSection from '@/components/Issue/AttachmentsSection';
import RichContentsSection from '@/components/Issue/RichContentsSection';
import DetailsSection from '@/components/Issue/DetailsSection';
import ShareSection from '@/components/Issue/ShareSection';

export default {
  name: 'edit',

  mixins: [SingleIssueMixin, FiltersMixin],

  components: {
    ShareSection,
    DetailsSection,
    RichContentsSection,
    AttachmentsSection,
    AppLayout,
    BrandSelect,
  },

  props: {
    categories: {
      type: Array,
      default: () => [],
    },
    statuses: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      localIssue: ISSUE_BLUEPRINT,
      options: {
        os: [],
        categories: [],
        statuses: [],
      },
    };
  },

  mounted() {
    this.localIssue = _.cloneDeep(this.issue);
  },

  computed: {
    OS_OPTIONS() {
      return OS_OPTIONS;
    },
  },

  methods: {},
};
</script>
