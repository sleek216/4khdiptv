<?php
/**
 * GitHub Auto-Deploy Webhook for cPanel
 * Triggered automatically on git push to main branch
 */

// Security token (optional query param: ?token=mysecrettoken)
$secret = 'iptv_deploy_2026';
if (isset($_GET['token']) && $_GET['token'] !== $secret) {
    http_response_code(403);
    die('Forbidden: Invalid token');
}

// Path to the cloned repository in cPanel
$repoPath = '/home/khdiptv/repositories/4khdiptv';

// Execute git pull and cPanel deploy
$output = [];
$return_var = 0;

$command = "cd {$repoPath} && git pull origin main 2>&1";
exec($command, $output, $return_var);

// If .cpanel.yml deployment is configured
$deployCmd = "cd {$repoPath} && /bin/cp -R * /home/khdiptv/ 2>&1";
exec($deployCmd, $output, $return_var);

header('Content-Type: application/json');
echo json_encode([
    'status' => $return_var === 0 ? 'success' : 'completed',
    'output' => $output
]);
