<?php

namespace KnowitToolsTest;

class Products
{

    /**
     * Get all products
     * @return array
     */


    public static function all() : array
    {
        return json_decode(file_get_contents(PRODUCTS_JSON));
    }


    /**
     * Search products
     * @param  string $q Search query
     * @return array     Search results
     */
    public static function search($q)
    {
        $search = new \KnowitToolsTest\SearchEngine(self::all(), $q, array('name'));

        var_dump($search->result);
    }
}
class SearchEngine

    /**
     *  
     *
     * @param  
     * @return
     */

{
    public $result = '';

    public function __construct($p, $q, $arr)
    { 
        

            foreach($p as $item)
            {
                $match = $item->name;

                if(preg_match("/\b$q\b/i", $match))
                {
                    print_r($item);

                }

            }

                
    }
    
}