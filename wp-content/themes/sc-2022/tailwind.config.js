module.exports = {
	content: [
		'./**/*.php',
		'./assets/css/**/*',
		'./assets/js/**/*',
		'./safelist.txt'
	],
	theme: {
		fontSize: {
			'xs': ['.75rem', '1.25'],
			'sm': ['.875rem', '1.25'],
			'base': ['1rem', '1.25'],
			'lg': ['1.125rem', '1.25'],
			'xl': ['1.25rem', '1.25'],
			'2xl': ['1.5rem', '1.25'],
			'3xl': ['1.875rem', '1.25'],
			'4xl': ['2.25rem', '1.25'],
			'5xl': ['3rem', '1.25'],
			'6xl': ['4rem', '1.25'],
		},
		screens: {
			'sm': '501px',
			'md': '768px',
			'lg': '1025px',
			'xl': '1367px',
			'2xl': '1601px',
		},
		extend: {
			borderWidth: {
				10: '10px',
			},
			colors: {
				primary: '#45ac34',
				secondary: '#5792de',
				dark: '#1d1e1b',
				light: '#f8f8f8',
			},
			fontFamily: {
				sans: ['"Roboto"', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', '"Segoe UI"', '"Helvetica Neue"', 'Arial', 'sans-serif', '"Apple Color Emoji"', '"Segoe UI Emoji"', '"Segoe UI Symbol"', '"Noto Color Emoji";'],
				serif: ['Kadwa', 'ui-serif', 'Georgia', 'Cambria', '"Times New Roman"', 'Times', 'serif']
			},
			maxWidth: {
				'site-logo': '186px',
			},
			maxHeight: {
				'15vh': '15vh',
				'25vh': '25vh',
				'30vh': '30vh',
				'50vh': '50vh',
			},
			minHeight: {
				'200px' : '200px',
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
