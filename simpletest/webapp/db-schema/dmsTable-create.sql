DROP TABLE IF EXISTS `dms`;

CREATE TABLE `dms` (
  `id` varchar(80) NOT NULL,
  `name` varchar(64),
  `resolutionx` integer NOT NULL,
  `resolutiony` integer NOT NULL,
  `k` varchar(256) NOT NULL,
  `inputdata` varchar(512) NOT NULL,
  `outputdata` varchar(512),
  `date` varchar(60),
  `user` varchar(128),
  `status` varchar(20),
  `gridjobid` varchar(512),
  `image` varchar(512),
  `dirty` integer NOT NULL DEFAULT 0,
 PRIMARY KEY  (`id`)
);
