<?php
/**
 * Created by PhpStorm.
 * User: silvest
 * Date: 18/02/2017
 * Time: 13:19
 */

namespace App\Facades\OAuth;

use App\Facades\Contracts\OAuth\OAuthInterface;
use Illuminate\Support\Facades\Facade;
use Facebook\Facebook;

/**
 * This is the Hashids facade class.
 *
 */
class JHFacebook extends Facade implements OAuthInterface
{

    public const SCOPE_SSO = 1;

    protected $client;

    protected $loginUrl;

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'JHGoogle';
    }

    public function __construct($scope)
    {

        $this->client = new Facebook([
            'app_id' => '164659077372337',
            'app_secret' => '011e4e5e4a5577481a59067b36a44c56',
            'default_graph_version' => 'v2.8',
        ]);

        switch($scope) {

            case JHGoogle::SCOPE_SSO: {

                $this->setSingleSignOnScopes();
                break;
            }
        }
    }

    public function setSingleSignOnScopes()
    {

        $helper = $this->client->getRedirectLoginHelper();
        $permissions = ['email']; // optional
        $this->loginUrl = $helper->getLoginUrl(route('facebook.sso'), $permissions);
    }

    public function createAuthUrl($scope = null) : ?string
    {

        return $this->loginUrl;
    }

    public function getAccessToken($authCode = null)
    {
        $helper = $this->client->getRedirectLoginHelper();
        $helper->getPersistentDataHandler()->set('state', $authCode);

        return $helper->getAccessToken();
    }

    public function setAccessToken(string $token)
    {

        $this->client->setDefaultAccessToken($token);
    }

    public function getRefreshToken() : ?string
    {
        return '';
    }

    public function getProfileInfo()
    {
        $response = $this->client->get('/me?fields=id,first_name,last_name,email');

        return $response->getGraphUser();
    }

}