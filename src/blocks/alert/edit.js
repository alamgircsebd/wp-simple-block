/**
 * Internal dependencies
 */
import Controls from './controls';
import Inspector from './inspector';

/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Fragment, Component } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';
import { select, withSelect, withDispatch, dispatch } from '@wordpress/data';
import { compose } from '@wordpress/compose';

/**
 * Block edit function
 */
class Edit extends Component {

	render () {
		const {
			attributes,
			className,
			isSelected,
			setAttributes,
			textColor,
		} = this.props;

		const {
			textAlign,
			value,
			fontSize,
			posts
		} = attributes;
		
		return (
			
			<Fragment>
				{ isSelected && ( <Inspector { ...this.props } /> ) }
				{ isSelected && ( <Controls { ...this.props } /> ) }
				
				<div 
					className={ classnames( className, 'wp-simple-block-alert' ) }
				>
					<RichText
						placeholder={ __( 'Write text…', 'wp-simple-block' ) }
						value={ value }
						onChange={ ( value ) => setAttributes( { value } ) }
						keepPlaceholderOnFocus
						style={{
							fontSize: `${fontSize}px`,
							textAlign: `${textAlign}`
						}}
					/>
				</div>
			</Fragment>	
		);
	}
}

export default compose([
	withDispatch( ( dispatch, ownProps, registry ) => { 
		
		const kinds = select('core').getEntitiesByKind('wp-simple-block');

		if ( !find( kinds, { name: 'wp-simple-block' } ) ) {
			dispatch('core').addEntities([
				{
					name: 'posts', 
					kind: 'wp-simple-block', 
					baseURL: '/wp-simple-block/v1/posts'
				}
			])
		}
	} ),

	withSelect( ( select, ownProps ) => {
		const { isResolving } = select( 'core/data' );
		
	    return {
	    	posts: select('core').getEntityRecords( 'wp-simple-block', 'posts', {numberposts: 1, post_type: 'post'} ),
	    	isResolving: isResolving( 'core', 'getEntityRecords', [ 'wp-simple-block', 'posts' ] ),
		} 
	} )

])(Edit);
