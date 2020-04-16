
<?php
echo "start task";
$project_path = 'project/modules/buses_drivers_movements'; // define folder path here
$oldnames = ['buses_drivers_movements','Buses_drivers_movements']; // define old files names
$newnames = ['buses_drivers','Buses_drivers']; // define new files names
$names = implode($oldnames,',');
// set the main folder name (or multiple folders array)
$path = realpath("$project_path");
$di = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach($di as $name => $fio) {

    if (strposa($fio->getFilename(), $oldnames) !== false) {
        $old_file_name = $fio->getPath() . DIRECTORY_SEPARATOR.$fio->getFilename() ;
        $new_file_name =   $fio->getPath() . DIRECTORY_SEPARATOR.str_replace( $oldnames, $newnames, $fio->getFilename() );
        $old_file_str = file_get_contents($old_file_name);
        $new_file_str= str_replace( $oldnames, $newnames, $old_file_str) ;
        file_put_contents($new_file_name, $new_file_str);
        unlink($old_file_name);
    }
}
function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $query) {
        if(stripos($haystack, $query, $offset) !== false) return true; // stop on first true result
    }
    return false;
}

echo " end task";
