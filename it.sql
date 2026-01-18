CREATE DATABASE IF NOT EXISTS `it` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE `it`;

CREATE TABLE IF NOT EXISTS `offers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL DEFAULT 0,
  `category` varchar(50) NOT NULL DEFAULT 'phone',
  `location` varchar(120) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `stock` int NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `offer_id` int NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_booking_offer` FOREIGN KEY (`offer_id`) REFERENCES `offers`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `offers` (`title`, `description`, `price`, `category`, `location`, `start_date`, `end_date`, `image_url`, `featured`, `stock`) VALUES
('PhoneX X1 Pro 5G', '6.7" AMOLED, 256 GB tárhely, 108 MP kamera, 120W gyorstöltés', 329990, 'phone', 'Budapest és online', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=900&q=80', 1, 12),
('PhoneX Air Mini', 'Kompakt 6.1" kijelző, 128 GB tárhely, 2 napos üzemidő', 199990, 'phone', 'Online', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1510552776732-03e61cf4b144?auto=format&fit=crop&w=900&q=80', 0, 22),
('PhoneX Shield MagSafe tok', 'Cseppálló, ütéselnyelő, mágneses tartozék-kompatibilis védelem', 12990, 'accessory', 'Raktáron', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=900&q=80', 1, 55),
('PhoneX Charge 45W GaN', 'Kompakt gyorstöltő két USB-C porttal', 16990, 'accessory', 'Raktáron', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1523968044756-39c9b1056ac3?auto=format&fit=crop&w=900&q=80', 0, 34),
('PhoneX Sound ANC Pro', 'Aktív zajszűrős fülhallgató, 30 óra üzemidő', 49990, 'accessory', 'Budapest', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&w=900&q=80', 1, 18),
('PhoneX Phone Ultra Zoom', 'Periszkópos kamera 5× optikai zoommal, 512 GB tárhely', 389990, 'phone', 'Budapest és online', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1491933382434-500287f9b54b?auto=format&fit=crop&w=900&q=80', 0, 8),
('PhoneX Glass kijelzővédő 2-pack', 'Karcolás- és ütésálló üveg, egyszerű felhelyező kerettel', 6990, 'accessory', 'Raktáron', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=900&q=80', 0, 80),
('PhoneX Dock vezeték nélküli töltő', '15W Qi, álló és fekvő mód, LED értesítés nélkül', 21990, 'accessory', 'Raktáron', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=900&q=80', 0, 41),
('PhoneX Phone Neo Lite', '6.4" OLED, 8 GB RAM, 256 GB tárhely, 66W gyorstöltés', 249990, 'phone', 'Online', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1512499617640-c2f999098c01?auto=format&fit=crop&w=900&q=80', 0, 30),
('PhoneX Phone Fold Infinity', 'Hajlítható 7.8" belső kijelző, ceruza támogatás, 1 TB tárhely', 529990, 'phone', 'Budapest és online', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=900&q=80', 1, 6),
('PhoneX Buds Lite', 'Bluetooth 5.3, 28 óra üzemidő, alacsony késleltetés gaming mód', 24990, 'accessory', 'Raktáron', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=900&q=80', 0, 70),
('PhoneX Shield Armor tok', 'Katonai szabványú ütésvédelem, integrált csuklópánt', 14990, 'accessory', 'Raktáron', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=900&q=80', 0, 65),
('PhoneX Charge 65W GaN Duo', 'Két USB-C, PPS, kompakt utazóadapter, több ország csatlakozóval', 22990, 'accessory', 'Raktáron', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1523968044756-39c9b1056ac3?auto=format&fit=crop&w=900&q=80', 1, 50),
('PhoneX Power Bank 20K PD', '20 000 mAh, 45W PD, kétirányú töltés, digitális kijelző', 18990, 'accessory', 'Raktáron', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1491933382434-500287f9b54b?auto=format&fit=crop&w=900&q=80', 0, 90),
('PhoneX Car Mag Mount', 'Mágneses autós tartó, 15W vezeték nélküli töltés, gömbfej állítás', 17990, 'accessory', 'Raktáron', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=900&q=80', 0, 60),
('PhoneX Phone Studio Cam', 'Vlog-kész mobil gyűrűfénnyel, 4K60, 256 GB tárhely', 289990, 'phone', 'Budapest', '2026-01-02', NULL, 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=900&q=80', 1, 10);


INSERT INTO `bookings` (`offer_id`, `name`, `email`, `phone`, `message`) VALUES
(1, 'Teszt Elek', 'teszt@phonex.hu', '+36 30 123 4567', 'Fekete szín, 256 GB változat.');
