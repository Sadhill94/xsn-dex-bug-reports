<template>
  <app-layout>
    <section class="issue-page brand-container brand-container--xxl">
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
              <h3>Details issue #{{ issue.id }}</h3>
            </div>
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
          <div class="details">
            <!-- FIRST ROWS -->
            <div class="details-row">
              <dl>
                <div class="details-column">
                  <dt>Bug category</dt>
                  <dd>
                    <span>{{ issue.category.name }}</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Dex version</dt>
                  <dd>
                    <span>{{ issue.version }}</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Short description</dt>
                  <dd>
                    <span>{{ issue.description }}</span>
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
                    <span>{{ issue.os }} {{ issue.os_distribution }}</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Assignee</dt>
                  <dd>
                    <span>{{ issue.assignee || 'none' }}</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Reported by</dt>
                  <dd>
                    <span>{{ issue.user_discord_id }}</span>
                  </dd>
                </div>

                <div class="details-column">
                  <dt>Github link</dt>
                  <dd>
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
                  <span>
                    {{ issue.steps_to_reproduce }}
                  </span>
                </dd>
              </div>
              <div class="rich-contents-column">
                <dt>Extra infos</dt>
                <dd>
                  <span>
                    {{
                      isPropertyNullOrEmpty('extra_infos')
                        ? 'None provided'
                        : issue.extra_infos
                    }}
                  </span>
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
                    <li v-for="file in issue.files" :key="file.id">
                      <div class="attachments-item">
                        <img
                          :src="file.file_path"
                          :alt="`file ${file.display_name}`"
                          class="w-56 h-32 mx-auto"
                        />
                        <div class="attachments-item-actions">
                          <a
                            :href="file.file_path"
                            target="_blank"
                            aria-label="view"
                          >
                            <img
                              src="/images/external-link-quarternary.png"
                              class="w-8"
                            />
                          </a>
                          <a
                            :href="`/files/download/${file.id}`"
                            target="_blank"
                            aria-label="download"
                          >
                            <img src="/images/download.png" class="w-8" />
                          </a>
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
                  <p v-if="issue.files.length < 1">No attachments found</p>
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
import AppLayout from '@/layouts/AppLayout';
import { formatDate } from '@/helpers/date';

export default {
  name: 'index',
  components: { AppLayout },
  props: {
    issue: {
      type: Object,
      default: null,
    },
  },
  methods: {
    handleCopyLink() {
      navigator.clipboard.writeText(location.href);
      this.$displayNotification({
        message: 'Issue link copied to the clipboard !',
      });
    },
    isPropertyNullOrEmpty(property) {
      if (this.issue[property]) {
        return this.issue[property] !== 'null';
      }
      return true;
    },
  },

  filters: {
    humanizeDate(value) {
      return formatDate(value, 'DD/MMM/YYYY');
    },
    removeExtensionIfExist(value) {
      const values = value.split('.');
      if (values.length > 1) {
        return values[0];
      } else {
        return value;
      }
    },
  },
  mounted() {
    console.log('this.data', this.issue);
  },
};
</script>
