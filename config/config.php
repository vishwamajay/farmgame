<?php
    
    //Array categoring farmers and animals
    $arr_farmer_type_ids = array(1=>"Farmer");
    $arr_cow_type_ids = array(2=>"Cow1",3=>"Cow2");
    $arr_bunny_type_ids = array(4=>"Bunny1",5=> "Bunny2",6=> "Bunny3",7=> "Bunny4");

    //Max total number of clicks to feed	
    $int_total_rounds = 20;//50;
    
    //Flag indicating alive status of farmer and animals, by default true
    $bol_is_farmer_alive = true;
    $bol_is_cows_alive = true;
    $bol_is_bunny_alive = true;

    //Click limit for feeding
    $int_max_fed_clicks_farmer = 7;//15;
    $int_max_fed_clicks_cows = 5;//10;
    $int_max_fed_clicks_bunny = 3;//8;

