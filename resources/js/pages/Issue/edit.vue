<template>
  <app-layout>
    <section
      id="edit-issue-page"
      class="issue-page brand-container brand-container--xxl"
    >
      <div class="issue" v-if="issue">
        <div class="header">
          <div class="informations">
            <div class="issue-share">
              <button class="h3" @click="handleCopyLink">
                <img
                  src="/images/link.png"
                  alt="copy link"
                  class="w-7 md:w-9"
                />
              </button>
              <h3>Edit issue #{{ issue.id }}</h3>
            </div>
          </div>
        </div>
        <div class="body">
          <div class="details">
            <!-- FIRST ROWS -->
            <div class="details-row">
              <dl>
                <div class="details-column">
                  <dt>Status</dt>
                  <dd>
                    <brand-select
                      :options="statuses"
                      :value="localIssue.status_id"
                      class="input"
                      @onChange="localIssue.status_id = $event.toString()"
                    />
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Bug category</dt>
                  <dd>
                    <brand-select
                      :options="categories"
                      :value="localIssue.category_id"
                      class="input"
                      @onChange="localIssue.category_id = $event.toString()"
                    />
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Dex version</dt>
                  <dd>
                    <input
                      type="text"
                      class="input"
                      v-model.trim="localIssue.version"
                    />
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Short description</dt>
                  <dd>
                    <input
                      type="text"
                      class="input"
                      v-model.trim="localIssue.description"
                    />
                  </dd>
                </div>
              </dl>
            </div>

            <!-- SECOND ROWS-->
            <div class="details-row">
              <dl>
                <div class="details-column">
                  <dt>Operating system</dt>
                  <dd>
                    <brand-select
                      :options="OS_OPTIONS"
                      :value="localIssue.os"
                      class="input"
                      @onChange="localIssue.os = $event.toString()"
                    />
                  </dd>
                </div>

                <div class="details-column">
                  <dt>OS distribution</dt>
                  <dd>
                    <input
                      type="text"
                      class="input"
                      v-model.trim="localIssue.os_distribution"
                    />
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Assignee</dt>
                  <dd>
                    <input
                      type="text"
                      class="input"
                      v-model.trim="localIssue.assignee"
                    />
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Reported by</dt>
                  <dd>
                    <input
                      type="text"
                      class="input"
                      v-model.trim="localIssue.user_discord_id"
                    />
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Github link</dt>
                  <dd>
                    <input
                      type="text"
                      class="input"
                      v-model.trim="localIssue.github_link"
                    />
                  </dd>
                </div>
              </dl>
            </div>
          </div>

          <div class="rich-contents">
            <dl class="rich-contents-row">
              <div class="rich-contents-column">
                <dt>Steps to reproduce</dt>
                <dd>
                  <textarea
                    rows="8"
                    class="input"
                    v-model.trim="localIssue.steps_to_reproduce"
                  ></textarea>
                </dd>
              </div>
              <div class="rich-contents-column">
                <dt>Extra infos</dt>
                <dd>
                  <textarea
                    rows="8"
                    class="input"
                    v-model.trim="localIssue.extra_infos"
                  ></textarea>
                </dd>
              </div>
            </dl>
          </div>

          <div class="attachments">
            <dl>
              <div>
                <dt class="">Attachments</dt>

                <dd class="mt-1">
                  <ul role="list" class="attachments-list">
                    <li v-for="file in localIssue.files" :key="file.id">
                      <div class="attachments-item">
                        <img
                          :src="file.file_path"
                          :alt="`file ${file.display_name}`"
                          class="w-56 h-32 mx-auto"
                        />
                        <div class="attachments-item-actions">
                          <!-- VIEW -->
                          <a
                            :href="file.file_path"
                            target="_blank"
                            aria-label="view"
                          >
                            <img
                              src="/images/external-link-quarternary.png"
                              alt="view image"
                            />
                          </a>
                          <!-- DOWNLOAD -->
                          <a
                            :href="
                              ROUTES.api.file.download.url.replace(
                                '{id}',
                                file.id
                              )
                            "
                            target="_blank"
                            aria-label="download"
                          >
                            <img
                              src="/images/download.png"
                              alt="download image"
                            />
                          </a>
                          <!-- DELETE -->
                          <button
                            @click="confirmDeleteFile(file.id)"
                            aria-label="delete file"
                          >
                            <img src="/images/trash.png" alt="delete image" />
                          </button>
                        </div>
                        <div class="attachments-item-meta">
                          <p class="meta-name">
                            {{ file.display_name | removeExtensionIfExist }}.{{
                              file.extension
                            }}
                          </p>
                          <div class="meta-update">
                            <p>{{ file.created_at | humanizeDate }}</p>
                            <span>{{ file.size }}KB</span>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <p v-if="localIssue.files.length < 1">No attachments found</p>
                </dd>
              </div>
            </dl>
          </div>
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
import { OS_OPTIONS } from '@/constant/os';
import { ROUTES } from '@/constant/routes';

import { SingleIssueMixin } from '@/mixins/single-issue';
import { FiltersMixin } from '@/mixins/filters';

export default {
  name: 'edit',

  mixins: [SingleIssueMixin, FiltersMixin],

  components: { AppLayout, BrandSelect },

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

  methods: {
    confirmDeleteFile(fileId) {
      if (confirm('Confirm your wish to delete this files')) {
        this.deleteFile(fileId);
      }
    },

    deleteFile(fileId) {
      const notification = {};
      axios
        .delete(ROUTES.api.file.delete.url.replace('{id}', fileId))
        .then(() => {
          notification.message = 'Successfully deleted';
          notification.type = 'success';
          this.localIssue.files = this.localIssue.files.filter(
            (file) => file.id !== fileId
          );
        })
        .catch((err) => {
          notification.message = err.response.statusText;
          notification.type = 'error';
        })
        .finally(() => {
          this.$displayNotification(notification);
        });
    },
  },
};
</script>
