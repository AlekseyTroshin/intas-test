DROP TABLE IF EXISTS trips;

DROP TABLE IF EXISTS regions;

DROP TABLE IF EXISTS couriers;

CREATE TABLE regions (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	travel_days INT NOT NULL DEFAULT 0,
	travel_days_back INT NOT NULL DEFAULT 0
);

CREATE TABLE couriers (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	is_busy BOOLEAN DEFAULT FALSE
);

CREATE TABLE trips (
	id INT AUTO_INCREMENT PRIMARY KEY,
	courier_id INT,
	region_id INT,
	departure_date DATE,
	arrival_date DATE,
	return_date DATE,
	FOREIGN KEY (courier_id) REFERENCES couriers(id),
	FOREIGN KEY (region_id) REFERENCES regions(id)
);

INSERT INTO regions (id, name, travel_days, travel_days_back) VALUES
(1, 'Санкт-Петербург', 4, 2),
(2, 'Уфа', 6, 7),
(3, 'Нижний Новгород', 2, 4),
(4, 'Владимир', 5, 5),
(5, 'Кострома', 4, 4),
(6, 'Екатеринбург', 1, 6),
(7, 'Ковров', 1, 1),
(8, 'Воронеж', 1, 4),
(9, 'Самара', 3, 4),
(10, 'Астрахань', 3, 6);

INSERT INTO couriers (id, name, is_busy) VALUES
(1, 'Раис Фаритович Хусаинов', NULL),
(2, 'Алмаз Айратович Кузнецов', 1),
(3, 'Алмаз Булатович Мустафин', NULL),
(4, 'Егор Николаевич Иванов', NULL),
(5, 'Егор Александрович Попов', NULL),
(6, 'Азат Алексеевич Соколов', 1),
(7, 'Иван Фаритович Мустафин', NULL),
(8, 'Борис Айратович Иванов', NULL),
(9, 'Салават Иванович Смирнов', NULL),
(10, 'Салават Николаевич Гайнуллин', 1);

INSERT INTO trips (id, courier_id, region_id, departure_date, arrival_date, return_date) VALUES
(1, 1, 8, '2024-08-01', '2024-08-02', '2024-08-06'),
(2, 2, 7, '2024-08-01', '2024-08-02', '2024-08-03'),
(3, 3, 5, '2024-08-01', '2024-08-05', '2024-08-09'),
(4, 4, 3, '2024-08-01', '2024-08-03', '2024-08-07'),
(5, 5, 7, '2024-08-01', '2024-08-02', '2024-08-03'),
(6, 6, 3, '2024-08-01', '2024-08-03', '2024-08-07'),
(7, 7, 1, '2024-08-01', '2024-08-05', '2024-08-07'),
(8, 8, 10, '2024-08-01', '2024-08-04', '2024-08-10'),
(9, 9, 9, '2024-08-01', '2024-08-04', '2024-08-08'),
(10, 10, 2, '2024-08-01', '2024-08-07', '2024-08-14'),
(11, 2, 1, '2024-08-07', '2024-08-11', '2024-08-13'),
(12, 5, 1, '2024-08-08', '2024-08-12', '2024-08-14'),
(13, 1, 2, '2024-08-10', '2024-08-16', '2024-08-23'),
(14, 4, 5, '2024-08-13', '2024-08-17', '2024-08-21'),
(15, 6, 6, '2024-08-13', '2024-08-14', '2024-08-20'),
(16, 7, 8, '2024-08-13', '2024-08-14', '2024-08-18'),
(17, 3, 8, '2024-08-14', '2024-08-15', '2024-08-19'),
(18, 9, 7, '2024-08-14', '2024-08-15', '2024-08-16'),
(19, 8, 6, '2024-08-15', '2024-08-16', '2024-08-22'),
(20, 2, 3, '2024-08-17', '2024-08-19', '2024-08-23'),
(21, 5, 5, '2024-08-19', '2024-08-23', '2024-08-27'),
(22, 10, 3, '2024-08-19', '2024-08-21', '2024-08-25'),
(23, 9, 6, '2024-08-22', '2024-08-23', '2024-08-29'),
(24, 3, 5, '2024-08-23', '2024-08-27', '2024-08-31'),
(25, 7, 10, '2024-08-23', '2024-08-26', '2024-09-01'),
(26, 6, 10, '2024-08-24', '2024-08-27', '2024-09-02'),
(27, 4, 7, '2024-08-25', '2024-08-26', '2024-08-27'),
(28, 8, 6, '2024-08-28', '2024-08-29', '2024-09-04'),
(29, 1, 2, '2024-08-29', '2024-09-04', '2024-09-11'),
(30, 2, 2, '2024-08-29', '2024-09-04', '2024-09-11'),
(31, 10, 2, '2024-08-31', '2024-09-06', '2024-09-13'),
(32, 5, 4, '2024-09-01', '2024-09-06', '2024-09-11'),
(33, 4, 6, '2024-09-02', '2024-09-03', '2024-09-09'),
(34, 9, 5, '2024-09-03', '2024-09-07', '2024-09-11'),
(35, 3, 10, '2024-09-06', '2024-09-09', '2024-09-15'),
(36, 7, 4, '2024-09-06', '2024-09-11', '2024-09-16'),
(37, 6, 2, '2024-09-07', '2024-09-13', '2024-09-20'),
(38, 8, 9, '2024-09-10', '2024-09-13', '2024-09-17'),
(39, 4, 2, '2024-09-14', '2024-09-20', '2024-09-27'),
(40, 1, 1, '2024-09-15', '2024-09-19', '2024-09-21'),
(41, 2, 8, '2024-09-15', '2024-09-16', '2024-09-20'),
(42, 5, 4, '2024-09-16', '2024-09-21', '2024-09-26'),
(43, 9, 7, '2024-09-16', '2024-09-17', '2024-09-18'),
(44, 10, 5, '2024-09-19', '2024-09-23', '2024-09-27'),
(45, 3, 6, '2024-09-21', '2024-09-22', '2024-09-28'),
(46, 7, 9, '2024-09-22', '2024-09-25', '2024-09-29'),
(47, 8, 9, '2024-09-23', '2024-09-26', '2024-09-30'),
(48, 9, 6, '2024-09-23', '2024-09-24', '2024-09-30'),
(49, 6, 6, '2024-09-25', '2024-09-26', '2024-10-02'),
(50, 2, 2, '2024-09-26', '2024-10-02', '2024-10-09'),
(51, 1, 4, '2024-09-27', '2024-10-02', '2024-10-07'),
(52, 5, 2, '2024-09-30', '2024-10-06', '2024-10-13'),
(53, 4, 5, '2024-10-01', '2024-10-05', '2024-10-09'),
(54, 10, 6, '2024-10-03', '2024-10-04', '2024-10-10'),
(55, 3, 8, '2024-10-04', '2024-10-05', '2024-10-09'),
(56, 7, 5, '2024-10-04', '2024-10-08', '2024-10-12'),
(57, 8, 8, '2024-10-05', '2024-10-06', '2024-10-10'),
(58, 9, 9, '2024-10-05', '2024-10-08', '2024-10-12'),
(59, 6, 6, '2024-10-06', '2024-10-07', '2024-10-13'),
(60, 1, 10, '2024-10-13', '2024-10-16', '2024-10-22'),
(61, 4, 7, '2024-10-13', '2024-10-14', '2024-10-15'),
(62, 2, 5, '2024-10-15', '2024-10-19', '2024-10-23'),
(63, 3, 7, '2024-10-15', '2024-10-16', '2024-10-17'),
(64, 7, 10, '2024-10-16', '2024-10-19', '2024-10-25'),
(65, 8, 7, '2024-10-16', '2024-10-17', '2024-10-18'),
(66, 10, 2, '2024-10-16', '2024-10-22', '2024-10-29'),
(67, 6, 7, '2024-10-17', '2024-10-18', '2024-10-19'),
(68, 5, 10, '2024-10-18', '2024-10-21', '2024-10-27'),
(69, 9, 9, '2024-10-18', '2024-10-21', '2024-10-25'),
(70, 4, 3, '2024-10-20', '2024-10-22', '2024-10-26'),
(71, 3, 7, '2024-10-22', '2024-10-23', '2024-10-24'),
(72, 6, 10, '2024-10-23', '2024-10-26', '2024-11-01'),
(73, 8, 7, '2024-10-24', '2024-10-25', '2024-10-26'),
(74, 1, 7, '2024-10-26', '2024-10-27', '2024-10-28'),
(75, 2, 3, '2024-10-29', '2024-10-31', '2024-11-04');