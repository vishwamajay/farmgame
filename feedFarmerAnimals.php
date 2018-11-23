<?php
	require_once('config/config.php');

    session_start();

    //Each click to feed incrementing feed count
    $_SESSION['int_feed_counter']++;
    
    if($_SESSION['int_feed_counter'] > $int_total_rounds){
    	$str_Result = 'FCE'; //This would indicate max feed counter exceeded
    }
    else{
    	/* Getting min and max value of array(farmers & animals) 
    	we will use this to genrate random feed to number */
        //Combining arrays by preserving keys
        $array_farmers_animals = $arr_farmer_type_ids + $arr_cow_type_ids + $arr_bunny_type_ids;
        $int_random_feed = array_rand($array_farmers_animals,1);

        $str_Result = $_SESSION['int_feed_counter'].'_'.$int_random_feed.'|'.$_SESSION['int_fed_clicks_farmer'];
        

        //Based on fed click setting fed given to counters
        if(in_array($int_random_feed, $arr_farmer_type_ids))
            $_SESSION['int_fed_clicks_farmer'] = 0;
        else
            $_SESSION['int_fed_clicks_farmer']++;

        if(in_array($int_random_feed, $arr_cow_type_ids))
            $_SESSION['int_fed_clicks_cows'] = 0;
        else
            $_SESSION['int_fed_clicks_cows']++;

        if(in_array($int_random_feed, $arr_bunny_type_ids))
            $_SESSION['int_fed_clicks_bunny'] = 0;
        else
            $_SESSION['int_fed_clicks_bunny']++;

        if($_SESSION['int_fed_clicks_farmer'] > $int_max_fed_clicks_farmer){
           $str_Result = 'FDGO'; //Farmer died Game Over
        }

        if($_SESSION['int_fed_clicks_cows'] > $int_max_fed_clicks_cows){
            ksort($arr_cow_type_ids);
            $arr_sort_keys = array_keys($arr_cow_type_ids);
            $int_min_arr_key = min($arr_sort_keys);
            unset($arr_cow_type_ids[$int_min_arr_key]);
        }
            
        if($_SESSION['int_fed_clicks_bunny'] > $int_max_fed_clicks_bunny){
            ksort($arr_bunny_type_ids);
            $arr_sort_keys = array_keys($arr_bunny_type_ids);
            $int_min_arr_key = min($arr_sort_keys);
            unset($arr_bunny_type_ids[$int_min_arr_key]);
        }
    }
    echo $str_Result;