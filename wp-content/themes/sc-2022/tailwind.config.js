module.exports = {
	content: [
		'./**/*.php',
		'./assets/css/**/*',
		'./assets/js/**/*',
		'./safelist.txt'
	],
	theme: {
		screens: {
			'sm': '501px',
			'md': '768px',
			'lg': '1025px',
			'xl': '1367px',
			'2xl': '1601px',
		},
		extend: {
			colors: {
				primary: '#43ac34',
				secondary: '#5792de',
				dark: '#212121',
				light: '#f8f8f8',
			},
			fontFamily: {
				sans: ['"Roboto"', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', '"Helvetica Neue"', 'Arial', 'sans-serif', '"Apple Color Emoji"', '"Segoe UI Emoji"', '"Segoe UI Symbol"', '"Noto Color Emoji";'],
				serif: ['Merriweather', 'ui-serif', 'Georgia', 'Cambria', '"Times New Roman"', 'Times', 'serif']
			},
			fontSize: {
				small: '0.875rem',
				regular: '1rem',
				large: '1.125rem',
				xl: '1.25rem',
				xxl: '1.5rem',
				xxxl: '1.875rem',
			},
			maxHeight: {
				'60vh': '60vh'
			},
			padding: {
				'video': '56.25%'
			}
		}
	},
	corePlugins: {
		container: false,
	},
	plugins: [
	]
};
