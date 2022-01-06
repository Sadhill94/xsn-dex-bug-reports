<template>
  <div class="attachments">
    <dl>
      <div>
        <dt class="">Attachments</dt>
        <dd class="mt-1">
          <ul role="list" class="attachments-list">
            <li v-for="file in files" :key="file.id">
              <div class="attachments-item">
                <img
                  v-if="isTxtOrLogFile(file.extension)"
                  src="/images/logFile.png"
                  :alt="`file ${file.display_name}`"
                  class="w-28 h-auto mx-auto"
                />
                <img
                  v-else
                  :src="file.file_path"
                  :alt="`file ${file.display_name}`"
                  class="w-56 h-32 mx-auto"
                />
                <div class="attachments-item-actions">
                  <!-- VIEW -->
                  <a :href="file.file_path" target="_blank" aria-label="view">
                    <img
                      src="/images/external-link-quarternary.png"
                      alt="view image"
                    />
                  </a>
                  <!-- DOWNLOAD -->
                  <a
                    :href="
                      ROUTES.api.file.download.url.replace('{id}', file.id)
                    "
                    target="_blank"
                    aria-label="download"
                  >
                    <img src="/images/download.png" alt="download image" />
                  </a>
                  <!-- DELETE -->
                  <button
                    v-if="isManager"
                    @click="confirmDeleteFile(file)"
                    aria-label="delete file"
                    class="mb-0"
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
          <p v-if="files.length < 1">No attachments found</p>
        </dd>
      </div>
    </dl>
  </div>
</template>

<script>
import { FiltersMixin } from '@/mixins/filters';
import { SingleIssueMixin } from '@/mixins/single-issue';
import { RolesMixin } from '@/mixins/roles';

export default {
  name: 'DisplayAttachmentsSection',

  mixins: [FiltersMixin, SingleIssueMixin, RolesMixin],

  props: {
    files: {
      type: Array,
      default: () => [],
    },
  },

  methods: {
    confirmDeleteFile(file) {
      if (confirm(`Confirm your wish to delete file ${file.display_name}`)) {
        this.$emit('deleteFile', file.id);
      }
    },
  },
};
</script>
