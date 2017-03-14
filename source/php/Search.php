<?php

namespace KnowitToolsTest;

class SearchEngine

    /**
     * @param Search algoritm construct function  
     * Sort $q into $q1 and $q2 depending on how many 
     * words and characters $q contains 
     * 
     * @param Take $q1 and $q2 and filter products.json
     *
     * @return result
     */

{
    public $result;

    public function __construct($p, $q)
    
    { 
        
        /* Make sure not to save temp variables */
        ob_start(); 

        /* Store how many words $q has and trim each array from blanckspace */
        $count_arr = explode(' ', $q);
        $count = array_map('trim',$count_arr);
        $arr_count = count($count_arr);

        $arr_match = 2;
        $str_count = '';
        $q1 = '';
        $q2 = '';
         
        /* If more then one word */
        if ($arr_count > 1) { 

            /* Check string length */
            $first_str = strlen($count[0]); 
            $second_str = strlen($count[1]); 
            
           /* If more characters than two */
            if ($first_str > 2 && $second_str > 2) {
                    
                    /*Save queries*/
                    $q1 = $count[0];
                    $q2 = $count[1]; 
                
            } else {

            /* If two words but not enough characters */ 
            $count = explode(' ', $q);
            $q1 = $count[0];
            $q2 = $q1;

            }           
        } else {

        /* Save $q to both $q1 and $q2 */
        $q1 = $q; 
        $q2 = $q1;
        }

        /* 
        * Load negative search word function and use it
        * with $q1 and $q2 to filter products json
        */
        $negative_query = SearchEngine::negative_query($q);

        $result = SearchEngine::loop_arr($p, $q1, $q2, $negative_query);

        /*Return results*/ 
        $this->result = $result;

        ob_end_flush();
    }


    /**
     * Get negative searchword
     * @return negative searchword, stripped from '-'
     */
    
    public static function negative_query($query)
    {
        $arr = explode(' ', $query);
        $query = '';
        
        foreach ($arr as $i) {
           
            $regex = "/-/";
            $match = $i;

            if (preg_match($regex, $match)) {
                $result = preg_replace("/-/", "", $i);
            
                if (strlen($result) > 2) {
                    $query = $result;
                }
            }
        }
        return $query;
    }

    /**
     * Loop through json and call filter function if negative searchword
     * @param
     * @return 
     */

    public static function loop_arr($p, $first_q, $second_q, $negative_query)
    {
        $second_q = $second_q;
        $arr = array();

        /* Sort the array using a user defined function */
        usort($p, function($a, $b) { 
        
        /* Compare the names */
        return $a->name > $b->name; 
        }); 

        /* If $q does not containt negative search word */ 
        if (empty($negative_query)) {

            /*
             * Loop through array and look for $q1 and $q2.
             * Store results in $arr
             */
            foreach($p as $item) {
                $match = $item->name;
                $regex = "/($first_q|$second_q\w)/i";

                if(preg_match($regex, $match)) {
                    
                    /* Store match in array */
                    $arr[] = $item; 
                }
            }
            return $arr;    

        } else {

         /* If negative search word = true, run negative search function */
         $filter = SearchEngine::filter_query($p, $first_q, $second_q, $negative_query);

         return $filter;
       
        }
    }
    
    /**
     * Filter out negative searchword from $result
     * @param
     * @return negative query
     */

    public static function filter_query($p, $first_q, $second_q, $negative_query)
    {
        $filter = array();
        $arr = array();
        
        foreach($p as $elementKey) {
            $match = $elementKey->name;
            $regex = "/($first_q|$second_q\w)/i";

            if(preg_match($regex, $match)) {

                $arr[] = $elementKey; 
            }
        }

        foreach($arr as $elementKey => $element) {
            
            foreach($element as $valueKey => $value)  {
            
            $match = $element->name;
            $regex = "/$negative_query/i";

            if(preg_match($regex, $match)) {        

                /* Delete this particular object from the $array */

                unset($arr[$elementKey]);
                    } 
                }
        }

        $filter = $arr;
        
        return $filter;
    } 
}