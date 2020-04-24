***REMOVED***
/**
 * Build a simple HTML page with multiple providers, opening provider authentication in a pop-up.
 */

require 'path/to/vendor/autoload.php';
require 'config.php';

use Hybridauth\Hybridauth;

$hybridauth = new Hybridauth($config);
$adapters = $hybridauth->getConnectedAdapters();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example 07</title>

    <script>
        function auth_popup( provider ){
            // replace 'path/to/hybridauth' with the real path to this script
            var authWindow = window.open('https://path/to/hybridauth/examples/example_07/callback.php?provider='+provider, 'authWindow', 'width=600,height=400,scrollbars=yes');
            return false;
        }
    </script>
    
</head>
<body>
    <h1>Sign in</h1>

    <ul>

***REMOVED*** foreach ($hybridauth->getProviders() as $name) : ?>
    ***REMOVED*** if (!isset($adapters[$name])) : ?>
        <li>
            <a href="#" onclick="javascript:auth_popup('***REMOVED*** print $name ?>');">
                Sign in with ***REMOVED*** print $name ?>
            </a>
        </li>
    ***REMOVED*** endif; ?>
***REMOVED*** endforeach; ?>

    </ul>

***REMOVED*** if ($adapters) : ?>
    <h1>You are logged in:</h1>
    <ul>
        ***REMOVED*** foreach ($adapters as $name => $adapter) : ?>
            <li>
                <strong>***REMOVED*** print $adapter->getUserProfile()->displayName; ?></strong> from
                <i>***REMOVED*** print $name; ?></i>
                <span>(<a href="***REMOVED*** print $config['callback'] . "?logout={$name}"; ?>">Log Out</a>)</span>
            </li>
        ***REMOVED*** endforeach; ?>
    </ul>
***REMOVED*** endif; ?>

</body>
</html>
