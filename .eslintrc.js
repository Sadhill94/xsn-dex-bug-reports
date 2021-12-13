module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
    es2021: true,
  },
  parserOptions: {
    ecmaVersion: 2021,
    sourceType: 'module',
  },
  plugins: ['prettier'],
  extends: [
    '@liip-lausanne',
    'plugin:prettier/recommended',
    'plugin:nuxt/recommended',
  ],
};
