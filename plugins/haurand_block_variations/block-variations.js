 wp.domReady( function() {
 wp.blocks.registerBlockVariation (
     'core/media-text', {
       name: 'haurand-bild',
       title: 'Haurand Medien-Text-Variante',
       attributes: {className: 'haurand-bild'},
       icon: 'format-image',
       scope: ['inserter'],
       innerBlocks: [
         ['core/heading', { level: 2, placeholder: 'Headline' }],
         ['core/paragraph', { placeholder: 'Beispieltext' }],
       ],
     }
   );
 } );