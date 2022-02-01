<template>
  <app-layout>
    <section
      id="edit-issue-page"
      class="issue-page brand-container brand-container--xxl"
    >
      <div class="issue" v-if="item">
        <div class="header">
          <div class="informations">
            <actions-section @onCopyClick="handleCopyLink">
              <h3 class="mb-0">Edit feature #{{ item.id }}</h3>
              <button @click="confirmDeleteIssue" aria-label="delete">
                <img src="/images/bin.png" class="w-7" alt="delete image" />
              </button>
              <div class="w-auto md:w-64 md:justify-end md:flex">
                <button
                  @click="handleSave"
                  class="uppercase p-2 bg-quaternary rounded-md w-36 ml-auto"
                >
                  Save
                </button>
              </div>
            </actions-section>
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

            <template #type>
              <brand-select
                :options="types"
                :value="localIssue.type_id"
                class="input"
                @onChange="localIssue.type_id = $event.toString()"
              />
            </template>

            <template #category>
              <brand-select
                :options="categories"
                :value="localIssue.category_id"
                class="input"
                @onChange="localIssue.category_id = $event.toString()"
              />
            </template>

            <template #trello_ref>
              <input
                type="text"
                class="input"
                v-model.trim="localIssue.trello_ref"
              />
            </template>

            <template #short_description>
              <input
                type="text"
                class="input"
                v-model.trim="localIssue.description"
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
          </details-section>

          <rich-contents-section>
            <template #extra_infos>
              <rich-text
                class="input"
                :value="localIssue.extra_infos"
                @input="localIssue.extra_infos = $event"
              />
            </template>
          </rich-contents-section>
          <display-attachments-section
            :files="localIssue.files"
            @deleteFile="deleteFile"
          />
          <add-attachments-section
            :issue-id="item.id"
            @onFileAdded="addFileToFront"
          />
        </div>
      </div>
    </section>
  </app-layout>
</template>
<script>
import _ from 'lodash';
import axios from 'axios';

import AppLayout from '@/layouts/AppLayout';
import BrandSelect from '@/components/BrandSelect';

import { ISSUE_BLUEPRINT } from '@/constant/form';

import { SingleIssueMixin } from '@/mixins/single-issue';
import { FiltersMixin } from '@/mixins/filters';
import DisplayAttachmentsSection from '@/components/Issue/DisplayAttachmentsSection';
import RichContentsSection from '@/components/Issue/RichContentsSection';
import DetailsSection from '@/components/Issue/DetailsSection';
import ActionsSection from '@/components/Issue/ActionsSection';
import { ROUTES } from '@/constant/routes';
import AddAttachmentsSection from '@/components/Issue/AddAttachmentsSection';
import RichText from '@/components/RichText';

export default {
  name: 'edit',

  mixins: [SingleIssueMixin, FiltersMixin],

  components: {
    AddAttachmentsSection,
    ActionsSection,
    DetailsSection,
    RichContentsSection,
    DisplayAttachmentsSection,
    AppLayout,
    BrandSelect,
    RichText,
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
    types: {
      type: Array,
      default: () => [],
    },
  },

  data() {
    return {
      localIssue: ISSUE_BLUEPRINT,
    };
  },

  mounted() {
    this.localIssue = _.cloneDeep(this.item);
    this.addAsteriksToRequiredFields();
  },

  methods: {
    handleSave() {
      if (!_.isEqual(this.item, this.localIssue)) {
        axios
          .post(
            ROUTES.api.issue.edit.url.replace('{id}', this.localIssue.id),
            this.localIssue
          )
          .then((res) => {
            this.$displayNotification({
              message: res?.data?.message || 'Successfully edited!',
              type: 'success',
            });
            this.$inertia.get(`/features/${this.localIssue.id}`);
          })
          .catch((err) => {
            this.$displayNotification({
              message: err?.response.data?.message || 'Something went wrong.',
              type: 'error',
            });
          });
      } else {
        this.$displayNotification({
          message:
            "Issues are identical, change it's content to be able to save",
        });
      }
    },
    addAsteriksToRequiredFields() {
      document
        .querySelectorAll('#edit-issue-page .required')
        .forEach((el) => (el.innerText = `${el.innerText}*`));
    },

    addFileToFront(file) {
      this.localIssue.files.push(file);
    },
  },
};
</script>
