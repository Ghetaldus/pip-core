-- ---------------------------------------------------------------------------------------

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_user`
--

DROP TABLE IF EXISTS `pip_user`;
CREATE TABLE IF NOT EXISTS `pip_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `avatar` varchar(32) NOT NULL DEFAULT 'avatar',
  `email` varchar(100) NOT NULL DEFAULT 'none',
  `password` varchar(40) NOT NULL DEFAULT 'none',
  `regdate` datetime DEFAULT NULL,
  `acode` int(6) NOT NULL DEFAULT '123',
  `active` int(11) NOT NULL DEFAULT '0',
  `scode` int(6) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Tablestructure for Table `pip_list_user`
--

DROP TABLE IF EXISTS `pip_list_user`;
CREATE TABLE IF NOT EXISTS `pip_list_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_template_building`
--

DROP TABLE IF EXISTS `pip_template_building`;
CREATE TABLE IF NOT EXISTS `pip_template_building` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT 'none',
  `icon` varchar(32) NOT NULL DEFAULT 'none',
  `rarity` int(11) NOT NULL DEFAULT '0',
  `category1` varchar(16) NOT NULL DEFAULT 'none',
  `category2` varchar(16) NOT NULL DEFAULT 'none',
  `category3` varchar(16) NOT NULL DEFAULT 'none',
  `targetid` int(11) NOT NULL DEFAULT '0',
  `acquire_level_min` int(11) NOT NULL DEFAULT '0',
  `acquire_level_max` int(11) NOT NULL DEFAULT '0',
  `upgrade_factor` float(2,2) NOT NULL DEFAULT '0',
  `sell_factor` float(2,2) NOT NULL DEFAULT '0',
  `sell_resid` int(11) NOT NULL DEFAULT '0',
  `required_level_min` int(11) NOT NULL DEFAULT '0',
  `required_level_max` int(11) NOT NULL DEFAULT '0',
  `default_level` int(11) NOT NULL DEFAULT '0',
  `max_level` int(11) NOT NULL DEFAULT '0',
  `limit` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `res1_id` int(11) NOT NULL DEFAULT '0',
  `res1_amount` int(11) NOT NULL DEFAULT '0',
  `res2_id` int(11) NOT NULL DEFAULT '0',
  `res2_amount` int(11) NOT NULL DEFAULT '0',
  `res3_id` int(11) NOT NULL DEFAULT '0',
  `res3_amount` int(11) NOT NULL DEFAULT '0',
  `res4_id` int(11) NOT NULL DEFAULT '0',
  `res4_amount` int(11) NOT NULL DEFAULT '0',
  `res5_id` int(11) NOT NULL DEFAULT '0',
  `res5_amount` int(11) NOT NULL DEFAULT '0',
  `res6_id` int(11) NOT NULL DEFAULT '0',
  `res6_amount` int(11) NOT NULL DEFAULT '0',
  `res7_id` int(11) NOT NULL DEFAULT '0',
  `res7_amount` int(11) NOT NULL DEFAULT '0',
  `res8_id` int(11) NOT NULL DEFAULT '0',
  `res8_amount` int(11) NOT NULL DEFAULT '0',
  `res9_id` int(11) NOT NULL DEFAULT '0',
  `res9_amount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data for Table `pip_template_building`
--

INSERT INTO `pip_template_building` (`id`, `name`, `icon`, `rarity`, `category1`, `category2`, `category3`, `targetid`, `acquire_level_min`, `acquire_level_max`, `upgrade_factor`, `sell_factor`,  `sell_resid`, `required_level_min`, `required_level_max`, `default_level`, `max_level`, `limit`, `score`, `res1_id`, `res1_amount`, `res2_id`, `res2_amount`, `res3_id`, `res3_amount`, `res4_id`, `res4_amount`, `res5_id`, `res5_amount`, `res6_id`, `res6_amount`, `res7_id`, `res7_amount`, `res8_id`, `res8_amount`, `res9_id`, `res9_amount`) VALUES
(1, 'testbuilding1', 'icon', '0', 'shop', '', 	'', '1', '1', '1', '0.5', '0.5', '0', '0', '10', '1', '10', '1', '2', '1', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 'testbuilding2', 'icon', '0', 'shop', '', 	'', '2', '1', '1', '0.5', '0.5', '0', '0', '10', '0', '10', '1', '3', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 'testbuilding3', 'icon', '0', 'shop', '', 	'', '3', '1', '1', '0.5', '0.5', '0', '1', '10', '0', '10', '1', '4', '3', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 'testbuilding4', 'icon', '0', 'shop', '', 	'', '4', '1', '1', '0.5', '0.5', '0', '2', '10', '0', '10', '1', '5', '4', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(5, 'testbuilding5', 'icon', '0', 'shop', '', 	'', '5', '1', '1', '0.5', '0.5', '0', '3', '10', '0', '10', '1', '6', '5', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- Tablestructure for Table `pip_list_building`
--

DROP TABLE IF EXISTS `pip_list_building`;
CREATE TABLE IF NOT EXISTS `pip_list_building` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `experience` int(11) NOT NULL DEFAULT '0',
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_template_tech`
--

DROP TABLE IF EXISTS `pip_template_tech`;
CREATE TABLE IF NOT EXISTS `pip_template_tech` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT 'none',
  `icon` varchar(32) NOT NULL DEFAULT 'none',
  `rarity` int(11) NOT NULL DEFAULT '0',
  `category1` varchar(16) NOT NULL DEFAULT 'none',
  `category2` varchar(16) NOT NULL DEFAULT 'none',
  `category3` varchar(16) NOT NULL DEFAULT 'none',
  `targetid` int(11) NOT NULL DEFAULT '0',
  `acquire_level_min` int(11) NOT NULL DEFAULT '0',
  `acquire_level_max` int(11) NOT NULL DEFAULT '0',
  `upgrade_factor` float(2,2) NOT NULL DEFAULT '0',
  `sell_factor` float(2,2) NOT NULL DEFAULT '0',
  `sell_resid` int(11) NOT NULL DEFAULT '0',
  `required_level_min` int(11) NOT NULL DEFAULT '0',
  `required_level_max` int(11) NOT NULL DEFAULT '0',
  `default_level` int(11) NOT NULL DEFAULT '0',
  `max_level` int(11) NOT NULL DEFAULT '0',
  `limit` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `res1_id` int(11) NOT NULL DEFAULT '0',
  `res1_amount` int(11) NOT NULL DEFAULT '0',
  `res2_id` int(11) NOT NULL DEFAULT '0',
  `res2_amount` int(11) NOT NULL DEFAULT '0',
  `res3_id` int(11) NOT NULL DEFAULT '0',
  `res3_amount` int(11) NOT NULL DEFAULT '0',
  `res4_id` int(11) NOT NULL DEFAULT '0',
  `res4_amount` int(11) NOT NULL DEFAULT '0',
  `res5_id` int(11) NOT NULL DEFAULT '0',
  `res5_amount` int(11) NOT NULL DEFAULT '0',
  `res6_id` int(11) NOT NULL DEFAULT '0',
  `res6_amount` int(11) NOT NULL DEFAULT '0',
  `res7_id` int(11) NOT NULL DEFAULT '0',
  `res7_amount` int(11) NOT NULL DEFAULT '0',
  `res8_id` int(11) NOT NULL DEFAULT '0',
  `res8_amount` int(11) NOT NULL DEFAULT '0',
  `res9_id` int(11) NOT NULL DEFAULT '0',
  `res9_amount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data for Table `pip_template_tech`
--

INSERT INTO `pip_template_tech` (`id`, `name`, `icon`, `rarity`, `category1`, `category2`, `category3`, `targetid`, `acquire_level_min`, `acquire_level_max`, `upgrade_factor`, `sell_factor`,  `sell_resid`, `required_level_min`, `required_level_max`, `default_level`, `max_level`, `limit`, `score`, `res1_id`, `res1_amount`, `res2_id`, `res2_amount`, `res3_id`, `res3_amount`, `res4_id`, `res4_amount`, `res5_id`, `res5_amount`, `res6_id`, `res6_amount`, `res7_id`, `res7_amount`, `res8_id`, `res8_amount`, `res9_id`, `res9_amount`) VALUES
(1, 'testtech1', 'icon', '0', 'shop', '', 	'', '1', '1', '1', '0.5', '0.5', '0', '0', '10', '1', '10', '1', '2', '1', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 'testtech2', 'icon', '0', 'shop', '', 	'', '2', '1', '1', '0.5', '0.5', '0', '0', '10', '0', '10', '1', '3', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 'testtech3', 'icon', '0', 'shop', '', 	'', '3', '1', '1', '0.5', '0.5', '0', '1', '10', '0', '10', '1', '4', '3', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 'testtech4', 'icon', '0', 'shop', '', 	'', '4', '1', '1', '0.5', '0.5', '0', '2', '10', '0', '10', '1', '5', '4', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(5, 'testtech5', 'icon', '0', 'shop', '', 	'', '5', '1', '1', '0.5', '0.5', '0', '3', '10', '0', '10', '1', '6', '5', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- Tablestructure for Table `pip_list_tech`
--

DROP TABLE IF EXISTS `pip_list_tech`;
CREATE TABLE IF NOT EXISTS `pip_list_tech` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `experience` int(11) NOT NULL DEFAULT '0',
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_template_resource`
--

DROP TABLE IF EXISTS `pip_template_resource`;
CREATE TABLE IF NOT EXISTS `pip_template_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT 'none',
  `icon` varchar(32) NOT NULL DEFAULT 'none',
  `rarity` int(11) NOT NULL DEFAULT '0',
  `required_level_min` int(11) NOT NULL DEFAULT '0',
  `required_level_max` int(11) NOT NULL DEFAULT '0',
  `default_amount` int(11) NOT NULL DEFAULT '0',
  `acquire_amount_min` int(11) NOT NULL DEFAULT '0',
  `acquire_amount_max` int(11) NOT NULL DEFAULT '0',
  `sell_factor` float(2,2) NOT NULL DEFAULT '0',
  `sell_resid` int(11) NOT NULL DEFAULT '0',
  `limit` int(11) NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '0',
  `gain` int(11) NOT NULL DEFAULT '0',
  `storage` int(11) NOT NULL DEFAULT '0',
  `tspan` int(11) NOT NULL DEFAULT '0',
  `res1_id` int(11) NOT NULL DEFAULT '0',
  `res1_amount` int(11) NOT NULL DEFAULT '0',
  `res2_id` int(11) NOT NULL DEFAULT '0',
  `res2_amount` int(11) NOT NULL DEFAULT '0',
  `res3_id` int(11) NOT NULL DEFAULT '0',
  `res3_amount` int(11) NOT NULL DEFAULT '0',
  `res4_id` int(11) NOT NULL DEFAULT '0',
  `res4_amount` int(11) NOT NULL DEFAULT '0',
  `res5_id` int(11) NOT NULL DEFAULT '0',
  `res5_amount` int(11) NOT NULL DEFAULT '0',
  `res6_id` int(11) NOT NULL DEFAULT '0',
  `res6_amount` int(11) NOT NULL DEFAULT '0',
  `res7_id` int(11) NOT NULL DEFAULT '0',
  `res7_amount` int(11) NOT NULL DEFAULT '0',
  `res8_id` int(11) NOT NULL DEFAULT '0',
  `res8_amount` int(11) NOT NULL DEFAULT '0',
  `res9_id` int(11) NOT NULL DEFAULT '0',
  `res9_amount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data for Table `pip_template_resource`
--

INSERT INTO `pip_template_resource` (`id`, `name`, `icon`, `rarity`, `required_level_min`, `required_level_max`, `default_amount`, `acquire_amount_min`, `acquire_amount_max`, `sell_factor`,  `sell_resid`, `limit`, `max`, `gain`, `storage`, `tspan`, `res1_id`, `res1_amount`, `res2_id`, `res2_amount`, `res3_id`, `res3_amount`, `res4_id`, `res4_amount`, `res5_id`, `res5_amount`, `res6_id`, `res6_amount`, `res7_id`, `res7_amount`, `res8_id`, `res8_amount`, `res9_id`, `res9_amount`) VALUES
(1, 'energy_res1', 	'resicon1', '0', '1', '10', '10', '1', '50', '0.5', '2', '0', '100', '5', '50', '61', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 'gold_res2', 	'resicon2', '0', '1', '10', '10', '1', '50', '0.5', '2', '0', '100', '5', '50', '61', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 'iron_res3', 	'resicon3', '0', '0', '10', '10', '1', '50', '0.5', '2', '0', '100', '0', '50', '61', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 'wood_res4', 	'resicon4', '0', '0', '10', '10', '1', '50', '0.5', '2', '0', '100', '0', '50', '61', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- Tablestructure for Table `pip_list_resource`
--

DROP TABLE IF EXISTS `pip_list_resource`;
CREATE TABLE IF NOT EXISTS `pip_list_resource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `max` int(11) NOT NULL DEFAULT '0',
  `gain` int(11) NOT NULL DEFAULT '0',
  `storage` int(11) NOT NULL DEFAULT '0',
  `res_tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_template_item`
--

DROP TABLE IF EXISTS `pip_template_item`;
CREATE TABLE IF NOT EXISTS `pip_template_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT 'none',
  `icon` varchar(32) NOT NULL DEFAULT 'none',
  `rarity` int(11) NOT NULL DEFAULT '0',
  `required_level_min` int(11) NOT NULL DEFAULT '0',
  `required_level_max` int(11) NOT NULL DEFAULT '0',
  `default_amount` int(11) NOT NULL DEFAULT '0',
  `default_level` int(11) NOT NULL DEFAULT '0',
  `max_level` int(11) NOT NULL DEFAULT '0',
  `limit` int(11) NOT NULL DEFAULT '0',
  `acquire_amount_min` int(11) NOT NULL DEFAULT '0',
  `acquire_amount_max` int(11) NOT NULL DEFAULT '0',
  `acquire_level_min` int(11) NOT NULL DEFAULT '0',
  `acquire_level_max` int(11) NOT NULL DEFAULT '0',
  `upgrade_factor` float(2,2) NOT NULL DEFAULT '0',
  `sell_factor` float(2,2) NOT NULL DEFAULT '0',
  `sell_resid` int(11) NOT NULL DEFAULT '0',
  `res1_id` int(11) NOT NULL DEFAULT '0',
  `res1_amount` int(11) NOT NULL DEFAULT '0',
  `res2_id` int(11) NOT NULL DEFAULT '0',
  `res2_amount` int(11) NOT NULL DEFAULT '0',
  `res3_id` int(11) NOT NULL DEFAULT '0',
  `res3_amount` int(11) NOT NULL DEFAULT '0',
  `res4_id` int(11) NOT NULL DEFAULT '0',
  `res4_amount` int(11) NOT NULL DEFAULT '0',
  `res5_id` int(11) NOT NULL DEFAULT '0',
  `res5_amount` int(11) NOT NULL DEFAULT '0',
  `res6_id` int(11) NOT NULL DEFAULT '0',
  `res6_amount` int(11) NOT NULL DEFAULT '0',
  `res7_id` int(11) NOT NULL DEFAULT '0',
  `res7_amount` int(11) NOT NULL DEFAULT '0',
  `res8_id` int(11) NOT NULL DEFAULT '0',
  `res8_amount` int(11) NOT NULL DEFAULT '0',
  `res9_id` int(11) NOT NULL DEFAULT '0',
  `res9_amount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data for Table `pip_template_item`
--

INSERT INTO `pip_template_item` (`id`, `name`, `icon`, `rarity`, `required_level_min`, `required_level_max`, `default_amount`, `default_level`, `max_level`, `limit`, `acquire_amount_min`, `acquire_amount_max`, `acquire_level_min`, `acquire_level_max`, `upgrade_factor`, `sell_factor`, `sell_resid`, `res1_id`, `res1_amount`, `res2_id`, `res2_amount`, `res3_id`, `res3_amount`, `res4_id`, `res4_amount`, `res5_id`, `res5_amount`, `res6_id`, `res6_amount`, `res7_id`, `res7_amount`, `res8_id`, `res8_amount`, `res9_id`, `res9_amount`) VALUES
(1, 'testitem1', 'icon', '1', '0', '10', '1', '0', '10', '0', '1', '5', '0', '0', '0.5', '0.5', '0', '1', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 'testitem2', 'icon', '1', '0', '10', '2', '0', '10', '0', '1', '5', '0', '0', '0.5', '0.5', '0', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 'testitem3', 'icon', '1', '1', '10', '3', '0', '10', '0', '1', '5', '0', '0', '0.5', '0.5', '0', '3', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 'testitem4', 'icon', '1', '2', '10', '0', '0', '10', '0', '1', '5', '0', '0', '0.5', '0.5', '0', '4', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(5, 'testitem5', 'icon', '1', '3', '10', '0', '0', '10', '0', '1', '5', '0', '0', '0.5', '0.5', '0', '5', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- Tablestructure for Table `pip_list_item`
--

DROP TABLE IF EXISTS `pip_list_item`;
CREATE TABLE IF NOT EXISTS `pip_list_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_template_char`
--

DROP TABLE IF EXISTS `pip_template_char`;
CREATE TABLE IF NOT EXISTS `pip_template_char` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT 'none',
  `icon` varchar(32) NOT NULL DEFAULT 'none',
  `rarity` int(11) NOT NULL DEFAULT '0',
  `category1` varchar(16) NOT NULL DEFAULT 'none',
  `category2` varchar(16) NOT NULL DEFAULT 'none',
  `category3` varchar(16) NOT NULL DEFAULT 'none',
  `required_level_min` int(11) NOT NULL DEFAULT '0',
  `required_level_max` int(11) NOT NULL DEFAULT '0',
  `default_level` int(11) NOT NULL DEFAULT '0',
  `max_level` int(11) NOT NULL DEFAULT '0',
  `limit` int(11) NOT NULL DEFAULT '0',
  `acquire_level_min` int(11) NOT NULL DEFAULT '0',
  `acquire_level_max` int(11) NOT NULL DEFAULT '0',
  `sell_factor` float(2,2) NOT NULL DEFAULT '0',
  `sell_resid` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `res1_id` int(11) NOT NULL DEFAULT '0',
  `res1_amount` int(11) NOT NULL DEFAULT '0',
  `res2_id` int(11) NOT NULL DEFAULT '0',
  `res2_amount` int(11) NOT NULL DEFAULT '0',
  `res3_id` int(11) NOT NULL DEFAULT '0',
  `res3_amount` int(11) NOT NULL DEFAULT '0',
  `res4_id` int(11) NOT NULL DEFAULT '0',
  `res4_amount` int(11) NOT NULL DEFAULT '0',
  `res5_id` int(11) NOT NULL DEFAULT '0',
  `res5_amount` int(11) NOT NULL DEFAULT '0',
  `res6_id` int(11) NOT NULL DEFAULT '0',
  `res6_amount` int(11) NOT NULL DEFAULT '0',
  `res7_id` int(11) NOT NULL DEFAULT '0',
  `res7_amount` int(11) NOT NULL DEFAULT '0',
  `res8_id` int(11) NOT NULL DEFAULT '0',
  `res8_amount` int(11) NOT NULL DEFAULT '0',
  `res9_id` int(11) NOT NULL DEFAULT '0',
  `res9_amount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data for Table `pip_template_char`
--

INSERT INTO `pip_template_char` (`id`, `name`, `icon`, `rarity`, `category1`, `category2`, `category3`,`required_level_min`, `required_level_max`, `default_level`, `max_level`, `limit`, `acquire_level_min`, `acquire_level_max`, `sell_factor`,  `sell_resid`, `score`, `res1_id`, `res1_amount`, `res2_id`, `res2_amount`, `res3_id`, `res3_amount`, `res4_id`, `res4_amount`, `res5_id`, `res5_amount`, `res6_id`, `res6_amount`, `res7_id`, `res7_amount`, `res8_id`, `res8_amount`, `res9_id`, `res9_amount`) VALUES
(1, 'testchar1', 'icon', '0', '', '', '', '0', '10', '1', '10', '0', '1', '3', '0.5', '0', '2', '1', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 'testchar2', 'icon', '0', '', '', '', '0', '10', '2', '10', '0', '1', '3', '0.5', '0', '3', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 'testchar3', 'icon', '0', '', '', '', '1', '10', '3', '10', '0', '1', '3', '0.5', '0', '4', '3', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 'testchar4', 'icon', '0', '', '', '', '2', '10', '0', '10', '0', '1', '3', '0.5', '0', '5', '4', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(5, 'testchar5', 'icon', '0', '', '', '', '3', '10', '0', '10', '0', '1', '3', '0.5', '0', '6', '5', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- Tablestructure for Table `pip_list_char`
--

DROP TABLE IF EXISTS `pip_list_char`;
CREATE TABLE IF NOT EXISTS `pip_list_char` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `experience` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `progress` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_template_task`
--

DROP TABLE IF EXISTS `pip_template_task`;
CREATE TABLE IF NOT EXISTS `pip_template_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT 'none',
  `icon` varchar(32) NOT NULL DEFAULT 'none',
  `rarity` int(11) NOT NULL DEFAULT '0',
  `category1` varchar(16) NOT NULL DEFAULT 'none',
  `category2` varchar(16) NOT NULL DEFAULT 'none',
  `category3` varchar(16) NOT NULL DEFAULT 'none',
  `required_level_min` int(11) NOT NULL DEFAULT '0',
  `required_level_max` int(11) NOT NULL DEFAULT '0',
  `default_level` int(11) NOT NULL DEFAULT '0',
  `limit` int(11) NOT NULL DEFAULT '0',
  `acquire_level_min` int(11) NOT NULL DEFAULT '0',
  `acquire_level_max` int(11) NOT NULL DEFAULT '0',
  `sell_factor` float(2,2) NOT NULL DEFAULT '0',
  `sell_resid` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `res1_id` int(11) NOT NULL DEFAULT '0',
  `res1_amount` int(11) NOT NULL DEFAULT '0',
  `res2_id` int(11) NOT NULL DEFAULT '0',
  `res2_amount` int(11) NOT NULL DEFAULT '0',
  `res3_id` int(11) NOT NULL DEFAULT '0',
  `res3_amount` int(11) NOT NULL DEFAULT '0',
  `res4_id` int(11) NOT NULL DEFAULT '0',
  `res4_amount` int(11) NOT NULL DEFAULT '0',
  `res5_id` int(11) NOT NULL DEFAULT '0',
  `res5_amount` int(11) NOT NULL DEFAULT '0',
  `res6_id` int(11) NOT NULL DEFAULT '0',
  `res6_amount` int(11) NOT NULL DEFAULT '0',
  `res7_id` int(11) NOT NULL DEFAULT '0',
  `res7_amount` int(11) NOT NULL DEFAULT '0',
  `res8_id` int(11) NOT NULL DEFAULT '0',
  `res8_amount` int(11) NOT NULL DEFAULT '0',
  `res9_id` int(11) NOT NULL DEFAULT '0',
  `res9_amount` int(11) NOT NULL DEFAULT '0',
  `rewardid1` int(11) NOT NULL DEFAULT '0',
  `rewardid2` int(11) NOT NULL DEFAULT '0',
  `rewardid3` int(11) NOT NULL DEFAULT '0',
  `rewardid4` int(11) NOT NULL DEFAULT '0',
  `rewardid5` int(11) NOT NULL DEFAULT '0',
  `rewardid6` int(11) NOT NULL DEFAULT '0',
  `rewardid7` int(11) NOT NULL DEFAULT '0',
  `rewardid8` int(11) NOT NULL DEFAULT '0',
  `rewardid9` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data for Table `pip_template_task`
--

INSERT INTO `pip_template_task` (`id`, `name`, `icon`, `rarity`, `category1`, `category2`, `category3`,`required_level_min`, `required_level_max`, `default_level`, `limit`, `acquire_level_min`, `acquire_level_max`, `sell_factor`, `sell_resid`, `score`, `res1_id`, `res1_amount`, `res2_id`, `res2_amount`, `res3_id`, `res3_amount`, `res4_id`, `res4_amount`, `res5_id`, `res5_amount`, `res6_id`, `res6_amount`, `res7_id`, `res7_amount`, `res8_id`, `res8_amount`, `res9_id`, `res9_amount`, `rewardid1`, `rewardid2`, `rewardid3`, `rewardid4`, `rewardid5`, `rewardid6`, `rewardid7`, `rewardid8`, `rewardid9`) VALUES
(1, 'testtask1', 'icon', '0', '', '', '', '0', '10', '1', '0', '1', '3', '0.5', '1', '2', '1', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(2, 'testtask2', 'icon', '0', '', '', '', '0', '10', '2', '0', '1', '3', '0.5', '1', '3', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(3, 'testtask3', 'icon', '0', '', '', '', '1', '10', '3', '0', '1', '3', '0.5', '1', '4', '3', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(4, 'testtask4', 'icon', '0', '', '', '', '2', '10', '0', '0', '1', '3', '0.5', '1', '5', '4', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'),
(5, 'testtask5', 'icon', '0', '', '', '', '3', '10', '0', '0', '1', '3', '0.5', '1', '6', '5', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- Tablestructure for Table `pip_list_task`
--

DROP TABLE IF EXISTS `pip_list_task`;
CREATE TABLE IF NOT EXISTS `pip_list_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `progress` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_template_requirement`
--

DROP TABLE IF EXISTS `pip_template_requirement`;
CREATE TABLE IF NOT EXISTS `pip_template_requirement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(16) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `req_category` varchar(16) NOT NULL DEFAULT 'none',
  `req_id` int(11) NOT NULL DEFAULT '0',
  `req_level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data for Table `pip_template_requirement`
--

INSERT INTO `pip_template_requirement` (`id`, `category`, `myid`, `req_category`, `req_id`, `req_level`) VALUES
(1, 'building', '2', 'building', 	'1', '1' ),
(2, 'building', '3', 'building', 	'1', '2' ),
(3, 'tech', 	'2', 'tech', 		'1', '1' ),
(4, 'tech', 	'3', 'tech', 		'1', '2' ),
(5, 'tech', 	'4', 'tech', 		'1', '3' );

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_template_shop`
--

DROP TABLE IF EXISTS `pip_template_shop`;
CREATE TABLE IF NOT EXISTS `pip_template_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT 'none',
  `icon` varchar(32) NOT NULL DEFAULT 'none',
  `category` varchar(16) NOT NULL DEFAULT '0',
  `default_level` int(11) NOT NULL DEFAULT '0', 
  `stock` tinyint(3) NOT NULL DEFAULT '0', 
  `tspan` int(11) NOT NULL DEFAULT '0',
  `amount_min` int(11) NOT NULL DEFAULT '0',
  `amount_max` int(11) NOT NULL DEFAULT '0',
  `required_level_min` int(11) NOT NULL DEFAULT '0',
  `required_level_max` int(11) NOT NULL DEFAULT '0',
  `rarity_min` int(11) NOT NULL DEFAULT '0',
  `rarity_max` int(11) NOT NULL DEFAULT '0',
  `upgrade_tspan` int(11) NOT NULL DEFAULT '0',
  `upgrade_amount` int(11) NOT NULL DEFAULT '0',
  `upgrade_required_level` int(11) NOT NULL DEFAULT '0',
  `upgrade_rarity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data for Table `pip_template_shop`
--

INSERT INTO `pip_template_shop` (`id`, `name`, `icon`, `category`, `default_level`, `stock`, `tspan`, `amount_min`, `amount_max`, `required_level_min`, `required_level_max`, `rarity_min`, `rarity_max`, `upgrade_tspan`, `upgrade_amount`, `upgrade_required_level`, `upgrade_rarity`) VALUES
(1, 'testshop1', 'icon', 'building', 	'1', '1', '10', '1', '3', '1', '10', '1', '10', '5', '1', '1', '1'),
(2, 'testshop2', 'icon', 'item', 		'0', '1', '10', '1', '3', '1', '10', '1', '10', '5', '1', '1', '1'),
(3, 'testshop3', 'icon', 'char', 		'0', '1', '10', '1', '3', '1', '10', '1', '10', '5', '1', '1', '1'),
(4, 'testshop4', 'icon', 'resource', 	'0', '1', '10', '1', '3', '1', '10', '1', '10', '5', '1', '1', '1'),
(5, 'testshop5', 'icon', 'task', 		'1', '1', '10', '1', '3', '1', '10', '1', '10', '5', '1', '1', '1'),
(6, 'testshop6', 'icon', 'tech', 		'1', '1', '10', '1', '3', '1', '10', '1', '10', '5', '1', '1', '1');

--
-- Tablestructure for Table `pip_list_shop`
--

DROP TABLE IF EXISTS `pip_list_shop`;
CREATE TABLE IF NOT EXISTS `pip_list_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `category` varchar(16) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Tablestructure for Table `pip_inventory_shop`
--

DROP TABLE IF EXISTS `pip_inventory_shop`;
CREATE TABLE IF NOT EXISTS `pip_inventory_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `category` varchar(16) NOT NULL DEFAULT '0',
  `objectid` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_list_globalbuff`
--

DROP TABLE IF EXISTS `pip_list_globalbuff`;
CREATE TABLE IF NOT EXISTS `pip_list_globalbuff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `category1` varchar(16) NOT NULL DEFAULT '16',
  `category2` varchar(16) NOT NULL DEFAULT '16',
  `category3` varchar(16) NOT NULL DEFAULT '16',
  `targetid` int(11) NOT NULL DEFAULT '0',
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tspan` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- ---------------------------------------------------------------------------------------

--
-- Tablestructure for Table `pip_template_reward`
--

DROP TABLE IF EXISTS `pip_template_reward`;
CREATE TABLE IF NOT EXISTS `pip_template_reward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT 'none',
  `icon` varchar(32) NOT NULL DEFAULT 'none',
  `myid` int(11) NOT NULL DEFAULT '0',
  `rarity` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `res1_id` int(11) NOT NULL DEFAULT '0',
  `res1_amount` int(11) NOT NULL DEFAULT '0',
  `res2_id` int(11) NOT NULL DEFAULT '0',
  `res2_amount` int(11) NOT NULL DEFAULT '0',
  `res3_id` int(11) NOT NULL DEFAULT '0',
  `res3_amount` int(11) NOT NULL DEFAULT '0',
  `res4_id` int(11) NOT NULL DEFAULT '0',
  `res4_amount` int(11) NOT NULL DEFAULT '0',
  `res5_id` int(11) NOT NULL DEFAULT '0',
  `res5_amount` int(11) NOT NULL DEFAULT '0',
  `res6_id` int(11) NOT NULL DEFAULT '0',
  `res6_amount` int(11) NOT NULL DEFAULT '0',
  `res7_id` int(11) NOT NULL DEFAULT '0',
  `res7_amount` int(11) NOT NULL DEFAULT '0',
  `res8_id` int(11) NOT NULL DEFAULT '0',
  `res8_amount` int(11) NOT NULL DEFAULT '0',
  `res9_id` int(11) NOT NULL DEFAULT '0',
  `res9_amount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data for Table `pip_template_reward`
--

INSERT INTO `pip_template_reward` (`id`, `name`, `icon`, `myid`, `rarity`, `amount`, `res1_id`, `res1_amount`, `res2_id`, `res2_amount`, `res3_id`, `res3_amount`, `res4_id`, `res4_amount`, `res5_id`, `res5_amount`, `res6_id`, `res6_amount`, `res7_id`, `res7_amount`, `res8_id`, `res8_amount`, `res9_id`, `res9_amount`) VALUES
(1, 'reward', 'icon', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

--
-- End
--

-- ---------------------------------------------------------------------------------------
