<?php

$config['uri_segment'] = 4;
// $choice = $config["total_rows"] / $config["per_page"];
// $config["num_links"] = floor($choice);
$config['num_links'] = 2;
$config['use_page_numbers'] = FALSE;

// style pagination
$config['full_tag_open'] = '<ul class="page-numbers">';
$config['full_tag_close'] = '</ul>';

$config['first_link'] = 'First';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '<i class="fa fa-angle-right"></i>';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="page-item"><span class="current">';
$config['cur_tag_close'] = '</span></li>';

$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';

$config['attributes'] = array('class' => 'page-link');