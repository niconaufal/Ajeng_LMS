module.exports = {
  purge: {
    enabled: false,
    content: ['resources/views/**/*.blade.php'],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
    backgroundColor: ({ after }) => after(['disabled'])
  },
  plugins: [],
}
