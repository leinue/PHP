<?php

namespace Cores\Databases;

interface IDatabase{

	function connect();
	function query($sql);
	function execute($sql);
	function close();

}
