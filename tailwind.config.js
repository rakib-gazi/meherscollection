/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{html,js}",
    "./*.php",
    "./dashboard/**/*.php",
    "./sign-up/**/*.php",
    "./login/**/*.php",
    "node_modules/preline/dist/*.js",
  ],
  theme: {
    extend: {
      colors:{
        'color-logo' :'#132749',
      },
      fontFamily:{
        'nunito' : '"Nunito Sans", sans-serif',
        'siliguri' : '"Hind Siliguri", sans-serif',
      },
    },
  },
  plugins: [
    require('preline/plugin'),
  ],
}

