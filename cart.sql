CREATE TABLE IF NOT EXISTS `mc_attributes` (
  `prodid` int(5) NOT NULL,
  `options` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




CREATE TABLE IF NOT EXISTS `mc_buyers` (
  `id` int(5) NOT NULL auto_increment,
  `fullname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;


CREATE TABLE IF NOT EXISTS `mc_cartitems` (
  `id` int(5) NOT NULL auto_increment,
  `cartitems` int(3) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `qty` int(5) NOT NULL,
  `sessid` varchar(32) NOT NULL,
  `timeofentry` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;




CREATE TABLE IF NOT EXISTS `mc_category` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
 `maincatid` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;


CREATE TABLE IF NOT EXISTS `mc_coupons` (
  `id` int(5) NOT NULL auto_increment,
  `code` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `dateeffect` datetime NOT NULL,
  `dateexpire` datetime NOT NULL,
  `gifttype` enum('money','percent') NOT NULL default 'money',
  `active` enum('0','1') NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `mc_ecadmin` (
  `id` int(5) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;



CREATE TABLE IF NOT EXISTS `mc_inv` (
  `prodid` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `mc_maincategory` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;




CREATE TABLE IF NOT EXISTS `mc_orders` (
  `prodid` varchar(255) NOT NULL,
  `qty` int(5) NOT NULL,
  `options` varchar(255) NOT NULL,
  `cost` decimal(7,2) NOT NULL,
  `buyerid` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `mc_products` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `descrip` text NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `catid` int(5) NOT NULL,
  `qty` int(5) NOT NULL,
  `link` varchar(250) NOT NULL,
  `weight` decimal(9,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;





CREATE TABLE IF NOT EXISTS `mc_searchHits` (
  `unique_ip` varchar(15) NOT NULL,
  `prodId` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `mc_spec` (
  `id` int(5) NOT NULL auto_increment,
  `prodid` int(5) NOT NULL,
  `times` varchar(255) NOT NULL,
  `timef` varchar(255) NOT NULL,
  `spec` enum('no','yes') NOT NULL default 'no',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `mc_searchHits` (
  `unique_ip` varchar(15) NOT NULL,
  `prodId` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
