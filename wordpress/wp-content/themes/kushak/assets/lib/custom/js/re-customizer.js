/* Customizer JS Upsale*/
jQuery(document).ready(function($){

    function kushak_reorder_sections( container ){

        var sections = [];
        var sectionName;
        $( container+' .control-section' ).each(function(){

            sectionName = $(this).attr('aria-owns');
            sectionName = sectionName.replace( "sub-accordion-section-", "");
            sections.push(sectionName);
        });
        var sections = sections.toString();

        var data = {
            'action': 'kushak_arrange_home_section',
            'sections': sections,
            '_wpnonce': kushak_customizer.ajax_nonce,
        };

        $.post( ajaxurl, data, function(response) {

            wp.customize.previewer.refresh();

        });

    }


    $('#sub-accordion-panel-homepage_section_panel').sortable({
      axis: 'y',
      items: '.control-section',
      update: function( event, ui ) {

        kushak_reorder_sections( '#sub-accordion-panel-homepage_section_panel' );

      },

    });

});