
Truncate table biblio;
Truncate table backup_log;
Truncate table biblio_attachment;
Truncate table biblio_author;
Truncate table biblio_topic;
Truncate table biblio_custom;
Truncate table files;
Truncate table item;
Truncate table loan;
Truncate table mst_author;
Truncate table mst_place;
Truncate table mst_publisher;
Truncate table mst_supplier;
Truncate table mst_topic;






Truncate table mst_coll_type;
INSERT INTO `mst_coll_type` (`coll_type_name`, `input_date`, `last_update`) VALUES
('Sách giáo trình', '2007-11-29', '2013-11-26'),
('Sách tham khảo', '2013-11-26', '2013-11-26');

Truncate table mst_gmd;
INSERT INTO `mst_gmd` (`gmd_id`, `gmd_code`, `gmd_name`, `icon_image`, `input_date`, `last_update`) VALUES
(1, 'BT', 'Bài trích', NULL, '2013-11-26', '2013-11-26'),
(2, 'BTC', 'Báo - Tạp chí', NULL, '2013-11-26', '2013-11-26'),
(3, 'BD', 'Bản đồ', NULL, '2013-11-26', '2013-11-26'),
(4, 'CO', 'Toàn văn', NULL, '2013-11-26', '2013-11-26'),
(5, 'SC', 'Sách chữ', NULL, '2013-11-26', '2013-11-26'),
(6, 'DI', 'Ấn phẩm định kỳ', NULL, '2013-11-26', '2013-11-26');

Truncate table mst_item_status;
INSERT INTO `mst_item_status` (`item_status_id`, `item_status_name`, `rules`, `no_loan`, `skip_stock_take`, `input_date`, `last_update`) VALUES
('CTM', ' ', NULL, 0, 0, '2013-11-26', '2013-11-27'),
('MIS', 'Mất', NULL, 1, 1, '2013-11-26', '2013-11-26'),
('MD', 'Mượn đọc', NULL, 0, 0, '2013-11-26', '2013-11-27');


Truncate table mst_language;
INSERT INTO `mst_language` (`language_id`, `language_name`, `input_date`, `last_update`) VALUES
('en', 'English', '2013-11-26', '2013-11-26'),
('vi', 'Tiếng Việt', '2013-11-26', '2013-11-26');

Truncate table mst_location;
INSERT INTO `mst_location` (`location_id`, `location_name`, `input_date`, `last_update`) VALUES
('PM', 'Cơ sở 1 : Phòng mượn', '2013-11-26', '2013-11-26'),
('PD', 'Cơ sở 1 : Phòng đọc', '2013-11-26', '2013-11-26'),
('CS3', 'Cơ sở 3', '0000-00-00', '2013-11-27');

Truncate table mst_member_type;
INSERT INTO `mst_member_type` (`member_type_id`, `member_type_name`, `loan_limit`, `loan_periode`, `enable_reserve`, `reserve_limit`, `member_periode`, `reborrow_limit`, `fine_each_day`, `grace_periode`, `input_date`, `last_update`) VALUES
(1, 'Sinh viên', 3, 7, 1, 2, 1095, 2, 0, 0, '2013-11-27', '2013-11-27'),
(2, 'GV-CBCNV', 10, 30, 1, 10, 10950, 0, 0, 0, '2013-11-27', '2013-11-27');

