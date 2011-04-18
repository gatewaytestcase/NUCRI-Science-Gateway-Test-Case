DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `uid` varchar(60) NOT NULL,
  `name` varchar(100) default '',
  `password` varchar(256) NOT NULL default '',
  `dirty` INTEGER NOT NULL default 0,
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
