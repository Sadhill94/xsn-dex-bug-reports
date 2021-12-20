export const CATEGORY_ID_FIELD_KEY = 'category_id';
export const STATUS_ID_FIELD_KEY = 'status_id';
export const FILES_FIELD_KEY = 'files';

export const FORM_METHODS = {
  create: 'create',
  edit: 'edit',
};

export const DEFAULT_FORM_FIELDS_VALUES = {
  description: '',
  os: 'Windows',
  version: '',
  /* eslint-disable */
  steps_to_reproduce: '',
  category_id: '',
  user_discord_id: '',
  extra_infos: '',
  status_id: '',
  github_link: '',
  /* eslint-enable */
};

export const REPORT_BUG_FORM_FIELDS = [
  {
    key: 'description',
    label: 'Short description',
    type: 'text',
    isRequired: true,
  },
  {
    key: CATEGORY_ID_FIELD_KEY,
    label: 'Bug category',
    type: 'select',
    options: [],
    isRequired: true,
  },
  {
    key: 'os',
    label: 'Operating system',
    type: 'select',
    options: [
      {
        name: 'Windows',
      },
      {
        name: 'MacOs',
      },
      {
        name: 'Linux',
      },
    ],
    isRequired: true,
  },
  {
    key: 'version',
    label: 'DEX version',
    type: 'text',
    isRequired: true,
  },
  {
    key: 'steps_to_reproduce',
    label: 'Steps to reproduce',
    type: 'textarea',
    isRequired: true,
  },
  {
    key: 'user_discord_id',
    label: 'Discord username',
    type: 'text',
    isRequired: true,
  },
  {
    key: 'extra_infos',
    label: 'Extra infos',
    type: 'textarea',
    isRequired: false,
  },
  {
    key: FILES_FIELD_KEY,
    label: 'Files',
    type: 'files',
    isRequired: true,
  },
];

export const PRIVATE_BUG_FORM_FIELDS = [
  {
    key: STATUS_ID_FIELD_KEY,
    label: 'Status',
    type: 'select',
    options: [],
    isRequired: true,
  },
  {
    key: 'assignee',
    label: 'Assignee',
    type: 'text',
    isRequired: false,
  },
  {
    key: 'github_link',
    label: 'Github link',
    type: 'text',
    isRequired: false,
  },
];
