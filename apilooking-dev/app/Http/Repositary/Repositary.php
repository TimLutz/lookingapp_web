<?php
namespace App\Http\Repositary;
use App\Models\CoupenVerify;
use App\Models\User;
use App\Models\Generalfield;
use App\Models\GeneralInformation;
use App\Models\JobSeekers;
use Validator;
use DB;
use Mail;

class Repositary
{
	public function getcompleteaddress($lat,$long)
		{
			
			
			try{
			$url='https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&key=AIzaSyD6W2r1BrzJ-3wE5OZlKcuIfr949bu6FqU';
			$result=json_decode(file_get_contents($url));

			foreach($result->results[0]->address_components as $key1=>$value1)
			{
				foreach($value1 as $key2=>$value2)
				{
					
					
					if(in_array('administrative_area_level_2',$value1->types))
					{
						$result_arr['city']=$value1->long_name;
					}
					if(in_array('administrative_area_level_1',$value1->types))
					{
						$result_arr['state']=$value1->long_name;
					}
					if(in_array('country',$value1->types))
					{
						$result_arr['country']=$value1->long_name;
					}
					if(in_array('postal_code',$value1->types))
					{
						$result_arr['postal_code']=$value1->long_name;
					}
				}
			}
			return $result_arr;

		}catch(\Exception $e){
			die($e->getMessage()); 
		}
	}
	public function getcurrency($country)
	{
		return CoupenVerify::select('coupon_currency')->where('coupon_country',$country)->pluck('coupon_currency');
		
		
	}
	public function referalGenerator()
	{
		
		
		$validate['personal_referral_code']=mt_rand(100000,999999);
		
		$validator = Validator::make( $validate  ,      [
            'personal_referral_code' 							=> 'required|unique:users',
			        
        ]);
		if($validator->errors()->first('personal_referral_code') ) 
		{
			$this->referalGenerator();
		}
		else{
			return $validate['personal_referral_code'];
		}
		
	}
	public function orederReferenceGenerator()
	{
		
		
		$validate['sale_random_reference_number']=mt_rand(100000000,999999999);
		
		$validator = Validator::make( $validate  ,      [
            'sale_random_reference_number' 							=> 'required|unique:orders',
			        
        ]);
		if($validator->errors()->first('sale_random_reference_number') ) 
		{
			$this->orederReferenceGenerator();
		}
		else{
			return $validate['sale_random_reference_number'];
		}
		
	}


	public function curlExec($url,$method,$dataset)
	{
		$secret_key = "cqzjzFAw-MVgAprGgfC-";

		
		$config=array('access_token'	=> 'ZxfMBLSFxFxJwCcYd455',
						'timestamp'		=> date('Y-m-d H:i:s'),
						'company_id'	=>  '10149'
					);

		$final=array_merge($dataset,$config);

		$signature = hash_hmac("sha1", http_build_query($final), $secret_key);
		$final["signature"] = $signature;
		
		$content=json_encode($final);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		curl_setopt($ch, CURLOPT_HTTPHEADER,
		   array('Content-Type:application/json',
		       'Content-Length: ' . strlen($content))
		);

		$json_response = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($status != 200) {
		   die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($ch) . ", curl_errno " . curl_errno($ch));
		}

		curl_close($ch);
		return $response = json_decode($json_response, true);
		


	}
// Static function for sending email throughout the application

	static function sendMail($email,$data=array(),$template,$subject){
		return Mail::send($template, $data, function($m) use($data,$email,$subject){
                $m->to($email)
                    ->subject($subject);
            });
	}

// Static function for getting the updated profile of a jobseeker	

	static function updateCvPercentageCalculated($user_id)
	{
		
		$cv_percentage=Jobseekers::where('user_id',$user_id)->first();
		$cv_percentage->cv_percentage=floatval(floatval($cv_percentage->general_cv_percentage+$cv_percentage->skills_percentage+$cv_percentage->language_percentage+$cv_percentage->proffesional_experience+$cv_percentage->personal_experience_percentage)/3);
		

		if($cv_percentage->save())
		{
			$cv_data['total_percentage']=$cv_percentage->cv_percentage;
			$cv_data['general_cv_percentage']=$cv_percentage->general_cv_percentage;
			$cv_data['language_percentage']=$cv_percentage->language_percentage;
			$cv_data['proffesional_experience']=$cv_percentage->proffesional_experience;
			$cv_data['personal_experience_percentage']=$cv_percentage->personal_experience_percentage;
			$cv_data['skills_percentage']=$cv_percentage->skills_percentage;
			return $cv_data;
		}
		
	}

	//function for returning diffrence beetween two dates 

	static function getageDiffrence($start,$end)
	{
		return	$length = $start->diffInMonths($end);
		
		//print_r($start); die('herecc');
	}
//function for the conversion opf months into 

	static function getQuotientAndRemainder($divisor, $dividend) {
	    $quotient = (int)($divisor / $dividend);
	    $remainder = $divisor % $dividend;
	   	if($remainder>=6)
	   	{
	   		$quotient++;
	   	}
	   	return $quotient;
	    
	}

	/*==================================================================================================
    Function for genarating random otp for a user 
    ====================================================================================================
    */

    public function randomGeneratorRefferal($length=5){
        $str = "";
        $characters = array_merge(range('A','Z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        if(User::where('token',$str)->exists()){
            randomGeneratorRefferal();
        }
        return $str;
    }

	

	

}
