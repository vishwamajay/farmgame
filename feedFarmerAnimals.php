<?php
	require_once('config/config.php');

    session_start();

    //Each click to feed incrementing feed count
    $_SESSION['int_feed_counter']++;
    
    if($_SESSION['int_feed_counter'] > $int_total_rounds){
    	echo $str_Result = 'FCE'; //This would indicate max feed counter exceeded
    }
    else{
    	//Adding arrays by preserving keys
        $array_farmers_animals = $arr_farmer_type_ids + $arr_cow_type_ids + $arr_bunny_type_ids;
        
        //Randomly getting key of array which will indicate whom to feed 
        $int_random_feed = array_rand($_SESSION['array_farmers_animals'],1);

        //Maintaing fed given to counters
        setFeedClickCounters($int_random_feed);

        //Set Fed and isAlive value of farmer/animals
        $str_Result = setFedOrIsAlive($int_max_fed_clicks_farmer, $int_max_fed_clicks_cows, $int_max_fed_clicks_bunny, $int_random_feed, $int_total_rounds); 
        echo $str_Result;
    }
    
    /**
    Usage : Setting feed click counters
    Input : Integer value conatining random key of farmer/animal to be fed
    Output : Updating session values/fed counters
    **/
    function setFeedClickCounters($int_random_feed){

        if(in_array($int_random_feed, array_keys($_SESSION['arr_farmer_type_ids']))){
            $_SESSION['int_fed_clicks_farmer'] = 0;
        }
        else{
            $_SESSION['int_fed_clicks_farmer']++;
        }

        if( is_array($_SESSION['arr_cow_type_ids']) && count($_SESSION['arr_cow_type_ids']) > 0 ){
            foreach($_SESSION['arr_cow_type_ids'] as $key_cow_type_id => $value_cow_type_id){
                if($int_random_feed == $key_cow_type_id){
                    $_SESSION['int_fed_clicks_cows_'.$key_cow_type_id] = 0;
                }    
                else{
                    $_SESSION['int_fed_clicks_cows_'.$key_cow_type_id]++;             
                }                      
            }
        }

        if( is_array($_SESSION['arr_bunny_type_ids']) && count($_SESSION['arr_bunny_type_ids']) > 0 ){
            foreach($_SESSION['arr_bunny_type_ids'] as $key_bunny_type_id => $value_bunny_type_id){
                if($int_random_feed == $key_bunny_type_id){
                    $_SESSION['int_fed_clicks_bunny_'.$key_bunny_type_id] = 0;
                }    
                else{
                    $_SESSION['int_fed_clicks_bunny_'.$key_bunny_type_id]++;             
                }                      
            }
        }  

    }

    /**
    Usage : Setting fed or isAlive values of farmers/animals
    Input : Integer value 
        a) Max fed click within which farmer has to be fed
        b) Max fed click within which cow has to be fed
        c) Max fed click within which bunny has to be fed
        d) random key of farmer/animal to be fed
        e) max total fed clicks permitted 
    Output : String value indicating which farmer/animal to be fed or isAlive value
    **/
    function setFedOrIsAlive($int_max_fed_clicks_farmer, $int_max_fed_clicks_cows, $int_max_fed_clicks_bunny,
        $int_random_feed, $int_total_rounds){
         
         $int_number_of_bunny_died = $int_number_of_cows_died = $int_number_of_farmer_died = $int_is_dead_id = '';

         $str_Result = $_SESSION['int_feed_counter'].'_'.$int_random_feed;
          
         if($_SESSION['int_fed_clicks_farmer'] > $int_max_fed_clicks_farmer){
           $int_is_dead_id = 1; 
           $int_number_of_farmer_died = 1;
           unset($_SESSION['arr_farmer_type_ids'][$int_is_dead_id]);
           unset($_SESSION['array_farmers_animals'][$int_is_dead_id]);
           $int_is_dead_id.=$int_is_dead_id.'~';
           $_SESSION['int_dead_count_farmer'] = 1;
         }
        
        if(is_array($_SESSION['arr_cow_type_ids']) && count($_SESSION['arr_cow_type_ids']) > 0 ){
            $int_cow_died_ids = '';
            $int_number_of_cows_died = 0;
            foreach($_SESSION['arr_cow_type_ids'] as $key_cow_type_id => $value_cow_type_id){
                if($_SESSION['int_fed_clicks_cows_'.$key_cow_type_id] > $int_max_fed_clicks_cows){
                    unset($_SESSION['arr_cow_type_ids'][$key_cow_type_id]);  
                    unset($_SESSION['array_farmers_animals'][$key_cow_type_id]);  
                    $int_is_dead_id.=$key_cow_type_id.'~';
                    $int_number_of_cows_died++;
                }    
            }    
        }
        
        if( is_array($_SESSION['arr_bunny_type_ids']) && count($_SESSION['arr_bunny_type_ids']) > 0 ){
            $int_bunny_died_ids = '';
            $int_number_of_bunny_died = 0;
            foreach($_SESSION['arr_bunny_type_ids'] as $key_bunny_type_id => $value_bunny_type_id){
                if($_SESSION['int_fed_clicks_bunny_'.$key_bunny_type_id] > $int_max_fed_clicks_bunny){
                    unset($_SESSION['arr_bunny_type_ids'][$key_bunny_type_id]);  
                    unset($_SESSION['array_farmers_animals'][$key_bunny_type_id]);  
                    $int_is_dead_id.=$key_bunny_type_id.'~';
                    $int_number_of_bunny_died++;
                }
            }
        }        
       
        if(trim($int_is_dead_id)!= '' ){
            $_SESSION['int_dead_count_cow'] = $_SESSION['int_dead_count_cow'] + $int_number_of_cows_died;
            $_SESSION['int_dead_count_bunny']  = $_SESSION['int_dead_count_bunny'] + $int_number_of_bunny_died;
            $str_display_msg = '';

            if($int_number_of_farmer_died > 0)
                $str_display_msg.= ' Farmer died :: ';

            if($int_number_of_cows_died > 0)
                $str_display_msg.= $int_number_of_cows_died.' Cow(s) died :: ';

            if($int_number_of_bunny_died>0)
                $str_display_msg.= $int_number_of_bunny_died.' Bunny(s) died :: ';

            $str_Result.= '|FOAD|'.$int_is_dead_id.'|'.$str_display_msg; //Farmer or Animal Dead
        }
        
        if($_SESSION['int_feed_counter'] == $int_total_rounds){ 
            if( (count($_SESSION['arr_farmer_type_ids']) <=0) || (count($_SESSION['arr_cow_type_ids']) <=0) || (count($_SESSION['arr_bunny_type_ids']) <=0) ){
                     $str_summary_message = ' Game finished : You loose the game,better luck next time ';
            }else{
                     $str_summary_message = ' Game finished : You win the game ';
            }
            $str_Result.= '|GFDS|'.$str_summary_message; //Game finished display summary
        }   

        return $str_Result;
    }