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
            $q1 = $q; 
            $q2 = $q1;

            }           
        }
        else //If query has less than two words -> assign same value to $q1 and $q2
        {
        $q1 = $q; 
        $q2 = $q1;
        }

        //If not pass on $q to search alg.



        //Loop through array
        $result = SearchEngine::loop_arr($p, $q1, $q2);
                
    
        //Filter negative search word
        $test = SearchEngine::filter_array($result, $negative_query);
       
        $super = SearchEngine::check_diff_multi($result, $test);

        print_r($super);
        // $this->result = $filter_results;

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
            $arr = array();

            foreach($p as $item)
            {
                $match = $item->name;
                $regex = "/($first_q|$second_q\w{3,})/i";

                if(preg_match($regex, $match))
                {
                    $arr[] = $item; //Store match in array
                }

            }
            return $arr;
    }
    
    public static function filter_array($p, $q)
    {
            $arr = array();

            foreach($p as $item)
            {
                $match = $item->name;
                $regex = "/$q/i";

                if(preg_match($regex, $match))
                {
                    $arr[] = $item; //Store match in array
                }

            }
            return $arr;
    }    
    public function check_diff_multi($array1, $array2){
            $result = array();
            
            foreach($array1 as $key => $val) 
            {
                 if(isset($array2[$key]))
                 {
                   
                   if(is_array($val) && $array2[$key])
                    {
                    $result[$key] = check_diff_multi($val, $array2[$key]);
                    }
                 } 
                    
                    else 
                    {
                    $result[$key] = $val;
                    }
            }

            return $result;
}
}