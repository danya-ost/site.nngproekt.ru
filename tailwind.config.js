/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');

module.exports = {
  content: [
    './frontend/views/**/*.{php,html}'
  ],
  theme: {
    extend: {},
    fontFamily: {
      'montserrat': ['"Montserrat"', 'sans-serif'],
    },
    container:{
      center: true,
    },
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1194px',
    },
    colors: {
      'main-red': '#CC0A0A',
      'main-red-900': '#BD0808',
      'main-gray': '#383838',
      'main-milk': '#F1F1F1',
      slate: colors.slate,
      gray: colors.gray,
      zinc: colors.zinc,
      neutral: colors.neutral,
      stone: colors.stone,
      red: colors.red,
      orange: colors.orange,
      amber: colors.amber,
      yellow: colors.yellow,
      lime: colors.lime,
      green: colors.green,
      emerald: colors.emerald,
      teal: colors.teal,
      cyan: colors.cyan,
      sky: colors.sky,
      blue: colors.blue,
      indigo: colors.indigo,
      violet: colors.violet,
      purple: colors.purple,
      fuchsia: colors.fuchsia,
      pink: colors.pink,
      rose: colors.rose,
      white: colors.white,
      black: colors.black
    }
  },
  plugins: [],
}
