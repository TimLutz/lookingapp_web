<?php

// app/Views/Subscribers/export.ctp

//foreach ($data as $row):
//	foreach ($row['User'] as &$cell):
//		// Escape double quotation marks
//		$cell = '"' . preg_replace('/"/','""',$cell) . '"';
//	endforeach;
//	echo implode(',', $row['User']) . "\n";
//endforeach;
echo implode(',', array('Sl No','Screen Name','User ID','Email','Member Type','Joined','Expires')) . "\n";
foreach ($data as $key=>$row):
    echo ($key+1).',';
    $screen_name=ereg_replace('\u.{4}', '', $row['User']['screen_name']);
    echo str_replace("\\","",$screen_name).',';
    echo $row['User']['token'].',';
    echo $row['User']['email'] .',';
    if($row['User']['member_type']==1 && strtotime($row['User']['valid_upto'])>=strtotime(date('Y-m-d')) && $row['User']['is_trial']==1){	
            echo 'Trial,' ;	
    }else if($row['User']['member_type']==1 && strtotime($row['User']['valid_upto'])>=strtotime(date('Y-m-d'))){
            echo 'Paid,';
        
    }else{
        if($row['User']['removead']==1 && strtotime($row['User']['removead_valid_upto'])>=strtotime(date('Y-m-d'))){
            echo 'Ad Free,';
        }else{
            echo 'Free,' ;
        }
    }    
    echo date('d-M-Y',strtotime($row['User']['creation_date'])).',';
    if($row['User']['member_type']==1 && strtotime($row['User']['valid_upto'])<strtotime(date('Y-m-d'))){ echo '----'."\n";}else {echo date('d-M-Y',strtotime($row['User']['valid_upto']))."\n";}
endforeach;