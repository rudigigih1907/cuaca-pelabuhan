<?php
    function display_error($validation, $field)
    {
        if ($validation->hasError($field)) {
            return $validation->getError($field);
        } else {
            return false;
        }
    }

    function uploaded($fileName = null, $dir = null, $defFile = null)
    {
        if ($fileName != null && $fileName != '' && file_exists(WRITEPATH .'uploads/'.$dir.'/'.$fileName)) {
            return base_url('uploads/' . $dir . '/' . $fileName);
        }
        else {
            if ($defFile = null) {
                return base_url('sb-admin2');
            }
            return base_url('sb-admin2/img/book.svg');
        }
        
    }
?>