SET time_zone = "+05:30";


--
-- Database: `tupperware`
--

-- --------------------------------------------------------

--
-- Table structure for table `harshamonsoon2023`
--

CREATE TABLE `harshamonsoon2023` (
  `id` int(11) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_mail` varchar(150) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_city` varchar(100) NOT NULL,
  `interested_store` varchar(100) NOT NULL,
  `utm_source` varchar(100) NOT NULL,
  `utm_medium` varchar(100) NOT NULL,
  `utm_campaign` varchar(100) NOT NULL,
  `submittime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `harshamonsoon2023`
  ADD PRIMARY KEY (`id`)


ALTER TABLE `harshamonsoon2023`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
COMMIT;