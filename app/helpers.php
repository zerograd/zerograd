<?php
	//This files contains helper functions for blade templates.

	 
	function getCount($search,$array){

        $count = 0;

        foreach($array as $value){
            if($value == $search) $count++;
        }

        return $count;
    }

?>