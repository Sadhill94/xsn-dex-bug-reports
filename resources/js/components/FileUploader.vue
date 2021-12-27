<template>
  <div class="w-full">
    <VueFileAgent
      id="file-uploader"
      ref="vueFileAgent"
      :theme="fileConfig.theme"
      :multiple="fileConfig.multiple"
      :deletable="true"
      :meta="true"
      :accept="fileConfig.accept"
      :maxSize="fileConfig.maxSize"
      :maxFiles="fileConfig.maxFiles"
      :helpText="fileConfig.helpText"
      :errorText="fileConfig.errorText"
      :uploadUrl="fileConfig.uploadUrl"
      @beforedelete="onBeforeDelete($event)"
      v-model="fileRecords"
    ></VueFileAgent>
  </div>
</template>

<script>
import { FILE_UPLOADER_CONFIG } from '@/constant/fileConfig';

export default {
  name: 'FileUploader',

  props: {
    hasSubmitted: {
      type: Boolean,
      default: false,
    },
    fileConfig: {
      type: Object,
      default: () => FILE_UPLOADER_CONFIG,
    },
  },

  data() {
    return {
      fileRecords: [],
    };
  },

  watch: {
    fileRecords: {
      deep: true,
      handler(val) {
        this.$emit('onFilesChange', val);
      },
    },
    hasSubmitted(newVal) {
      if (newVal) {
        this.fileRecords = [];
      }
    },
  },
  methods: {
    /**
     * Show an confirm before deleting the file
     * @param fileRecord
     */
    onBeforeDelete(fileRecord) {
      if (confirm('Are you sure you want to delete the file ?')) {
        this.$refs.vueFileAgent.deleteFileRecord(fileRecord);
        setTimeout(() => {}, 5000);
      }
    },
    /**
     * Remove from the data property the file - it has already been removed from the input
     * @param fileRecord
     */
  },
};
</script>

<style lang="scss">
#file-uploader {
  .vue-file-agent .file-preview-new svg {
    @apply fill-current text-white;
  }
  .vue-file-agent .file-preview-new .help-text {
    @apply text-white;
  }

  .vue-file-agent .file-preview .file-delete {
    top: 1rem;
  }

  .vue-file-agent.file-input-wrapper {
    @apply border-white rounded-md;
  }

  .vue-file-agent .file-preview-wrapper .file-preview:before {
    @apply bg-transparent;
  }

  .file-name,
  .file-ext,
  .file-size,
  .file-delete {
    @apply text-white;
  }
  .file-preview.other-preview,
  .file-preview.image-preview {
    @apply bg-tertiary rounded-md #{!important};
  }
  .vue-file-agent
    .file-preview-wrapper-image
    .file-preview
    .file-preview-overlay {
    @apply bg-transparent;
  }

  .file-error-wrapper .file-error-message {
    @apply bg-danger;
  }

  .file-preview-wrapper .file-preview .image-dimension {
    @apply hidden;
  }
}
</style>
