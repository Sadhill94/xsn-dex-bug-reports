export const FILE_UPLOADER_CONFIG = {
  theme: 'list',
  accept: '.jpeg, .jpg, .png, .gif, .log, .txt',
  maxSize: '2MB',
  maxFiles: 4,
  helpText: 'Load your logs or screenshots',
  errorText: {
    type:
      'Invalid file type. Only .jpeg, .jpg, .png, .gif, .log or .txt allowed',
    size: 'File too heavy. 2MB/file max',
  },
};
