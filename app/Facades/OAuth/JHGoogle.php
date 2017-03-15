<?php
/**
 * Created by PhpStorm.
 * User: silvest
 * Date: 18/02/2017
 * Time: 13:19
 */

namespace App\Facades\OAuth;

use App\Facades\Contracts\OAuth\OAuthInterface;

/**
 * This is the Hashids facade class.
 *
 */
class JHGoogle extends BaseOAuth implements OAuthInterface
{

    public const SCOPE_SSO = 1;
    public const SCOPE_YOUTUBE = 2;

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
     * JHGoogle constructor.
     * @param $scope
     */
    public function __construct($scope)
    {

        $this->client = new \Google_Client();
        $this->client->setAuthConfig(base_path('client_secrets.json'));
        $this->client->setIncludeGrantedScopes(true);

        switch($scope) {

            case JHGoogle::SCOPE_SSO: {

                $this->setSingleSignOnScopes();
                break;
            }

            case JHGoogle::SCOPE_YOUTUBE: {

                $this->setYoutubeScopes();
                break;
            }
        }
    }

    /**
     * Set the single sign-on scopes with the callback url.
     */
    public function setSingleSignOnScopes()
    {

        $this->client->addScope([
            'profile',
            'email',
        ]);

        $this->client->setRedirectUri(route('google.sso'));
    }

    /**
     *Set the scopes required for youtube access.
     */
    private function setYoutubeScopes()
    {

        $this->client->addScope([
            'profile',
            'email',
            \Google_Service_YouTube::YOUTUBE_READONLY,
        ]);

        $this->client->setAccessType("offline");
        $this->client->setRedirectUri(route('google.sso'));
    }

    /**
     * @param null $scope
     * @return null|string
     */
    public function createAuthUrl($scope = null) : ?string
    {

        return $this->client->createAuthUrl($scope);
    }

    /**
     * @param null $authCode
     * @return array|null
     */
    public function getAccessToken($authCode = null) : ?array
    {

        if($authCode)
            return $this->client->authenticate($authCode);

        return $this->client->getAccessToken();
    }

    /**
     * @param string $token
     */
    public function setAccessToken(string $token)
    {

        $this->client->setAccessToken($token);
    }

    /**
     * @return null|string
     */
    public function getRefreshToken() : ?string
    {

        return $this->client->getRefreshToken();
    }

    /**
     * @return \Google_Service_People_Person
     */
    public function getProfileInfo()
    {

        $profile = new \Google_Service_People($this->client);

        return $profile->people->get('people/me');
    }

}