<?php

function handle_error($code,$data){
   
   switch ($code) {
   	case '1':
   	    $return['code']=$code;
   		$return['msg']='Failed to connect database';
         //header('Content-Type: application/json');
         $list[]=$return;
   		return json_encode($list);
   		break;
   	case '2':
   		$return['code']=$code;
   		$return['msg']='Failed to open private_key file';
         $list[]=$return;
         return json_encode($list);
   		break;
   	case '3':
   		$return['code']=$code;
   		$return['msg']='Failed to decode the private_key';
         
         $list[]=$return;
         return json_encode($list);
   		break;  
   	case '4':
   		$return['code']=$code;
   		$return['msg']='Wrong token, access denied';
         $list[]=$return;
         return json_encode($list);
   		break;
   	case '5':
   		$return['code']=$code;
   		$return['msg']='Token not provided';
         $list[]=$return;
         return json_encode($list);
   		break;
   	case '6':
   		$return['code']=$code;
   		$return['msg']='SELECT query failed';
         $list[]=$return;
         return json_encode($list);
   		break;   	
   	case '7':
   		$return['code']=$code;
   		$return['msg']='Unable to lock the table';
         $list[]=$return;
         return json_encode($list);
   		break;
   	case '8':
   		$return['code']=$code;
   		$return['msg']='SELECT query failed during method';
         $list[]=$return;
         return json_encode($list);
   		break;
   	case '9':
   		$return['code']=$code;
   		$return['msg']='UPDATE query failed';
         $list[]=$return;
         return json_encode($list);
   		break;   	
   	case '10':
   		$return['code']=$code;
   		$return['msg']='Fail to release the table';
         $list[]=$return;
         return json_encode($list);
   		break;
   	case '11':
   		$return['code']=$code;
   		$return['msg']='The required amount exceed limit';
         $list[]=$return;
         return json_encode($list);
   		break;
   	case '12':
   		$return['code']=$code;
   		$return['msg']='The required amount is invalid';
         $list[]=$return;
         return json_encode($list);
   		break;
   	case '13':
   		$return['code']=$code;
   		$return['msg']='No required amount is given';
         $list[]=$return;
         return json_encode($list);
   		break;
      case '14':
         $return['code']=$code;
         $return['msg']=$data;
         $list[]=$return;
         return json_encode($list);
         break;
   
   	default:
         $return['code']=$code;
         $return['msg']='success!';
         $return['data']=$data;
         $list[]=$return;
   		return json_encode($list);
   		break;
   }

}


?>