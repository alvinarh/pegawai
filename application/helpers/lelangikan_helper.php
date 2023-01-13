<?php
if (!function_exists('check_login')) {
	function check_login()
	{
		$ci = get_instance();
		if (!$ci->session->userdata('nama')) {
			redirect('User');
		}
	}
}
