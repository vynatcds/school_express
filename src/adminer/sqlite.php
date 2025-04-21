<?php

	function adminer_object()
	{
		$aLoad = [];

		require "plugins/CSqlite.php";
		# overwrite defaults
		$aOpt = [
			# root path to search for files
			'vPath' => '../',
			# we search for *.sqlite / *.db files
			'vSearch' => "#(.+\.sqlite|.+\.db)$#",
			# write access!
			'vPwdFile' => __DIR__ . "/CSqlite.pwd",
		];
		$aLoad[] = new CSqlite($aOpt);

		class AdminerCustomization extends Adminer\Plugins
		{
		}
		return new AdminerCustomization($aLoad);
	}
	include "./adminer-5.2.1.php";