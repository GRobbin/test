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

        return $search->result;
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
        ob_start(); //Make sure not to save these temp variables

        // If query has negative search word
        // return negative word to filter out
        $negative_query = SearchEngine::negative_query($q);

        // If $q has two words, each at least three charcters 
        // explode search words into seperate variables
        $count = str_word_count($q, 1);
        $arr_count = count($count);
        
        $arr_match = 2;
        $str_count = '';
        $q1 = '';
        $q2 = '';
         
        if ($arr_count == 2) //Om fler än ett ord
        { 
            $first_str = strlen($count[0]); //Spara ord 1
            $second_str = strlen($count[1]); //Spara ord 2
            
            if ($first_str > 2 && $second_str > 2) //Om fler bokstäver än två
            {
                $str_count = 3; //Str_count = tre ord


                //Kolla om $q har två ord och om de orden har två bokstäver eller mer
                if ($arr_count == 2 && $str_count > 2 ) 
                { 
                    $q1 = $count[0]; //Spara första ordet
                    $q2 = $count[1]; //Spara andra ordet
                    


                }
            }    
            else //Om två ord men otillräckligt med bokstäver
            {
            $q1 = $q; 
            $q2 = $q1;

            }           
        }
        else //Om $q inte har två ord. Ge samma värde till q2 och q2
        {
        $q1 = $q; 
        $q2 = $q1;
        }

        //If not pass on $q to searchalg


        $test = SearchEngine::explode_query($q);
 



        //Loop through array
        $result = SearchEngine::loop_arr($p, $q1, $q2);
                
                $this->result = $result;

        //Filter negative search word
        ob_end_flush();
    }

    /**
     * Explodes query
     * @param  
     * @return
     */

    public static function explode_query($e)
    {
        $arr = explode(' ', $e);

        return $arr;
    }

    /**
     * Extract negative search word
     * @param
     * @return
     */
    
    public static function negative_query($query)
    {
        $arr = explode(' ', $query);
        $query = '';
        
        foreach ($arr as $i){
           
            $regex = "/-/";
            $match = $i;

            if (preg_match($regex, $match))
            {;
            $query = preg_replace("/-/", "", $i);
            }
        }

        return $query;
    }

    public static function loop_arr($p, $first_q, $second_q)
    {
            $result = '';
            $second_q = $second_q;

            foreach($p as $item)
            {
                $match = $item->name;
                $regex = "/($first_q|$second_q\w{3,})/i";

                if(preg_match($regex, $match))
                {
                    $result = print_r($item); //Varför behövs printf?
                }

            }
            return $result;
    }
}