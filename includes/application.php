<?php

  error_reporting(E_ALL);
  date_default_timezone_set('UTC');

  // consider moving this outside of the web space
  require 'includes/configure.php';

  if (!defined('DB_SERVER') || !defined('DB_DATABASE') || !defined('DB_USER') || !defined('DB_PASSWORD')) {
    die('Missing configuration');
  }

  try {
    $db = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_USER, DB_PASSWORD);
  } catch (PDOException $e) {
    error_log('Error!: ' . $e->getMessage());
    die('Could not connect to database');
  }
