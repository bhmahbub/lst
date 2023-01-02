<?php  ; 
	function en2bnNumber ($number){
	  $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "LST");
	  $replace_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এলএসটি");

	  $bn_number = str_replace($search_array, $replace_array, $number);

	  return $bn_number;
	}
	function bn2enNumber ($number){
	  
	  $search_array = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "এলএসটি");
	  $replace_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "LST");

	  $en_number = str_replace($search_array, $replace_array, $number);

	  return $en_number;
	}
?>
