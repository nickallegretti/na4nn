***REMOVED***
/*!
* A simple example that shows how to connect users to providers using OpenID.
*/

include 'vendor/autoload.php';

***REMOVED***
    'callback'  => Hybridauth\HttpClient\Util::getCurrentUrl(),

    'openid_identifier' => 'https://open.login.yahooapis.com/openid20/www.yahoo.com/xrds',
    // 'openid_identifier' => 'https://openid.stackexchange.com/',
    // 'openid_identifier' => 'http://steamcommunity.com/openid',
    // etc.
***REMOVED***

try {
    $adapter = new Hybridauth\Provider\OpenID( $config );

    $adapter->authenticate();

    $tokens = $adapter->getAccessToken();
    $userProfile = $adapter->getUserProfile();

    // print_r( $tokens );
    // print_r( $userProfile );

    $adapter->disconnect();
}
catch( Exception $e ){
    echo $e->getMessage();
}
