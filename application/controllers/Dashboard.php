<?php
	class Dashboard extends CI_Controller 
	{
		function index()
		{
			// $this->load->view('view_dashboard');
			check_session();
			$this->template->load('template','view_dashboard');
		}
	}
?>
