/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        // Nav, Footer, Cards
        'ow-blue': '#02042d', 
        'ow-violet': '#7D1C4A',
        'ow-pink': '#cf1974',
        'ow-light-blue': '#020ab6',
        'ow-white': '#f4f4f4',
        'ow-input' : '#323461',
        'ow-light-gray': '#F5F5F7',
      },
      animation: {
        'blob-bounce': 'blob-bounce 5s infinite ease',
      },
      keyframes: {
        'blob-bounce': {
          '0%': {
            transform: 'translate(-100%, -100%) translate3d(0, 0, 0)',
          },
          '25%': {
            transform: 'translate(-100%, -100%) translate3d(100%, 0, 0)',
          },
          '50%': {
            transform: 'translate(-100%, -100%) translate3d(100%, 100%, 0)',
          },
          '75%': {
            transform: 'translate(-100%, -100%) translate3d(0, 100%, 0)',
          },
          '100%': {
            transform: 'translate(-100%, -100%) translate3d(0, 0, 0)',
          },
        },
      },
    },
  },
  plugins: [],
};