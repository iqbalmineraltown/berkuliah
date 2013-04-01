<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=berkuliah_test',
				'emulatePrepare' => true,
				'username' => 'berkuliah',
				'password' => 'c3456',
				'charset' => 'utf8',
			),
		),
	)
);
