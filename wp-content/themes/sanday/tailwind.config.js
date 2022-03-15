const _ = require("lodash");
const tailpress = require("@jeffreyvr/tailwindcss-tailpress");

module.exports = {
  content: [
    './*/*.php',
    './**/*.php',
    './resources/css/*.css',
    './resources/js/*.js',
    './safelist.txt'
  ],
  theme: {
    container: false,
    screens: {
      'sm': '501px',
      'md': '768px',
      'lg': '1025px',
      'xl': '1367px',
      '2xl': '1601px',
    },
    extend: {
      colors: {
        primary: '#00c496',
        secondary: '#14B8A6',
        dark: '#212121',
        light: '#f8f8f8',
      },
      fontSize: {
        small: '0.875rem',
        regular: '1rem',
        large: '1.125rem',
        xl: '1.25rem',
        xxl: '1.5rem',
        xxxl: '1.875rem',
      }
    }
  },
  corePlugin: {
    container: false,
  },
  plugins: [
    tailpress.tailwind
  ]
};
