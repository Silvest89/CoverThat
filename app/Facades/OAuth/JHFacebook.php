<?php
/**
 * Created by PhpStorm.
 * User: silvest
 * Date: 18/02/2017
 * Time: 13:19
 */

namespace App\Facades\OAuth;

use App\Facades\Contracts\OAuth\OAuthInterface;
use Facebook\Facebook;

/**
 * This is the Hashids facade class.
 *
 */
class JHFacebook extends BaseOAuth implements OAuthInterface
{

    public const SCOPE_SSO = 1;

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'JHGoogle';
    }

    /**
     * JHFacebook constructor.
     * @param $scope
     */
    public function __construct($scope)
    {

        $this->client = new Facebook([
            'app_id' => '164659077372337',
            'app_secret' => '011e4e5e4a5577481a59067b36a44c56',
            'default_graph_version' => 'v2.8',
        ]);

        switch($scope) {

            case JHFacebook::SCOPE_SSO: {

                $this->setSingleSignOnScopes();
                break;
            }
        }
    }

    /**
     * Set the single sign-on scopes with the callback url.
     */
    public function setSingleSignOnScopes()
    {

        $helper = $this->client->getRedirectLoginHelper();
        $permissions = ['email']; // optional
        $this->loginUrl = $helper->getLoginUrl(route('facebook.sso'), $permissions);
    }

    /**
     * @param null $scope
     * @return null|string
     */
    public function createAuthUrl($scope = null) : ?string
    {

        return $this->loginUrl;
    }

    /*
     * Returns the accesstoken
     */
    public function getAccessToken($authCode = null)
    {
        $helper = $this->client->getRedirectLoginHelper();
        $helper->getPersistentDataHandler()->set('state', $authCode);

        return $helper->getAccessToken();
    }

    /**
     * Set the accesstoken for consecutive requests.
     * @param string $token
     */
    public function setAccessToken(string $token)
    {

        $this->client->setDefaultAccessToken($token);
    }

    /**
     * Returns the refreshtoken.
     * @return null|string
     */
    public function getRefreshToken() : ?string
    {
        return '';
    }

    /**
     * Returns the user's profile info object.
     * @return \Facebook\GraphNodes\GraphUser
     */
    public function getProfileInfo()
    {
        $response = $this->client->get('/me?fields=id,first_name,last_name,email');

        return $response->getGraphUser();
    }

}