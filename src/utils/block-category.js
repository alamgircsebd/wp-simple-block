/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { getCategories, setCategories } from '@wordpress/blocks';
import { Icon } from '@wordpress/components';

setCategories( [
	{
		slug: 'wp-simple-block',
		title: __( 'WP Simple Block', 'wp-simple-block' ),
		icon: <Icon icon={ 'wordpress' } />
	},
	...getCategories().filter( ( { slug } ) => slug !== 'wp-simple-block' ),

] );
