<?php
/**
 * mgft_shortcodes_ajax.php Created by Andrea Sciamanna
 * On 06/11/12, 10.16
 */

if (!class_exists('mgft_shortcodes')) {
    require_once 'mgft_shortcodes.php';
}

class mgft_editor_ajax
{
    private static function array_push_assoc($array, $key, $value)
    {
        $array[$key] = $value;
        return $array;
    }

    static function process_ajax_sample()
    {
        $settings = $_POST['settings'];
        $shortcodeArguments = array('id' => $settings['id']);
        //$shortcodeArguments = array_merge($shortcodeArguments, $settings['params']);
        //echo '<pre>' . print_r($settings['params'], true) . '</pre>';
        foreach ($settings['params'] as $key => $value) {
            $shortcodeArguments = self::array_push_assoc($shortcodeArguments, strtolower($key), $value['value']);
        }

        //echo '<pre>' . print_r($shortcodeArguments, true) . '</pre>';
        switch ($settings['shortcodeType']) {
            case 'progressbar':
                if ($shortcodeArguments['autostyle']) {
                    ?>
                <link rel="stylesheet" href="<?php echo misamee_gf_tools::getPluginUrl() . 'css/style.css' ?>">
                <?php
                }
                echo mgft_shortcodes::progressbar($shortcodeArguments);
                break;
            default:
                echo mgft_shortcodes::grand_total($shortcodeArguments);
                break;
        }

        die();
    }

    static function process_ajax_fields()
    {
        $form_id = $_POST['form_id'];

        $form = RGFormsModel::get_form_meta($form_id);
        $fields = $form['fields'];

        $ids = array();
        foreach ($fields as $key => $row) {
            $ids[$key] = $row['id'];
        }
        array_multisort($ids, SORT_ASC, $fields);

        //echo '<pre>' . print_r($fields, true) . '</pre>';
        ?>
    <style type="text/css">
        #ajax_fields_list td {
            vertical-align: top;
        }

        #ajax_fields_list tr:nth-child(odd) {
            background-color: #eee;
        }

        #ajax_fields_list tr:nth-child(even) {
            background-color: #fff;
        }
    </style>
    <table id="ajax_fields_list">
        <thead>
        <tr>
            <th>Placeholder</th>
            <th>Field Name</th>
            <th>Type</th>
            <th>Possible values</th>
        </tr>
        </thead>
        <tbody>
            <?php
            foreach ($fields as $id => $properties) {
                if ($properties['label'] != '') {
                    ?>
                <tr>
                    <td>{{<?php echo $properties['id']; ?>}}</td>
                    <td><?php echo $properties['label']; ?></td>
                    <td><?php echo $properties['type']; ?></td>
                    <td><?php
                        if (array_key_exists('choices', $properties) && $properties['choices']) {
                            $choices = $properties['choices'];
                            echo '<ol>';
                            foreach ($choices as $index => $value) {
                                echo '<li><strong>' . $value['value'] . '</strong>';
                                if ($value['value'] != $value['text']) {
                                    echo ' (' . $value['text'] . ')';
                                }
                                echo '</li>';
                            }
                            echo '</ol>';
                        } else {
                            echo 'n/a';
                        }
                        ?>
                    </td>
                </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <?php
        die();
    }
}
