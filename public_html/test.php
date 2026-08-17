<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>1. PHP is Working!</h2>";
echo "PHP Version: " . phpversion() . "<br><br>";

echo "<h2>2. Checking Paths:</h2>";
$base = dirname(__DIR__);
echo "Base Path: " . $base . "<br>";

if (file_exists($base . '/.env')) {
    echo "✅ .env found (" . filesize($base . '/.env') . " bytes)<br>";
} else {
    echo "❌ .env NOT found at " . $base . '/.env' . "<br>";
}

if (file_exists($base . '/vendor/autoload.php')) {
    echo "✅ vendor/autoload.php found<br>";
} else {
    echo "❌ vendor/autoload.php NOT found at " . $base . '/vendor/autoload.php' . "<br>";
}

if (file_exists($base . '/bootstrap/app.php')) {
    echo "✅ bootstrap/app.php found<br>";
} else {
    echo "❌ bootstrap/app.php NOT found<br>";
}

echo "<h2>3. Attempting to Bootstrap Laravel:</h2>";
try {
    require $base . '/vendor/autoload.php';
    $app = require_once $base . '/bootstrap/app.php';
    echo "✅ Laravel bootstrapped successfully!<br>";
} catch (\Throwable $e) {
    echo "❌ <b>Laravel Error:</b> " . $e->getMessage() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
