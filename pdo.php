<?php 
$dns ='mysql:host='.getenv("DB_HOST").';port=3306;dbname=ter_db;';
$pdo = new PDO ($dns,getenv("DB_USER"),getenv("DB_PASSWORD"),array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));