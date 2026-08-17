<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h2>Fixing File & Folder Permissions...</h2>";

$base = dirname(__DIR__);

function fixPermissions($path) {
    if (!file_exists($path)) {
        echo "Path does not exist: {$path}<br>";
        return;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    $dirs = 0;
    $files = 0;

    // Fix base folder permission
    @chmod($path, 0755);

    foreach ($iterator as $item) {
        if ($item->isDir()) {
            if (@chmod($item->getPathname(), 0755)) {
                $dirs++;
            }
        } else {
            if (@chmod($item->getPathname(), 0644)) {
                $files++;
            }
        }
    }

    echo "✅ <b>{$path}</b>: Fixed {$dirs} folders (0755) and {$files} files (0644).<br>";
}

// Fix vendor permissions
fixPermissions($base . '/vendor');

// Fix storage permissions
fixPermissions($base . '/storage');
@chmod($base . '/storage', 0775);

// Fix bootstrap/cache permissions
fixPermissions($base . '/bootstrap/cache');
@chmod($base . '/bootstrap/cache', 0775);

echo "<br><h3>All permissions fixed! Now open:</h3>";
echo "<a href='/test.php'>👉 Test Laravel Again (/test.php)</a><br><br>";
echo "<a href='/'>👉 Open Website Homepage (/)</a>";
