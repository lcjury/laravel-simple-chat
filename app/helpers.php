<?php

if (! function_exists('guest_filetype')) {

    /**
     * Helper for guessing to map a file type from a file_mime.
     * Some people put this code inside the model itself, I'm not 
     * sure if it belongs there, so, I prefer to create a helper until
     * I know were to put the code.
     * @param string $file_mime
     * @param array $file_map
     * @return string 
     **/
    function guest_filetype($file_mime, $file_map)
    {
        $file_mime = (explode('/', $file_mime));
        $file_type = reset($file_mime);
        $file_type = $file_map[$file_type];
        return $file_type;
    }
}
