-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2016 at 05:25 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `synopsis` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `publisher_id` int(10) unsigned NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `synopsis`, `description`, `category_id`, `publisher_id`, `photo`, `created_at`, `updated_at`) VALUES
(3, 'Kambing Jantan', 'Kambing Jantan merupakan film Indonesia yang dirilis pada 5 Maret 2009. Film ini dibintangi antara lain oleh Raditya Dik', 'Selepas SMU, Dika (Raditya Dika), yang mempunyai nama panggilan Kambing, harus melanjutkan pendidikan di Adelaide, Australia, mengambil gelar finance yang tidak sesuai minatnya. Maka diakhirilah perjalanan hidup Dika mencari jati diri.\r\n\r\nKetika dia menjalani kuliah di Australia, problema timbul dengan Kebo (Herfiza Novianti), pacarnya, karena harus menjalani Long Distance Relationship (LDR) yang menyebabkan pengeluaran keuangan sangat besar, komunikasi yang terganggu, dan kehidupan kuliah yang semakin lama membuat mereka menjadi berbeda.\r\n\r\nProblem lainnya seperti bagaimana Dika mengalami kesulitan dalam belajar, dan kemunculan Jenny Dickson, dosen bule yang lebih mirip tentara wanita, menambah dilema si Kambing dalam menyelesaikan masalah LDR dan finance (dalam dua arti sebenarnya: kebutuhan finance-nya dan sekolah finance-nya).\r\n\r\nPertemuannya dengan seorang teman SD yang membaca blog Dika berjudul “Kambingjantan” membuka pikirannya bahwa dia bisa saja jadi penulis komedi.', 1, 1, '220px-Kambing_Jantan_The_Movie-003.jpg', '2016-04-22 07:10:29', '2016-04-22 07:10:29'),
(6, 'Cinta Brontosauruss', 'Cinta Brontosaurus adalah film drama Indonesia tahun 2013. Film ini dirilis pada tanggal 8 Mei 2013.', 'Dika (Raditya Dika) adalah seorang penulis yang baru saja putus cinta dengan Nina (Pamela Bowie), pacarnya setelah sekian lama. Semenjak putus cinta ini, dia percaya bahwa cinta bisa kadaluarsa. Kosasih (Soleh Solihun), agen naskah Dika, mencoba untuk membuat Dika yakin terhadap cinta kembali, seperti Kosasih yakin dengan istrinyanya Wanda (Tyas Mirasih). Usaha ini, membawa Dika ke dalam serangkaian perkenalan absurd.\r\n\r\nNamun, cinta bisa datang tanpa persiapan. Seperti saat Dika bertemu dengan Jessica (Eriska Rein), seorang perempuan yang jalan pikirannya sama anehnya dengan Dika. Semakin Dika kenal dengan Jessica, semakin dia bertanya: apa benar cinta bisa kadaluarsa?\r\n\r\nDi sisi yang lain, Mr. Soe Lim (Ronny P. Tjandra), menawarkan untuk memfilmkan buku Dika, yang berjudul Cinta Brontosaurus. Tertarik, Dika berusaha untuk menulis skrip film tersebut. Masalah mulai timbul ketika di tengah jalan, Mr. Soe Lim mencoba untuk mengubah naskah asli Dika menjadi film horror yang sedang laku.\r\n\r\nFilm ini adalah perjalanan Dika untuk memahami cinta, yang justru dia dapatkan dari pengalamannya bersama Jessica, teman, dan keluarganya sendiri.', 7, 1, 'Cinta Brontosaurus Movie.jpeg', '2016-04-22 08:05:50', '2016-04-22 08:22:39');

-- --------------------------------------------------------

--
-- Table structure for table `book_keyword`
--

CREATE TABLE IF NOT EXISTS `book_keyword` (
  `book_id` int(10) unsigned NOT NULL,
  `keyword_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_keyword`
--

INSERT INTO `book_keyword` (`book_id`, `keyword_id`) VALUES
(3, 5),
(3, 9),
(3, 10),
(6, 2),
(6, 3),
(6, 5),
(6, 9),
(6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `book_writer`
--

CREATE TABLE IF NOT EXISTS `book_writer` (
  `book_id` int(10) unsigned NOT NULL,
  `writer_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_writer`
--

INSERT INTO `book_writer` (`book_id`, `writer_id`) VALUES
(3, 1),
(6, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Novel', '2016-04-20 17:00:00', '2016-04-22 00:20:13'),
(2, 'Majalah', '2016-04-21 23:20:11', '2016-04-22 00:20:17'),
(4, 'Buku Resep', '2016-04-22 00:20:45', '2016-04-22 00:31:59'),
(5, 'LKS Sekolah', '2016-04-22 00:20:47', '2016-04-22 00:23:19'),
(6, 'Sains', '2016-04-22 00:21:06', '2016-04-22 00:21:06'),
(7, 'Buku Pemrograman', '2016-04-22 00:21:13', '2016-04-22 00:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sekolah', '2016-04-22 13:38:17', '2016-04-22 13:38:17'),
(2, 'buku', '2016-04-22 13:38:17', '2016-04-22 13:38:17'),
(3, 'misteri', '2016-04-22 13:38:17', '2016-04-22 13:38:17'),
(4, 'pelajaran', '2016-04-22 13:38:17', '2016-04-22 13:38:17'),
(5, 'lucu', '2016-04-22 13:38:17', '2016-04-22 13:38:17'),
(6, 'humor', '2016-04-22 13:38:17', '2016-04-22 13:38:17'),
(7, 'sains', '2016-04-22 13:38:17', '2016-04-22 13:38:17'),
(9, 'funny', '2016-04-22 07:10:29', '2016-04-22 07:10:29'),
(10, 'story of my life', '2016-04-22 07:10:29', '2016-04-22 07:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_04_21_000000_create_categories_table', 1),
('2016_04_21_000000_create_keywords_table', 1),
('2016_04_21_000000_create_publishers_table', 1),
('2016_04_21_000000_create_writers_table', 1),
('2016_04_21_000001_create_books_table', 1),
('2016_04_21_000002_create_book_keywords_table', 1),
('2016_04_21_000002_create_book_writers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE IF NOT EXISTS `publishers` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `address`, `phone`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Gramedia', 'Jakarta', '-', '-', '2016-04-22 01:59:24', '2016-04-22 01:59:24'),
(2, 'Tiga Aksara', 'Surabaya', '021013100', '-', '2016-04-22 01:59:40', '2016-04-22 01:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@library.com', '$2y$10$1jhUcJAI9deHDMJGSKEeRegyfzaj71TAcJIO6f3X8nKH3x5Ol1ZVu', 'TJy9WTOzti2AXLyCIaWIRLPLstCduknSsp4W8cvYoPEzzrsNv7YMZHMiYj1Q', '2016-04-21 05:49:53', '2016-04-22 08:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `writers`
--

CREATE TABLE IF NOT EXISTS `writers` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `writers`
--

INSERT INTO `writers` (`id`, `name`, `address`, `phone`, `photo`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Raditya Dika', 'Jalan pelan pelan banyak anak kecil', '085755516675', 'download.jpg', 'Penulis buku dan juga stand up comedian', '2016-04-22 01:14:50', '2016-04-22 01:16:59'),
(2, 'Dewi Lestari', 'Jakarta', '-', 'download (1).jpg', 'ewi Lestari Simangunsong yang akrab dipanggil Dee (lahir di Bandung, Jawa Barat, 20 Januari 1976; umur 38 tahun) adalah seorang penulis dan penyanyi asal Indonesia. Dee pertama kali dikenal masyarakat sebagai anggota trio vokal Rida Sita Dewi. Ia merupakan alumnus SMA Negeri 2 Bandung dan lulusan Universitas Parahyangan, jurusan Hubungan Internasional. Sejak menerbitkan novel Supernova yang populer pada tahun 2001, ia kemudian dikenal luas sebagai novelis.', '2016-04-22 01:20:17', '2016-04-22 01:20:17'),
(3, 'Andrea Hirata', 'Jalan Patimura 1', '085712681711', 'download (2).jpg', 'ndrea Hirata terlahir dengan nama Aqil Barraq Badruddin Seman Said Harun (lahir di Belitung, 24 Oktober 1976; umur 38 tahun) adalah novelis yang telah merevolusi sastra Indonesia. Ia berasal dari Pulau Belitung, provinsi Bangka Belitung. Novel pertamanya adalah Laskar Pelangi.', '2016-04-22 01:22:05', '2016-04-22 01:59:03'),
(4, 'Mira Widjaja', 'Jalan Mawar 10 RT 01 RW 01', '-', 'download (3).jpg', 'Mira Widjaja (Wong), atau lebih dikenal dengan nama pena Mira W. (lahir 13 September 1951; umur 63 tahun), adalah novelis Indonesia. \r\nTerlahir dari keluarga keturunan Tionghoa, ia dikenal sebagai salah satu penulis novel-novel roman populer di Indonesia. \r\nAyahnya, Othniel, adalah pelopor industri perfilman di Indonesia. Mira menulis novel dengan berbagai genre, termasuk roman, kriminal, dan kehidupan rumah sakit. Ia berprofesi sebagai dokter sebelum menjadi penulis', '2016-04-22 01:23:03', '2016-04-22 02:35:58'),
(5, 'Habiburrahman El Shirazy', '-', '-', 'download (4).jpg', 'Habiburrahman El Shirazy(lahir di Semarang, Jawa Tengah, 30 September 1976; umur 38 tahun) adalah novelis nomor. 1 Indonesia dinobatkan oleh Insani Universitas Diponegoro. Selain novelis, sarjana Universitas Al-Azhar, Kairo, Mesir ini juga dikenal sebagai sutradara, dai, dan penyair. Karya-karyanya banyak diminati tak hanya di Indonesia, tapi juga di mancanegara seperti Malaysia, Singapura, Brunei, Hongkong, Taiwan dan Australia. Karya-karya fiksinya dinilai dapat membangun jiwa dan menumbuhkan semangat berprestasi pembaca. Di antara karya-karyanya yang telah beredar di pasaran adalah Ayat-Ayat Cinta (telah dibuat versi filmnya, 2004), Di Atas Sajadah Cinta (telah disinetronkan Trans TV, 2004), Ketika Cinta Berbuah Surga (2005), Pudarnya Pesona Cleopatra (2005), Ketika Cinta Bertasbih (2007), Ketika Cinta Bertasbih 2 (Desember, 2007) Dalam Mihrab Cinta (2007), Bumi Cinta, (2010) dan The Romance. Kini sedang merampungkan Langit Makkah Berwarna Merah, Bidadari Bermata Bening, dan Bulan Madu di Yerussalem.', '2016-04-22 01:24:11', '2016-04-22 01:24:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
 ADD PRIMARY KEY (`id`), ADD KEY `books_category_id_foreign` (`category_id`), ADD KEY `books_publisher_id_foreign` (`publisher_id`);

--
-- Indexes for table `book_keyword`
--
ALTER TABLE `book_keyword`
 ADD KEY `book_keywords_book_id_foreign` (`book_id`), ADD KEY `book_keywords_keyword_id_foreign` (`keyword_id`);

--
-- Indexes for table `book_writer`
--
ALTER TABLE `book_writer`
 ADD KEY `book_writers_book_id_foreign` (`book_id`), ADD KEY `book_writers_writer_id_foreign` (`writer_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `writers`
--
ALTER TABLE `writers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `writers`
--
ALTER TABLE `writers`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
ADD CONSTRAINT `books_publisher_id_foreign` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `book_keyword`
--
ALTER TABLE `book_keyword`
ADD CONSTRAINT `book_keywords_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_keywords_keyword_id_foreign` FOREIGN KEY (`keyword_id`) REFERENCES `keywords` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_writer`
--
ALTER TABLE `book_writer`
ADD CONSTRAINT `book_writers_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_writers_writer_id_foreign` FOREIGN KEY (`writer_id`) REFERENCES `writers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
