const defaultConfig = require("@wordpress/scripts/config/.eslintrc.js");

module.exports = {
	...defaultConfig,
	rules: {
		...defaultConfig.rules,
		'eqeqeq': 'off',
	},
};
