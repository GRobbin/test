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
    public $result;

    public function __construct($p, $q, $arr)
    
    { 
        ob_start(); //Make sure not to save these temp variables

        // If query has negative search word
        // return negative word to filter out


        // If $q has two words, each at least three charcters 
        // explode search words into seperate variables
        $count = str_word_count($q, 1);
        $arr_count = count($count);
        
        $arr_match = 2;
        $str_count = '';
        $q1 = '';
        $q2 = '';
         
        if ($arr_count == 2) //If more then one word
        { 
            $first_str = strlen($count[0]); //Save first search word
            $second_str = strlen($count[1]); //Save second search word
            
            if ($first_str > 2 && $second_str > 2) //If more characters than two
            {
                $str_count = 3; 


                //Check if query has two words and if their length = > 3
                if ($arr_count == 2 && $str_count > 2 ) 
                { 
                    $q1 = $count[0]; //Save first search word
                    $q2 = $count[1]; //Save second search word
                }
            }    
            else //If two words but not enough characters
            {
            $count = str_word_count($q, 1);
            $q1 = $count[0];
            $q2 = $q1;

            }           
        }
        else //If query has less than two words -> assign same value to $q1 and $q2
        {
        $remove_whitespace = str_replace(' ','',$q);
        $q1 = $remove_whitespace; 
        $q2 = $q1;
        }

        //Loop through array
        $negative_query = SearchEngine::negative_query($q);
        $result = SearchEngine::loop_arr($p, $q1, $q2, $negative_query);

        $this->result = $result;
        
        return $result;
 

        ob_end_flush();
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
        
        foreach ($arr as $i)
        {
           
            $regex = "/-/";
            $match = $i;

            if (preg_match($regex, $match))
            {
                $query = preg_replace("/-/", "", $i);
            }

            
        }
        return $query;
    }

    /**
     * Loop through json and filter if negative search word
     * @param
     * @return 
     */

    public static function loop_arr($p, $first_q, $second_q, $negative_query)
    {
        $second_q = $second_q;
        $arr = array();

        usort($p, function($a, $b) { //Sort the array using a user defined function
        return $a->name > $b->name; //Compare the scores
        }); 
        
        if (empty($negative_query))
        {

            foreach($p as $item)
            {
                $match = $item->name;
                $regex = "/($first_q|$second_q\w)/i";

                if(preg_match($regex, $match))
                {
                    $arr[] = $item; //Store match in array
                }

            }
            return $arr;       
        }
        else 
        {

         $filter = SearchEngine::filter_query($p, $first_q, $second_q, $negative_query);

         return $filter;
       
        }

    }
    
    /**
     * Filter 
     * @param
     * @return Returns negative query
     */

    public static function filter_query($p, $first_q, $second_q, $negative_query)
    {
        $filter = array();
        
        foreach($p as $elementKey)
        {
            $match = $elementKey->name;
            $regex = "/($first_q|$second_q\w{3,})/i";

            if(preg_match($regex, $match))
            {
                $arr[] = $elementKey; //Store match in array
            }
        }

        foreach($arr as $elementKey => $element) 
        {
            foreach($element as $valueKey => $value) 
                {
            
            $match = $element->name;
            $regex = "/$negative_query/i";

            if(preg_match($regex, $match))
                    {                            
                //delete this particular object from the $array
                unset($arr[$elementKey]);
                    } 
                }
        }

        $filter = $arr;
        
        return $filter;
    } 
}