<?php
	require_once('config/config.php');

    session_start();

    //Each click to feed incrementing feed count
    $_SESSION['int_feed_counter']++;
    
    if($_SESSION['int_feed_counter'] > $int_total_rounds){
    	echo 'FCE'; //This would indicate max feed counter exceeded
    }
    else{
    	/* Getting min and max value of array(farmers & animals) 
    	we will use this to genrate random feed to number */
    	ksort($array_farmers_animals);
    	$arr_sort_keys = array_keys($array_farmers_animals);
    	$int_min_arr_key = min($arr_sort_keys);
    	$int_max_arr_key = max($arr_sort_keys);

    	//System genrated number, we will use it for feeding farmer/animal
        $int_random_feed = mt_rand($int_min_arr_key, $int_max_arr_key);
        echo $_SESSION['int_feed_counter'].'_'.$int_random_feed;
    }