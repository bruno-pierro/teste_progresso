<?php

function _open()
{
	global $_sess_db;

	if ($_sess_db = mysql_connect('localhost', 'root', '')) {
		return mysql_select_db('sessions', $_sess_db);
	}

	return FALSE;
}

function _close()
{
	global $_sess_db;

	return mysql_close($_sess_db);
}

?>