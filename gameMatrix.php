<?php 
    require_once('config/config.php'); 
    
    //Intialize session and set default feed count session variable to zero
    session_start();
    
    //Combining arrays by preserving keys
    $array_farmers_animals = $arr_farmer_type_ids + $arr_cow_type_ids + $arr_bunny_type_ids;

    $_SESSION['array_farmers_animals'] = $array_farmers_animals;
    $_SESSION['arr_farmer_type_ids'] = $arr_farmer_type_ids; 
    $_SESSION['arr_cow_type_ids'] = $arr_cow_type_ids;
    $_SESSION['arr_bunny_type_ids'] = $arr_bunny_type_ids;

    $_SESSION['int_feed_counter'] = 0;

    //Intialize default fed click counters
    $_SESSION['int_fed_clicks_farmer'] = 0;    

    if( is_array($_SESSION['arr_cow_type_ids']) && count($_SESSION['arr_cow_type_ids']) > 0 ){
      foreach($_SESSION['arr_cow_type_ids'] as $key_cow_type_id => $value_cow_type_id){
          $_SESSION['int_fed_clicks_cows_'.$key_cow_type_id] = 0;
      }  
    }
      
    if( is_array($_SESSION['arr_bunny_type_ids']) && count($_SESSION['arr_bunny_type_ids']) > 0 ){
      foreach($_SESSION['arr_bunny_type_ids'] as $key_bunny_type_id => $value_bunny_type_id){
          $_SESSION['int_fed_clicks_bunny_'.$key_bunny_type_id] = 0;
      }  
    }

    //Getting count of farmers and animals
    $int_count_farmers_animals = count($array_farmers_animals);
      
    //Setting grid html in a variable, which can be printed  
      $str_grid_html = '<input type="button" onclick="feedFarmerAnimal()" value="Click Here To Feed" name="feedFarmerAnimal" id="feedFarmerAnimal" />';

      $str_grid_html.= '<table>';

      /* Iterating through max clicks available and 
      array of farmer animals to genrate game matrix grid */
      for($int_click_counter = 0; $int_click_counter<=$int_total_rounds; $int_click_counter++){
          $str_grid_html.= '<tr>';
          for($int_grid_counter = 0; $int_grid_counter<=$int_count_farmers_animals; $int_grid_counter++){ 
             $str_row_id = $int_click_counter.'_'.$int_grid_counter; //Unique Id for each row element

             if($int_click_counter == 0){ //creating header row
                 $str_grid_header = in_array($int_grid_counter,array_keys($array_farmers_animals)) ? $array_farmers_animals[$int_grid_counter] : 'Round';

                 $str_type_id = "id=type_$int_grid_counter"; //Unique Id for each row element
                 $str_grid_html.= '<th '.$str_type_id.'>'.$str_grid_header.'</th>';
             }
             elseif($int_click_counter > 0 && $int_grid_counter == 0){ //creating click counter rows
                 $str_grid_html.= '<td id="'.$str_row_id.'">'.$int_click_counter.'</td>';
             }
             else{    
                 $str_grid_html.= '<td id="'.$str_row_id.'">&nbsp;</td>';
              }     
          }
          $str_grid_html.= '</tr>';
      }
      $str_grid_html.= '</table>';
      echo $str_grid_html;  
 