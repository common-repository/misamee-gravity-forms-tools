<style>
    #select_mgft_shortcode {
        background-color: #F2825B; /* Very old browsers */
        background-color: rgb(242, 130, 91); /* Old browsers */
        background: -moz-linear-gradient(top, rgba(242, 130, 91, 1) 0%, rgba(229, 91, 43, 1) 50%, rgba(240, 113, 70, 1) 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(242, 130, 91, 1)), color-stop(50%, rgba(229, 91, 43, 1)), color-stop(100%, rgba(240, 113, 70, 1))); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, rgba(242, 130, 91, 1) 0%, rgba(229, 91, 43, 1) 50%, rgba(240, 113, 70, 1) 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, rgba(242, 130, 91, 1) 0%, rgba(229, 91, 43, 1) 50%, rgba(240, 113, 70, 1) 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, rgba(242, 130, 91, 1) 0%, rgba(229, 91, 43, 1) 50%, rgba(240, 113, 70, 1) 100%); /* IE10+ */
        background: linear-gradient(top bottom, rgba(242, 130, 91, 1) 0%, rgba(229, 91, 43, 1) 50%, rgba(240, 113, 70, 1) 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = '#f2825b', endColorstr = '#f07146', GradientType = 0); /* IE6-9 */
    }

    #select_mgft_shortcode .wrap {
        background-image: url('<?php echo misamee_gf_tools::getPluginUrl(); ?>images/misamee_logo.png');
        background-position: top center;
    }

    #select_mgft_shortcode fieldset {
        padding: 0 15px;
        margin-bottom: 15px;
    }

    #select_mgft_shortcode fieldset .row {
        background-color: rgba(255, 255, 255, 0.8);
        margin: 2px 0;
        padding: 2px;
    }

    #select_mgft_shortcode label {
        font-weight: bold;
    }

    #select_mgft_shortcode label.normal {
        margin: 0 2px 0 0;
        padding: 2px;
        width: 50%;
        display: inline-block;
    }

    #select_mgft_shortcode label.full {
        width: 100%;
    }

    #select_mgft_shortcode .wrap {
        margin: 15px 0;
    }

    #select_mgft_shortcode .preview {
        padding: 5px;
        float: none;
        border-style: solid;
        border-color: #000;
        border-width: 1px;
        margin: 0 5px;
        background-color: #FFFFBB;
    }

</style>