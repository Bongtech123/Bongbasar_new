-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2020 at 06:40 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doshor`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `about_id` int(11) NOT NULL,
  `about_contact` varchar(255) NOT NULL,
  `about_email` varchar(255) NOT NULL,
  `about_details` longtext NOT NULL,
  `about_address` varchar(255) NOT NULL,
  `about_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`about_id`, `about_contact`, `about_email`, `about_details`, `about_address`, `about_status`) VALUES
(2, '7044189253', 'crossedarrows20@gmail.com', 'Crossed Arrows is one of the most independent-minded and prestigious literary publishers in Kolkata. The company publishes both literary fiction and upmarket non-fiction, and provides authors with the intimacy of a small, passionate and creative team while consistently punching above its weight in review coverage and cultural impact.', 'C/2 Ramkrishna Upanibesh, Regent Estate, Kolkata-700092', 0),
(3, '7044189253', 'doshor.publication@gmail.com', 'Doshor Publications is one of the most independent-minded and prestigious literary publishers in Kolkata. The company publishes both literary fiction and upmarket non-fiction, and provides authors with the intimacy of a small, passionate and creative team while consistently punching above its weight in review coverage and cultural impact.', 'C/2 Ramkrishna Upanibesh, Regent Estate, Kolkata-700092', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` int(11) NOT NULL,
  `admin_mail` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `admin_mail`, `admin_password`) VALUES
(1, 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `admin_logo`
--

CREATE TABLE `admin_logo` (
  `logo_id` int(11) NOT NULL,
  `logo_name` varchar(255) NOT NULL,
  `logo_image` varchar(255) NOT NULL,
  `logo_for` varchar(255) NOT NULL,
  `logo_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_logo`
--

INSERT INTO `admin_logo` (`logo_id`, `logo_name`, `logo_image`, `logo_for`, `logo_status`) VALUES
(1, 'doshor', 'Logo_Final12.png', 'doshor', 0),
(2, 'crossArrow', 'CROSSED_ARROWS_PNG_LOGO1.png', 'cross_arrow', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_stock`
--

CREATE TABLE `admin_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_link` varchar(255) NOT NULL,
  `stock_file` varchar(255) NOT NULL,
  `stock_status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_stock`
--

INSERT INTO `admin_stock` (`stock_id`, `stock_link`, `stock_file`, `stock_status`) VALUES
(4, 'https://www.doshor.com/User/stock', '16_frames_final_(1).pdf', 0),
(2, '2020Crossed Arrows Catalougue', 'Catalouge_Back1.pdf', 0),
(3, 'Stocklist', 'Catalouge_Back2.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `banner_heading` varchar(255) NOT NULL,
  `banner_description` longtext NOT NULL,
  `banner_for` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `banner_image`, `banner_heading`, `banner_description`, `banner_for`, `status`) VALUES
(1, 'Banner6.jpg', 'https://www.doshor.com/', 'Read, Lead, Achieve', 'bengali', 0),
(4, 'Crossed_Banner.jpg', 'https://www.doshor.com/User/crossedarrows', 'Crossed Arrows', 'english', 0),
(10, 'Banner34.jpg', 'https://www.doshor.com/User/bookView/33', 'Nirbachito 30', 'bengali', 0),
(12, 'Banner12.jpg', 'https://www.doshor.com/User/bookView/14', '16 Frames', 'english', 0),
(13, 'Banner41.jpg', 'https://www.doshor.com/User/bookView/30', 'Stories of the Colonial Architecture', 'english', 0),
(14, 'Banner51.jpg', 'https://www.doshor.com/User/bookView/32', 'BOLLYWOOD CINEMA KALEIDOSCOPE', 'english', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_language` varchar(255) NOT NULL,
  `book_type_id` int(11) NOT NULL,
  `book_category_id` varchar(255) NOT NULL,
  `binding_types` varchar(255) NOT NULL,
  `book_price` varchar(255) NOT NULL,
  `book_offer` varchar(255) NOT NULL,
  `sles_price` varchar(255) NOT NULL,
  `delivery_price` varchar(255) NOT NULL,
  `book_stock_unit` varchar(255) NOT NULL,
  `book_alert_unit` varchar(255) NOT NULL,
  `book_author_id` int(11) NOT NULL,
  `book_publication_year` varchar(255) NOT NULL,
  `book_isbn` varchar(255) NOT NULL,
  `book_product_dimensions` varchar(255) NOT NULL,
  `book_description` longtext CHARACTER SET utf8 NOT NULL,
  `book_pages` varchar(255) NOT NULL,
  `book_ratting` varchar(255) NOT NULL,
  `book_read` longtext NOT NULL,
  `book_image_1` varchar(255) NOT NULL,
  `book_image_2` varchar(255) NOT NULL,
  `book_image_3` varchar(255) NOT NULL,
  `book_image_4` varchar(255) NOT NULL,
  `book_file` varchar(255) NOT NULL,
  `book_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `book_name`, `book_language`, `book_type_id`, `book_category_id`, `binding_types`, `book_price`, `book_offer`, `sles_price`, `delivery_price`, `book_stock_unit`, `book_alert_unit`, `book_author_id`, `book_publication_year`, `book_isbn`, `book_product_dimensions`, `book_description`, `book_pages`, `book_ratting`, `book_read`, `book_image_1`, `book_image_2`, `book_image_3`, `book_image_4`, `book_file`, `book_status`) VALUES
(11, 'Natyorabi ', 'bengali', 14, '23', 'Hard cover', '450', '', '360', '60', '50', '40', 3, '2020-02-01', '978-8194442929', '19x12x1.5', 'রবীন্দ্রনাথ ঠাকুরের পাঁচটি ছোটগল্প এবং একটি উপন্যাসের নাট্যরূপ ‘নাট্যরবি’। এখানে মূল কাহিনি এবং রবীন্দ্রদর্শনকে কেন্দ্রে রেখে নাট্যরূপ দেওয়া হয়েছে। পাশাপাশি গল্পগুলোর প্রেক্ষাপট অনুযায়ী কাহিনিতে নতুন চরিত্রের আগমন ঘটেছে। অনেক ক্ষেত্রে প্রেক্ষাপটের চরিত্রগুলোর বাস্তব নাম ব্যবহার করা হয়েছে। যেমন, ‘ছুটি’এবং ‘সমাপ্তি’গল্প নির্মিত হয়েছে সাহাজাদপুরের দুটি বিশেষ ঘটনার ছায়া অবলম্বনে, যা রবীন্দ্রনাথ ঠাকুর সেখানে দেখেছিলেন। তাই এর বিভিন্ন ঘটনা এবং চরিত্র বাস্তব অনুযায়ী লেখা হয়েছে। এ রকম সবগুলো নাটকেই কিছু কিছু বিষয় রয়েছে। এতে প্রকাশিত হয়েছে নাটকের নাটকীয়তা। স্বদেশী আন্দোলন, সামাজিক মূল্যবোধ, পারিবারিক চাহিদা, ব্যক্তিগত অনুভূতি, সাহিত্য-সংস্কৃতিভিত্তিক জীবনাচরণ ইত্যাদি বিষয় সম্পর্কে রবীন্দ্রদর্শন কেমন ছিলো তার প্রতিনিধিত্ব করছে এই নাটকগুলো।', '218', '3', '', 'Natyorabi2.jpg', '', '', '', '', 0),
(12, 'Space Part1', 'bengali', 13, '21', 'Paperback', '200', '', '160', '60', '50', '40', 1, '2019-02-01', '978-8193890226', '19x12x1.5', 'মহাজাগতিক বিষয়বস্তু নিয়ে আমাদের সকলেরই সমান আগ্রহ। এই বিশ্বব্রহ্মান্ডে প্রতিনিয়ত ঘটে চলেছে নানান ঘাত-প্রতিঘাত। ধ্বংসের মধ্য দিয়েই নতুন সৃষ্টি আকার ধারণ করছে। কিন্তু বিজ্ঞানের কঠিন ভাষায়, গাণিতিক পদ্ধতিতে এই মহাকাশ সম্পর্কে জানা সাধারণ মানুষের আয়ত্তের বাইরে। সেখান থেকেই ডঃ সমীরকুমার মুখোপাধ্যায়ের SPACE বইটি অনন্য। এখানে অতি সহজ ভাষায় মহাকাশ বিজ্ঞানের বিভিন্ন গূঢ়তত্ত্ব, মহাকাশ অভিযান, নভশ্চরদের অবদান আলোচনা করা হয়েছে। যা সববয়সী মানুষদের জন্য ভীষণভাবে প্রযোজ্য।', '120', '', '', 'SPACE1.jpg', 'Nirbachito14.jpg', '', '', '', 0),
(13, 'Bandar Cossimbazar', 'bengali', 12, '16', 'Hard cover', '450', '', '360', '60', '50', '40', 4, '2019-01-02', '978-8193890288', '19 x 13 x 2.5 cm', 'বন্দর কাশিমবাজারের উত্থানপতনের কাহিনি এক বিয়োগান্ত রূপকথা। ১৬৩০ খ্রিস্টাব্দের পর তার উত্থান আর ১৮১৩ খ্রীস্টাব্দে তার পতন। গঙ্গা নদীর ধারার সঙ্গে জড়িত কাশিমবাজারের ভাগ্য, বিদেশি বাণিজ্যের সঙ্গে তার উন্নতি আর রেশমশিল্পের অবসানের সঙ্গে তার অপমৃত্যু। দিল্লি থেকে পাটনা ও রাজমহল হয়ে হুগলি আসার নদীপথে কাশিমবাজারের অবস্থিতি। সপ্তদশ শতাব্দীতে বিভিন্ন স্থান থেকে ব্যবসায়ীরা এখানে সমবেত হলেন। গুজরাটি বণিককুল, মাড়োয়ারি মহাজন নিজেদের বাসা বাঁধলেন। বিদেশি বণিকগণ কাশিমবাজারে ঘাঁটি গড়তে দেরি করলেন না। নদীর পারে শ্রেষ্ঠ জায়গাটি দখল করলেন ফরাসি বণিকগণ। কিছুদিনের মধ্যেই এই অঞ্চল ফরাসডাঙা রূপে খ্যাত হল। তারপর ওলন্দাজ বণিককুল কালিকাপুরে ছাউনি পত্তন করলেন। আর ইংরেজরা এলেন সবার শেষে।', '312', '5', '', 'Bandor_Cossimbazar.jpg', '', '', '', '', 0),
(14, '16 Frames', 'english', 24, '31', 'Hard cover', '350', '199', '280', '60', '50', '40', 5, '2020-02-02', '978-8194442905', '19x12x1.5', 'A brief introduction 16 FRAMES is a collection of 16 chapters on cinema not bound to any particular topic. The chapters are of varying lengths since all of them were already published articles in newspapers and magazines. Written over nearly two decades the articles raise curiosity of the reader and also fascinate him by the originality of the subjects dealt with. Though diverse in topics the articles are a critical insight to cinema. ', '152', '3', '<h3>16 FRAMES</h3>\r\n\r\n<h3>Memories of Afterimage</h3>\r\n\r\n<h3>Amitava Nag</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>First Published</h3>\r\n\r\n<h3>January 2020</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>Copyright &copy; Amitava Nag, 2020</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>Amitava Nag has asserted his right under the Indian Copyright Act to be identified as Author of this work</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>All rights reserved. No part of this publication may be reproduced, distributed, or transmitted in any form or by any means, electronic or mechanical, including photocopying, recording, or any storage or retrieval system, without prior permission in writing from the publisher</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>Publisher</h3>\r\n\r\n<h3>Crossed Arrows (An imprint of Doshor Publication), C/2 Ramkrishna Upanibesh, Regent Estate,</h3>\r\n\r\n<h3>Jadavpur, Kolkata 700092</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>ISBN: &nbsp;978-81-944429-0-5</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>Typeset by Debashish Roy Choudhury</h3>\r\n\r\n<h3>Printed and bound in India by S.P. Communications, Kolkata</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3><strong>Dedication</strong></h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&quot;To my ever-understanding father and oft-inquisitive son -</h3>\r\n\r\n<h3>for their patience, and belief in me,</h3>\r\n\r\n<h3>for helping me to fiercely protect my trust in human imagination, and its power to move images.&quot;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3><strong>Acknowledgement</strong></h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>In any collection of film essays, one of the biggest challenges has always been the procurement of film stills to accompany the articles.&nbsp; Will all articles carry stills with them? How many stills is sufficient for each article? Questions are more and in the end the decisions end up being dissatisfactory most of the times. In a book like this of sixteen essays with more than a double of that number of films being discussed, the task was arduous. Yet, I must say I am quite lucky. I have been extended help by all concerned and generously.</h3>\r\n\r\n<h3>I take this opportunity to thank Kunal Sen, son of filmmaker Mrinal Sen, for promptly sharing a few pics from his illustrious father&rsquo;s personal collections. I thank Moinak Biswas, film scholar, professor, filmmaker and a long-time friend not only for providing me with the stills of his film <em>Sthaniya Sambad</em> but for being a support to <em>Silhouette</em>, the film magazine I have been editing since 2001. For the last two decades Moinak-da lends his help and advice every time I approached him with my requests. I am indebted to Nandita Das, actress and filmmaker, Manas Mukul Das and Rima Das, both filmmakers for their help and support. My thanks to the late photographer Sukumar Roy for quite a few stills he kindly shared with me for the purpose of using them in the books I have written and will be writing. I am hugely indebted, as almost always, to Shoma A Chatterji for providing me with stills from her personal collection for several films. She had also been a steadfast support of my writings over the years and kindly agreed to write a foreword for this book.</h3>\r\n\r\n<h3>Many of these articles over a period of time evolved with me, my viewpoints of life, society and politics. My biggest source of intellectual sustenance has always been my interactions with only a handful, but important friends. Shiladitya Sarkar, painter and writer has been the sharpest critical whip and an equally resourceful spring of light and life. My friends at Silhouette Film Society helped me evolve in my halcyon days of youth, they instilled in me a belief that I may try writing on cinema as well.</h3>\r\n\r\n<h3>I am indebted to Sayani Dutta Mitra and Manan Dutta of Doshor Publications for giving my articles a home. Their youthful exuberance and endeavour is worth appreciating. My gratitude to them and my wishes for a bright and a fulfilling future.</h3>\r\n\r\n<h3>At home, for the last two decades, my wife Sudeshna enabled me to engage in writing on cinema by taking care of the small nuances of daily routine. A friend since my university days, I cannot enough, and hence should not try thanking her. That I can still go on writing and discussing cinema and other arts is due to her and my octogenarian father&rsquo;s silent support.</h3>\r\n\r\n<h3>I also thank all who have wished these articles well over the years and will stand by this collection.</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3><strong>FOREWORD</strong></h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>Amitava Nag is quite a close friend and has been one over a decade though in terms of chronological age, we are distanced by a generation at least. He is as young as my son &ndash; if I had had one &ndash; and proves that friendship is not limited by age, culture, class or anything else. It is the passion for cinema and writing on it that forms the foundation of this bonding and continues to enrich both our love for cinema.</h3>\r\n\r\n<h3>He is so well-versed in world cinema spanning a considerable space of time and geography and culture, that to write a foreword to his book is perhaps, embarrassing for one who is not well-versed in international cinema beyond a limited point. So, one accepts the process of writing a foreword more as a learning experience than as a critiquing foreword. Amitava&rsquo;s greatest contribution to writing on cinema is the journal he founded, Silhouette first in print and then as a digital version. The issues combined or taken separately, can easily offer a rich frame of reference to film studies researchers now and in the future. But that is another story.</h3>\r\n\r\n<h3>I am serious when I say that reading the typescript slowly has indeed been a learning experience for me. His perspective is unique and individualistic, dotted with the expertise he has gathered mainly from his vast experience as an avid cinema-watcher than as an academic scholar. And this is certainly not his first book on cinema.</h3>\r\n\r\n<h3>16 FRAMES is an apt title which he explains in his introduction. He traces his evolution into a lover of cinema and how it changed his outlook on life and lifestyle, ideology and content in different ways.&nbsp; 16 FRAMES also justifies the inclusion of 16 chapters in the book on subjects as varied and as all-encompassing as cinema itself that knows no boundaries.</h3>\r\n\r\n<h3>The chapters are short because they have followed the general space newspapers and magazines permit to freelancers and all these have appeared in different newspapers and magazines. But let not the brevity of the chapters fool the reader in any way. They raise the curiosity of the reader and also fascinate him by the originality of the subject dealt with.</h3>\r\n\r\n<h3>Some examples may prove the point. <em>I&rsquo;s Eyes: Exploring Use of Eyes in a few Films of the Kolkata International Film Festival 2016 </em>throws up a completely new perspective on how &lsquo;eyes&rsquo; have been used in different films by the respective filmmakers across time and space. He fortifies his reading with examples of films he has seen such as Kim Ki Duk&rsquo;s <em>Net</em> and Kristina Grozeva-Petar Valchanov&rsquo;s <em>Glory </em>and Luis Bunuel&rsquo;s<em> Un Chien Andalou.</em> from the international cinema map.</h3>\r\n\r\n<h3>The short but crisp and detailed essays are marked by his uniquely distinct perspective and are often sectioned off with separate headings that shed light on the multi-layered aspects of each essay flush with examples of films that exemplify his argument. For example, the first essay, <em>Of Father, Brothers and an Unholy Hunger &ndash; Looking at Kaaka Muttai and Sahaj Pather Gappo</em> is sectioned off by several headings such as - <em>The absent father</em>, <em>The free egg, Train &ndash; the aggressor and the provider</em> and <em>An unholy hunger </em>that finally zeroes the focus on just two recent films - <em>Kaaka Muttai</em> and <em>Sahaj Pather Gappo.</em></h3>\r\n\r\n<h3>I loved the analysis of two recent versions of Sarat Chandra Chatterjee&rsquo;s classic <em>Devdas</em> &ndash; one by Sanjay Leela Bhansali and the other by Anurag Kashyap. The metamorphosis of the original Devdas from a tragic, triangular but purely platonic love story to one with strong sexual overtones offers a rare insight into the way he reads into mainstream films.</h3>\r\n\r\n<h3>There are a few relatively abstract essays such as <em>An Indian Film Theory </em>and <em>The Colour of Aesthetics</em> that are backed by in-depth research and demand repeated reading. The second one gives one to think where he argues against the colourization of film classics like Ray&rsquo;s <em>Pather Panchali</em> and manages to convert his readers to his point of view in case they thought otherwise.</h3>\r\n\r\n<h3><em>Between spirit and bleakness &ndash; Village Rockstars and Manto</em> offers a deep insight into two different women filmmakers &ndash; though the author does not treat them as &ldquo;women&rdquo; filmmakers &ndash; makes for a very interesting and insightful read indeed through its comparison and contrasting of the subject of the two films, the treatment they have been given and the contextual backdrop of the two directors one of who has handled every department of film making alone and yet won both notice and international awards.</h3>\r\n\r\n<h3>And so the book reads on, like a river, sometimes placid, sometimes turbulent, flowing through the reader&rsquo;s mind, through the films one has certainly watched and films one has never seen and is never likely to see, through the vicarious but rich experience of reading about them in a different vein and a different context. Did I say this is certainly not Amitava&rsquo;s first book on cinema? I can flesh out that by adding &ndash; this is certainly not his last&hellip;&hellip;.</h3>\r\n\r\n<h3>Dr. Shoma A. Chatterji</h3>\r\n\r\n<h3>Kolkata</h3>\r\n\r\n<h3>Wednesday, 23 October 2019</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3><strong>&nbsp;Contents</strong></h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3><em>Introduction&nbsp;&nbsp; </em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>From &lsquo;Calcutta&rsquo; to &lsquo;Kolkata&rsquo;: The Journey of Bengali Cinema &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>The Marwaris in Satyajit Ray&rsquo;s Films: &lsquo;Outsiders&rsquo; in Bengali Psyche&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>Ahead of Its Time: Rape of the Bengali Middle Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>The Bengali Mother: Through Filmic Lenses&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>An Ode to the Cigarette in Indian Cinema &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>Crossing Borders with Cinema&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</h3>\r\n\r\n<h3>From Devdas to Dev &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>Iago versus Langda: Interpretation of the Shakespearean Villain&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3><em>Bistar Badal Jaate Hain &hellip; Par Aadmi Nahin Badalte</em>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The &lsquo;Heroine&rsquo; from <em>Bhumika</em> to <em>Iti Mrinalini&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</em>The &lsquo;Choice&rsquo; of the Filmic Woman&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>Chaturanga: The Complex Tapestry&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>The Colour of Aesthetics&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>I&rsquo;s Eyes: Exploring Use of Eyes in a Few Films of the</h3>\r\n\r\n<h3>Kolkata International Film Festival 2016&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>Of Father, Brothers and an Unholy Hunger:</h3>\r\n\r\n<h3>Looking at <em>Kaaka Muttai</em> and <em>Sahaj Pather Gappo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</em></h3>\r\n\r\n<h3>Between Spirit and Bleakness: <em>Village Rockstars</em> and <em>Manto</em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>An Indian Film Theory?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3><a name=\"_Toc4071423\"><strong>Introduction</strong></a></h3>\r\n\r\n<h3>Writing on cinema had never been my first choice as a profession. Being a graduate in Physics with a post-graduation in Computer Studies, I was safely and surely sailing to a cushioned software job at the turn of the millennium. I joined,India&rsquo;s topmost IT giant, eventually, after university and, subsequently, moved to one of world&rsquo;s best as well. However, in between writing codes, managing projects and architecting large data warehouses, I did write. Being born in Calcutta (it wasn&rsquo;t Kolkata yet) in the early 1970s in an academic family had its pitfalls. We were a serious bunch of people, honestly. We didn&rsquo;t have television at home till the late 1980s and cinema, due to lack of availability and my parents&rsquo; energies, were infrequent, almost meagre. We were encouraged to gorge on books and so did we. Much later, when I wrote vociferously about how cinema should untie its link with cinema, I found it intriguing as it was literature that paved my walkway to cinema.</h3>\r\n\r\n<h3>&nbsp;&nbsp; Now, I don&#39;t remember how and when I got interested to cinema seriously. Reading Bibhuti Bibhutibhushan Bandyopadhyay&#39;s epic <em>Pather Panchali</em> during a vacation at my grandmother&rsquo;s place is the turning point for me. All that I can recollect now is that I was hitting adolescence at that time. The love for literature soared and watching Satyajit Ray&rsquo;s first film at Nandan, the cinema centre in Calcutta , shortly after reading the novel sealed it for me. My parents must have noticed my liking for the moving images from my writing on cinema in our handwritten family magazine. I guess they did as , I was presented with Andrew Robinson&rsquo;s superbly crafted <em>The Inner Eye</em> on Satyajit Ray on the occasion of my fifteenth birthday. My love for Ray and for cinema grew hand in hand since then.</h3>\r\n\r\n<h3>&nbsp;&nbsp; It was in the summer of 2001, after I came back to Kolkata, that a group of eventless youth including me clubbed together in the placid afternoons of leisurely Saturdays. Most of us met individually during the Kolkata Film Festival the preceding years and finally in 2001, the Silhouette Film Society was born. In those weekly meets, &nbsp;we discussed cinema, argued with our individual points of view, fought vociferously and loved the conundrum. Members joined and lost, to corporate bandwagons and to film schools; yet, the Silhouette Film Society sailed through with private film shows and an enviable magazine&mdash;<em>Silhouette</em>. Over time, the print edition made way for a web magazine. As the scope of the magazine expanded, members became busy, film shows were fewer. It was for <em>Silhouette</em> that I first took to writing on cinema seriously, on &lsquo;serious&rsquo; cinema if we understand what it means!</h3>\r\n\r\n<h3>&nbsp;&nbsp; Since then, for the last two decades, I have been writing on cinema regularly not only in <em>Silhouette</em> (now available at <a href=\"http://www.silhouette-magazine.com\" style=\"color:blue; text-decoration:underline\">www.silhouette-magazine.com</a>) but also in other outlets including <em>The Hindu,Outlook,The Statesman, </em><em>News18.com</em> and <em>The Wire </em>to name a few. In between, I penned three books on cinema till date&mdash;Reading <em>the Silhouettes, Beyond Apu: 20 Favourite film roles of Soumitra Chatterjee</em> and <em>Satyajit Ray&rsquo;s Heroes and Heroines</em>. I have a couple of other books that are lying with publishers at different stages of production. It is at this juncture that I realised that many of my early writings and also the not-so-early ones which are being lost. No one to blame but me since I never paid much heed in curating them systematically. The need for this book is to compile some of them into a collection.</h3>\r\n\r\n<h3>&nbsp;&nbsp; Over the years, I have written numerous articles on cinema&mdash;film reviews being the maximum, review of books on cinema and interviews taken of film personalities. Parallelly,I have also written several critical articles on cinema &mdash; the different trends, intertextualising &nbsp;cinema with other art forms picking one or more films, so on and so forth. Of these, I have chosen sixteen articles for this collection, hence the name of the book.</h3>\r\n\r\n<h3>&nbsp;&nbsp; For amateur film-makers, 16 mm film (along with 8 mm) first came into being as a cheap alternative to the prevalent and professional 35 mm ones. I have no degree in film appreciation and yet I have written for two decades on cinema as an amateur and for love of the medium. My stance is probably similar to the amateur film-maker who took up the 16 mm film for his creative and analytical expression, almost a century back. From this aspect as well, I think the name of the book being <em>16 FRAMES</em> is apt and commemorative.</h3>\r\n\r\n<h3>&nbsp;&nbsp; The articles in this book are a selected collection of critical essays on cinema. I have deliberately refrained from having or trying to establish a thematic link between them. The articles are written over a span of several years in disparate journals and magazines with varying philosophies. My intention is to embrace the diversity in them and to invite readers to appreciate the same in their own ways.</h3>\r\n\r\n<h3>My indebtedness for the content of this book reaches out first to my &lsquo;Silhouette&rsquo; mates. My understanding of cinema cultivated in the formative years of this millennium &mdash;thanks to them. I would also wish to single out my friend of undergraduate days Partha Sarathi Raha, who shared the same dream as mine, of becoming a film-maker, when we dared.&nbsp; That I moved away from such an illusion to a different reality is a personal truth. However,through thick and thin, with several intense discussions and debates I had with him, for just being there as a mirror to reflect those thoughts, Partha ensured that I didn&rsquo;t drift away far from cinema. Thanking friends with whom you grew up from being lanky boys to pot-bellied men is almost criminal&mdash;I won&rsquo;t embarrass Partha, and in the process myself, by doing so.</h3>\r\n\r\n<h3>&nbsp;&nbsp; I would also thank Antara Nanda Mondal, Chief Editor, <em>Learning </em><em>and Creativity</em> magazine. Antara emerged almost from nowhere quite a few summers back when I was contemplating of moving <em>Silhouette</em> magazine online. She is a rock-solid support of <em>Silhouette</em> now, a consulting editor and one of the most trusted friends.</h3>\r\n\r\n<h3>When I was languishing my days in Pune in India&rsquo;s leading IT company, playing football for ninety minutes in the afternoons and thinking of a better next day, Anil Saari Arora implanted the belief in me that I can write on cinema. A kindred soul, Anil da was a poet, a film critic, a journalist and what not. It was he who introduced me to the enigmatic Dilip Chitre and almost forced me to write for <em>Maharashtra Herald</em>,which he edited for a brief period, and also for <em>New Quest</em> magazine,which Dilip da edited. All these happened even before the Silhouette Film Society was even conceived. On the other side of life when I will meet both of them, I know they will embrace me with the same affection and tolerance.</h3>\r\n\r\n<h3>&nbsp;&nbsp; These days, writing on cinema in the form of books is primarily on film personalities. This book is a far cry from that task. It is also not an academic book with references outwitting the written text. My hope with this book is that the reader will find it a light reading and yet probing deeper questions than the superficial interpretations. The success of the book can be judged in creating that sense of unease, and to dive and drive further into the aesthetics of cinema from an amateur film critic.</h3>\r\n', '16_Frames4.jpg', '16_Frames5.jpg', '', '', '16_frames1.pdf', 0),
(16, 'The Rise of Kleptocracy in India', 'english', 18, '28', 'Hard cover', '250', '99', '200', '60', '50', '40', 7, '2020-07-10', '978-8193954492', '19x12x1.5', '\"Just as it is impossible not to taste honey or poison that one may find at the tip of one\'s tongue, so it is impossible for one dealing with government funds not to take at least a bit of the King\'s wealth. Just as it is impossible to know when a fish moving in water is drinking it, so it is impossible to find out when government servants in charge of undertakings misappropriate money.\" --- Arthasastra, Kautilya. That trend is still going on.', '208', '4', '<div>\r\n<p>The rise of Kleptocracy in India</p>\r\n\r\n<p>Samirkumar Mukhopadhyay</p>\r\n\r\n<p>First Published : June, 2019</p>\r\n\r\n<p>&copy;</p>\r\n\r\n<p>Samirkumar Mukhopadhyay All rights reserved</p>\r\n\r\n<p>Publisher</p>\r\n\r\n<p>Doshor Publication</p>\r\n\r\n<p>This book is sold subject to the condition that it shall not by way of trade or otherwise, be lent, resold, hired out, circulated, and no reproduction in any form, in whole or in part (except for the brief quotations in critical articles or reviews) may be made without written permission of the publishers.</p>\r\n\r\n<p>ISBN-978-81-939544-9-2</p>\r\n\r\n<p>Rs. 250/-</p>\r\n</div>\r\n\r\n<div>\r\n<p>Dedicated in memory of</p>\r\n\r\n<p>Feroze Gandhi, An undaunted Fighter against Corruption</p>\r\n</div>\r\n\r\n<p>Foreword</p>\r\n\r\n<p>On the one hand rampant corruption among the higher leadership of the State of India and mute and submission of the people on the other are the two main contrasting realities prevailing in Indian democracy to-day. But neither the independence movement was participated by millions of people with thousands of freedom fighters becoming martyrs, nor the country&rsquo;s Constitution was framed to give birth to a top-to-bottom corrupt political system as it has come to stay to-day. What is most unfortunate is that Pt. Nehru, one of the leaders of the freedom movement and taking the leadership as the Prime Minister of the independent India, with his charismatic leadership qualities, as is usually claimed, could have at least proven his real &lsquo;political will&rsquo; not to allow the new born State to lose its direction of progress into the quicksand of corruption. But instead virtually he himself supported corruption when he unhesitatingly stood by his close &nbsp;friend</p>\r\n\r\n<div>\r\n<p>V. K. Krishna Menon in independent India&rsquo;s Jeep Scandal in 1948. This attitude of Nehru had its recurrence in Haridas Mundra&rsquo;s LIC scam in 1958 and that brought about a virtual rift between Nehru and his son-in-law Feroze Gandhi. This dawned a new morning in independent India in the sense that a dissenting voice dared to be echoed within the four walls of the Parliament in presence of Nehru with a towering personality. Had the initial message from a leader like Nehru been a firm one against any form of distortion including, of course, corruption, then things might not have been as ridiculous at such a high speed as India has emerged to be by now.</p>\r\n</div>\r\n\r\n<div>\r\n<p>Gradually the apparent &lsquo;democratic&rsquo; polity of India has developed itself as paradise for money- makers. Under the politico-legal umbrella offered by the political leadership the big business houses, the government officials, the police, the musclemen all have taken shelter as fortune- makers in terms of wealth accumulation and that too obviously going beyond the legal barricades and social ethos. What is alarming is that the political leaderships of almost all parties, barring left parties, do not think of taking disciplinary steps against such practices of the party members. Point is, however, who is to bell the cat since the top leaders like Mulayam Singh Yadav, Akhilesh Yadav, Mayabati, Jayalalithaa, Rajib Gandhi, Lalu Prasad Yadav, Mamata Banerjee, Karunanidhi and many more are themselves alleged to have been involved in different illegal money-making processes.</p>\r\n</div>\r\n\r\n<div>\r\n<p>One thing to be noted is that people for joining politics do not need any academic qualification, Ravri Devi being a case in point, no character certificate of keeping in tune with social ethos, no retirement age, no show cause at party levels against criminal or semi-criminal activities of any member, who so ever be, no compulsion of disclosing the sources of their asset-makings in a very short span or a long run of time. So where are we heading to? Only 2 days&rsquo; &lsquo;patriotic&rsquo; parades do not really leave any impact on the people at large to ignite sense of love for the country. Showing picture of fluttering of national flag associated with national anthem is a sheer mockery on the part of the decision-makers. By now the Indian population has been made to turn into a lump of flesh, thanks to the political leaderships of almost all parties. It pains those few Indians entertaining real love and feelings for the country and respect for martyrs and fighters of freedom struggle. The author of the book has tried to touch a few major peaks of corruption that have engulfed Indian democracy to turn it into what Aristotle called &lsquo;oligarchy&rsquo;. One thing must be admitted that though individual incidents have been taken into deliberation but they are in no way exceptions to the system, but integral parts institutional network of the corruption-ridden Indian democracy.</p>\r\n</div>\r\n\r\n<div>\r\n<p>Purpose of writing this book is to rouse awareness among the people as to representatives they elect are not worthy of running a healthy democratic polity. The masters of our political system mostly have offered crude indifference to the basic principles of the constitution which reads as follows.</p>\r\n\r\n<p>&ldquo;WE, THE PEOPLE OF INDIA, having solemnly resolved to constitute India into a SOVEREIGN SOCIALIST SECULAR DEMOCRATIC</p>\r\n\r\n<p>REPUBLIC and to secure to all its citizens :</p>\r\n\r\n<p>JUSTICE, social, economic and political;</p>\r\n\r\n<p>LIBERTY of thought, expression, belief, faith and worship;</p>\r\n\r\n<p>EQUALITY of status and of opportunity; and to promote among them all</p>\r\n\r\n<p>FRATERNITY assuring the dignity of the individual and the unity and integrity of the Nation;</p>\r\n\r\n<p>IN&nbsp; OUR&nbsp; CONSTITUENT ASSEMBLY this</p>\r\n\r\n<p>twenty-sixth&nbsp; day&nbsp;&nbsp; of&nbsp;&nbsp; November,&nbsp;&nbsp; 1949, do HEREBY ADOPT, ENACT AND GIVE TO OURSELVES THIS &nbsp;CONSTITUTION.&rdquo;</p>\r\n</div>\r\n\r\n<p>It would not be an audacity for the author if he dares say that every nook&nbsp; and&nbsp; nook&nbsp; and&nbsp; corner of the constitution has&nbsp; been&nbsp; recklessly&nbsp; ravaged&nbsp; by the larger section of the politicians.</p>\r\n\r\n<p>However, the present author is neither the first one nor is going to be the last one in dealing with the pernicious disease of corruption and criminality among the governors in the main leading to the debasement of the ethical and cultural foundation of the Indian political system. I convey my congratulations to &lsquo;Doshor&rsquo; the publisher for taking initiative in publishing the book. I also convey my best greetings for press men and all others giving their earnest labour for quality and timely publication of the book. I also thank all my well wishers who encouraged me for writing the book. I will be happy if the erudite readers convey their considered observations on reading the book to the publisher of the book.&nbsp;</p>\r\n\r\n<p>Samir Mukherjee</p>\r\n', 'kleptocracy1.jpg', 'kleptocracy2.jpg', '', '', 'KLEPTOCRACY.pdf', 0),
(17, 'Nirbachito 30', 'bengali', 23, '10', 'Hard cover', '400', '', '320', '60', '50', '40', 8, '2020-02-05', '978-8194186779', '19x13x2.5', 'বাংলা সাহিত্যে প্রায় বিস্মৃত জগতে বিচরণ করতে গিয়েই লেখাগুলির সূচনা। কবি সুভাষ মুখোপাধ্যায়, অরুণ মিত্র, শক্তি চট্টোপাধ্যায়, অন্নদাশঙ্কর রায়, শৈলজানন্দ মুখোপাধ্যায়, সরোজকুমার রায়চৌধুরী, অমূল্যধন মুখোপাধ্যায়কে চিনিয়ে দেওয়ার জন্য কলম ধরা। সম্পাদক রামানন্দ চট্টোপাধ্যায়,প্রাবন্ধিক রাজনারায়ণ বসু, শিশুসাহিত্যিক মনোরঞ্জন ভট্টাচার্য, কবি সুধীন্দ্রনাথ দত্ত,ঔপনাসিক শৈলবালা ঘোষজায়াকে কি মনে পড়ে? তারাই যেন এই গ্রন্থে নতুনভাবে উপস্থিত। বাংলা সাহিত্য ও সাহিত্যিকের মণিকোঠায় কত যে উজ্জ্বল নাম। সেখান থেকে বাছাই করা কবি-লেখকদের সৃষ্টির জগতে ঘুরে বেড়িয়েছেন লেখক অরুণ মুখোপাধ্যায়। তিনি কখনও বইমেলার চত্বরে, কখনও বা কলেজস্ট্রিট বইপাড়ার পুরোনো বই-এর দোকানে সুরম্য ভ্রমণ করেছেন। খুঁজেছেন দুষ্প্রাপ্য বই, হারিয়ে যাওয়া শব্দ এবং অবশ্যই হারিয়ে যাওয়া লেখকদের।', '238', '4', '', 'Nirbachito.jpg', 'Nirbachito1.jpg', '', '', '', 1),
(18, 'Samadhibitan', 'bengali', 17, '39', 'Hard cover', '150', '', '120', '60', '50', '40', 10, '2020-01-31', '978-8194186786', '19.1 x 13 x 1 cm', 'পিয়াসের কবিতার প্রতিটি শব্দে রয়েছে তীক্ষ্ণ বিশ্লেষণ। শব্দের সুর রয়েছে এক ছন্দে বাঁধা। প্রেম, বিরহ, ভালোবাসা, মৃত্যু- জীবনের প্রতিটি অনুভূতি এবং পর্যায়কে এই কাব্যগ্রন্থে নতুনভাবে তুলে ধরা হয়েছে। যা পাঠকের মস্তিস্কে সজোড়ে ধাক্কা দেবে। কবিতার ভাষা রক্তাক্ত করেছে পাঠকের হৃদয়। সামনে এনেছে রূঢ় বাস্তবতাকে।', '53', '3', '', 'Samadhibitan.jpg', 'Samadhibitan_1.jpg', '', '', '', 0),
(19, 'Bhuter Khoje', 'bengali', 13, '21', 'Paperback', '150', '', '120', '60', '50', '40', 9, '2019-02-18', ' 978-8193954416', '12 x 19 x 1 cm', 'ভূতের অস্তিত্ব কি সত্যিই আছে? .গভীর রাতের অন্ধকারে একা পথ চলতে আমাদের সকলেরই ভয় হয়। কারও মতে, এই ভয়-ই ভূত। ভূতের খোঁজে সংকলনে এমনই ন’টি গল্প উঠে এসেছে যেখানে লেখক ভূত নামক মিথকে গভীরভাবে পর্যবেক্ষণ করেছেন। অন্ধবিশ্বাসে বিশ্বাসী না হয়ে তলিয়ে দেখেছেন প্রকৃত ঘটনা। যা কখনও ভূত নামক বিশ্বাসকে টলিয়ে দেয়, আবার পরমুহূর্তে শব্দের মায়াজালে তৈরি করেন আরেক মিথ। ', '88', '2', '', 'Bhuter_Khoje.jpg', 'Bhuter_Khoje1.jpg', '', '', '', 0),
(20, 'Lalche Daag', 'bengali', 11, '10', 'Hard cover', '100', '', '80', '60', '50', '40', 9, '2018-02-03', '', '19.1 x 13 x 1 cm', '‘লালচে দাগ’ উপন্যাসটি শুধুমাত্র বিপ্লবের স্বপ্নে বিভোর মেধাবী ছাত্র স্বাধীনের নয়। না, ভালোবাসার মানুষটিকে কাছে পেতে বিপ্লবের ফলাফল বা সফলতা সম্পর্কে অবিশ্বাসী, ব্যর্থ, হতাশ, ভালোবাসার কাঙালিনী শেফালীর নিষ্ফল জীবনের। ১৯৬৯-এ নিজেদের জীবনকে বাজি রেখে নতুন দেশ গড়ার স্বপ্নে বিপ্লবে সামিল হয়েছিলেন হাজার হাজার মেধাবী তরুণ- তরুণী। তাঁদের এক জ্বলন্ত আখ্যান \" লালচে দাগ\"।', '96', '2', '', 'Lalche_Daag.jpg', 'Lalche_Daag1.jpg', '', '', '', 0),
(21, 'Kolikata Kalpolata', 'bengali', 12, '16', 'Hard cover', '225', '', '165', '60', '50', '40', 12, '2010-01-30', ' 978-8193890271', '18x12x1.5', '\'কলিকাতা নামের ব্যুৎপত্তি বিষয়ে বহুতর কল্পনা কল্পিত হইয়াছে। কোন মহাশয় লিখিয়াছেন যে, অনেক নগরের নাম দেবমণ্ডপাদির আখ্যা অনুসারে প্রতিষ্ঠিত হইয়া থাকে; অতএব বোধ হয় কলিকাতার অদূরবর্তী পীঠস্থান কালীঘাটের নামানুসারে ইহার নামকরণ হইয়া থাকিবে। অর্থাৎ কলিকাতার নাম, কালীঘাট অথবা কালীঘাঠার অপভ্রংশ মাত্র। আর এক রহস্যজনক জনশ্রুতি এই যে, ইংরাজেরা যখন প্রথমতঃ এই স্থানে বাণিজ্যালয় স্থাপনার্থ আগমন করিলেন, তখন গঙ্গাতীরে দণ্ডায়মান কোন লোককে অঙ্গুলী প্রসারণ পূর্বক স্থানের নাম জিজ্ঞাসা করাতে সে ব্যক্তি সেইদিকে শায়িত এক ছিন্নবৃক্ষ দেখিয়া মনে করিল সাহেবরা কবে ঐ বৃক্ষছেদন হইয়াছে, তাহাই জিজ্ঞাসা করিতেছেন। অতএব সে উত্তরচ্ছলে কহিল – “কালকাটা”। সেই হইতে ইংরাজেরা ইহার নাম “ক্যালকাটা” রাখিলেন। এই ব্যুৎপত্তি অমূলক হইলেও ইহার রচয়িতার চতুর বুদ্ধির ব্যাখ্যা করা কর্তব্য। ফলতঃ কোৎরঙ্গ-কুচিনান প্রভৃতি গ্রামাখ্যা যেমন নিরর্থক,— কলিকাতা শব্দও যে সেইরূপ নিরর্থক তাহাতে সন্দেহ করিবার প্রয়োজন নাই।\'', '108', '5', '', 'Kolikata_kolpolata.jpg', 'Kolikata_kolpolata1.jpg', '', '', '', 0),
(22, 'Arif', 'bengali', 11, '10', 'Hard cover', '399', '', '320', '60', '50', '40', 11, '2020-01-01', ' 978-8194186793', '19x13x2.5', 'পাটনার একজন পুলিশ আধিকারিকের ছেলে আরিফ। নিম্নমধ্যবিত্ত পরিবারের ছেলের স্বপ্ন ছিল সিভিল সার্ভিস পরীক্ষায় উত্তীর্ন হয়ে আইএএস আধিকারিক হওয়ার। তার বিশ্বাস আইএএস হলে পরিবারের সমস্ত দুঃখ কষ্ট সে দূর করতে পারবে। নিজের প্রস্তুতিতেও কোনও ফাঁকি ছিল না। এমন সময় আরিফের জীবনে সুমিত্রা এল। বদলে গেল তার জীবন। ঘনিয়ে এল এক চরম অনিশ্চয়তা। স্বপ্নের চূড়া থেকে একধাক্কায় বাস্তবের মাটিতে পড়ে আদৌ কি আরিফ জীবনের লড়াইয়ে ঘুরে দাঁড়াতে পারবে কিনা তারই আখ্যান ‘আরিফ’।', '254', '2', '', 'Arif.jpg', 'Arif1.jpg', '', '', '', 0),
(23, 'Rasosundari', 'bengali', 12, '16', 'Hard cover', '250', '', '200', '60', '50', '40', 3, '2019-02-11', ' 978-8193890264', '19.1 x 13 x 1 cm', 'বিশ্ব সাহিত্যের ইতিহাসে একাদশ শতকে স্প্যানিশ ভাষায় প্রথম আত্মজীবনী লেখা হয়েছিল; লিখেছিলেন গ্রেনেদার বাদশা আবদুল্লাহ। ইংরেজি ভাষায় প্রথম আত্মজীবনী লেখা হয়েছিলো ত্রয়োদশ শতকে। লিখেছিলেন মারগেরি কেম্প। তাঁর আত্মজীবনীর নাম ছিলো ‘দ্য বুক অব মারগেরি কেম্প’। বাংলা ভাষার প্রথম আত্মজীবনীকার রাসসুন্দরী দেবী। বাংলাদেশের প্রত্যন্ত গ্রামের একজন মহিলা। প্রথাগত শিক্ষায় শিক্ষিত নন। শুধুমাত্র আত্মবিশ্বাসের জোরে উনষাট বছর বয়সে লিখলেন আত্মজীবনী ‘আমার জীবন’। দোসর থেকে প্রকাশিত ‘রাসসুন্দরী’ ‘আমার জীবন’-এর বাইরে গিয়ে তাঁর সমগ্র জীবন ও সাহিত্যকর্ম নিয়ে এক গবেষণাধর্মী আলোচনা।', '120', '5', '', 'Rasosundari.jpg', 'Rasosundari1.jpg', '', '', '', 0),
(24, 'Lokayat Murshidabad ', 'bengali', 12, '16', 'Hard cover', '499', '', '400', '60', '50', '40', 13, '2020-02-18', ' 978-8193890295', '19x12x3', 'লোকায়ত মুর্শিদাবাদ বইটিতে সমগ্র জেলার আর্থিক, সামাজিক ও পরিবেশগত বিষয়টিকে লোকসংস্কৃতির সুবিশাল প্রেক্ষাপটে উপস্থাপন করা হয়েছে। বর্তমান যান্ত্রিক সভ্যতার কারণে গ্রাম বাংলা তথা আমাদের লোকসংস্কৃতির ওপর যে প্রভাব পড়েছে, তার পূর্ণাঙ্গ বিশ্লেষণ এই বইটিতে করা হয়েছে। অবস্থান, জনসংখ্যা, কৃষি, জীবিকা, থেকে শুরু করে লোকচার, পূজো- পার্বন, ব্রতকথা, ধাঁধা প্রতিটি বিষয়কে সুচারুরূপে উপস্থাপিত করা হয়েছে।', '390', '3', '', 'Lokayat_Murshidabad.jpg', 'Lokayat_Murshidabad1.jpg', '', '', '', 0),
(25, 'Space Part2', 'bengali', 13, '16', 'Paperback', '200', '', '160', '60', '50', '40', 1, '2020-02-06', '978-8194186748', '12 x 19 x 1.5 cm', 'নীল আকাশ এবং তাকে পেরিয়ে যে অন্তহীন শূন্যতা বিরাজ করে সেখানে কী রহস্য লুকিয়ে আছে, তাকে ঘিরে মানুষের কৌতূহলের কোনও সীমা নেই। আকাশ পেরিয়ে মহাকাশ। পৃথিবী থেকে ১০০ কিমি বা ৬২ মাইল ওপরে অবস্থিত এক সীমাহীন, দিগন্তহীন এলাকা, যা সম্পূর্ন আঁধারে ঢাকা, শব্দহীন। বিজ্ঞানীদের ভাষায় মহাকাশকে নানা রং-এর অসংখ্য তারকাখচিত কম্বলের মতো দেখতে লাগে। মহাজাগতিক বিষয়বস্তু নিয়ে আমাদের সকলেরই সমান আগ্রহ। কিন্তু বিজ্ঞানের কঠিন ভাষায়, গাণিতিক পদ্ধতিতে এই মহাকাশ সম্পর্কে জানা সাধারণ মানুষের আয়ত্তের বাইরে । সেখান থেকেই ডঃ সমীরকুমার মুখোপাধ্যায় Space 2 বইটি অন্যন্য। এখানে অতি সহজ ভাষায় আকাশ-মহাকাশের পার্থক্য, তারাদের প্রকারভেদ, মহাকাশ অভিযান, নভশ্চরদের দিনযাপন,সর্বোপরি গবেষণার তাগিদে মহাকাশে কত প্রাণ নতুন জীবন পেয়েছে, আবার কত প্রাণ হারিয়েছে তার পুঙ্খানুপুঙ্খ আলোচনা করা হয়েছে এই বইটিতে, যা সববয়সি মানুষদের জন্য ভীষণভাবে প্রযোজ্য বা উপযোগী।', '130', '3', '', 'space2.jpg', 'space2_back.jpg', '', '', '', 0),
(26, 'Mukhosh', 'bengali', 17, '39', 'Hard cover', '150', '', '120', '60', '50', '40', 9, '2017-08-05', '', '19x13x1.5', ' তুষার চক্রবর্তীর কবিতায় আমরায় ছোটো ছোটো শব্দে আমরা মূল বিষয়বস্তুতে প্রবেশ করি। কবি তাঁর কবিতায় রোমান্টিকতাকে চ্যালেঞ্জ জানিয়েছেন বারবার। ', '96', '', '', 'Mukhosh.jpg', 'saradamangal1.jpg', '', '', '', 0);
INSERT INTO `book` (`book_id`, `book_name`, `book_language`, `book_type_id`, `book_category_id`, `binding_types`, `book_price`, `book_offer`, `sles_price`, `delivery_price`, `book_stock_unit`, `book_alert_unit`, `book_author_id`, `book_publication_year`, `book_isbn`, `book_product_dimensions`, `book_description`, `book_pages`, `book_ratting`, `book_read`, `book_image_1`, `book_image_2`, `book_image_3`, `book_image_4`, `book_file`, `book_status`) VALUES
(30, 'Stories of the Colonial architecture', 'english', 18, '28', 'Paperback', '350', '175', '280', '60', '50', '40', 16, '2019-02-05', '978-8193954409', '23x15x1.5', 'Colonial times witnessed several new constructions- giving shape to new spaces and interactions. This included both public and private spaces. This work focuses on specific public spaces from the colonial times across the regions of Kolkata (West Bengal, India) and Colombo (Western Province, Sri Lanka). Various similarities lie between these two cities pertaining to the British colonial times of the respective countries as the socio-cultural fabric slowly witnessed many changes within. Numerous public constructions across both cities stand till date, as sentinels to weave a communication of several stories of yore. The work aims to help in spreading awareness and an understanding about the need for a balance between history and modernity- a continuity from the past that helps to find answers to many questions in the present.', '192', '0', '<h1><img alt=\"\" src=\"https://images-na.ssl-images-amazon.com/images/I/81Rn-n5Of0L.jpg\" style=\"height:507px; width:321px\" /></h1>\r\n\r\n<h1>Stories of the Colonial architecture</h1>\r\n\r\n<p>&nbsp;(KOLKATA-COLOMBO)</p>\r\n\r\n<p>Lopamudra Maitra Bajpai</p>\r\n\r\n<p>First Published</p>\r\n\r\n<p>January 2019</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Copyright &copy; Lopamudra Maitra Bajpai, 2019</p>\r\n\r\n<p>Lopamudra Maitra Bajpai&nbsp; has asserted her right under the Indian Copyright Act to be identified as Author of this work.</p>\r\n\r\n<p>All rights reserved. No part of this publication may be reproduced, distributed, or transmitted in any form or by any means, electronic or mechanical, including photocopying, recording, or any storage or retrieval system, without prior permission in writing from the publisher.</p>\r\n\r\n<p>Publisher</p>\r\n\r\n<p>Crossed Arrows (A unit of Doshor Publication)</p>\r\n\r\n<p>C/2 Ramkrishna Upanibesh, Regent Estate,</p>\r\n\r\n<p>Jadavpur, Kolkata 700092</p>\r\n\r\n<p>E-mail: <a href=\"mailto:doshor.publication@gmail.com\" style=\"color:blue; text-decoration:underline\">doshor.publication@gmail.com</a></p>\r\n\r\n<p>ISBN: 978-8193954409</p>\r\n\r\n<p>Printed and bound in India by S.P. Communications Pvt Ltd, Kolkata</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u><em>Acknowledgement</em></u></p>\r\n\r\n<p>My sincere thanks to India-Sri Lanka Foundation and the Honourable High Commission of India in Sri Lanka (Colombo)- for the award of a social science research grant under the proposed title- &ldquo;<em>Histories and stories of public spaces- A study of the colonial architecture of Kolkata and Colombo</em>&rdquo;- and for encouraging research in history and comparative studies of South Asia. It is with their kind help that this study was possible between the two cities of Colombo in Sri Lanka and Kolkata in India. Heartfelt thanks to HE The High Commissioner of India, Respected Sir Mr. Taranjit Singh Sandhu. Thanks to HE The Former Deputy High Commissioner of India, Respected Sir Mr. Arindam Bagchi. I am much obliged and extend my sincere thanks to Respected Sir Mr. Niteen Yeola- 2nd Secretary (Pol.)- HCI, Sri Lanka- for all the help, support and encouragement. I also extend my sincere gratitude and thanks to Honourable Madam Mrs. Rajashree Chintak Behera- The Former Director, Indian Cultural Centre, Colombo- for always being an encouraging support<strong>.</strong></p>\r\n\r\n<p>I would also like to take the opportunity to extend my thanks to, Mr. Jawhar Sircar, Former Culture Secretary, Government of India and Former CEO Prasar Bharti, Government of India for his guidance and help. I also take the opportunity to extend my thanks to Dr. Siddhartha Mukherjee, Shiladitya Pandit (Correspondent, The Times of India, Pune), Dr. Pranab Jyoti Sharma (Manger- Language Services SAGE India Publications Pvt. Ltd.), Mrs. Luna Bose and Rishav Bose from Colombo, Architect Gopa Sen, Dr. Rupendra Kumar Chattopadhyay (Paresh Chandra Chatterjee Professor of History, Presidency University, Kolkata) and Dr. Shubha Majumdar (Deputy Superintending Archaeologist, Archaeological Survey of India, New Delhi) and the helpful team of Archaeological Survey of India, Kolkata Chapter and Sanjeewani Vidyarathne (National Museum, Colombo) and my friends Ms. Radhika Singh and Ms. Rukmini Mukherjee for their love and support.&nbsp; I would like to take this opportunity also to express my gratitude towards two important teachers who have always been a source of inspiration and motivation and guided me to learn history, research and ethnography- Late Prof. Amalendu Mukherjee, historian and Lecturer, Calcutta University and Late Dr. (Prof.) D.K. Bhattacharya, prehistorian and former Head of the Department of Anthropology, Delhi University. As I pen down the last few words of this work, I remember their words fondly. They would have been the happiest today to see the fruition of the hardwork.</p>\r\n\r\n<p>Last, but not the least, I would like to extend my thanks to my Baba- Dr. Tushar Kanti Maitra, my Ma- Mrs. Manju Maitra, my sister- Dr. Gargi Maitra and especially my little daughter- Aishani- without whose constant support, love and encouragement and fruitful discussions, this work would not have been possible.</p>\r\n\r\n<p><em><u>Prologue</u></em></p>\r\n\r\n<p>The history of colonial times observed tremendous changes with respect to economic as well as socio-cultural, religious and political spheres of the Indian sub-continent. With a new chapter in history, the time also witnessed a period of rebuilding an identity and amidst the many factors, this was aided by the constructions of new buildings, giving shape to new settlements and recreating a new geography of the region. Down the course of history, these constructions have been the representations of an era gone by however, many have fallen into a state of despair in the present. This include both public and private historical places. While some have been fortunate enough to receive the touches of conservation, there are many who still lie in oblivion. This work focuses on specific public spaces from the colonial times across the regions of Kolkata (West Bengal, India) and Colombo (Western Province, Sri Lanka). This is not a technical work on architecture or conservation of heritage sites, but aims to touch upon the vital points of both through an understanding of history and the intangible cultural heritage element of the many lore and stories associated with historical spaces. The work aims to help in spreading awareness about not only these spaces, but the need to have an understanding about a balance between history and modernity- a continuity from the past that helps to find answers to many questions in the present.</p>\r\n\r\n<p>Thanks and regards</p>\r\n\r\n<p>Dr. Lopamudra Maitra Bajpai</p>\r\n\r\n<p>April 18, 2018</p>\r\n\r\n<p>World Heritage Day</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><u><em>Introduction- History, Stories and Preservation</em></u></p>\r\n\r\n<p>Once upon a time, next to the lion&rsquo;s gateway of the king&#39;s palace there was a huge tiger in an iron cage. The tiger used to go down on his knees to all the people who passed to and fro in front of the palace and say, &#39;Won&#39;t you please open the door of the cage for me just this once, kind sirs?&#39; &#39;You must be joking,&#39; they replied. &#39;If we open the door for you you&#39;ll break our necks.&#39; Meanwhile one day there was a lavish feast at the palace. Learned men came flocking to attend it. Amongst them was a Brahmin who looked very kind and innocent. The tiger started to bow and scrape before him, and the Brahmin said, &#39;Ah, this is a very well-mannered tiger! What do you want, my son?&#39; The tiger clasped his paws together and said, &#39;Please be so good as to open the door of this cage for me. I implore you on my bended knees.&#39;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Brahmin was such a kind-hearted man that he quickly did what the tiger asked and opened the cage-door. Then the good-for-nothing tiger came grinning out of the cage and said, &#39;Sir, I&#39;m going to eat you up!&#39; Anyone else would have fled instantly. But this Brahmin didn&#39;t know how to flee. &#39;I&#39;ve never heard anything like it!&#39; he said in great dismay. &#39;I&#39;ve done you such a favour and now you say you&#39;re going to eat me! Surely people don&#39;t do such things, do they?&#39; &#39;Indeed they do,&#39; said the tiger. &#39;They do it all the time.&#39; That can&#39;t be so,&#39; said the Brahmin. &#39;Come on, let&#39;s find three witnesses and see what they say.&#39; &#39;All right&#39;, said the tiger. &#39;If the witnesses agree with you. I&#39;ll release you and go on my way. But if they say that I&#39;m right. I&#39;ll catch you and eat you up.&#39;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The two of them went into the fields to look for witnesses. Between two of the fields the farmers had banked up some earth to make a small raised path. The Brahmin pointed to the path and said, &#39;This can be one of my witnesses.&#39; &#39;Very well,&#39; said the tiger, &#39;ask him what he thinks.&#39; So the Brahmin called to the path, &#39;Hey, my friend, tell me what you think: if I do good to someone, does he do me harm in return?&#39; &#39;Yes indeed, sir,&#39; said the path. &#39;Look at what happens to me. By lying between two farmers&#39; fields I do them a great service. Neither of them can take away the other&#39;s land; the water in one field cannot go into the other. I do them this service, but the wretches hack me with their ploughs to make their fields bigger.&#39; &#39;You hear what he says, sir,&#39; said the tiger, &#39;how harm is done in return for good?&#39; &#39;Wait,&#39; said the Brahmin, &#39;I still have another two witnesses to come.&#39; The Wicked Tiger The Stupid Tiger and other tales &#39;All right, let&#39;s find them,&#39; said the tiger.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the middle of a field there was a banyan tree. The Brahmin pointed it out and said, &#39;This can be my second witness.&#39; &#39;Very well,&#39; said the tiger, &#39;ask him, and let&#39;s see what he says.&#39; So the Brahmin called to the banyan tree, &#39;My friend, you are very old, and have seen and heard much. Tell me, if someone does a good turn can he receive a bad turn back?&#39; &#39;That&#39;s the first thing that happens to me,&#39; said the banyan tree. &#39;People sit in my shade to get cool, yet they jab me to get my sap for glue. They even tear off my leaves to catch the sap in. Look at this &mdash; one of my branches has just been broken off.&#39; &#39;Well, sir,&#39; said the tiger, &#39;you hear what he says.&#39; The Brahmin was now in some difficulty and couldn&#39;t quite think of what to say. But at that moment a jackal happened to be passing. The Brahmin pointed to the jackal and said, &#39;He can be my third witness. Let&#39;s see what he says.&#39; So he called out to the jackal, &#39;Jackal, sir, stop a minute and be a witness for me.&#39; The jackal stopped, but wasn&#39;t keen to come closer. He answered from a distance, &#39;What a strange request! How can I be your witness?&#39; &#39;Tell me,&#39; said the Brahmin, &#39;do people harm those who have done them favours?&#39; &#39;Who has done the favour, and who has done the harm?&#39; asked the jackal. &#39;If you tell me, then I can give you my opinion.&#39; &#39;This tiger was in a cage,&#39; said the Brahmin, &#39;and a Brahmin was walking along the path &mdash; &#39; &#39;This is very complicated,&#39; interrupted the jackal. &#39;I shan&#39;t be able to say anything unless I see the cage and the path.&#39; So they all had to go back to see the cage.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>When the jackal had paced all round it, examining it closely from all sides, he said, &#39;All right. I&#39;ve got the cage and path straight. Now tell me what happened.&#39; &#39;The tiger was in the cage,&#39; said the Brahmin, &#39;and a Brahmin was walking along the path &mdash; &#39; At once the jackal stopped him and said, &#39;Wait a minute &mdash; don&#39;t go so fast. I want to get this first bit clear. What were you saying? The tiger was a Brahmin, and the path was walking through the cage?&#39; The tiger burst out laughing when he heard this and said, &#39;What an ass you are! The tiger was in the cage and the Brahmin was walking along the path.&#39; &#39;Hang on,&#39; said the jackal, &#39;the Brahmin was in the cage, and the tiger was walking along the path &mdash; &#39; &#39;No, you fool, not that,&#39; said the tiger. &#39;The tiger was in the cage and the Brahmin was walking along the path.&#39; &#39;I can see that this is going to be a very confusing story,&#39; said the jackal. &#39;I can&#39;t follow it at all. What did you say? The tiger was in the Brahmin, and the cage was walking along the path?&#39; &#39;Never have I met such an idiot!&#39; bellowed the tiger. &#39;It was the tiger who was in the cage, and the Brahmin was walking along the path.&#39; &#39;It&#39;s no good,&#39; said the jackal, scratching his head. &#39;I won&#39;t be able to understand such a difficult story.&#39; The tiger lost his temper. &#39;You will have to understand it,&#39; he roared. &#39;Look, I was inside this cage &mdash; look&mdash; like this&mdash;&#39; As he spoke he got into the cage. The jackal shut the door and drew the bolt. Then he said to the Brahmin, &#39;Good sir, now I understand everything. If you want to hear my opinion, it is this: you should not do favours for the wicked. The tiger was right: bad is often done in return for good. Run away quickly now &mdash; the feast in the palace is not over yet.&#39; And the jackal went off to the forest, while the Brahmin went to join the feast.</p>\r\n\r\n<p>Thus goes a very famous folktale<strong> </strong>in Bangla from the region of Bengal&nbsp;(undivided), as well as Bangladesh and was part of the famous publication- Tuntunir Boi (The Book of Tuntuni- the tailor bird) of 1910 by renowned author, poet, illustrator and publisher Upendrakishore Ray Chowdhury. In the book Old Deccan Days from (central) India one can get to know about a similar story- where the tiger is replaced with an alligator and the matter was finally settled by a clever jackal after several appeals were made to a banyan tree, camel, bullock and an eagle. In another version, as mentioned in The Tales of Punjab from (northern) India - the matter was referred to a pipal or Bo tree and a road, while the final dispute was settled by a jackal who put the tiger back into the cage.</p>\r\n\r\n<p>A similar story echoes in the Sinhala language as well, which sounds very close to the Bengali counterpart. In this version, a crocodile attempts to eat the man and appeal was variously made to a kumbuk tree&nbsp;and a cow. Finally a jackal settles the dispute. Interestingly enough, a version of The Panchatantra from India also comes close to the Sinhala version where a crocodile attempts to eat a Brahmin priest and various appeals were made to a mango tree and an old cow and finally a jackal settles the dispute. Thus, the storyline seems to have revolved across the region of India and adjoining places- &ldquo;reflecting the flora, fauna, the society and the temperament, and most importantly- the similarities of emotions of the common man.&rdquo; (Bajpai Maitra, 6:2017). Interestingly enough, the diversity of the regions are reflected through the emphasised variations, &ldquo;like the mention of the immense prominence of kumbuk tree across the region of Sri Lanka, the significance of the mango, banyan or pipal trees in the regions of India, Sri Lanka or Bangladesh or the importance of an agricultural</p>\r\n\r\n<div>&nbsp;\r\n<hr />\r\n<div>\r\n<h3>End of this Sample book.</h3>\r\n\r\n<h3>Enjoyed the Preview?</h3>\r\n</div>\r\n</div>\r\n', 'Stories_of_the_colonial_architecture2.jpg', 'Stories_of_the_colonial_architecture11.jpg', '', '', 'Colonial_architecture.pdf', 0),
(31, 'Stories of preservation', 'special', 18, '28', 'SOFT', '00', '00', '00', '00', '00', '00', 16, '2020-08-04', '00', '1x1x1', 'The history of colonial times observed tremendous changes with respect to economic as well as socio-cultural, religious and political spheres of the Indian sub-continent. With a new chapter in history, the time also witnessed a period of rebuilding an identity and amidst the many factors, this was aided by the constructions of new buildings, giving shape to new settlements and recreating a new geography of the region. Down the course of history, these constructions have been the representations of an era gone by however, many have fallen into a state of despair in the present.', '10', '00', '<p>The history of colonial times observed tremendous changes with respect to economic as well as socio-cultural, religious and political spheres of the Indian sub-continent. With a new chapter in history, the time also witnessed a period of rebuilding an identity and amidst the many factors, this was aided by the constructions of new buildings, giving shape to new settlements and recreating a new geography of the region. Down the course of history, these constructions have been the representations of an era gone by however, many have fallen into a state of despair in the present.</p>\r\n', 'Stories_of_the_colonial_architecture3.jpg', '', '', '', 'First_few_chapters.pdf', 0),
(32, 'Bollywood Cinema Kaleidoscope', 'english', 18, '28', 'Hard cover', '600', '299', '480', '60', '50', '40', 17, '2020-01-28', '978-8194442912', '19.1 x 13 x 2.5 cm', 'This book is aimed at offering an insight into different aspects of Bollywood cinema that need highlighting now and for the future as an archival collection of concepts, ideas, realities and ideologies Bollywood Cinema represents, reflects, deflects from and critiques as well.', '324', '', '<p><img alt=\"\" src=\"https://images-na.ssl-images-amazon.com/images/I/51R9T6ETW6L.jpg\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div>\r\n<p>Bollywood Cinema Kaleidoscope by</p>\r\n\r\n<p>Shoma A. Chatterji</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>First Published January 2020</p>\r\n\r\n<p>&copy;</p>\r\n\r\n<p>Shoma A. Chatterji, 2020</p>\r\n\r\n<p>Shoma A. Chatterji has asserted her right under the Indian Copyright Act to be identified as Author of this work.</p>\r\n\r\n<p>Publisher</p>\r\n\r\n<p>Crossed Arrows (An imprint of Doshor Publication) C/2 Ramakrishna Upanibesh, Regent Estate, Jadavpur, Kolkata 700092</p>\r\n\r\n<p>E-mail: <a href=\"mailto:doshor.publication@gmail.com\">doshor.publication@gmail.com</a></p>\r\n\r\n<p>ISBN: 978-81-944429-1-2</p>\r\n\r\n<p>All rights reserved. No part of this publication may be reproduced, distributed, or transmitted in any form or by any means, electronic or mechanical, including photocopying, recording, or any storage or retrieval system, without prior permission in writing from the publisher</p>\r\n\r\n<p>&nbsp;Rs. 600/-</p>\r\n\r\n<table align=\"left\">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\nThis work is dedicated to:</div>\r\n\r\n<div>\r\n<p>My grandson Ishaan Agarwal, 19, with the hope that he reads it, if not now, sometime into the future when he has outgrown Game of Thrones and world cricket;</p>\r\n\r\n<p>The late Gulshan Ewing, the first editor (Eve&rsquo;s Weekly and Star &amp; Style) to accept my articles and letters to the editor around four decades ago and I kept writing for the two magazines till they went out of circulation;</p>\r\n\r\n<p>The late B.K. Karanjia for opening the doors of SCREEN which I contributed to for 32 years and through several editors ranging between Udaya Tara Nayar, Sanjit Narwekar, Rauf Ahmed, Bhawana Somaaya, and Priyanka Sinha Jha;</p>\r\n\r\n<p>Rajinder Menon who opened the window to my first ever weekly column in The Daily and marked a milestone for me</p>\r\n\r\n<p>The late P. Lal, the first ever publisher to have published my first collection of short stories entitled YES AND OTHER STORIES under the Writers Workshop imprint many years ago.</p>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>It is really more challenging to put together an introduction to a collection of essays than it is to write the essays. And this despite having penned several books on Indian cinema and written an introduction to most of them.</p>\r\n\r\n<p>Taking on the phrase, &lsquo;Everything negative&mdash;pressure,&nbsp;challenges&mdash;are all an opportunity for me to rise.&rsquo; I decided to get onto the keyboard and do the needful. This book is aimed at offering an insight into different aspects of Bollywood cinema that need highlighting now and for the future as an archival collection of concepts, ideas, realities and ideologies Bollywood Cinema represents, reflects, deflects from and critiques as well. Keeping away from theory for me, was a conscious decision because I had somewhat wearied of the rather narrow readership that heavy film theories attracted. My singular aim was to attract the lay reader, the film buff and the student of film studies just beginning to skim below the surface. I chose some topics I had already written on and then expanded on them with more research and inputs. But there was much more left to be written and I had to put everything in a time capsule and let the ideas find fruit in language and opinion, in perspective and comment.</p>\r\n\r\n<p><em><u>Bollywood</u></em></p>\r\n\r\n<p>The term Bollywood is popularly used for the Hindi language film industry based in Mumbai, Maharashtra, India. Bollywood is the largest film producer in India and one of the largest centres of film-making in the world. The movies are made in Hindi, a language that is widely spoken and understood by Indians across the globe making it popular not only among the Indian diasporic community but also with other audiences. Bollywood&rsquo;s global circulations have been especially multifaceted and surprising in reaching beyond South Asian Diasporas to connect with audiences throughout the world.</p>\r\n\r\n<p>Rajadhyaksha (2003)&nbsp;&nbsp;has described the international re-branding of Indian commercial cinema, as a process of &ldquo;Bollywoodization&rdquo;. Thus, while the majority of popular discourse in circulation now seems to present Indian cinema and &ldquo;Bollywood&rdquo; as synonymous, Rajadhyaksha is at pains to maintain a distinction between the two, claiming that, &ldquo;the cinema has been in existence as a national industry of sorts for the past fifty years&hellip;Bollywood has been around for only about a decade now&rdquo; (p. 28). He further insists on making this distinction between Indian cinema and Bollywood for two major reasons, firstly because the cultural industry surrounding the &ldquo;Bollywood&rdquo; brand extends far beyond the production and consumption of feature films, and secondly because the high-budget gloss and transnational themes of the major Bollywood films are far from representative of the majority of Indian film production.</p>\r\n\r\n<p>Indian cinema has also been a major recipient of the processes of remediation occurring with the arrival of digital technologies and the new media environment. In search of content and visual styles, India&rsquo;s internet portals have made a broad use of film-related material, promoting themselves with movie gossip and giving access to downloads of star images. Therefore, film producers, distributors and film fans in India were well placed to make use of the new medium for promotional purposes. Film magazines have put out extensive electronic editions and major film projects and film stars have commonly produced websites as part of their promotional strategy for some years now.&nbsp; Fortunately, these practices have also been instrumental in developing a global communication for promoting Indian films and film stars. Also, the dominant use of English language in all this Indian content, including much of the Bollywood-themed material, has also had the effect of privileging a vision of India that speaks primarily to Indians overseas and globally-oriented elites at home (Athique, 2011, p. 5)&nbsp;The short form NRI (Non-Resident Indian) is the most common term used in India to describe people of Indian origin living overseas. Therefore, &ldquo;there is a strong resident elite and NRI alliance that shapes the Internet presence of India and Indians, just as in many other domains&rdquo; (Gopinath, 2009, p. 303). In this sense, both the &ldquo;Bollywood film and its cross-media presence are seen as consciously addressing the &lsquo;non-resident audience&rdquo; also referenced by Rajadyaksha (2003, p. 29).</p>\r\n\r\n<p>Bollywood films are a much sought after entertainment source for Indians living in India as well as abroad. Moreover, Dissanayake (2006) argued that the diasporic communities are becoming more interested in Bollywood films that deal with Indian history, Indian heritage and culture and Indian nationhood. Bollywood movies are becoming an integral part of the Indian diaspora through which they can stay in touch and maintain Indian traditions and culture. As Chopra (2007)&nbsp;observed Bollywood is not just a style of filmmaking; it is a culture and a religion unto itself. He further observed that Bollywood films strongly influence dress codes, language, and rituals for both the educated person and a layman alike and also noted that members of a certain Bollywood film club from South Korea wore Shahrukh Khan (a popular Bollywood actor) t-shirts and sun glasses while watching a Hindi film. In fact, many ardent Indian movie fans of Indian origin copy their favorite actor&rsquo;s mannerisms, dress styles, and body language with utmost sincerity, which relates to a concept called fan culture (Srinivas, 1998). This suggests the emergence of a particular Bollywood culture in India, which is now being spread by new media technologies even within the Indian diaspora.</p>\r\n\r\n<p><u><em>Kaleidoscope</em></u></p>\r\n\r\n<p>The Kaleidoscope was invented by David Brewster in 1816 originally designed to produce theatrical <em>phantasmata</em> which in course of time, turned into a child&rsquo;s toy to a world of colourful designs created by rolling the tapered, cylindrical instrument round and round each turn creating a new design of broken glass pieces inserted into the cylinder. I use this as a metaphor for the collection of topics I have explored in depth to offer a glimpse into new and colourful designs through the very existence and evolution of Bollywood cinema.&nbsp; The use of this term in the title also signifies to some extend, the globalization of Bollywood cinema in a certain sense.</p>\r\n\r\n<p><em><u>Choice of Essays</u></em></p>\r\n\r\n<p>The choice of the 15 essays was mainly hinged to cinema that many had already seen so that they could relive them through the essays such as <em>Mother India</em> and Amitabh Bachchan. Some of these essays are born out of my personal invention and innovation while some were strongly recommended by some of my journalist friends, For example, while I suggested an exploration of the <em>Dalit Identity in Indian Cinema</em>, they asked me to do a piece on the <em>Out-of-The-Box Heroes of Bollywood</em> like Irrfan Khan, Nawazuddin Siddiqui, Ayushman<u><ins>n</ins></u> Khurana and so on who do not fit in either the chocolate-boy hero of the 1960s and 70s or in the action, six-pack abs heroes represented by the likes of Salman Khan and Hrithik Roshan. It was a real discovery for me as a writer because I had to watch some of their films again and again and with each such viewing, I discovered something I had missed earlier. An essay on the emergence of the <u><ins>&lsquo;</ins></u>New Woman<u><ins>&rsquo;</ins></u> in Hindi cinema was an appropriate afterthought<u><ins><ins>.</ins></ins></u>What defines the <u><ins>&lsquo;</ins></u>new<u><ins>&rsquo;</ins></u> woman in Bollywood films? The &lsquo;new&rsquo; woman is fiercely independent. They do not need heroes to lean on, like Rani Mukherjee has portrayed in a number of films, or, the changing image of the prostitute who never talks about any sad, <u><ins>&lsquo;</ins></u>back story<u><ins>&rsquo;</ins></u> to gain sympathy but turns out to be a right-thinking woman who does not shy away from her profession or offers any apology for being within it. Brilliant<u><ins>!</ins></u>&nbsp;While researching for this book, I also discovered how the celluloid representation of the LGBTQ+ person evolved in our films and the results were very encouraging<u><ins>,</ins></u> never mind if they were feature films or documentaries. I have not dwelt on documentaries unless I had to but the space is well-deserved.&nbsp; The idea of the essay on <em>Romanticising History or Historicising Romance</em> came from one of the editors of the publications I write for when trouble was brewing around <em>Padmavat </em>and this gave me the opportunity of another window which revealed how most of the so-called historical films are based on pure fiction mainly around characters such as Anarkali and Jodha in <em>Jodha<u><ins> </ins></u>Akbar</em>. <em>Manikarnika</em>, I realised after watching the film, was mainly a platform offered to Kangana Ranaut who also took over the directorial reins of the film, perhaps as an &lsquo;investment<u><ins>&rsquo;</ins></u> towards another National Award for Best Actress<u><ins>,</ins></u> which she has already won twice. <em>The Muslim Identity in Indian Cinema</em> was extremely interesting from the research point of view and I acquired so much material that it made me feel this itself could be a full-fledged book.&nbsp; The area around sports films and biopics on sportsmen and sportswomen is relatively unexplored so far as writing on cinema goes<u><ins>,</ins></u> so this offered a very good opening for me. The same applies to Mental Illness as depicted in Indian Cinema which suffers from medical inaccuracies either for want of proper research or for commercial issues or both. Often, conditions like Tourette&rsquo;s Syndrome and Dyslexia are genetic disorders and not mental aberrations at all but the films concerning them do not go much into research.Two more chapters suggested by my friends are - Student Activism in Indian Cinema and Biographical Feature Films. I had not dwelt with the first at any time over these forty years and the second one I had touched upon within specific genres. So, specially, the first topic was quite challenging because not many had explored this field before. But it made me happy to accept the challenge for the research and then the writing. I chose the title <em>Bollywood Cinema </em>with the lay cinema buff in mind so that he is not confused by theory and can really enjoy reading about films he has alre<u><ins>a</ins></u>dy seen or films these essays may inspire him to see. Every book &ndash; the reading and the writing of it, is a long journey and I have thoroughly enjoyed this one as much as I did the others before this. It is a journey filled with trying to find out your own mistakes and setting them right, going through each sentence, paragraph and page as if through a magnifying glass and still not able to see them all. For me, writing a book is a journey undertaken with a lot of love and passion and fascination for cinema, filled with pitfalls, adventures, misadventures till the last word has been tapped into the computer. But complete fulfilment will come when a reader reaches out and says, &lsquo;I have read your book and I liked it.&rsquo;</p>\r\n\r\n<p>Dr Shoma A. Chatterji</p>\r\n\r\n<p>August 2019</p>\r\n\r\n<p>BOLLYWOOD AND THE CINEMA OF SPORT</p>\r\n\r\n<p><u><em>Introduction</em></u></p>\r\n\r\n<p>India has produced immortal sportspersons in history, excelled in team sports like hockey and football, but sports and sportspersons as a genre in cinema has remained relatively lesser known among both filmmakers and audience. However, this anathema towards films based on sports and sportspersons has changed in recent times. The turning point came with Aamir Khan&rsquo;s <em>Lagaan</em> directed by Ashutosh Gowarikar. <em>Lagaan</em> is a fictionalised slice of life placed within India&rsquo;s colonial history. There have been feature films on great sportspersons portrayed by actors who are not into the sports they have performed and have yet come out with award-worthy performances. Examples are aplenty<u><ins>&mdash;</ins></u><em>Paan Singh Tomar, Bhaag Milkha Bhaag, Mary Kom, Dangal</em> and many more.</p>\r\n\r\n<p>Sports basically, are a way of life that demand a certain attitude, high moral values, focus and strict discipline. A sport is a concept and an ideology not limited to performance in the field or within the four walls of a hall. Interestingly, indoor games do not feature in Bollywood at all except cards that function not as a game but as an indulgence to gamble. Do these carry over in films dealing with sports through entirely fictionalised narratives or through real-life representations on celluloid? These are questions this essay will seek to find answers to, or, perhaps, discover some questions that may keep hanging in the air.</p>\r\n\r\n<p><u>&nbsp;Sports in fictional films</u></p>\r\n\r\n<p>Taking stock of notable Indian films dealing in sports down the years, the output is disappointing. This writer could count only eight Hindi films between 1984 and 2005. These are<u><ins>&mdash;</ins></u>Raj N. Sippy&rsquo;s <em>Boxer</em> (1984) starring Mithun Chakraborty, <em>Hip Hip Hurray</em> the same year directed by Prakash Jha starring the relatively unknown Raj Kiran as a sports instructor<u><ins>, </ins></u><em>Saaheb</em> (1985), directed by Anil Ganguly with Anil Kapoor that had sports as a sub-plot in the sentimental family melodrama, Mansoor Ali Khan&rsquo;s delightfully entertaining <em>Jo Jeeta Wohi Sikandar</em> (1992<u><ins>), </ins></u>Vikram Bhatt&rsquo;s <em>Ghulam</em> (1998), Gul Bahar Singh&rsquo;s <em>Goal</em> (1999) produced by the Children&rsquo;s Film Society and Ashutosh Gowarikar&rsquo;s <em>Lagaan</em> (2001) complete the list closing with Nagesh Kukunoor&rsquo;s <em>Iqbal</em>. The thumping box office and critical success of Kukunoor&rsquo;s <em>Iqbal</em> (2005) produced by Subhash Ghai ought to have marked a turning point in the visibility and importance of sports in Indian cinema. Sadly<u><ins>,</ins></u> however, the entire emphasis of the success of <em>Iqbal </em>was placed on the hearing disability and the socially challenged backdrop of Iqbal, the protagonist, played convincingly by Shreyas Talpade and not on the game. But one needs to compliment Kukunoor for the film&rsquo;s unusual approach barring the clich&eacute; character of the alcoholic cricket coach who is persuaded to train Iqbal before he plays in front of the selection panel. We will keep away from <em>Sultan </em>because of its extremely patriarchal handling of the theme where the girl, a great wrestler herself, falls in love with Sultan and is forced to give up the sport. The same goes for films that did not do well at the box office and were critical failures such as fictionalised biographies of Mohammed Azharuddin and M.S. Dhoni. A sports film demands a completely different approach in the entire technique and aesthetics of filmmaking that would involve an equal commitment from the director, the script writer, the cinematographer, the sound designer and the editor plus the one working on the production design and on the costumes. How many filmmakers are this committed? <em>Jo Jeeta Wohi Sikandar</em> (1992) is about a cycling race that goes beyond the race to extend itself to an exploration of class discrimination between students of two different schools, one a humble, Hindi medium one and one a prestigious<u><ins>,</ins></u> English-medium one. It also is a model lesson on how negative competition can create havoc in the lives of dedicated competitors but also bring about a positive metamorphosis in the life and philosophy of the protagonist Sanju (A<u><ins>a</ins></u>mir Khan). Sanju changes from a happy-go-lucky, irreverent, never-care-less young schoolboy to a responsible young son who is not only repentant about his past behaviour but is also determined to win the race which his brother was originally supposed to participate in.</p>\r\n\r\n<p>The training sessions Sanju undergoes are handled extremely well. <em>Jo Jeeta Wohi Sikandar</em> was such a big hit that it became not only a cult film but also a trendsetter that triggered the Telugu <em>Thammdu </em>((1999), the Tamil <em>Badri</em> (2001), the Kannada <em>Yuvaraja </em>(2001) and the Bengali <em>Champion</em> (2003)<u><ins>.</ins></u> Mansoor Ali Khan<u><ins>,</ins></u> who directed his debut film, said that it was loosely based on <em>Breaking Away</em> (1979) produced and directed by Peter Yates and won many awards.&nbsp;&nbsp;<em>Iqbal </em>essays the dilemma of small town talents trying to make up the means to attend a sports school or clinics with a meagre family income and innocent guardians who do not have anything to do with such &lsquo;costly affairs&rsquo;. But Iqbal&rsquo;s self determination and the guidance from an alcoholic coach Mohit (Naseeruddin Shah) with the limited resources available, prompted him to think big. It clearly shows how success can be achieved by an individual&rsquo;s self confidence, optimism and hard work cutting across all odds that we face in our day<u><ins>-</ins></u>to<u><ins>-</ins></u>day life. Life is not easy for many and for people like Iqbal it is all the more difficult to live a normal life. The drunkard coach and the owner of the coaching academy would represent the society which is filled with evils and impurity. All aspects of destiny, fortitude and diligence unfold in Kukunoor&rsquo;s film so smoothly that viewers are taken aback by the emotional effects. The politics of sports is also regenerated to give a real sense of happenings and events in the world of sports.</p>\r\n\r\n<p><em>Lagaan</em> cannot be defined just as a sports film. It basically is a powerful patriotic statement in history that, though fiction, comes across with conviction and massive audience acceptance. <em>Lagaan </em>shows cricket as a matter of life<u><ins> </ins></u>or<u><ins> </ins></u>death for the simple villagers of Champaran, a fictional village set in the Victorian era when the British were in full control. The villagers had never even heard the word <u><ins>&lsquo;</ins></u>cricket<u><ins>&rsquo;</ins></u> in their lives and objects like the bat, the ball, the wickets and the pitch were alien concepts. The final cricket match between the British officers and the poor peasants is played fiercely because the latter know that their lives depend on the outcome. Champaran is a drought-stricken village that failed to produce crops so the villagers could not pay the taxes imposed by the British. They are forced to accept the wager by the British officers that if they win in a game of cricket against the British players, their taxes would be waived for three years. <em>Lagaan</em><em>&nbsp;</em>is the third Indian film nominated for the Academy Award for Best.</p>\r\n\r\n<div>\r\n<h3>&nbsp;</h3>\r\n\r\n<hr />\r\n<div>\r\n<h3>End of this Sample book.</h3>\r\n\r\n<h3>Enjoyed the Preview?</h3>\r\n</div>\r\n\r\n<div>\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div>\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div>\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n', 'Bollywood_Cinema_Kaleidoscope.jpg', 'Bollywood_Cinema_Kaleidoscope1.jpg', '', '', 'Bollywood_Final_18-01-2020_Last_(1).pdf', 0),
(33, 'Nirbachito 30', 'bengali', 12, '16', 'Hard cover', '400', '', '360', '60', '50', '40', 8, '2020-01-01', '978-8194186779', '19 x 13 x 2.5 cm', 'বাংলা সাহিত্যে প্রায় বিস্মৃত জগতে বিচরণ করতে গিয়েই লেখাগুলির সূচনা। কবি সুভাষ মুখোপাধ্যায়, অরুণ মিত্র, শক্তি চট্টোপাধ্যায়, অন্নদাশঙ্কর রায়, শৈলজানন্দ মুখোপাধ্যায়, সরোজকুমার রায়চৌধুরী, অমূল্যধন মুখোপাধ্যায়কে চিনিয়ে দেওয়ার জন্য কলম ধরা। সম্পাদক রামানন্দ চট্টোপাধ্যায়,প্রাবন্ধিক রাজনারায়ণ বসু, শিশুসাহিত্যিক মনোরঞ্জন ভট্টাচার্য, কবি সুধীন্দ্রনাথ দত্ত,ঔপনাসিক শৈলবালা ঘোষজায়াকে কি মনে পড়ে? তারাই যেন এই গ্রন্থে নতুনভাবে উপস্থিত। বাংলা সাহিত্য ও সাহিত্যিকের মণিকোঠায় কত যে উজ্জ্বল নাম। সেখান থেকে বাছাই করা কবি-লেখকদের সৃষ্টির জগতে ঘুরে বেড়িয়েছেন লেখক অরুণ মুখোপাধ্যায়। তিনি কখনও বইমেলার চত্বরে, কখনও বা কলেজস্ট্রিট বইপাড়ার পুরোনো বই-এর দোকানে সুরম্য ভ্রমণ করেছেন। খুঁজেছেন দুষ্প্রাপ্য বই, হারিয়ে যাওয়া শব্দ এবং অবশ্যই হারিয়ে যাওয়া লেখকদের।', '238', '', '', 'Nirbachito2.jpg', 'Nirbachito11.jpg', '', '', '', 0);
INSERT INTO `book` (`book_id`, `book_name`, `book_language`, `book_type_id`, `book_category_id`, `binding_types`, `book_price`, `book_offer`, `sles_price`, `delivery_price`, `book_stock_unit`, `book_alert_unit`, `book_author_id`, `book_publication_year`, `book_isbn`, `book_product_dimensions`, `book_description`, `book_pages`, `book_ratting`, `book_read`, `book_image_1`, `book_image_2`, `book_image_3`, `book_image_4`, `book_file`, `book_status`) VALUES
(34, 'History of Canals in Bengal', 'english', 18, '28', 'Hard cover', '350', '175', '280', '60', '50', '40', 18, '2018-11-15', '978-8193890202', '23x15x2', 'Bengal is a riverine state. The most important part of this is the canal Network. From the very beginning, the canal played an important role in the commercial trade of Bengal. Besides, it had a great impact on the life of Bengal.', '256', '', '<div>\r\n<p><img alt=\"\" src=\"https://images-na.ssl-images-amazon.com/images/I/51hJTLoLraL.jpg\" style=\"height:485px; width:307px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>History of Canals In Bengal</p>\r\n\r\n<p>Himendusekhar Banerjee</p>\r\n\r\n<p>First Published 2018</p>\r\n\r\n<p>&copy;</p>\r\n\r\n<p>Himendusekhar Banerjee</p>\r\n\r\n<p>All rights reserved</p>\r\n\r\n<p>Publisher</p>\r\n\r\n<p>Crrossed Arrows</p>\r\n\r\n<p>C/2 Ramkrishna upanibesh</p>\r\n\r\n<p>P.O. Regent Estate, Kolkata-700092 e.mail : <a href=\"mailto:doshor.publication@gmail.com\">doshor.publication@gmail.com</a></p>\r\n\r\n<p>website : <a href=\"http://www.doshor.com/\">www.doshor.com</a></p>\r\n\r\n<p>ISBN-978-8193890202</p>\r\n\r\n<p>This book is sold subject to the condition that it shall not by way of trade or otherwise, be lent, resold, hired out, circulated, and no reproduction in any form, in whole or in part (except for the brief quotations in critical articles or reviews) may be made without written permission of the publishers.</p>\r\n\r\n<p>Rs. 350/-</p>\r\n\r\n<h3>P r e f a c&nbsp; e</h3>\r\n</div>\r\n\r\n<div>\r\n<p>Water,&rsquo;an integral component of all ecological and societal processes &lsquo;is fast dwindling and is not only a grave concern for India but a widely discussed global issue of present times. &lsquo;The Bengal delta&rsquo;, wrote Kalyan Rudra of West Bengal Government &lsquo;which was described as areas of excess water in the colonial documents now suffers from acute dearth of water during lean months.&rsquo; At a meeting of water activists and experts in December 2016 (reports Times of India dated Septemer 1, 2017) the country&rsquo;s water resources were analysed and the verdict was chilling. Over 70% of the rivers&rsquo; conditions were critical, their water flows diminished, tributaries were dwindling or cut off pollution was rampant, ri9ver banks encroached, and catchment areas denuded of forest. Preservation, maintenance and use of water resources in the river-dominated deltaic domain of eastern India are,therefore, primordial concerns for people inhabiting the region.The natural resource of water in this part has always remained a driving force and a catalyst for its socio-economic, religious-cultural, ecological evolutionary processes throughout history. Complex multi-faceted interactions between water and human living may be observed when we delve deep inside the history of this region.Glimpses of such interactions can be obtained from the writings of many an eminent scholar of the past and present. But a comprehensive study discussing the&nbsp;ordinary 265many aspects of the impact of water resources on the life and living of the residents inhabiting this region is lacking. There are studies on irrigation etc. on the Ganges valley, north-western and western India, south India by Indian and non-Indian scholars. Even the writings of Dr.S.K. Mahapatra(2005), Dr. Ganeswar Nayak (2007) on Orissa canal system and water transport throw light on technological changes in canal irrigation and navigation system and its diverse impact upon Orissa&rsquo;s peasant economy and society. But such works are lacking so far as Bengal during the colonial era is concerned. My present research work is a modest approach on &lsquo;History of canals in Bengal&rsquo;, mainly during the 19th c., almost a virgin field of study which has been discussed with an understanding of this region&rsquo;s peoples&rsquo; many aspects of river-centric life and living during the period under review. It offers a fascinating study&ndash;why and how the Calcutta and Eastern canals, the Orissa canal system (Orissa at that time belonged to the province of Bengal) came into being; posed as insurance against recurring drought, flood and famine; improved the natural drainage system and opened up rural interiors. Those were the canals due to which new markets sprang upon its banks, new settlements were colonized, people spurred to new agricultural, economic and trading activities which became integral components in the country&rsquo;s infrastructural modernization and in transforming agriculture, trade, economy, society and life of people. But those canals dwindled over time while competing with the railways and due to neglect in their proper upkeep by successive governments which resulted in the sordid present-day scenario of a moribund state affecting life, economy and environment of the region.The moot purport of this study is to make people at the helm of affairs aware about the potential of the water resources with which this region is endowed with, which will serve as a ready reckonrt with details I have collected from very wide range of study over the years. The following chapters are arranged to discuss the subject in detail&ndash;</p>\r\n</div>\r\n\r\n<div>\r\n<ol>\r\n	<li>The &lsquo;introduction&rsquo; chapter traces how the river- dominated eastern segment of India&rsquo;s settlements, life, economy, society had been affected by the changing courses of her rivers over the years.</li>\r\n	<li>The first chapter discusses the many aspects of why does the state of West Bengal need to resuscitate and preserve her water bodies. It will help artificial irrigation, play a big role in infrastructural development, encourage trade and tourism, assist fisheries and horticulture and serve as drainage channels mitigating to a great extent the rigours of recurring flood and drought which have become endemic in this part of India. This will also offer the panacea to solve water-logging in Kolkata, preserve the wetlands, ecological balance, bio-diversity and maintain weather conditions all around. All these would be great boon to life in general, particularly of the rural areas.</li>\r\n	<li>The second chapter-&lsquo;The Calcutta and Eastern canals&rsquo;, an under-researched topic, delineates the construction part of the canals in question, its potency as means of conveyance of an ever- increasing internal trade and in opening up Bengal&rsquo;s rural interior as well as transforming Calcutta&nbsp; into&nbsp;&nbsp; a mega city which became appendage to main-line river traffic and integral part of the transportation network in Bengal in the 19th century; the role of the government in conserving the canals, its gradual disuse in the face of competition with the railways and its overall impact in transforming the socio- economic life of the people inhabiting the region.</li>\r\n</ol>\r\n</div>\r\n\r\n<div>\r\n<ol>\r\n	<li>The third chapter deals with &lsquo;The Orissa canal system&rsquo; (comprising the Orissa canals, the Midnapore and Hijli tidal canals) that were designed to protect the province from famine caused by recurring destructive inundation and occasional droughts by taming the flooding rivers constructing weirs, dams, embankments, etc. to supply water to meet inequality and deficiency in natural rainfall to irrigate the great and most important grain-growing tracts. Those were also intended to serve the purpose of navigation running in two directions&ndash;from Cuttack to the sea at False Point giving access to the coast and another line of navigable communication between Cuttack and Calcutta so that in years of plenty those would give exit to the surplus produce of the country and give entry to foodstuff in times of deficit because Orissa of those days was geographically isolated to an excessive degree. But the construction of B. N. Railway marked the beginning of its decline and now it is almost dead and grabbed by land mafia and shrimp cultivators to a large extent.</li>\r\n	<li>The fourth chapter&ndash;&lsquo;History of commercial navigation by steamboats along the eastern waters&rsquo; is almost a virgin field of study and presents the history of its progress in detail giving an account of the part played by steamboats in opening up the interior (district- wise) that brought about infrastructural transformation in this part of the country. In fact, steamboats, aided by the network of rivers in this region, played a far more important role than the railways in breaking the self-sufficiency of villages by augmenting the process of commercialization and market-oriented agricultural production. But neglect of water bodies and lack of conservation affected the navigability of the water-routes which in turn paralysed steamer traffic.</li>\r\n</ol>\r\n</div>\r\n\r\n<div>\r\n<ol>\r\n	<li>The fifth chapter contains a discussion about &lsquo;boats and boatmen of Bengal&rsquo; who rove bravely and laboriously their crafts against stormy weather or menacing waves risking their lives just to eke out a living.They have now become a very insignificant category of people leaving space for modernization of transportation and in the present day scenario almost a forgotten chapter.</li>\r\n</ol>\r\n\r\n<p>I was registered in the Jadavpur University for Ph.D. which task I could not submit within the stipulated time. However,over years I went on collecting materials in addition to my regular college duties and University assignments with the intention to complete the work after I retire. My work is based on primary materials, including archival, government reports, contemporary or near-contemporary journals, Gazetteers, Survey- Settlement reports, writings of officials directly in-charge of canal administration as well as secondary sources, such as, books, journals and also availed link facility. I have followed the standard spellings in naming places, rivers, etc. I have kept the references with myself, any reader interested to be sure about the authenticity of any information may be satisfied if contacted to the author&rsquo;s e-mail address. I never received any grant from any institute nor availed any leave from my college to get rid of my usual college and university assignments and devote the time to pursue my work.</p>\r\n</div>\r\n\r\n<div>\r\n<p>Meanwhile, the Calcutta chapter of &ldquo;The Calcutta Canals&rdquo; was presented in a seminar organized jointly by the Birla Industrial and Technological Museum, Centre for Studies in Social Science and NISTADS. Subsequently it was published in &ldquo;West Bengal&rdquo;, a journal of the Government of West Bengal;and the Bengali version of which was included in a book named &ldquo;Vishay Kolkata&rdquo; published by National Library Workers&rsquo; Association in 1993. Most of the writings were complete long back and were lying idle inside my drawer when my elder daughter Miss Kaushikibrata Banerjee rather compelled me to complete the work and publish it. I am deeply indebted to her for her initiative and give time to oversee the work.But the real credit for publishing the book goes to Sri Arijit Saha who is almost like my son to whom I will remain ever grateful. The young hearts of &lsquo;Doshor Publication&rsquo;deserve my heart-felt thanks for kindly consenting to publish the work of a writer from nowhere. I wish them all success in life. I also extend my sincere thanks to &ldquo;Amra Monbhasi&rdquo; for the support and encouragement I received from them in publishing my work. In the cultural and literary arena they are doing commendable jobs and I am convinced that they have a very bright future. I am now 75 years of age and would remain ever grateful to those authorities if my work is&nbsp; of any use to them in resuscitating the water resources in this part of our country. Any constructive suggestion&nbsp; is welcome for future improvements to the book.</p>\r\n\r\n<p>Introduction</p>\r\n</div>\r\n\r\n<div>\r\n<h3>Bengal-a river dominated delta</h3>\r\n\r\n<p>The Indian subcontinent, especially her eastern segment, has been endowed with ocean, and a maze of rivers, creeks, bils, backwaters, etc. which may be considered as the most important geo-physical feature of the area. These water bodies provided the ingress from and egress to the sea that formed routes for her inland ports and cities rich with various agricultural produce, quality handicrafts, etc. to build up commercial, colonial, missionary ties with the outside world and her polity, economy, trade, culture and society in general had been river-centric to a large extent. While rivers bore the main brunt of inland water-borne traffic, canals, constructed by the colonial Government in the 19th century, served as appendage to the main-line river traffic and both the systems were interdependent and intertwined.These canals were either used as means of transit or served both the purposes of navigation and irrigation.A historical survey of the origin and development of these canal projects, the commercial potency of the water resources that stimulated and provided &lsquo;the alacrity and bustle of traffic&rsquo; and transformation in agricultural pursuits and the many matters of &rsquo;the interface between hydrology and human society&rsquo; at different geographic locations cannot be elaborated without an understanding of the influence of the river system on Bengal&rsquo;s life and economy.</p>\r\n</div>\r\n\r\n<div>\r\n<p>During the days gone by oceans, navigable rivers, and amiable climate largely determined the locale of human settlements, activities and conditions of life. Man had to constantly adjust himself with the &lsquo;swings of the streams&rsquo;. &ldquo;Human map follows the hydrological map&rdquo;- such goes the saying. The Nile, Tigris, Euphrates, Indus, Wang ho are considered mother rivers that spawned great civilizations of yonder days. Over time though man has learnt many ways to harness rivers to serve his&nbsp; needs, he still faces the wrath of rivers&rsquo; fury, land-erosion or change in river-courses at times if they are left to dwindle or due to some natural calamity causing serious impediments to the natural drainage system creating manifold habitation problems. That provide the rationale why we should devote our all-out effort to revive, preserve and maintain the water bodies with which this region is endowed with.</p>\r\n\r\n<p>The Ganges, Brahmaputra, Meghna, with numerous tributaries and distributaries created deltaic Bengal and the same fluvial action has been responsible for shifting of river-courses over time. Banks of major rivers once studded with great port towns, capital cities witnessed their gradual decline because of such shiftings of river- courses or due to competition with the railways or because the rivers became difficult to navigate due to negligence in their upkeep and the present-day scenario is-many of these rivers have changed courses, some disappeared from the surface altogether or &lsquo;turned to trickle&rsquo; causing congestion of drainages, environmental pollution and various types of health hazards. As a consequence there have been gravitational shifts of settlements from river banks to either roads or railway tracks. A glimpse into Bengal&rsquo;s past will reveal the kaleidoscope of such changes.</p>\r\n</div>\r\n\r\n<p>From the dawn of Bengal&rsquo;s historical period she earned her name as a sea-faring nation. She had overseas trade relations with south-east Asian countries like Java, Sumatra, Siam (modern Thailand),etc.; far eastern countries of China, Japan; coastal ports of Orissa, Coromandel, Malabar, Gujarat; African coasts, Arab and other near eastern countries, Rome, Greece, Mediterranean countries, etc. According to Mahavamsa the Vanga King Vijayasimha conquered Lanka (modern Sri Lanka) in 544 B.C. and named it Sinhala. Some of the ancient dynasties of Bengal, Orissa and south India built up several colonies in many of the countries of south-east Asia. As a consequence the main texture of Bengal&rsquo;s culture and society have never been insular but cosmopolitan, legacy of&nbsp; which she proudly maintains&nbsp; till date.</p>\r\n\r\n<p>From earliest time important port cities emerged upon river banks like the town of Ganges mentioned by Periplus as the grand emporium for Bengal at no great distance from Calcutta. About the time of Lord Buddha, and possibly earlier, sea-going vessels used to be laden with merchandise of the Ganges plain from Benares. The next important commercial emporium was Pataliputra (modern Patna), located at the confluence of the Ganges and Son rivers which rose to prominence under the Mauryas and Guptas. During this period another important port was Champa on the Ganges in the Bhagalpur district. Kausambi was another port on the</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<hr />\r\n<h3>End of this Sample Book.</h3>\r\n\r\n<h3>Enjoyed the Preview?</h3>\r\n', 'History_of_Canals_in_Bengal.jpg', 'History_of_Canals_in_Bengal1.jpg', '', '', 'History_of_Canals_in_Bengal.pdf', 0),
(35, 'Patjhar', 'bengali', 17, '39', 'Hard cover', '100', '', '80', '60', '50', '40', 19, '2018-01-01', '', '18.5x13.5x1', 'মানসী কবিরাজের কবিতার প্রতিটি শব্দে তীক্ষ্ণ সামাজিক বিশ্লেষণ। কিন্তু তার সুর থাকে এক ছন্দে বাঁধা। ‘পতঝড়’ আমাদের নতুন করে, নতুন ভাবে চিন্তার রসদ জোগায়।', '64', '', '', 'Patjhar.jpg', '', '', '', '', 0),
(36, 'Care Kori Naa', 'bengali', 17, '39', 'Hard cover', '100', '', '80', '60', '50', '40', 20, '2018-01-01', '', '19x13x1.2', 'অভিরূপ দত্তের কবিতায় ছোটো ছোটো শব্দে আমরা মূল বিষয়বস্তুতে প্রবেশ করি। কবি প্রথাগত রোমান্টিকতাকে চ্যালেঞ্জ জানিয়েছেন বারবার। ভালোবাসার বিভিন্ন রূপকে কখনও নিপুন ছন্দমনস্কতায় কখনও বা তীক্ষ্ণ ভাষায় রচনা করেছেন। প্রেম, ভালোবাসা, স্নেহ, ঘৃণা, লোভ, লজ্জা মানুষের জীবনের প্রতিটি রিপুকে কবি নিজের কবিতার সুন্দরভাবে ফুটিয়ে তুলেছেন।', '64', '', '', 'Care_Kori_Naa.jpg', '', '', '', '', 0),
(37, 'Mon Kemoner Bigyapan', 'bengali', 17, '39', 'Hard cover', '100', '', '80', '60', '50', '40', 20, '2019-02-18', '978-8193954430', '19.1 x 13 x 1.2 cm', 'ভালো নেই, কেউ ভালো নেই…অভিরূপ দত্তর কবিতার প্রতিটি অক্ষরে ফুটে উঠেছে প্রেম, বিরহ, আবেগ, বিশ্বাস, অবিশ্বাসের মতো সূক্ষ্ম অনুভূতিগুলো। যেখানে নামহীন ভালোবাসা অন্যের ভালো থাকাতে নিজের সুখ খুঁজে পায়। যেখানে চাওয়া-পাওয়া সমীকরণে, দ্বিধাদ্বন্দ্বের টানাপোড়েনে ভালোবাসাকেও শুষ্ক মনে হয়। চাওয়া-পাওয়ার এক অদ্ভুত দোলাচল নিয়েই ‘মন কেমনের বিজ্ঞাপন’, যা প্রত্যেক পাঠকের মন ছুঁয়ে যাবে বলে আশা করা যায়।', '64', '', '', 'Mon.jpg', 'Mon1.jpg', '', '', '', 0),
(38, ' Chewinggum', 'bengali', 11, '10', 'Paperback', '150', '', '120', '60', '50', '40', 1, '2018-02-08', '', '19x12x2.3', 'ছোটগল্পের সবথেকে বড় আকর্ষণ, তা শেষ হয়েও শেষ হয় না। আর এই গুনটি ভীষণভাবে ফুটে ওঠে সমীরকুমার মুখোপাধ্যায়ের লেখনীতে। মিষ্টতা থেকে তিক্ততা-- সম্পর্কের প্রতিটি স্তর খুব সূক্ষ্মভাবে বর্তমান তাঁর গল্পে। যেখানে প্রত্যেকেই নিজেকে খুঁজে পাবেন। এমনই কিছু গল্পের সংকলন \'চুয়িংগাম\'।', '378', '', '', 'Chewinggum.jpg', 'Chewinggum1.jpg', '', '', '', 0),
(39, 'Prio O Natun Bari', 'bengali', 11, '10', 'Hard cover', '100', '', '80', '60', '50', '40', 21, '2018-02-05', '', '18x11x1', 'একটি বাড়িকে কেন্দ্র করে বাবা ও ছোট্ট সুমির গল্প ‘প্রিয় ও নতুন বাড়ি’। এই গল্পে সম্পর্কের নানান দিক খুব সুন্দরভাবে ফুটিয়ে তোলা হয়েছে। ছোট থেকে বড় হয়ে ওঠার সময় চারপাশের মানুষ তাদের ভালোবাসা, ঘৃণা, লোভ সুমির মনকে ভীষণভাবে নাড়া দেয়। এই সংসারকে সে নতুনভাবে আবিষ্কার করে। সুমির চোখ দিয়ে লেখক যেন তারই গল্প বুনেছেন।', '159', '', '', 'Prio_O_Natun_Bari.jpg', 'Prio_O_Natun_Bari1.jpg', '', '', '', 0),
(40, 'Benarasi', 'bengali', 11, '10', 'Hard cover', '100', '', '80', '60', '50', '40', 9, '2018-08-22', '978-8193890240', '19.1 x 13 x 1 cm', 'একটি মেয়ের জীবনে বেনারসি শুধু শাড়ি নয়, প্রতীক ভালোবাসার, বিশ্বাসের। কিন্তু প্রিয়ার কাছে এর অর্থ সম্পূর্ণ ভিন্ন। তাঁকে প্রতিটা মুহূর্ত লড়াই করে যেতে হয় নিজের বেনারসি, নিজের বিশ্বাস, নিজের পরিবারকে বাঁচিয়ে রাখতে। সমাজ, রাজনীতির আবর্তে একটি মেয়ের একক লড়াইয়ের গল্প \'বেনারসি\'।', '96', '', '', 'Benarasi2.jpg', 'Benarasi11.jpg', '', '', '', 0),
(41, 'B-52', 'bengali', 11, '10', 'Hard cover', '125', '', '100', '60', '50', '40', 9, '2018-02-05', '', '19.1 x 13 x 1.5 cm', 'তুষার চক্রবর্তীর ছোটগল্পের সঙ্গে যারা পরিচিত B-52 তাঁদের এক নতুন খোঁজ দেবে। আর যারা নতুনভাবে পরিচিত হবেন, তাঁদের জন্যও থাকছে এক নতুন শব্দ ‘ভয়’। ভয় পায় না এমন মানুষ আমাদের চারপাশে খুব কমই আছেন। রাতের অন্ধকারে অনেক সময় নিজের নিঃশ্বাসকেও ভয় হয়। তাই প্রেম, ভালবাসা, বন্ধুত্বের পাশাপাশি এই সংকলনে আপনার সঙ্গী হোক ভয়।', '181', '', '', 'B-52.jpg', 'B-52_Copy.jpg', '', '', '', 0),
(42, 'Bachelor\'s Diary', 'bengali', 11, '10', 'Paperback', '150', '', '120', '60', '50', '40', 23, '2017-07-22', '', '18x11x0.5', 'গ্রীষ্মের দাবদাহের পর বর্ষা যেভাবে নতুন প্রাণ সঞ্চার করে, রাজীব বেরার গল্পগুলিও ঠিক তেমন। যেখান থেকে অচিরেই বুকভরা টাটকা অক্সিজেন পাওয়া যায়। ‘Bachelor’s Diary’-র ২০ টি গল্পের মধ্যে আমরা যুব মনের বিভিন্ন শেড খুঁজে পাই। হাসি, কান্না, প্রেম, বিচ্ছেদ, সুখ, দুঃখের এক নতুন সমীকরণ খুঁজে বের করেছেন রাজীব- যা পাঠক, মনে ভিন্ন চিন্তার রসদ জোগাবে। আর এখানেই একজন গল্পকারের সাফল্য।', '88', '', '', 'Bachelor_diary.jpg', 'Bachelor_diary1.jpg', '', '', '', 0),
(43, 'Birchi', 'bengali', 11, '10', 'Hard cover', '250', '', '200', '60', '10', '4', 9, '2017-07-22', '', '22x14x1', 'বিড়চি শুধুমাত্র দুমকার একটি মেয়ের নাম নয়। ভালোবাসার জন্য যারা জীবনের সবকিছু ত্যাগ করতে পারে তাদের প্রতিনিধি বিড়চি। গল্পকার তুষার চক্রবর্তী-র কলমে প্রেম-বিচ্ছেদ, আশা-নিরাশা, সাফল্য-ব্যর্থতার মতো শব্দগুলো বারবার ফিরে এসেছে এই সংকলনে। চোদ্দোটি ছোটোগল্পে লেখক মানবজীবনের নানান জটিল দিকগুলি সহজ ভাষায় ফুটিয়ে তুলেছেন। যা কোথাও গিয়ে সম্পর্কের সূক্ষ্ম দিকগুলির প্রতিবিম্বস্বরূপ।', '112', '', '', 'birchi.jpg', 'birchi1.jpg', '', '', '', 0),
(44, 'Trikonmiti', 'bengali', 11, '10', 'Paperback', '100', '', '80', '60', '50', '40', 23, '2018-02-08', '', '19x12x1', 'শ্রীজিতা, রিমি আর আয়েশা। এদের জীবন কিভাবে এক মেরুতে এসে দাঁড়ালো তারই আখ্যান ত্রিকোণমিতি। সমাজের এক আদিম প্রবৃত্তির বিরুদ্ধে তিন নারীর মরণপন লড়াইকে এই উপন্যাসের প্রতিটি পাতায় চিত্রিত করা হয়েছে। বঞ্চনা, অত্যাচার সহ্য করতে করতে, একসময় মনে হয় জীবন বুঝি এখানেই শেষ। আর ঠিক তখনই ফের একবার ঘুরে দাঁড়ানোর শেষ চেষ্টা। সফল হবে কি এই ত্রয়ী? তারই উত্তর লুকিয়ে রয়েছে ত্রিকোণমিতি জুড়ে।', '96', '', '', 'Trikonmiti.jpg', 'Trikonmiti1.jpg', '', '', '', 0),
(45, 'Benarasi', 'bengali', 11, '10', 'Hard cover', '100', '', '80', '60', '50', '40', 9, '2018-08-22', '978-8193890240', '19.1 x 13 x 1 cm', 'একটি মেয়ের জীবনে বেনারসি শুধু শাড়ি নয়, প্রতীক ভালোবাসার, বিশ্বাসের। কিন্তু প্রিয়ার কাছে এর অর্থ সম্পূর্ণ ভিন্ন। তাঁকে প্রতিটা মুহূর্ত লড়াই করে যেতে হয় নিজের বেনারসি, নিজের বিশ্বাস, নিজের পরিবারকে বাঁচিয়ে রাখতে। সমাজ, রাজনীতির আবর্তে একটি মেয়ের একক লড়াইয়ের গল্প \'বেনারসি\'।', '96', '', '', 'Benarasi.jpg', 'Benarasi1.jpg', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE `book_author` (
  `book_author_id` int(11) NOT NULL,
  `book_author_name` varchar(255) NOT NULL,
  `author_for` varchar(255) NOT NULL,
  `book_author_image` varchar(255) NOT NULL,
  `book_author_description` longtext NOT NULL,
  `book_author_status` int(11) NOT NULL DEFAULT 0,
  `display` enum('show','hide') NOT NULL DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`book_author_id`, `book_author_name`, `author_for`, `book_author_image`, `book_author_description`, `book_author_status`, `display`) VALUES
(1, 'Samirkumar Mukherjee', 'bengali', 'samir1.jpg', 'সাহিত্য সমালোচক, প্রাবন্ধিক, অনুবাদক সমীরকুমার মুখোপাধ্যায়ের জন্ম কলকাতার বাগবাজারে। দীর্ঘদিন কলেজে অধ্যাপনার সঙ্গে নিযুক্ত ছিলেন। কর্মজীবনের মধ্যেই তিনি কলকাতা বিশ্ববিদ্যালয় থেকে বাংলার কৃষি ব্যবস্থার ওপর গবেষণা করে Ph.D. ডিগ্রি অর্জন করেন। তাঁর গবেষনা-উত্তরকালে তিনি ‘From Permanent Settlement to Operation Barga’ গ্রন্থটি প্রকাশ করেন। সম্প্রতি তাঁর ‘Rise of Kleptocracy In India’, ‘ঈশ্বর…?’ বইগুলো পাঠকের প্রশংসা পেয়েছে। ', 0, 'hide'),
(3, 'Mahfuza Hilali', 'bengali', 'mahfuza_hilali.jpg', 'মাহফুজা হিলালী ১৯৭৬ সালের ১৪ জুন সিরাজগঞ্জের শাহজাদপুরে জন্মগ্রহণ করেন। তিনি মঞ্চনাটকে কাজ করছেন ২০ বছর ধরে। বর্তমানে তিনি ‘লোক নাট্যদল, সিদ্ধেশ্বরী, ঢাকা’-র নাট্যকর্মী। এ নাট্যদলের সম্পাদক মন্ডলীর সদস্য। শিক্ষাজীবনে তিনি ‘বাংলা সাহিত্যের ছাত্রী ছিলেন। ২০০৮ সালে ঢাকা বিশ্ববিদ্যালয় থেকে এম.ফিল. এবং ২০১৪ সালে একই বিশ্ববিদ্যালয় থেকে পিএইচ. ডি. অর্জন করেন। তিনি বাংলা একাডেমি প্রকাশিত ‘বিবর্তনমূলক বাংলা অভিধান’ এর গবেষক এবং সংকলক হিসেবে কাজ করেছেন। বাংলাদেশ এশিয়াটিক সোসাইটি-এর ‘এনসাইক্লোপিডিয়া অব বাংলাদেশ ওয়ার অব লিবারেশন’ প্রকল্পে  তথ্য সংগ্রাহক ও গবেষক পদে কাজ করেছেন। বর্তমানে তিনি ব্র্যাক বিশ্ববিদ্যালয়ে বাংলা ভাষা ও সাহিত্য বিষয়ের সহকারী অধ্যাপক। তার প্রকাশিত গবেষণামূলক বই ‘রবীন্দ্র-নাট্যে নারী’, ‘মানিক বন্দ্যোপাধ্যায়ের উপন্যাস : জীবন ও সমাজ’, ‘সাহিত্যের নানা মাত্রা’, ‘রাসসুন্দরী’; কবিতার বই ‘স্বীয় সঙ্গোপনে’; সাহিত্য-সমালোচনামূলক বই ‘রবীন্দ্রনাথ : স্ত্রীর পত্র’; নাটকের বই ‘রবীন্দ্রনাথ নিয়ে দুটি নাটক’, ‘তিনটি নাটক’; ইতিহাস বিষয়ক বই ‘মুক্তিযুদ্ধের কিশোর ইতিহাস : সিরাজগঞ্জ’। \r\n', 0, 'show'),
(4, 'Somendra Chandra Nandi', 'bengali', 'Somendra_Chandra_Nandi.jpg', 'বিশিষ্ট প্রাবন্ধিক, নাট্যকার ডঃ সোমেন্দ্রচন্দ্র নন্দী কাশিমবাজার রাজপরিবারে ৫ সেপ্টেম্বর ১৯২৮ সালে জন্মগ্রহণ করেন। কলকাতা বিশ্ববিদ্যালয় থেকে আধুনিক ইতিহাসে স্নাতকোত্তর। ১৯৮১ সালে রবীন্দ্রভারতী বিশ্ববিদ্যালয় থেকে পিএইচডি ডিগ্রি অর্জন করেন। ১৯৮২ সালে কলকাতা বিশ্ববিদ্যালয় থেকে ডিলিট অর্জন করেন। এশিয়াটিক সোসাইটির তাঁকে ফেলো নির্বাচন করে সম্মানিত করে। ছাত্রাবস্থা থেকেই ইতিহাসের প্রতি গভীর আগ্রহ। ইতিহাসের নানান দিক নিয়ে দীর্ঘদিন ধরে গবেষণা করে চলেছেন। ইতিহাসচর্চার পাশাপাশি নাটক নিয়েও তিনি দীর্ঘ সময় কাটিয়েছেন। তাঁর লেখা ইতিহাস ও নাটকের বহু বই বাংলা ও ইংরেজি ভাষায় প্রকাশিত, যা পাঠকের পাশাপাশি সমালোচকদেরও প্রশংসা অর্জন করেছে। যার মধ্যে ‘বন্দর কাশিমবাজার’ বিশেষভাবে জনপ্রিয়। এ ছাড়াও ‘বাংলা ঐতিহাসিক নাটক সমালোচনা’, ‘বাংলা নিঃশব্দ চলচ্চিত্র’, ‘Life and Times of Cantoo Baboo the Banian of Warren Hastings’, ‘History of the Cossimbazar Raj in the Nineteenth Century’ বইগুলি ডঃ নন্দীকে প্রাবন্ধিক হিসাবে প্রতিষ্ঠিত করেছে। এই বইগুলো শুধু পাঠক নয়, গবেষকদের ক্ষেত্রেও যথেষ্ট উপযোগী। ', 0, 'show'),
(5, 'Amitava Nag', 'english', 'Amitava_akash_nag.jpg', 'Amitava Nag is an independent film scholar and critic. He writes extensively on cinema for the last twenty years and  has  been a freelance critic for The Hindu, OUTLOOK, News18, The Statesman, Himal Magazine, Silhouette Film magazine to name some. Amitava has authored Satyajit Ray’s Heroes and Heroines, Beyond Apu: 20 Favourite Film roles of Soumitra Chatterjee, Reading the Silhouette: Collection of writings on selected Indian films, Smriti Sotta o Cinema and edits the film magazine Silhouette since 2001. \r\nHe also writes poetry and short fiction in Bengali and English for several magazines both national and international.\r\n\r\n', 0, 'show'),
(7, 'Samir Mukherjee', 'english', 'samir2.jpg', 'Literary critic, essayist, translator Samirkumar Mukherjee was born in Bagbazar, Calcutta. He was engaged in teaching in the college for a long time. During his career he did his Ph.D. in research on the agricultural system of Bengal from Calcutta University.  In the aftermath of his research, he published the book ‘From Permanent Settlement to Operation Barga’. Recently his books ‘Rise of Kleptocracy In India’, ‘Iswar...?’ Have been appreciated by the readers.', 0, 'show'),
(8, 'Arun Mukhopadhyay', 'bengali', 'Arun_mukhopadhyay.jpg', 'অরুন মুখোপাধ্যায়ের জন্ম ১৯৬৯ সালের ২৭ সেপ্টেম্বর। বর্ধমান বিশ্ববিদ্যালয় থেকে বাংলা সাহিত্যে স্নাতকোত্তর। পেশায় শিক্ষক। তাঁর শখ বিশেষ কোনও বিষয় নিয়ে গবেষণা, প্রয়োজনে ক্ষেত্রসমীক্ষআ ও ভ্রমণ। ইতিপূর্বে প্রকাশ পেয়েছে অনুলিখন ও সম্পাদনায় ক্ষেতনামা বাঙালী লেখকদের স্ত্রী-র মুখের কথা ‘আমার স্বামী’, ‘সেরা লেখিকাদের সেরা গল্প’,’১০০ বছরের সেরা হাসি’। পশ্চিমবঙ্গের শতবর্ষ অতিক্রান্ত গ্রন্থাগার গুলির ইতিবৃত্ত ‘এই বাংলার শতায়ু গ্রন্থাগার’ নামক গ্রন্থে লিপিবদ্ধ করেছেন। তাঁর একক সম্পাদনায় প্রকাশ পেয়েছে ‘বাংলার সেরা প্রবন্ধ’। রায়বাহাদুর প্রিয়নাথ মুখোপাধ্যায় প্রনীত ‘দারোগার দপ্তর’(দুই খণ্ড), শৈলবালা ঘোষজায়ার ‘সেরা পাঁচটি উপন্যাস’, ‘কল্লোল কবিতা ও গল্পসমগ্র’, ‘হিন্দুতীর্থ গয়া’, ‘হিন্দুতীর্থ কাশী-বারাণসী’, ‘কলকাতার ৫১ কালীবাড়ী’, ‘হিন্দুতীর্থ কামরূপ-কামাক্ষা’ তাঁর লেখা তীর্থভ্রমণ ও ধর্মবিষয়ক গ্রন্থ। কাজের স্বীকৃতি স্বরূপ ‘গজেন্দ্রকুমার মিত্র’ ও ‘সুমথনাথ ঘোষ’ স্মৃতি পুরস্কার প্রাপ্ত।', 0, 'show'),
(9, 'Tushar Chakrabarti', 'bengali', 'Tushar_Chakrabarti.jpg', 'তুষার চক্রবর্তীর জন্ম ১৯৬৬ সালের ১০ জুন, হাওড়ার বাকসারা গ্রামে। শিবপুর দীনবন্ধু কলেজ থেকে বি এস সি পাস করেন। কলেজে পড়ার সময় তিনি ছাত্র রাজনীতির সঙ্গে যুক্ত ছিলেন।  কস্ট একাউন্টেন্সি পড়তে পড়তেই গুজরাটের কান্ডলা পোর্ট ট্রাষ্টে চাকরি। বর্তমানে তিনি সরকারি চাকুরিরত। স্কুল জীবন থেকেই লেখালেখির অভ্যাস ছিল। বিভিন্ন ম্যাগাজিন ও স্মরণিকায় তিনি নিয়মিত লেখালেখি করতেন। মাঝে সাময়িক বিরতির পর আবার বিভিন্ন বৈদ্যুতিন মাধ্যমে গল্প, কবিতা প্রবন্ধ লিখতে শুরু করেন। তাঁর লেখা উপন্যাস ‘বেনারসি’,‘লালচে দাগ’, ‘Inqualab’, গল্প সংকলন ‘বিড়চি’, ‘ভূতের খোঁজে’,’ ‘B-52’, এবং কবিতা সংকলন ‘মুখোশ’ ইতিমধ্যেই পাঠকের প্রশংসা অর্জন করেছে। ত্রিনয়ণার খোঁজে (এসিপি নচিকেতা সিরিজ) লেখকের প্রথম রহস্য উপন্যাস।', 0, 'hide'),
(10, 'Pias Majid', 'bengali', 'Pias_Majid.jpg', '২১ ডিসেম্বর ১৯৮৪, বাংলাদেশের কুমিল্লা জেলায় জন্ম পিয়াস মজিদের। ইতিহাস বিষয়ে স্নাতক ও স্নাতকোত্তর। কবি, প্রাবন্ধিক, গল্পকার ও সম্পাদক। উল্লেখযোগ্য কবিতার বই- নাচপ্রতিমার লাশ, মারবেল ফলের মওসুম, কুয়াশা ক্যাফে, নিঝুম মল্লার, প্রেমপিয়ানো, গোলাপের নহবত, ক্ষুধা ও রেঁস্তোরার প্রতিবেশী, নির্ঘুম নক্ষত্রের নিশ্বাস। কবিতাকৃতি ও সাহিত্যকর্মের স্বীকৃতিস্বরূপ অর্জন করেছেন- এইচএসবিসি-কালি ও কলম সাহিত্য পুরস্কার, আদম তরুণ কবি সম্মাননা, সিটি-আনন্দ আলো পুরস্কার, শ্রীপুর সাহিত্য পরিষদ পুরস্কার, দাঁড়াবার জায়গা পুরস্কার, ব্র্যাক ব্যাংক-সমকাল সাহিত্য পুরস্কার, সমতটের কাগজ সম্মাননা, পদক্ষেপ পুরস্কার, ইতিকথা সম্মাননা, দিগন্তধারা পুরস্কার, মেদিনীপুর কলেজ প্রাক্তনী প্রদত্ত সংবর্ধনা।  পেশাজীবনে বাংলা একাডেমি, ঢাকা-য় কর্মরত। ', 0, 'hide'),
(11, 'Abdullah Khan', 'bengali', 'Abdulla_Khan.jpg', 'বিহারের মতিহারিতে আবদুল্লাহ খানের জন্ম। কর্মসূত্রে মুম্বাই নিবাসী আবদুল্লা একজন ঔপনাসিক, চিত্র নাট্যকার, সাহিত্য সমালোচক। ইতিমধ্যেই তাঁর লেখা Brooklyn Rail (New York), Wasafiri (London), The Hindu (India), The Daily Star (Bangladesh) এবং Friday Times (Pakistan)- এ প্রকাশিত হয়েছে। ‘Patna Blues’ তাঁর প্রথম উপন্যাস। যা ইতিমধ্যেই হিন্দি, ঊর্দূ, কানাড়া, মারাঠি, মালায়ালাম,তামিলে অনুবাদ হয়েছে। ‘আরিফ’ নামে যা এবার বাংলাতেও প্রকাশিত।', 0, 'hide'),
(12, 'Rangalal Bandopadhyay', 'bengali', 'Rangalal_Bandyopadhyay.jpg', 'রঙ্গলাল বন্দ্যোপাধ্যায়ের জন্ম ১৮২৭ সালে বর্ধমানের বাকুলিয়া গ্রামে। বাকুলিয়ার স্থানীয় পাঠশালা ও মিশনারী স্কুলে শিক্ষাশেষে হুগলি মহসিন কলেজে কিছুদিন পড়াশোনা করেন। \r\nকবি ঈশ্বরচন্দ্র গুপ্তের সাহায্যে ‘সংবাদ প্রভাকর’ পত্রিকায় তিনি সাহিত্য রচনা আরম্ভ করেন। ১৮৫৫ খ্রিস্টাব্দে প্রকাশিত এডুকেশন গেজেট পত্রিকার সহঃ-সম্পাদক ছিলেন। সেই সময়ের এডুকেশন গেজেটে তাঁর গদ্য এবং পদ্য দুই রকম রচনাই প্রকাশিত হত। ১৮৫২ সালে প্রকাশিত \'মাসিক সংবাদসাগর\' ও ১৮৫৬ সালে প্রকাশিত ‘সাপ্তাহিক বার্তাবহ\' পত্রিকা দুটোতে তিনি সম্পাদক হিসেবে দায়িত্ব পালন করেন।\r\nরঙ্গলাল বন্দ্যোপাধ্যায় মূলত স্বদেশপ্রেমিক কবিরূপে বিখ্যাত। তাঁর রচিত কাব্যগ্রন্থের মধ্যে উল্লেখযোগ্য পদ্মিনী উপাখ্যান, কর্মদেবী এবং শূরসুন্দরী। টডের অ্যানাল্‌স্‌ অফ রাজস্থান থেকে কাহিনীর অংশ নিয়ে তিনি পদ্মিনী উপাখ্যান রচনা করেন।  ১৮৭২ সালে কালিদাসের সংস্কৃত কুমারসম্ভব ও ঋতুসংহারের পদ্যানুবাদ করেছিলেন। তাঁর কলিকাতা কল্পলতা বইটি বাংলা ভাষায় সম্ভবত কলকাতার প্রথম পূর্ণাঙ্গ ইতিহাস। \r\n', 0, 'hide'),
(13, 'Pulekandu Sinha', 'bengali', 'Pulekandu_Sinha.jpg', 'লোকসংস্কৃতি গবেষক পুলকেন্দু সিংহের জন্ম ১৯৩৮ মুর্শিদাবাদের ভরতপুরে। তরুণ বয়স থেকেই লেখালেখির সূত্রপাত। মণীশ ঘটকের প্রভাবে লোকজীবন ও লোকশিল্পীদের অনুসন্ধান করে তাঁদের উপযুক্ত প্রশিক্ষণের ব্যবস্থা করেন। ঐতিহ্যকে অক্ষুন্ন রেখে তাদের নিয়ে সংগঠন, অনুষ্ঠান, গবেষণা, আলোচনা সহ বহুমুখী কাজে ব্রতী। ১৯৭৫ সালে মুর্শিদাবাদ ও পার্শ্ববর্তী জেলায় লোকশিল্পীদের একত্রিত করে লোকায়ত শিল্পী সংসদ গঠন ও সংগঠনের সম্পাদকের দায়িত্ব গ্রহণ। ১৯৬৬-৬৭ সালে বিশিষ্ট ব্যক্তিত্ব সুধী প্রধানের সঙ্গে পশ্চিমবঙ্গ সরকারের প্রযোজরায় বাংলার কবিগান তথ্যচিত্র তৈরিতে সহযোগিতা। ১৯৭৮-৭৯ সালে সুধী প্রধানের সঙ্গ যুগ্মভাবে রাজ্যসরকারের কাছে লোকসংস্কৃতি পর্ষদ গঠন ও সূচনাকাল থেকে এই কেন্দ্রের দায়িত্ব পালন করেছেন। বর্তমানে যা রাজ্য লোকসংস্কৃতি ও আদিবাসী সংস্কৃতি কেন্দ্র নামে পরিচিত। ১৯৭৮ সালে আকাদেমী অব ফোকলোর কর্তৃক ফেলোশিপ প্রাপ্ত।', 0, 'hide'),
(14, ' Biharilal Chakrabarty', 'bengali', 'Biharilal_Chakrabarty.jpg', '‘সারদামঙ্গল’ কবি বিহারীলাল চক্রবর্তীর শ্রেষ্ঠ কাব্য। এই কাব্যগ্রন্থটি প্রথম প্রকাশিত হয়েছিল \'আর্যদর্শন\' পত্রিকায়। প্রকাশকাল ১২৮৬ বঙ্গাব্দ (২৯ ডিসেম্বর ১৮৭৯ খ্রিস্টাব্দ)। আখ্যানকাব্য হলেও এর আখ্যানবস্তু সামান্যই। মূলত গীতিকবিতাধর্মী কাব্য এটি। রবীন্দ্রনাথ ঠাকুর এই কাব্য সম্পর্কে লিখেছেন, “সূর্যাস্তকালের সুবর্ণমণ্ডিত মেঘমালার মত সারদামঙ্গলের সোনার শ্লোকগুলি বিবিধরূপের আভাস দেয়। কিন্তু কোন রূপকে স্থায়ীভাবে ধারণ করিয়া রাখে না। অথচ সুদূর সৌন্দর্য স্বর্গ হইতে একটি অপূর্ণ পূরবী রাগিণী প্রবাহিত হইয়া অন্তরাত্মাকে ব্যাকুল করিয়া তুলিতে থাকে।”', 0, 'hide'),
(15, 'test', 'special', 'images_(2).jpg', 'test', 0, 'show'),
(16, 'Lopamudra Maitra Bajpai', 'english', 'Lopamudra_Maitra_Bajpai.jpg', 'Dr. Lopamudra Maitra Bajpai is a Visual Anthropologist, author and international columnist. She has been working with History, Intangible Cultural Heritage, Popular Culture and Communication for more than one and a half decades.  She is a graduate from Presidency College, Kolkata (now Presidency University), and completed her higher studies from Deccan College Post-graduate and research Institute and Symbiosis Institute of Media and Communication (SIMC), Pune and her PhD from University of Calcutta. She has been a university teacher at Symbiosis International University and has also been visiting professor at various universities across India and Sri Lanka. She was also recently deputed as Culture Specialist (Research) at SAARC Cultural Centre, Colombo, Sri Lanka and is a Research Grant Fellow of the India-Sri Lanka Foundation of the Indian High Commission, Sri Lanka. She has several international publications on intangible cultural heritage to her credit and continues to write for international columns. She has represented India across international platforms variously for her research.', 0, 'show'),
(17, 'Shoma A Chatterji', 'english', 'Shoma_Chatterji1.jpg', 'Shoma A Chatterji is a freelance journalist, film scholar and author of 25 books. She has won two National Film Awards, one for Best Writing on Cinema in 1991(Best Film Critic) and the other for Best Book on Cinema in 2002. She won the Bengal Film Journalists Association’s ‘Best Critic Award’ in 1998 and the  Bharat Nirman Award for excellence in journalism in 2004. In 2009–2010, she won a Special Award for ‘consistent writing on women\'s issues’ from UNFPA Laadli Media Awards (Eastern region). In 2010. She has been a jury member at many film festivals in India and abroad.', 0, 'show'),
(18, 'Himendusekhar Banerjee', 'english', 'Himendusekhar_Banerjee.jpg', 'Himendusekhar Banerjee was born at Narayanganj, near Dhaka, now in erstwhile Bangladesh and later shifted to Calcutta before the Partition of India. His father had a transferable job with whom he had to stay and thus, travelled far and wide across the region, experiencing life in rural Bengal; in mufassal towns of different districts where he grew up in the midst of pristine nature — rivers, trees, bushes, the open air and the simple folk. This led him to gather first-hand knowledge about the ways of life in rural Bengal which he later assimilated into his present research work.\r\nHe has been a teacher for almost four decades and eventually retired as a Selection-Grade Lecturer from Khudiram Bose Central College, Kolkata, affiliated to Calcutta University. He participated and read papers in several seminars, published articles and commentaries based on his research works. ‘History of Canals in Bengal’ is the product of his years’ labour. \r\n\r\n', 0, 'show'),
(19, 'Manasi Kabiraj', 'bengali', 'Manasi.jpg', 'মানসী কবিরাজ', 0, 'hide'),
(20, 'Abhirup Datta', 'bengali', 'Abhirup.jpg', 'অভিরূপ দত্ত', 0, 'hide'),
(21, 'Nipa Mukhopadhyay', 'bengali', 'Nipa.jpg', 'নীপা মুখোপাধ্যায়ের জন্ম ১৯৬৫ সালের ২৫ ডিসেম্বর দুর্গাপুরে। ইকোলজিতে এমএসসি। ২২ বছর ধরে শিক্ষাকতার সঙ্গে যুক্ত। লেখিকা পশুপ্রেমিক। অবসর সময়ে বাগানের পরিচর্চা ও গান শুনতে ভালবাসেন। ছোটবেলা থেকেই লেখালেখির শখ। বেশকিছু সাহিত্য পত্রিকায় লেখালেখি করেন। ‘প্রিয় ও নতুন বাড়ি’ লেখিকার প্রথম উপন্যাস।', 0, 'hide'),
(22, 'Pinaki Chakrabarti', 'bengali', 'Pinaaki.jpg', 'Pinaki', 0, 'hide'),
(23, 'Rajib Bera', 'bengali', 'Rajib.jpg', 'Rajib', 0, 'hide');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

CREATE TABLE `book_category` (
  `book_category_id` int(11) NOT NULL,
  `book_category_name` varchar(255) NOT NULL,
  `category_type` varchar(255) NOT NULL,
  `book_category_image` varchar(255) NOT NULL,
  `book_category_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`book_category_id`, `book_category_name`, `category_type`, `book_category_image`, `book_category_status`) VALUES
(10, 'FICTION', 'bengali', 'FICTION3.jpg', 0),
(16, 'NON FICTION', 'bengali', 'NON_FICTION2.jpg', 0),
(21, 'CHILDREN', 'bengali', 'CHILDREN1.jpg', 0),
(23, 'DRAMA', 'bengali', 'DRAMA1.jpg', 0),
(28, 'ACADEMIC', 'english', 'ACADEMIC.jpg', 0),
(31, 'PROFESSIONAL', 'english', 'PROFESSIONAL.jpg', 0),
(35, 'SELF HELP', 'english', 'SELF_HELP.jpg', 0),
(36, 'TRANSLATION', 'english', 'TRANSLATION.jpg', 0),
(37, 'LITERATURE AND FICTION', 'english', 'LITERATURE.jpg', 0),
(38, 'ART', 'english', 'ART.jpg', 0),
(39, 'POETRY', 'bengali', 'POETRY.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_submission`
--

CREATE TABLE `book_submission` (
  `book_submission_id` int(11) NOT NULL,
  `book_submission` longtext NOT NULL,
  `submission_status` int(22) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_submission`
--

INSERT INTO `book_submission` (`book_submission_id`, `book_submission`, `submission_status`) VALUES
(2, '<h1><big><sub>Manuscript Submission</sub></big></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><big>If you&rsquo;ve written something you think people must read, you&rsquo;re at the right place! We currently accept unsolicited work in Bangla and English across genres including fiction and non-fiction (adult and children&rsquo;s), biography, current affairs, and self-help. Please note that Doshor does not publish theses, unless the theses have been converted into a book form. Research work on the basis of thesis papers may also be considered.</big></p>\r\n\r\n<p><big>What do I need to submit?</big></p>\r\n\r\n<p><big>&middot; Please send in a detailed proposal of the work which should include a synopsis and the first three sample chapters. We will ask for the complete manuscript only if your proposal is under consideration.</big></p>\r\n\r\n<p><big>&middot; Content list or outline</big></p>\r\n\r\n<p><big>&middot; A short biography of the author.</big></p>\r\n\r\n<p><big>&middot; In the mail body, please include the following</big></p>\r\n\r\n<ol>\r\n	<li>\r\n	<p><big>Full name,</big></p>\r\n	</li>\r\n	<li>\r\n	<p><big>Email ID,</big></p>\r\n	</li>\r\n	<li>\r\n	<p><big>Contact number</big></p>\r\n	</li>\r\n</ol>\r\n\r\n<p><big>Where do I submit my work?</big></p>\r\n\r\n<p><big>&middot; Submit via email to <a href=\"mailto:doshorsubmission@gmail.com\">doshorsubmission@gmail.com</a></big></p>\r\n\r\n<p><big>Or via post. Address- Doshor Publications, C/2 Ramkrishna Upanibesh, Regent Estate, Jadavpore, Kolkata-700092</big></p>\r\n\r\n<p><big>&middot; All submissions should be typed up using legible font</big></p>\r\n\r\n<p><big>When do I hear back from you?</big></p>\r\n\r\n<p><big>&middot; Please allow 30 days for your proposal/manuscript to be considered.</big></p>\r\n\r\n<p><big>&middot; If you haven&rsquo;t heard from us after one month, please consider that we will not be moving ahead with your proposal or manuscript.</big></p>\r\n\r\n<p><big>&middot; Manuscripts will not be returned to the authors, irrespective of the outcome of the review process. Make sure that you retain a copy of your work.</big></p>\r\n\r\n<p><big>&middot; Doshor Publications is not responsible for any loss or damage of submitted work.</big></p>\r\n\r\n<p><big>&middot; If you wish to enquire about your manuscript, please email us a query.</big></p>\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_terms_conditoin`
--

CREATE TABLE `book_terms_conditoin` (
  `book_terms_conditoin_id` int(11) NOT NULL,
  `book_terms` varchar(255) NOT NULL,
  `terms_condition_status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_type`
--

CREATE TABLE `book_type` (
  `book_type_id` int(11) NOT NULL,
  `book_type` varchar(255) NOT NULL,
  `sequence` int(150) NOT NULL,
  `book_type_status` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_type`
--

INSERT INTO `book_type` (`book_type_id`, `book_type`, `sequence`, `book_type_status`) VALUES
(2, 'Doshor Trending', 1, '0'),
(3, 'Crossed Arrows Trending', 2, '0'),
(8, 'Just Released', 3, '0'),
(11, 'Fiction', 4, '0'),
(12, 'Non-Fiction', 5, '0'),
(13, 'Children', 7, '0'),
(14, 'Drama', 8, '0'),
(17, 'Poetry', 6, '0'),
(18, 'Academic', 9, '0'),
(19, 'Self Help', 11, '0'),
(20, 'Translation', 12, '0'),
(21, 'Literature and Fiction', 13, '0'),
(22, 'Art', 14, '0'),
(24, 'Professional', 10, '0');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_book_name` varchar(255) NOT NULL,
  `cart_book_language` varchar(11) NOT NULL,
  `cart_book_price` varchar(255) NOT NULL,
  `cart_book_quantity` varchar(255) NOT NULL,
  `cart_book_total_price` varchar(255) NOT NULL,
  `cart_deleviry_price` varchar(11) NOT NULL,
  `cart_book_type` varchar(255) NOT NULL,
  `cart_user_id` varchar(255) NOT NULL,
  `cart_status` varchar(255) NOT NULL,
  `cart_book_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_book_name`, `cart_book_language`, `cart_book_price`, `cart_book_quantity`, `cart_book_total_price`, `cart_deleviry_price`, `cart_book_type`, `cart_user_id`, `cart_status`, `cart_book_id`) VALUES
(1, 'Birchi', '', '200', '1', '200', '60', '', '1', '1', '43'),
(2, 'B-52', '', '100', '3', '300', '180', '', '1', '1', '41'),
(3, 'Stories of the Colonial architecture', '', '280', '1', '280', '60', '', '1', '11', '30');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_phone` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_address` varchar(255) NOT NULL,
  `contact_status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_id`, `contact_name`, `contact_phone`, `contact_email`, `contact_address`, `contact_status`) VALUES
(1, 'Doshor Publications', '7044189253', 'team.doshor@gmail.com', 'C/2 Ramkrishna Upanibesh, \r\nRegent Estate, Kolkata-700092', 0);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `delivery_address_id` int(11) NOT NULL,
  `delivery_user_id` varchar(255) NOT NULL,
  `delivery_first_name` varchar(255) NOT NULL,
  `delivery_last_name` varchar(255) NOT NULL,
  `delivery_address_details` varchar(255) NOT NULL,
  `delivery_district` varchar(255) NOT NULL,
  `delivery_state` varchar(255) NOT NULL,
  `delivery_pincode` varchar(255) NOT NULL,
  `delivery_mobile_no` varchar(255) NOT NULL,
  `delivery_locality` varchar(255) NOT NULL,
  `delivery_landmark` varchar(255) NOT NULL,
  `delivery_alternative_mobile_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`delivery_address_id`, `delivery_user_id`, `delivery_first_name`, `delivery_last_name`, `delivery_address_details`, `delivery_district`, `delivery_state`, `delivery_pincode`, `delivery_mobile_no`, `delivery_locality`, `delivery_landmark`, `delivery_alternative_mobile_no`) VALUES
(1, '1', 'Swapan', 'Kanrar', '15\'1 russa road 3rd lane ', 'kol', 'west bengal', '7114546', '12345697890', 'nmv', 'nmv', '');

-- --------------------------------------------------------

--
-- Table structure for table `how_to_order`
--

CREATE TABLE `how_to_order` (
  `how_to_order_id` int(11) NOT NULL,
  `text_editor` longtext NOT NULL,
  `how_to_order_status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `library`
--

CREATE TABLE `library` (
  `library_id` int(11) NOT NULL,
  `library_user_id` varchar(255) NOT NULL,
  `library_book_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `library`
--

INSERT INTO `library` (`library_id`, `library_user_id`, `library_book_id`) VALUES
(1, '78', '28'),
(2, '88', '28'),
(3, '88', '31'),
(4, '80', '31');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(11) NOT NULL,
  `order_book_name` varchar(255) DEFAULT NULL,
  `order_book_price` varchar(255) DEFAULT NULL,
  `order_book_quantity` varchar(255) DEFAULT NULL,
  `order_book_total_price` varchar(255) DEFAULT NULL,
  `order_delivery_price` varchar(255) NOT NULL,
  `order_book_type` varchar(11) NOT NULL,
  `order_user_id` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL COMMENT 'o=pending,1=deliverd,2=cancel',
  `order_date` varchar(255) DEFAULT NULL,
  `order_delivery_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `payment_id`, `product_id`, `order_book_name`, `order_book_price`, `order_book_quantity`, `order_book_total_price`, `order_delivery_price`, `order_book_type`, `order_user_id`, `order_status`, `order_date`, `order_delivery_date`) VALUES
(1, '1', '11', 'Natyorabi ', '450', '1', '510', '60', '14', '1', '0', '20-09-20', '30-09-20'),
(2, '1', '11', 'Natyorabi ', '450', '1', '510', '60', '14', '1', '1', '20-09-20', '30-09-20'),
(3, '1', '11', 'Natyorabi ', '450', '1', '510', '60', '14', '1', '2', '20-09-20', '30-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `address_id` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `payment_id` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `amount` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `address_id`, `payment_id`, `amount`) VALUES
(1, '1', '1', 'pay_FMB7vcftOu9zGO', '260.0');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_package`
--

CREATE TABLE `subscription_package` (
  `subscription_package_id` int(11) NOT NULL,
  `suubscription_package_name` varchar(255) NOT NULL,
  `subscription_time` varchar(255) NOT NULL,
  `subscription_price` varchar(255) NOT NULL,
  `subcription_pac_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_user`
--

CREATE TABLE `subscription_user` (
  `subscription_id` int(11) NOT NULL,
  `subscription_price` varchar(255) NOT NULL,
  `subscription_start_date` varchar(255) NOT NULL,
  `subscription_end_date` varchar(255) NOT NULL,
  `subscription_package_name` varchar(255) NOT NULL,
  `subscription_user_id` varchar(255) NOT NULL,
  `subscription_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uploutlets`
--

CREATE TABLE `uploutlets` (
  `uploutlets_id` int(11) NOT NULL,
  `uploutlets_text` longtext NOT NULL,
  `uploutlets_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploutlets`
--

INSERT INTO `uploutlets` (`uploutlets_id`, `uploutlets_text`, `uploutlets_status`) VALUES
(4, '<h3><big>&nbsp; &nbsp;Doshor Bookstore&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</big></h3>\r\n\r\n<p><big>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Doshor Publications</big></p>\r\n\r\n<p><big>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; C/2, Ramkrishna Upanibesh</big></p>\r\n\r\n<p><big>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Jadavpore, Kolkata-92</big></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3><big>&nbsp; &nbsp; Other Outlets&nbsp;&nbsp;</big></h3>\r\n\r\n<ul>\r\n	<li>Dey&#39;s Publishing- College Street</li>\r\n	<li>Dey Book Store (Dipu)-&nbsp;College Street</li>\r\n	<li>Dey Book Store (Adi)-&nbsp;College Street</li>\r\n	<li>Storyteller Bookstore- EM bypaas</li>\r\n</ul>\r\n\r\n<h2>&nbsp; &nbsp; &nbsp; &nbsp;Online</h2>\r\n\r\n<h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<a href=\"https://www.doshor.com/\" target=\"_blank\">doshor.com</a></h3>\r\n\r\n<h3>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href=\"https://www.amazon.in/s?k=doshor&amp;ref=nb_sb_noss\" target=\"_blank\">amazon.in</a></h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<p>&nbsp;</p>\r\n', 0),
(8, '<p>abcfgvfgfg</p>\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(255) NOT NULL,
  `user_last_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone_no` varchar(255) NOT NULL,
  `user_subscription_status` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_phone_no`, `user_subscription_status`, `user_password`) VALUES
(1, 'Swapan', 'Kanrar', 'swapan.kanrar143@gmail.com', '9732954177', '', '4297f44b13955235245b2497399d7a93');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_logo`
--
ALTER TABLE `admin_logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `admin_stock`
--
ALTER TABLE `admin_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_author`
--
ALTER TABLE `book_author`
  ADD PRIMARY KEY (`book_author_id`);

--
-- Indexes for table `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`book_category_id`);

--
-- Indexes for table `book_submission`
--
ALTER TABLE `book_submission`
  ADD PRIMARY KEY (`book_submission_id`);

--
-- Indexes for table `book_terms_conditoin`
--
ALTER TABLE `book_terms_conditoin`
  ADD PRIMARY KEY (`book_terms_conditoin_id`);

--
-- Indexes for table `book_type`
--
ALTER TABLE `book_type`
  ADD PRIMARY KEY (`book_type_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`delivery_address_id`);

--
-- Indexes for table `how_to_order`
--
ALTER TABLE `how_to_order`
  ADD PRIMARY KEY (`how_to_order_id`);

--
-- Indexes for table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`library_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_package`
--
ALTER TABLE `subscription_package`
  ADD PRIMARY KEY (`subscription_package_id`);

--
-- Indexes for table `subscription_user`
--
ALTER TABLE `subscription_user`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `uploutlets`
--
ALTER TABLE `uploutlets`
  ADD PRIMARY KEY (`uploutlets_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_logo`
--
ALTER TABLE `admin_logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_stock`
--
ALTER TABLE `admin_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
  MODIFY `book_author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `book_category`
--
ALTER TABLE `book_category`
  MODIFY `book_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `book_submission`
--
ALTER TABLE `book_submission`
  MODIFY `book_submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `book_terms_conditoin`
--
ALTER TABLE `book_terms_conditoin`
  MODIFY `book_terms_conditoin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_type`
--
ALTER TABLE `book_type`
  MODIFY `book_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `delivery_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `how_to_order`
--
ALTER TABLE `how_to_order`
  MODIFY `how_to_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `library`
--
ALTER TABLE `library`
  MODIFY `library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `subscription_package`
--
ALTER TABLE `subscription_package`
  MODIFY `subscription_package_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_user`
--
ALTER TABLE `subscription_user`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uploutlets`
--
ALTER TABLE `uploutlets`
  MODIFY `uploutlets_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
