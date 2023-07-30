import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { useEntityProp } from '@wordpress/core-data';
import { useSelect } from '@wordpress/data';

import {
	TextareaControl,
	ToggleControl,
	BaseControl,
} from '@wordpress/components';

const PluginDocumentSettingPanelDemo = () => {
	const postType = useSelect(
		( select ) => select( 'core/editor' ).getCurrentPostType(),
		[]
	);

	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );

	return (
		<PluginDocumentSettingPanel name="inc2734-wp-seo" title="SEO">
			<TextareaControl
				label="Meta description"
				value={ meta?.[ 'wp-seo-meta-description' ] }
				onChange={ ( value ) =>
					setMeta( {
						...meta,
						'wp-seo-meta-description': value.replace(
							/\r?\n/g,
							''
						),
					} )
				}
			/>

			<BaseControl label="Meta robots" id="inc2734-wp-seo-meta-robots">
				<ToggleControl
					label="noindex"
					checked={ meta?.[ 'wp-seo-meta-robots' ].includes(
						'noindex'
					) }
					onChange={ ( value ) => {
						let newRobots = [ ...meta?.[ 'wp-seo-meta-robots' ] ];
						if ( value ) {
							if ( ! newRobots.includes( 'noindex' ) ) {
								newRobots.push( 'noindex' );
							}
						} else {
							newRobots = newRobots.filter(
								( _value ) => 'noindex' !== _value
							);
						}

						setMeta( {
							...meta,
							'wp-seo-meta-robots': newRobots,
						} );
					} }
				/>

				<ToggleControl
					label="nofollow"
					checked={ meta?.[ 'wp-seo-meta-robots' ].includes(
						'nofollow'
					) }
					onChange={ ( value ) => {
						let newRobots = [ ...meta?.[ 'wp-seo-meta-robots' ] ];
						if ( value ) {
							if ( ! newRobots.includes( 'nofollow' ) ) {
								newRobots.push( 'nofollow' );
							}
						} else {
							newRobots = newRobots.filter(
								( _value ) => 'nofollow' !== _value
							);
						}

						setMeta( {
							...meta,
							'wp-seo-meta-robots': newRobots,
						} );
					} }
				/>
			</BaseControl>
		</PluginDocumentSettingPanel>
	);
};

registerPlugin( 'plugin-document-setting-panel-demo', {
	render: PluginDocumentSettingPanelDemo,
	icon: 'palmtree',
} );

document.addEventListener( 'DOMContentLoaded', () => {
	const description = document.getElementById( 'wp-seo-meta-description' );
	const counter = document.getElementById(
		'wp-seo-meta-description-counter'
	);
	if ( ! description || ! counter ) {
		return;
	}

	const count = () => ( counter.innerText = description.value.length );
	const removeBreaks = () =>
		( description.value = description.value.replace( /\r?\n/g, '' ) );

	count();
	description.addEventListener( 'change', count );
	description.addEventListener( 'keyup', count );
	description.addEventListener( 'paste', count );
	description.addEventListener( 'input', removeBreaks );
} );
