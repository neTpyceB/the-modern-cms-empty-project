INSERT INTO `cms_languages` (`short`, `full`) VALUES ("en", "English");
INSERT INTO `cms_languages` (`short`, `full`) VALUES ("ru", "Russian");
ALTER TABLE `cms_translations` ADD `en` TEXT;
ALTER TABLE `cms_translations` ADD `ru` TEXT;
INSERT INTO `cms_pages` (`template_id`, `location`, `title`, `order`, `in_menu`, `active`) VALUES ("1", "en", "Welcome", "1", "1", "1");
INSERT INTO `cms_pages` (`template_id`, `location`, `title`, `order`, `in_menu`, `active`) VALUES ("1", "ru", "Welcome", "1", "1", "1");