<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\Eloquents\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Facades\OAuth\JHFacebook;
use App\Facades\OAuth\JHGoogle;

use App\Models\Account\User;
use App\Models\Account\UserInformation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class OAuthController extends Controller
{


    private $user;


    /**
     * OAuthController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    public function facebookSingleSignOn(Request $request)
    {

        $fb = new JHFacebook(JHFacebook::SCOPE_SSO);

        $accessToken = $fb->getAccessToken($request->state);

        if($accessToken) {

            $fb->setAccessToken($accessToken);
            $profile = $fb->getProfileInfo();

            $email = $profile->getEmail();
            $firstName = $profile->getFirstName();
            $lastName = $profile->getLastName();

            if($user = $this->user->createUserWithInformation($email, $firstName, $lastName))
                Auth::login($user, true);

            return redirect()->route('dashboard.home');
        }

        return redirect()->route('page.login');
    }


    public function googleSingleSignOn(Request $request)
    {

        $authCode = $request->code;

        $youtube = new JHGoogle(JHGoogle::SCOPE_SSO);

        if($youtube->getAccessToken($authCode)) {

            $profile = $youtube->getProfileInfo();

            $email = $profile->getEmailAddresses()[0]->value;

            $firstName = $profile->getNames()[0]->givenName;
            $lastName = $profile->getNames()[0]->familyName;

            if($user = $this->user->createUserWithInformation($email, $firstName, $lastName))
                Auth::login($user, true);

            return redirect()->route('dashboard.home');
        }

        return redirect()->route('page.login');
    }

}
