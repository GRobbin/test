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
        $search = new \KnowitToolsTest\SearchEngine(
            self::all(),
            $q,
            array(
                'name'
            )
        );

        return $search->result;
    }
}
class SearchEngine
{
    /**
     * Search algoritm
     * @param  
     * @return 
     */

    public $result = '';

    public function __construct($p, $q, $arr)
    {
            $x = explode(' ', $q);
            $this->result = $x;

    }
