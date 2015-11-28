INSERT INTO `cms_languages` (`short`, `full`) VALUES ("en", "English");
ALTER TABLE `cms_translations` ADD `en` TEXT;
INSERT INTO `cms_pages` (`template_id`, `location`, `title`, `order`, `in_menu`, `active`) VALUES ("1", "en", "Welcome", "1", "1", "1");