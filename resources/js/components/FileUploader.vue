<template>
  <div class="w-full">
    <VueFileAgent
      id="file-uploader"
      ref="vueFileAgent"
      :theme="fileConfig.theme"
      :multiple="true"
      :deletable="true"
      :meta="true"
      :accept="fileConfig.accept"
      :maxSize="fileConfig.maxSize"
      :maxFiles="fileConfig.maxFiles"
      :helpText="fileConfig.helpText"
      :errorText="{
        type: 'Invalid file type. Only images or zip Allowed',
        size: 'Files should not exceed 10MB in size',
      }"
      @beforedelete="onBeforeDelete($event)"
      @delete="fileDeleted($event)"
      v-model="fileRecords"
    ></VueFileAgent>
  </div>
</template>

<script>
const FILE_UPLOADER_CONFIG = {
  theme: 'list',
  accept: '.jpeg, .jpg, .png, .gif, .log, .txt',
  maxSize: '10MB',
  maxFiles: 6,
  helpText: 'Load your logs or screenshots',
  errorText: {
    type:
      'Invalid file type. Only .jpeg, .jpg, .png, .gif, .log or .txt allowed',
    size: 'Files too heavy.',
  },
};
export default {
  name: 'FileUploader',

  props: {
    hasSubmitted: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      fileRecords: [],
    };
  },

  computed: {
    fileConfig() {
      return FILE_UPLOADER_CONFIG;
    },
  },

  watch: {
    fileRecords: {
      deep: true,
      handler(val) {
        this.$emit('onFilesChange', val);
      },
    },
    hasSubmitted(newVal) {
      console.log('HAS SUBMITTED NEW VAL', newVal);
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
      }
    },
    /**
     * Remove from the data property the file - it has already been removed from the input
     * @param fileRecord
     */
    fileDeleted(fileRecord) {
      this.fileRecords = this.fileRecords.filter(
        (file) => file.size !== fileRecord.size
      );
    },
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
}
</style>
