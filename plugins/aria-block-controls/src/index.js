
/**
 * WordPress dependencies
 */
import { addFilter } from '@wordpress/hooks';
import { createHigherOrderComponent } from '@wordpress/compose';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import './style.scss';
import './editor.scss';

/**
 * Add ARIA attributes to all blocks
 */
function addAriaAttributes( settings ) {
	if ( ! settings.attributes ) {
		settings.attributes = {};
	}

	settings.attributes.ariaLabel = {
		type: 'string',
		default: '',
	};

	settings.attributes.ariaLabelledby = {
		type: 'string',
		default: '',
	};

	settings.attributes.ariaDescribedby = {
		type: 'string',
		default: '',
	};

	settings.attributes.customAria = {
		type: 'string',
		default: '',
	};

	return settings;
}

addFilter(
	'blocks.registerBlockType',
	'aria-block-controls/add-attributes',
	addAriaAttributes
);

/**
 * Add ARIA controls to the Advanced panel
 */
const withAriaControls = createHigherOrderComponent( ( BlockEdit ) => {
	return ( props ) => {
		const { attributes, setAttributes, isSelected } = props;
		const { ariaLabel, ariaLabelledby, ariaDescribedby, customAria } = attributes;

		return (
			<>
				<BlockEdit { ...props } />
				{ isSelected && (
					<InspectorControls>
						<PanelBody
							title={ __( 'ARIA Attributes', 'aria-block-controls' ) }
							initialOpen={ false }
						>
							<TextControl
								label={ __( 'ARIA Label', 'aria-block-controls' ) }
								value={ ariaLabel || '' }
								onChange={ ( value ) => setAttributes( { ariaLabel: value } ) }
								help={ __( 'Provides an accessible label for the element.', 'aria-block-controls' ) }
							/>
							<TextControl
								label={ __( 'ARIA Labelledby', 'aria-block-controls' ) }
								value={ ariaLabelledby || '' }
								onChange={ ( value ) => setAttributes( { ariaLabelledby: value } ) }
								help={ __( 'ID of the element that labels this element.', 'aria-block-controls' ) }
							/>
							<TextControl
								label={ __( 'ARIA Describedby', 'aria-block-controls' ) }
								value={ ariaDescribedby || '' }
								onChange={ ( value ) => setAttributes( { ariaDescribedby: value } ) }
								help={ __( 'ID of the element that describes this element.', 'aria-block-controls' ) }
							/>
							<TextControl
								label={ __( 'Custom ARIA Attributes', 'aria-block-controls' ) }
								value={ customAria || '' }
								onChange={ ( value ) => setAttributes( { customAria: value } ) }
								help={ __( 'Add custom ARIA attributes (e.g., aria-expanded=true, aria-controls=menu-1).', 'aria-block-controls' ) }
							/>
						</PanelBody>
					</InspectorControls>
				) }
			</>
		);
	};
}, 'withAriaControls' );

addFilter(
	'editor.BlockEdit',
	'aria-block-controls/with-aria-controls',
	withAriaControls
);
	