const defaultConfig = require( '@wordpress/scripts/config/eslint.config.cjs' );

module.exports = [
	{
		ignores: [ '**/dist/**', '**/.export/**' ],
	},
	...defaultConfig,
	{
		files: [ 'src/src/js/**/*.js' ],
		settings: {
			'import/core-modules': [
				'@wordpress/plugins',
				'@wordpress/editor',
				'@wordpress/core-data',
				'@wordpress/data',
				'@wordpress/components',
			],
		},
		rules: {
			eqeqeq: 'off',
			'@wordpress/no-unsafe-wp-apis': 'off',
		},
	},
];
