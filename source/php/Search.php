<?php

namespace KnowitToolsTest;

class SearchEngine

    /**
     *  
     *
     * @param  
     * @return
     */

{
    public $result;

    public function __construct($p, $q)
    
    { 
        //Make sure not to save these temp variables

        ob_start(); 

        // If $q has two words, each at least three charcters 

        $count_arr = explode(' ', $q);
        $count = array_map('trim',$count_arr);
        $arr_count = count($count_arr);

        $arr_match = 2;
        $str_count = '';
        $q1 = '';
        $q2 = '';
         
        //If more then one word

        if ($arr_count > 1) 
        { 
            //Check string length

            $first_str = strlen($count[0]); 
            $second_str = strlen($count[1]); 
            
            //If more characters than two

            if ($first_str > 2 && $second_str > 2) 
            {
                    //Save queries

                    $q1 = $count[0];
                    $q2 = $count[1]; 
                
            }  
            //If two words but not enough characters  

            else 
            {
            $count = explode(' ', $q);
            $q1 = $count[0];
            $q2 = $q1;

            }           
        }
        else
        {
        $q1 = $q; 
        $q2 = $q1;
        }

        //Loop through array

        $negative_query = SearchEngine::negative_query($q);

        $result = SearchEngine::loop_arr($p, $q1, $q2, $negative_query);

        $this->result = $result;

        ob_end_flush();
    }


    /**
     * Get negative searchword
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
                $result = preg_replace("/-/", "", $i);
            
                if (strlen($result) > 2)
                {
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

        //Sort the array using a user defined function

        usort($p, function($a, $b) { 
        
        //Compare the names
        return $a->name > $b->name; 
        }); 
        
        if (empty($negative_query))
        {

            foreach($p as $item)
            {
                $match = $item->name;
                $regex = "/($first_q|$second_q\w)/i";

                if(preg_match($regex, $match))
                {
                    //Store match in array

                    $arr[] = $item; 
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
     * Filter out negative searchword from $result
     * @param
     * @return Returns negative query
     */

    public static function filter_query($p, $first_q, $second_q, $negative_query)
    {
        $filter = array();
        $arr = array();
        
        foreach($p as $elementKey)
        {
            $match = $elementKey->name;
            $regex = "/($first_q|$second_q\w)/i";

            if(preg_match($regex, $match))
            {
                //Store match in array

                $arr[] = $elementKey; 
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