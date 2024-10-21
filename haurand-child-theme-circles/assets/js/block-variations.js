/**
* Create a custom Media & Text variation */ 

wp.blocks.registerBlockVariation(
	'core/media-text',
	{
		name: 'media-text-custom',
		title: 'Media and Text Custom',
		attributes: {
			align: 'wide',
			backgroundColor: 'accent-6'
		},
	}
);

/* Create a custom Media & Text variation: red */ 
wp.blocks.registerBlockVariation(
	'core/media-text',
	{
		name: 'media-text-red',
		title: 'Media and Text red',
		attributes: {
			align: 'wide',
			backgroundColor: 'accent-8',
			textColor: 'base-2'
		},
	}
);

/* Create a custom Media & Text variation: custom Color and innerBlocks */ 
wp.blocks.registerBlockVariation(
	'core/media-text',
	{
		name: 'media-text-custom-color',
		title: 'Media and Text custom color',
		attributes: {
			align: 'wide',
			style: {"color":{"background":"#1d6ff2"}},
			textColor: 'base-2',
            className: "test-class"
		},
		innerBlocks: [
			[
				'core/heading',
				{
					level: 3,
					placeholder: 'Heading'
				} 
			],
			[
				'core/paragraph',
				{
					placeholder: 'Enter content here...'
				} 
			],
		],
	}
);

/* Create a image variation */ 
wp.blocks.registerBlockVariation(
	'core/image',
	{
		name: 'image-wide-rounded-corners',
		title: 'Breites Bild mit runden Ecken',
		attributes: {
			align: 'wide',
			style: {"border":{"radius":"30px"}}
		},
	}
);

/* Register the "Post Search" block variation for Search Block. */
wp.domReady ( function() {
	wp.blocks.registerBlockVariation( 'core/search', {
		name: 'wpu/post-search',
		title: 'Post Search', 
		attributes: {
			placeholder: 'Search Posts', 
			query: {
				post_type: 'post'
			}
		}
	} );
} );		

