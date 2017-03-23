-- Tasks 
INSERT INTO `tasks` VALUES (1,'Tâche 1','Description','Objectif',1,2,0,0);
INSERT INTO `tasks` VALUES (2,'Tâche 2',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id justo et dolor semper maximus. Phasellus finibus turpis id massa fringilla, eget iaculis dui vehicula. Donec quis justo vitae leo accumsan dignissim nec id sem. Nullam interdum laoreet odio tempor luctus. Fusce tincidunt consectetur eleifend. Proin malesuada, felis et porta cursus, mi ipsum lacinia lectus, ac placerat orci nunc eu erat. Pellentesque quis laoreet arcu, nec facilisis neque. Praesent gravida libero odio, sed posuere velit convallis at. Etiam sem sapien, tempus non malesuada vel, semper sit amet quam. Nulla justo turpis, interdum vel felis sit amet, bibendum hendrerit lacus. Ut at vestibulum quam, in hendrerit ex. Nulla facilisi. Nunc facilisis enim at ultricies lacinia. Nam sed mauris non magna ornare faucibus sollicitudin elementum mauris.

Curabitur vulputate interdum felis nec ultrices. Mauris tincidunt tincidunt consequat. Nulla tempor velit nulla, et blandit mi tempor id. Duis interdum molestie nibh vitae aliquam. Nullam tincidunt, ligula ac feugiat condimentum, est orci ultrices risus, vel tincidunt arcu felis et nunc. Nunc ut varius diam, at faucibus ante. Fusce pretium venenatis vulputate. Nulla suscipit molestie nibh, ac placerat ipsum eleifend sit amet. Nulla viverra arcu sit amet odio egestas vestibulum. Praesent eget arcu ut dui molestie molestie. Vestibulum accumsan est ac nisi semper, non hendrerit justo hendrerit. Curabitur cursus egestas mauris sed interdum. Vestibulum eu congue ex. ','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id justo et dolor semper maximus. Phasellus finibus turpis id massa fringilla, eget iaculis dui vehicula. Donec quis justo vitae leo accumsan dignissim nec id sem. Nullam interdum laoreet odio tempor luctus.',3.5,2,0,0);
INSERT INTO `tasks` VALUES (3,'Tâche 3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id justo et dolor semper maximus. Phasellus finibus turpis id massa fringilla, eget iaculis dui vehicula','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id justo et dolor semper maximus. Phasellus finibus turpis id massa fringilla, eget iaculis dui vehicula',1,1,0,1);
INSERT INTO `tasks` VALUES (4,'Tâche 4','Ds','Ds',3,1,0,1);
INSERT INTO `tasks` VALUES (6,'Test','Test12','Test 2',2,1,1,1);

-- Domains
INSERT INTO `domains` VALUES (1,'Web');
INSERT INTO `domains` VALUES (2,'Embedded');
INSERT INTO `domains` VALUES (3,'Network');
INSERT INTO `domains` VALUES (4,'Development');
INSERT INTO `domains` VALUES (5,'Security');
INSERT INTO `domains` VALUES (6,'Testing');
INSERT INTO `domains` VALUES (7,'Support');
INSERT INTO `domains` VALUES (8,'Multimedia');
INSERT INTO `domains` VALUES (9,'Infrastructure');
INSERT INTO `domains` VALUES (10,'Office');

-- 
INSERT INTO `prerequisites` VALUES (2,1);
INSERT INTO `prerequisites` VALUES (3,2);
INSERT INTO `prerequisites` VALUES (3,1);
INSERT INTO `prerequisites` VALUES (4,3);
INSERT INTO `prerequisites` VALUES (4,1);
INSERT INTO `prerequisites` VALUES (4,2);

-- Materials
INSERT INTO `materials` VALUES (1,'Raspberry Pi');
INSERT INTO `materials` VALUES (2,'Beaglebone');
INSERT INTO `materials` VALUES (3,'Switch 8x');
INSERT INTO `materials` VALUES (4,'Router wifi');
INSERT INTO `materials` VALUES (5,'Dongle bluetooth');
