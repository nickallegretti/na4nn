***REMOVED***
/**
 * Build a simple HTML page with multiple providers.
 */

include 'vendor/autoload.php';
include 'config.php';

use Hybridauth\Hybridauth;

$hybridauth = new Hybridauth($config);
$adapters = $hybridauth->getConnectedAdapters();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Example 06</title>
</head>
<body>
<h1>Sign in</h1>

<ul>
    ***REMOVED*** foreach ($hybridauth->getProviders() as $name) : ?>
        ***REMOVED*** if (!isset($adapters[$name])) : ?>
            <li>
                <a href="***REMOVED*** print $config['callback'] . "?provider={$name}"; ?>">
                    Sign in with <strong>***REMOVED*** print $name; ?></strong>
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
