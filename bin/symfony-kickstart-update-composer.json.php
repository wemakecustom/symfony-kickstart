<?php

$project = getcwd();
if (isset($argv[1])) {
    $project = $argv[1];
}

$json_path = "${project}/composer.json";
if (!is_file($json_path)) {
    throw new \RuntimeException('Argument 1 must be the directory of the project to alter');
}

$json = file_get_contents($json_path);
$data = json_decode($json,true);

foreach (array('post-install-cmd', 'post-update-cmd') as $event) {
    foreach ($data['scripts'][$event] as $i => $script) {
        switch ($script) {
            case 'Incenteev\ParameterHandler\ScriptHandler::buildParameters':
            case 'WMC\Composer\Utils\ConfigFile\ConfigDir::updateDirs':
            case 'WMC\AppLoader\ScriptHandler::buildParameters':
                unset($data['scripts'][$event][$i]);
                break;
        }
    }

    array_unshift($data['scripts'][$event], "WMC\Composer\Utils\ConfigFile\ConfigDir::updateDirs");
    array_unshift($data['scripts'][$event], "WMC\AppLoader\ScriptHandler::buildParameters");
}

$data['require']['symfony2-bundles/wmccommonbundle'] = '*';
$data['require']['symfony2-bundles/wmcdoctrinebundle'] = '*';
$data['require']['sp/bower-bundle'] = 'dev-master';
$data['require']['jms/di-extra-bundle'] = '1.x';
$data['require']['jms/security-extra-bundle'] = '1.x';

$data['require']['wemakecustom/symfony-app-loader'] = '~1.0';
$data['require']['wemakecustom/composer-script-utils'] = '>=0.3';
$data['require']['wemakecustom/directory-loader-bundle'] = '1.0.*@dev';
$data['require']['stof/doctrine-extensions-bundle'] = '~1.1';
$data['require']['friendsofsymfony/user-bundle'] = '~2.0';

$data["minimum-stability"] = "dev";
$data["prefer-stable"] = true;

$data["extra"]["symfony-app-dir"] = "app";
$data["extra"]["symfony-web-dir"] = "htdocs";
$data["extra"]["symfony-assets-install"] = "relative";

$data["extra"]["update-config-dirs"]["confs/dist"] = "confs";
$data["extra"]["update-config-dirs"]["app/config/parameters/dist"] = "app/config/parameters/local";

unset($data['require']['incenteev/composer-parameter-handler']);
unset($data['extra']['incenteev-parameters']);


$data["repositories"] = array(
    array(
        "packagist" => false,
    ),
    array(
        "type" => "composer",
        "url"  => "http://gitlab-composer.stage.wemakecustom.com/",
    ),
    array(
        "type" => "composer",
        "url"  => "http://composer.wemakecustom.com/proxy/packagist",
    ),
);

$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
file_put_contents($json_path,$json);
