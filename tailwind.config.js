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
    },
  },
  plugins: [
    require('preline/plugin'),
  ],
}

