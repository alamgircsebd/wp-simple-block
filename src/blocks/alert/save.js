/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { RichText } from '@wordpress/block-editor';

const save = ( { attributes } ) => {

	const {
		textAlign,
		title,
		value,
	} = attributes;

	return (
		<div className={ classnames( attributes.className, 'wp-simple-block-alert' ) }>
			<RichText.Content
				tagName="p"
				value={ value }
			/>
		</div>
	);
};

export default save;
