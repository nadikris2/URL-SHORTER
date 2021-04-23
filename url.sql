

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `url` (
  `id` int(40) NOT NULL,
  `shorten_url` varchar(500) NOT NULL,
  `full_url` varchar(2000) NOT NULL,
  `clicks` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `url`
  ADD PRIMARY KEY (`id`);



ALTER TABLE `url`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;
