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
				primary: '#45ac34',
				secondary: '#5792de',
				dark: '#1d1e1b',
				light: '#f8f8f8',
			},
			fontFamily: {
				sans: ['"Roboto"', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', '"Helvetica Neue"', 'Arial', 'sans-serif', '"Apple Color Emoji"', '"Segoe UI Emoji"', '"Segoe UI Symbol"', '"Noto Color Emoji";']
			},
			fontSize: {
				small: '0.875rem',
				regular: '1rem',
				large: '1.125rem',
				xl: '1.25rem',
				xxl: '1.5rem',
				xxxl: '1.875rem',
			},
			maxWidth: {
				'site-logo': '186px',
			},
			maxHeight: {
				'40vh': '40vh',
				'80vh': '80vh'
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
