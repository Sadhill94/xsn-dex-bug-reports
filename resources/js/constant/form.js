import { OS_OPTIONS } from '@/constant/os';

export const DEX_WALLET_GITHUB_REPO_URL =
  'https://api.github.com/repos/X9Developers/stakenet-light-wallet/releases';

export const CATEGORY_ID_FIELD_KEY = 'category_id';
export const STATUS_ID_FIELD_KEY = 'status_id';
export const TYPE_ID_FIELD_KEY = 'type_id';
export const FILES_FIELD_KEY = 'files';
export const VERSION_FIELD_KEY = 'version';

export const ISSUE_BLUEPRINT = {
  id: '',
  description: '',
  os: 'Windows',
  os_distribution: '',
  [VERSION_FIELD_KEY]: '',
  steps_to_reproduce: '',
  [CATEGORY_ID_FIELD_KEY]: '',
  user_discord_id: '',
  extra_infos: '',
  [STATUS_ID_FIELD_KEY]: '',
  [TYPE_ID_FIELD_KEY]: '',
  github_link: '',
  assignee: '',
  [FILES_FIELD_KEY]: [],
  trello_ref: '',
};

export const BUG_FORM_NAME = 'BUG_REPORT';
export const FEATURE_FORM_NAME = 'FEATURE_REQUEST';

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
    options: OS_OPTIONS,
    isRequired: true,
  },
  {
    key: 'os_distribution',
    label: 'OS distribution',
    additionalInfos: ['Fedora, Ubuntu, Sierra, ...'],
    type: 'text',
    isRequired: false,
  },
  {
    key: VERSION_FIELD_KEY,
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
    additionalInfos: [
      'Authorized formats: log, txt, jpg, jpeg, png, gifs',
      '4 files maximum per reports and each file size of 2MB maximum',
    ],
    type: 'files',
    isRequired: false,
  },
];

export const FEATURE_REQUEST_FORM_FIELDS = [
  {
    key: 'description',
    label: 'Short description',
    type: 'text',
    isRequired: true,
  },
  {
    key: CATEGORY_ID_FIELD_KEY,
    label: 'Category',
    type: 'select',
    options: [],
    isRequired: true,
  },
  {
    key: 'user_discord_id',
    label: 'Discord username',
    type: 'text',
    isRequired: false,
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
    additionalInfos: [
      'Authorized formats: log, txt, jpg, jpeg, png, gifs',
      '4 files maximum per reports and each file size of 2MB maximum',
    ],
    type: 'files',
    isRequired: false,
  },
];
