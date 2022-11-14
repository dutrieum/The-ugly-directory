/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    fontFamily: {
      'serif': ['Arvo', 'serif'],
      'sans': ['Nunito', 'sans-serif'],
    },
    fontSize: {
      '22': '22px',
      '30': '30px',
      '32': '32px',
      '36': '36px',
      '60': '60px',
      '80': '80px',
      '130': '130px'
    },
    colors: {
      'green': 'var(--color-green)',
      'light-green': 'var(--color-light-green)',
      'dark-green': 'var(--color-dark-green)',
      'black': 'var(--color-black)',
      'gray': 'var(--color-gray)',
      'white': 'var(--color-white)',
    },
    extend: {},
  },
  plugins: [],
}
