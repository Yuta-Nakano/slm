module.exports = {
  // purge: [
  //   './resources/**/*.blade.php',
  //   './resources/**/*.js',
  //   './resources/**/*.vue',
  // ],
  purge: false,
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      tableLayout: ['hover', 'focus'],
    },
  },
  variants: {
    extend: {
      opacity: ['disabled'],
    },
  },
  plugins: [require('@tailwindcss/forms')],
}
