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
        //print_r($_SESSION['array_farmers_animals']);
        //$int_random_feed = array_rand($array_farmers_animals,1);
        $int_random_feed = array_rand($_SESSION['array_farmers_animals'],1);

        //Based on fed click setting fed given to counters
        if(in_array($int_random_feed, array_keys($arr_farmer_type_ids)))
            $_SESSION['int_fed_clicks_farmer'] = 0;
        else
            $_SESSION['int_fed_clicks_farmer']++;

        if(in_array($int_random_feed, array_keys($arr_cow_type_ids)))
            $_SESSION['int_fed_clicks_cows'] = 0;
        else
            $_SESSION['int_fed_clicks_cows']++;

        if(in_array($int_random_feed, array_keys($arr_bunny_type_ids)))
            $_SESSION['int_fed_clicks_bunny'] = 0;
        else
            $_SESSION['int_fed_clicks_bunny']++;

        $str_Result = ''; 
        if($_SESSION['int_fed_clicks_farmer'] > $int_max_fed_clicks_farmer){
           $str_Result = 'FDGO'; //Farmer died Game Over
           $int_min_arr_key = 1;
           unset($_SESSION['arr_farmer_type_ids'][$int_min_arr_key]);
           unset($_SESSION['array_farmers_animals'][$int_min_arr_key]);
        }
        elseif($_SESSION['int_fed_clicks_cows'] > $int_max_fed_clicks_cows){
            ksort($arr_cow_type_ids);
            $arr_sort_keys = array_keys($arr_cow_type_ids);
            $int_min_arr_key = min($arr_sort_keys);
            unset($_SESSION['arr_cow_type_ids'][$int_min_arr_key]);
            //print_r($arr_cow_type_ids); die;
            unset($_SESSION['array_farmers_animals'][$int_min_arr_key]);
            $_SESSION['int_fed_clicks_cows'] = 0; 
            $str_Result = 'OCD'; //One cow died
        }
        elseif($_SESSION['int_fed_clicks_bunny'] > $int_max_fed_clicks_bunny){
            ksort($arr_bunny_type_ids);
            $arr_sort_keys = array_keys($arr_bunny_type_ids);
            $int_min_arr_key = min($arr_sort_keys);
            unset($_SESSION['arr_bunny_type_ids'][$int_min_arr_key]);
            //print_r($arr_bunny_type_ids); die;
            unset($_SESSION['array_farmers_animals'][$int_min_arr_key]);
            $_SESSION['int_fed_clicks_bunny'] = 0;
            $str_Result = 'OBD'; //One bunny died
        }
        else{
            $int_min_arr_key = 0;
            $str_Result = $_SESSION['int_feed_counter'].'_'.$int_random_feed.'|'.$int_min_arr_key; 
        }
        
        $str_Result = $str_Result.'|'.$int_min_arr_key;
        
    }
    echo $str_Result;