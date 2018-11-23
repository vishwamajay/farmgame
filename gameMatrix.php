<?php 
    require_once('config/config.php'); 

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
             if($int_click_counter == 0){ //creating header row
                 $str_grid_header = in_array($int_grid_counter,array_keys($array_farmers_animals)) ? $array_farmers_animals[$int_grid_counter] : 'Round';
                 $str_grid_html.= '<th>'.$str_grid_header.'</th>';
             }
             elseif($int_click_counter > 0 && $int_grid_counter == 0){ //creating click counter rows
                 $str_grid_html.= '<td>'.$int_click_counter.'</td>';
             }
             else{    
                 $str_grid_html.= '<td>&nbsp;</td>';
              }     
          }
          $str_grid_html.= '</tr>';
      }
      $str_grid_html.= '</table>';
      echo $str_grid_html;  
 