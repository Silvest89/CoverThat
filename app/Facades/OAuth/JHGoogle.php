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

/**
 * This is the Hashids facade class.
 *
 */
class JHGoogle extends Facade implements OAuthInterface
{

    public const SCOPE_SSO = 1;
    public const SCOPE_YOUTUBE = 2;

    protected $client;

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

    public function setSingleSignOnScopes()
    {

        $this->client->addScope([
            'profile',
            'email',
        ]);

        $this->client->setRedirectUri('http://' . \Request::getHost() . '/oauth/google/sso');
    }

    private function setYoutubeScopes()
    {

        $this->client->addScope([
            'profile',
            'email',
            \Google_Service_YouTube::YOUTUBE_READONLY,
        ]);

        $this->client->setAccessType("offline");
        $this->client->setRedirectUri('https://' . \Request::getHost() . '/oauth/google/callback');
    }

    public function createAuthUrl($scope = null) : ?string
    {

        return $this->client->createAuthUrl($scope);
    }

    public function getAccessToken($authCode = null) : ?array
    {

        if($authCode)
            return $this->client->authenticate($authCode);

        return $this->client->getAccessToken();
    }

    public function setAccessToken(string $token)
    {

        $this->client->setAccessToken($token);
    }

    public function getRefreshToken() : ?string
    {

        return $this->client->getRefreshToken();
    }

    public function getProfileInfo()
    {

        $profile = new \Google_Service_People($this->client);

        return $profile->people->get('people/me');
    }

}