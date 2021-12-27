<template>
  <div class="add-attachments">
    <file-uploader
      :file-config="fileConfig"
      @onFilesChange="handleAddFile"
      :has-submitted="hasSubmitted"
    />
  </div>
</template>

<script>
import axios from 'axios';

import { ROUTES } from '@/constant/routes';
import { FILE_UPLOADER_CONFIG } from '@/constant/fileConfig';

import FileUploader from '@/components/FileUploader';
export default {
  name: 'AddAttachmentsSection',
  components: { FileUploader },
  props: {
    issueId: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      hasSubmitted: false,
    };
  },
  computed: {
    fileConfig() {
      return {
        ...FILE_UPLOADER_CONFIG,
        maxFiles: 8,
        multiple: false,
        maxSize: '4MB',
        helpText: 'Load more files',
        errorText: {
          size: 'File too heavy, 4MB/file max',
        },
      };
    },
  },
  methods: {
    handleAddFile(fileInArray) {
      if (fileInArray.length > 0) {
        const payload = new FormData();
        payload.append('file', fileInArray[0].file);
        payload.append('issue_id', this.issueId.toString());

        axios
          .post(ROUTES.api.file.addSingle.url, payload)
          .then((res) => {
            this.$emit('onFileAdded', res.data);
            this.$displayNotification({
              message: 'File added successfully',
              type: 'success',
            });
          })
          .catch((err) => {
            this.$displayNotification({
              message:
                err?.response?.data?.message ||
                'Something went wrong adding the file',
              type: 'error',
            });
          })
          .finally(() => {
            this.hasSubmitted = true;

            setTimeout(() => {
              this.hasSubmitted = false;
            }, 500);
          });
      }
    },
  },
};
</script>
