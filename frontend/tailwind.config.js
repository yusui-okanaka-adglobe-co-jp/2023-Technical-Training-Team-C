module.exports = {
  prefix: 'tw-',

  content: ['./src/**/*.{html,js}', './node_modules/tw-elements/dist/js/**/*.js'],
  plugins: [require('tw-elements/dist/plugin.cjs')],
  darkMode: 'class',
}
