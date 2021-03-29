-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2021 at 01:03 AM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `public404`
--

-- --------------------------------------------------------

--
-- Table structure for table `bregex`
--

CREATE TABLE `bregex` (
  `id` int NOT NULL,
  `page` varchar(255) NOT NULL,
  `regex` varchar(300) NOT NULL,
  `rpl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bregex`
--

INSERT INTO `bregex` (`id`, `page`, `regex`, `rpl`) VALUES
(10, 'global constraints', '/alert\\s*\\(/', '//alert('),
(11, 'global constraints', '/window\\s*\\.\\s*location/', '//window.location'),
(12, '#', '/alert\\s*\\(/', ''),
(13, '#', '/window\\s*\\.\\s*location/', ''),

-- --------------------------------------------------------

--
-- Table structure for table `bstr`
--

CREATE TABLE `bstr` (
  `id` int NOT NULL,
  `page` varchar(255) NOT NULL,
  `str` text NOT NULL,
  `rpl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `btag`
--

CREATE TABLE `btag` (
  `id` int NOT NULL,
  `page` varchar(255) NOT NULL,
  `tag` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `btag`
--

INSERT INTO `btag` (`id`, `page`, `tag`) VALUES
(1, 'global constraints', '<!--...--><!DOCTYPE> <a><abbr><address><area><article><aside><audio><b><base><bdi><bdo><blockquote><body><br><button><canvas><caption><circle><cite><code><col><colgroup><command><data><datagrid><datalist><dd><del><details><dfn><div><dl><dt><em><embed><eventsource><fieldset><figcaption><figure><footer><form><h1><h2><h3><h4><h5><h6><head><header><hgroup><hr><html><i><iframe><img><input><ins><kbd><keygen><label><legend><li><mark><map><menu><meta><meter><nav><noscript><object><ol><optgroup><option><output><p><param><pre><progress><q><ruby><rp><rt><s><samp><script><section><select><small><source><span><strong><style><sub><summary><sup><svg><table><tbody><td><textarea><tfoot><th><thead><time><title><tr><track><u><ul><var><video><wbr>'),
(4, 'test', '<!--...-->\n<!DOCTYPE> \n<a>\n<abbr>\n<address>\n<area>\n<article>\n<aside>\n<audio>\n<b>\n<base>\n<bdi>\n<bdo>\n<blockquote>\n<body>\n<br>\n<button>\n<canvas>\n<caption>\n<circle>\n<cite>\n<code>\n<col>\n<colgroup>\n<command>\n<data>\n<datagrid>\n<datalist>\n<dd>\n<del>\n<details>\n<dfn>\n<div>\n<dl>\n<dt>\n<em>\n<embed>\n<eventsource>\n<fieldset>\n<figcaption>\n<figure>\n<footer>\n<form>\n<h1>\n<h2>\n<h3>\n<h4>\n<h5>\n<h6>\n<head>\n<header>\n<hgroup>\n<hr>\n<html>\n<i>\n<iframe>\n<img>\n<input>\n<ins>\n<kbd>\n<keygen>\n<label>\n<legend>\n<li>\n<link>\n<mark>\n<map>\n<menu>\n<meta>\n<meter>\n<nav>\n<noscript>\n<object>\n<ol>\n<optgroup>\n<option>\n<output>\n<p>\n<param>\n<pre>\n<progress>\n<q>\n<ruby>\n<rp>\n<rt>\n<s>\n<samp>\n<script>\n<section>\n<select>\n<small>\n<source>\n<span>\n<strong>\n<style>\n<sub>\n<summary>\n<sup>\n<svg>\n<table>\n<tbody>\n<td>\n<textarea>\n<tfoot>\n<th>\n<thead>\n<time>\n<title>\n<tr>\n<track>\n<u>\n<ul>\n<var>\n<video>\n<wbr>'),
(41, '', '<!--...--><!DOCTYPE> <a><abbr><address><area><article><aside><audio><b><base><bdi><bdo><blockquote><body><br><button><canvas><caption><circle><cite><code><col><colgroup><command><data><datagrid><datalist><dd><del><details><dfn><div><dl><dt><em><embed><eventsource><fieldset><figcaption><figure><footer><form><h1><h2><h3><h4><h5><h6><head><header><hgroup><hr><html><i><iframe><img><input><ins><kbd><keygen><label><legend><li><link><mark><map><menu><meta><meter><nav><noscript><object><ol><optgroup><option><output><p><param><pre><progress><q><ruby><rp><rt><s><samp><script><section><select><small><source><span><strong><style><sub><summary><sup><svg><table><tbody><td><textarea><tfoot><th><thead><time><title><tr><track><u><ul><var><video><wbr>'),
(53, 'cats', '<!--...-->\n<!DOCTYPE> \n<a>\n<abbr>\n<address>\n<area>\n<article>\n<aside>\n<audio>\n<b>\n<base>\n<bdi>\n<bdo>\n<blockquote>\n<body>\n<br>\n<button>\n<canvas>\n<caption>\n<circle>\n<cite>\n<code>\n<col>\n<colgroup>\n<command>\n<data>\n<datagrid>\n<datalist>\n<dd>\n<del>\n<details>\n<dfn>\n<div>\n<dl>\n<dt>\n<em>\n<embed>\n<eventsource>\n<fieldset>\n<figcaption>\n<figure>\n<footer>\n<form>\n<h1>\n<h2>\n<h3>\n<h4>\n<h5>\n<h6>\n<head>\n<header>\n<hgroup>\n<hr>\n<html>\n<i>\n<iframe>\n<img>\n<input>\n<ins>\n<kbd>\n<keygen>\n<label>\n<legend>\n<li>\n<link>\n<mark>\n<map>\n<menu>\n<meta>\n<meter>\n<nav>\n<noscript>\n<object>\n<ol>\n<optgroup>\n<option>\n<output>\n<p>\n<param>\n<pre>\n<progress>\n<q>\n<ruby>\n<rp>\n<rt>\n<s>\n<samp>\n<script>\n<section>\n<select>\n<small>\n<source>\n<span>\n<strong>\n<style>\n<sub>\n<summary>\n<sup>\n<svg>\n<table>\n<tbody>\n<td>\n<textarea>\n<tfoot>\n<th>\n<thead>\n<time>\n<title>\n<tr>\n<track>\n<u>\n<ul>\n<var>\n<video>\n<wbr>'),
(55, 'about', '<!--...-->\n<!DOCTYPE> \n<a>\n<abbr>\n<address>\n<area>\n<article>\n<aside>\n<audio>\n<b>\n<base>\n<bdi>\n<bdo>\n<blockquote>\n<body>\n<br>\n<button>\n<canvas>\n<caption>\n<circle>\n<cite>\n<code>\n<col>\n<colgroup>\n<command>\n<data>\n<datagrid>\n<datalist>\n<dd>\n<del>\n<details>\n<dfn>\n<div>\n<dl>\n<dt>\n<em>\n<embed>\n<eventsource>\n<fieldset>\n<figcaption>\n<figure>\n<footer>\n<form>\n<h1>\n<h2>\n<h3>\n<h4>\n<h5>\n<h6>\n<head>\n<header>\n<hgroup>\n<hr>\n<html>\n<i>\n<iframe>\n<img>\n<input>\n<ins>\n<kbd>\n<keygen>\n<label>\n<legend>\n<li>\n<link>\n<mark>\n<map>\n<menu>\n<meta>\n<meter>\n<nav>\n<noscript>\n<object>\n<ol>\n<optgroup>\n<option>\n<output>\n<p>\n<param>\n<pre>\n<progress>\n<q>\n<ruby>\n<rp>\n<rt>\n<s>\n<samp>\n<script>\n<section>\n<select>\n<small>\n<source>\n<span>\n<strong>\n<style>\n<sub>\n<summary>\n<sup>\n<svg>\n<table>\n<tbody>\n<td>\n<textarea>\n<tfoot>\n<th>\n<thead>\n<time>\n<title>\n<tr>\n<track>\n<u>\n<ul>\n<var>\n<video>\n<wbr>'),
(58, 'about/mod', '<!--...-->\n<!DOCTYPE> \n<a>\n<abbr>\n<address>\n<area>\n<article>\n<aside>\n<audio>\n<b>\n<base>\n<bdi>\n<bdo>\n<blockquote>\n<body>\n<br>\n<button>\n<canvas>\n<caption>\n<circle>\n<cite>\n<code>\n<col>\n<colgroup>\n<command>\n<data>\n<datagrid>\n<datalist>\n<dd>\n<del>\n<details>\n<dfn>\n<div>\n<dl>\n<dt>\n<em>\n<embed>\n<eventsource>\n<fieldset>\n<figcaption>\n<figure>\n<footer>\n<form>\n<h1>\n<h2>\n<h3>\n<h4>\n<h5>\n<h6>\n<head>\n<header>\n<hgroup>\n<hr>\n<html>\n<i>\n<iframe>\n<img>\n<input>\n<ins>\n<kbd>\n<keygen>\n<label>\n<legend>\n<li>\n<link>\n<mark>\n<map>\n<menu>\n<meta>\n<meter>\n<nav>\n<noscript>\n<object>\n<ol>\n<optgroup>\n<option>\n<output>\n<p>\n<param>\n<pre>\n<progress>\n<q>\n<ruby>\n<rp>\n<rt>\n<s>\n<samp>\n<script>\n<section>\n<select>\n<small>\n<source>\n<span>\n<strong>\n<style>\n<sub>\n<summary>\n<sup>\n<svg>\n<table>\n<tbody>\n<td>\n<textarea>\n<tfoot>\n<th>\n<thead>\n<time>\n<title>\n<tr>\n<track>\n<u>\n<ul>\n<var>\n<video>\n<wbr>'),
(60, 'images', '<!--...-->\n<!DOCTYPE> \n<a>\n<abbr>\n<address>\n<area>\n<article>\n<aside>\n<audio>\n<b>\n<base>\n<bdi>\n<bdo>\n<blockquote>\n<body>\n<br>\n<button>\n<canvas>\n<caption>\n<circle>\n<cite>\n<code>\n<col>\n<colgroup>\n<command>\n<data>\n<datagrid>\n<datalist>\n<dd>\n<del>\n<details>\n<dfn>\n<div>\n<dl>\n<dt>\n<em>\n<embed>\n<eventsource>\n<fieldset>\n<figcaption>\n<figure>\n<footer>\n<form>\n<h1>\n<h2>\n<h3>\n<h4>\n<h5>\n<h6>\n<head>\n<header>\n<hgroup>\n<hr>\n<html>\n<i>\n<iframe>\n<img>\n<input>\n<ins>\n<kbd>\n<keygen>\n<label>\n<legend>\n<li>\n<link>\n<mark>\n<map>\n<menu>\n<meta>\n<meter>\n<nav>\n<noscript>\n<object>\n<ol>\n<optgroup>\n<option>\n<output>\n<p>\n<param>\n<pre>\n<progress>\n<q>\n<ruby>\n<rp>\n<rt>\n<s>\n<samp>\n<script>\n<section>\n<select>\n<small>\n<source>\n<span>\n<strong>\n<style>\n<sub>\n<summary>\n<sup>\n<svg>\n<table>\n<tbody>\n<td>\n<textarea>\n<tfoot>\n<th>\n<thead>\n<time>\n<title>\n<tr>\n<track>\n<u>\n<ul>\n<var>\n<video>\n<wbr>'),
(85, 'donate', '<!--...-->\n<!DOCTYPE> \n<a>\n<abbr>\n<address>\n<area>\n<article>\n<aside>\n<audio>\n<b>\n<base>\n<bdi>\n<bdo>\n<blockquote>\n<body>\n<br>\n<button>\n<canvas>\n<caption>\n<circle>\n<cite>\n<code>\n<col>\n<colgroup>\n<command>\n<data>\n<datagrid>\n<datalist>\n<dd>\n<del>\n<details>\n<dfn>\n<div>\n<dl>\n<dt>\n<em>\n<embed>\n<eventsource>\n<fieldset>\n<figcaption>\n<figure>\n<footer>\n<form>\n<h1>\n<h2>\n<h3>\n<h4>\n<h5>\n<h6>\n<head>\n<header>\n<hgroup>\n<hr>\n<html>\n<i>\n<iframe>\n<img>\n<input>\n<ins>\n<kbd>\n<keygen>\n<label>\n<legend>\n<li>\n<link>\n<mark>\n<map>\n<menu>\n<meta>\n<meter>\n<nav>\n<noscript>\n<object>\n<ol>\n<optgroup>\n<option>\n<output>\n<p>\n<param>\n<pre>\n<progress>\n<q>\n<ruby>\n<rp>\n<rt>\n<s>\n<samp>\n<script>\n<section>\n<select>\n<small>\n<source>\n<span>\n<strong>\n<style>\n<sub>\n<summary>\n<sup>\n<svg>\n<table>\n<tbody>\n<td>\n<textarea>\n<tfoot>\n<th>\n<thead>\n<time>\n<title>\n<tr>\n<track>\n<u>\n<ul>\n<var>\n<video>\n<wbr>')

-- --------------------------------------------------------

--
-- Table structure for table `freeze`
--

CREATE TABLE `freeze` (
  `id` int NOT NULL,
  `page` varchar(255) NOT NULL,
  `state` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freeze`
--

INSERT INTO `freeze` (`id`, `page`, `state`) VALUES
(1, 'about', 1),
(2, 'ben', 1),
(3, 'cats', 0),
(4, 'about/mod', 1),
(5, 'images', 1),
(6, 'donate', 1),
(7, 'not set', 0);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int NOT NULL,
  `page` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `page`) VALUES
(1, '#');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int NOT NULL,
  `sendto` varchar(16) NOT NULL,
  `sentfrom` varchar(16) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `invite` tinyint NOT NULL,
  `unread` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `sendto`, `sentfrom`, `subject`, `message`, `invite`, `unread`) VALUES
(1, 'elduderino', 'wetbadger', 'Welcome', 'Welcome to the website!', 0, 7),
(2, 'juan', 'admin', '', 'Welcome, Juan', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `mods`
--

CREATE TABLE `mods` (
  `id` int NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(50) NOT NULL,
  `page1` varchar(255) NOT NULL,
  `page2` varchar(255) NOT NULL,
  `page3` varchar(255) NOT NULL,
  `level` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mods`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `loc` int NOT NULL,
  `uid` int NOT NULL,
  `page` varchar(255) NOT NULL,
  `post` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vote` tinyint NOT NULL,
  `authorization` tinyint(1) NOT NULL,
  `views` bigint NOT NULL DEFAULT '0',
  `ipv4` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `loc`, `uid`, `page`, `post`, `vote`, `authorization`, `views`, `ipv4`) VALUES
(82, 1, 0, 'cats', '<h1>This page is about cats.</h1>', 0, 7, 0, '73.173.248.255')

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bregex`
--
ALTER TABLE `bregex`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bstr`
--
ALTER TABLE `bstr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `btag`
--
ALTER TABLE `btag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freeze`
--
ALTER TABLE `freeze`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mods`
--
ALTER TABLE `mods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bregex`
--
ALTER TABLE `bregex`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bstr`
--
ALTER TABLE `bstr`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `btag`
--
ALTER TABLE `btag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `freeze`
--
ALTER TABLE `freeze`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mods`
--
ALTER TABLE `mods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
