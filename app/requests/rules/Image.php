<?php

namespace App\requests\rules;

use App\cores\Rule;

class Image
{
    public function check()
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mtype = finfo_file($finfo, $_FILES["photo"]["tmp_name"]);
        finfo_close($finfo);

        $whitelists = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (isset($_FILES["photo"])) {
            if (in_array($mtype, $whitelists))
                return true;
            else
                return false;
        } else
            return false;
    }

    public function getErrorMsg()
    {
        return "The uploaded file is not an image";
    }
}