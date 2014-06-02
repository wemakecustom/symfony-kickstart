<?php
$json_path = "${argv[1]}/composer.json";
$json = file_get_contents($json_path);
$data = json_decode($json,true);

foreach (array('post-install-cmd', 'post-update-cmd') as $event) {
    foreach ($data['scripts'][$event] as $i => $script) {
        if ($script == 'Incenteev\ParameterHandler\ScriptHandler::buildParameters') {
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

$data["minimum-stability"] = "dev";
$data["prefer-stable"] = true;

$data["extra"]["symfony-app-dir"] = "app";
$data["extra"]["symfony-web-dir"] = "htdocs";
$data["extra"]["symfony-assets-install"] = "relative";

$data["extra"]["update-config-dirs"]["confs/dist"] = "confs";
$data["extra"]["update-config-dirs"]["app/config/parameters/dist"] = "app/config/parameters/local";

$data["repositories"][] = array(
	"type" => "composer",
	"url" => "http://gitlab-composer.stage.wemakecustom.com/"
);

$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
file_put_contents($json_path,$json);
