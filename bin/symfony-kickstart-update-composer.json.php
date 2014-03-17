<?php
$json_path = "${argv[1]}/composer.json";
$json = file_get_contents($json_path);
$data = json_decode($json,true);
//$data["require"]["wemakecustom/symfony-app-loader"] = "~1.0@dev";
foreach (array('post-install-cmd', 'post-update-cmd') as $event) {
    $data['scripts'][$event][] = "WMC\Composer\Utils\ConfigFile\ConfigDir::updateDirs";
    $data['scripts'][$event][] = "WMC\AppLoader\ScriptHandler::buildParameters";
}
$data["minimum-stability"] = "dev";
$data["prefer-stable"] = true;
$data["extra"]["symfony-app-dir"] = "app";
$data["extra"]["symfony-web-dir"] = "htdocs";
$data["extra"]["symfony-assets-install"] = "relative";
$data["extra"]["update-config-dirs"]["confs/dist"] = "confs";
$data["repositories"][] = array(
	"type" => "composer",
	"url" => "http://gitlab-composer.stage.wemakecustom.com/"
);
$json = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents($json_path,$json);
