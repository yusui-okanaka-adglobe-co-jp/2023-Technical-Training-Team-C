module.exports = {
  root: true,
  env: {
    browser: true,
    node: true,
  },
  extends: ['plugin:sonarjs/recommended', 'prettier'],
  plugins: ['sonarjs'],
  // add your custom rules here
  rules: {},
}
