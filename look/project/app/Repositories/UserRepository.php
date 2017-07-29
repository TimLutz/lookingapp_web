<?php namespace repositories;

use App\Models\User;
use App\Models\EmailTemplate;
use Hash;
use Mail;

class UserRepository {
	
    public function findByUserNameOrCreate($userData) {
        $user = User::where('email', '=', $userData['email'])->first();
        if(!$user) {
			$user = new User();
			$user->first_name = $userData['first_name'];
			$user->email = $userData['email'];
			$user->status = '1';
			$user->role = '3';
            
			if(isset($userData['facebook_url'])){
				$user->facebook_url = $userData['facebook_url'];
			}
			elseif(isset($userData['linkedin_url'])){
				$user->linkedin_url = $userData['linkedin_url'];
			}
			elseif(isset($userData['google_url'])){
				$user->google_url = $userData['google_url'];
			}
			$user->save();
			
			//Dynamic Email Template
			$template=EmailTemplate::find('569f564c04896f60016ae42c');
			$find=array('@username@','@sitename@');
			$values=array($user->first_name,config('app.website_name'));
			$body=str_replace($find,$values,$template->content);
			//Send Mail
			Mail::send('emails.verify', array('content'=>$body), function($message) use($template,$user)
				{
					$message->to($user->email)
							->subject($template->subject);
							
				});
        }

        $this->checkIfUserNeedsUpdating($userData, $user);
		$data['user'] = $user;
        return $data;
    }

    public function checkIfUserNeedsUpdating($userData, $user) {

        $socialData = [
            'email' => $userData['email'],
            'first_name' => $userData['first_name'],
        ];
		if(isset($userData['facebook_url'])){
			$socialData['facebook_url'] = $userData['facebook_url'];
		}
		elseif(isset($userData['linkedin_url'])){
			$socialData['linkedin_url'] = $userData['linkedin_url'];
		}
		elseif(isset($userData['google_url'])){
			$socialData['google_url'] = $userData['google_url'];
		}
		
        $dbData = [
            'email' => $user->email,
            'first_name' => $user->first_name,
        ];
		
		if(isset($user->facebook_url)){
			$dbData['facebook_url'] = $user->facebook_url;
		}
		elseif(isset($user->linkedin_url)){
			$dbData['linkedin_url'] = $user->linkedin_url;
		}
		elseif(isset($user->google_url)){
			$dbData['google_url'] = $user->google_url;
		}

        if (array_diff($socialData, $dbData)) {
			$user->email = $userData['email'];
			$user->first_name = $userData['first_name'];
			if(isset($userData['facebook_url'])){
				$user->facebook_url = $userData['facebook_url'];
			}
			elseif(isset($userData['linkedin_url'])){
				$user->linkedin_url = $userData['linkedin_url'];
			}
			elseif(isset($userData['google_url'])){
				$user->google_url = $userData['google_url'];
			}
			$user->save();
        }
    }
}
?>
