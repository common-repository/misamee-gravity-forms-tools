if (typeof jQuery !== 'undefined') {
    jQuery(document).ready(function () {
        jQuery('.mgft-progressbar[data-percentage]').each(function () {
            var percentage = jQuery(this).data('percentage');
            var colors = jQuery(this).data('colors');
            var colorsArray = colors.split(',');

            if (colorsArray.length !== 0) {
                var segments = 100 / colorsArray.length;

                for (var i = 0; i < colorsArray.length; i++) {
                    var segment = (i + 1);

                    if (percentage <= (segment * segments)) {
                        jQuery('span', jQuery(this)).css('background-color', colorsArray[i]);
                        break;
                    }
                }
            }
            jQuery('span', jQuery(this)).css('width', percentage + '%');
        });
    });
}
