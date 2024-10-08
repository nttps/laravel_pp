<?php  #endregion


function list_filter($list, $args = array(), $operator = 'AND')
{
    if (!is_array($list)) {
        return array();
    }

    $util = new \NttpsDev\Libs\List_Util($list);

    return $util->filter($args, $operator);
}


function filterArray($array, $allowed = [])
{
    return array_filter(
        $array,
        function ($val, $key) use ($allowed) { // N.b. $val, $key not $key, $val
            return isset($allowed[$key]) && ($allowed[$key] === true || $allowed[$key] === $val);
        },
        ARRAY_FILTER_USE_BOTH
    );
}

function filterKeyword($data, $search, $field = '')
{
    $filter = '';
    if (isset($search['value'])) {
        $filter = $search['value'];
    }
    if (!empty($filter)) {
        if (!empty($field)) {

            if (strpos(strtolower($field), 'created_at') !== false) {
                // filter by date range


                $data = filterByDateRange($data, $filter, $field);
            } else {
                // filter by column
                $data = array_filter($data, function ($a) use ($field, $filter) {
                    return (boolean)preg_match("/$filter/i", $a[$field]);
                });
            }
        } else {
            // general filter
            $data = array_filter($data, function ($a) use ($filter) {
                return (boolean)preg_grep("/$filter/i", (array)$a);
            });
        }
    }
    return $data;
}

function filterByDateRange($data, $filter, $field)
{
    // filter by range
    if (!empty($range = array_filter(explode('|', $filter)))) {
        $filter = $range;
    }

    if (is_array($filter)) {
        foreach ($filter as &$date) {
            // hardco ded date format
            $date = date_create($date);
            $date = date_create_from_format('Y-m-d', date_format($date, 'Y-m-d'));
        }
        // filter by date range
        $data = array_filter($data, function ($a) use ($field, $filter) {
            // hardcoded date format
            $a[$field] = date_create($a[$field]);
            $current = date_create_from_format('Y-m-d', date_format($a[$field], 'Y-m-d'));

            $from    = $filter[0];

            $to      = $filter[1];
            if ($from <= $current && $to >= $current) {
                return true;
            }

            return false;
        });
    }
    return $data;
}


if(!function_exists('imageThumbnail')){
    function imageThumbnail($type , $image){
        // Return empty string if the field not found
        if (!isset($image)) {
            return '';
        }
                // We need to get extension type ( .jpeg , .png ...)
      

        // We remove extension from file name so we can append thumbnail type
        // We remove extension from file name so we can append thumbnail type
        $path = substr($image, 0,strrpos($image, '/'));
        //dd($name);
        // We merge original name + type + extension
        $name =explode('/', $image);
        // We merge original name + type + extension
        return $path.'/'.$type.'/'.end($name);
    }
}

if(!function_exists('getColletion')){
    function getColletion($id){
        $name = NttpsApp\Models\Category::withTranslation()->find($id)->first();
        return $name;
    }
}
