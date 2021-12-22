export const WINDOWS_BASE_PATH = '%LocalAppData%\\Stakenet\\stakenet-wallet\\';
export const MACOS_BASE_PATH =
  '~/Library/Application Support/Stakenet/stakenet-wallet/';
export const LINUX_BASE_PATH = '~/.local/share/Stakenet/stakenet-wallet/';

export const OS_LIST = [
  {
    name: 'Windows',
    paths: [
      {
        name: 'debug.log',
        path: WINDOWS_BASE_PATH,
      },
      {
        name: 'updater.log',
        path: WINDOWS_BASE_PATH,
      },
      {
        name: 'crash reports',
        path: `${WINDOWS_BASE_PATH}reports\\crash\\`,
      },
      {
        name: 'btc lnd.log',
        path: `${WINDOWS_BASE_PATH}lnd\\btc\\logs\\bitcoin\\mainnet\\`,
      },
      {
        name: 'ltc lnd.log',
        path: `${WINDOWS_BASE_PATH}lnd\\ltc\\logs\\litecoin\\mainnet\\`,
      },
      {
        name: 'xsn lnd.log',
        path: `${WINDOWS_BASE_PATH}lnd\\xsn\\logs\\xsncoin\\mainnet\\`,
      },
    ],
  },
  {
    name: 'MacOs',
    paths: [
      {
        name: 'debug.log',
        path: MACOS_BASE_PATH,
      },
      {
        name: 'updater.log',
        path: MACOS_BASE_PATH,
      },
      {
        name: 'crash reports',
        path: `${MACOS_BASE_PATH}reports/crash/`,
      },
      {
        name: 'btc lnd.log',
        path: `${MACOS_BASE_PATH}lnd/btc/logs/bitcoin/mainnet/`,
      },
      {
        name: 'ltc lnd.log',
        path: `${MACOS_BASE_PATH}lnd/ltc/logs/litecoin/mainnet/`,
      },
      {
        name: 'xsn lnd.log',
        path: `${MACOS_BASE_PATH}lnd/xsn/logs/xsncoin/mainnet/`,
      },
    ],
  },
  {
    name: 'Linux',
    paths: [
      {
        name: 'debug.log',
        path: LINUX_BASE_PATH,
      },
      {
        name: 'updater.log',
        path: LINUX_BASE_PATH,
      },
      {
        name: 'crash reports',
        path: `${LINUX_BASE_PATH}reports/crash/`,
      },
      {
        name: 'btc lnd.log',
        path: `${LINUX_BASE_PATH}lnd/btc/logs/bitcoin/mainnet/`,
      },
      {
        name: 'ltc lnd.log',
        path: `${LINUX_BASE_PATH}lnd/ltc/logs/litecoin/mainnet/`,
      },
      {
        name: 'xsn lnd.log',
        path: `${LINUX_BASE_PATH}lnd/xsn/logs/xsncoin/mainnet/`,
      },
    ],
  },
];
