module.exports = {
	env: {
		browser: true,
		commonjs: true,
		es6: true,
		node: true
	},
	extends: ['eslint:recommended', 'wordpress', 'prettier'],

  parserOptions: {
    parser: '@babel/eslint-parser',
    ecmaVersion: 2018, // Allows for the parsing of modern ECMAScript features
    sourceType: 'module' // Allows for the use of imports
  },

	rules: {
		// Disable weird WP spacing rules.
		// 'space-before-function-paren': 'off',
		// 'space-in-parens': 'off',
		// 'array-bracket-spacing': 'off', // Disable weird WP spacing rules.
		indent: ['error', 'tab'],
		semi: ['error', 'always'],
		quotes: ['error', 'single'],

		'linebreak-style': ['error', 'unix'],
    'prefer-promise-reject-errors': 'off',

    'prettier/prettier': [
      'warn',
      {
        singleQuote: true,
        semi: false,
        trailingComma: 'none',
        endOfLine: 'auto'
      }
    ],

    // allow debugger during development only
    'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off'
	}
};
``;
