INSERT into dt14330_postmeta ( post_id, meta_key, meta_value ) SELECT ID, '_sample', 'prepared' FROM dt14330_posts;
INSERT into dt14330_commentmeta ( comment_id, meta_key, meta_value ) SELECT comment_ID, '_sample', 'prepared' FROM dt14330_comments;
UPDATE `dt14330_posts` SET `ID`= `ID`+10000 WHERE 1=1;

UPDATE `dt14330_postmeta` SET `meta_id`= `meta_id`+100000 WHERE 1=1;
UPDATE dt14330_postmeta SET post_id = post_id + 10000 WHERE 1 = 1;

UPDATE `dt14330_commentmeta` SET `meta_id`= `meta_id`+200000 WHERE 1=1;
UPDATE dt14330_commentmeta SET comment_id = comment_id + 10000 WHERE 1 = 1;

UPDATE `dt14330_postmeta` SET meta_value = CONCAT('user-',SUBSTRING_INDEX(meta_value, '-', -1) + 1000) WHERE meta_key = 'assigned_to';
UPDATE `dt14330_postmeta` SET meta_value = meta_value + 1000 WHERE meta_key = 'corresponds_to_user';



UPDATE dt14330_comments SET comment_ID = comment_ID + 10000 where 1=1;
UPDATE dt14330_comments SET comment_post_ID = comment_post_ID + 10000 where 1=1;
UPDATE dt14330_comments SET user_id = user_id + 1000 where 1=1;

DELETE FROM `dt14330_dt_activity_log` WHERE `action` LIKE 'logged_in';
DELETE FROM `dt14330_dt_activity_log` WHERE `object_type` LIKE 'User';
UPDATE dt14330_dt_activity_log SET `hist_ip` = '' WHERE 1=1;

UPDATE dt14330_dt_activity_log SET `histid` = histid + 100000 WHERE 1=1;
UPDATE dt14330_dt_activity_log SET  `object_id` = object_id + 10000 WHERE 1=1;
UPDATE dt14330_dt_activity_log SET  `user_id` = user_id + 1000 WHERE 1=1;
UPDATE dt14330_dt_activity_log SET `meta_id` = meta_id + 100000 WHERE 1=1;
UPDATE dt14330_dt_activity_log SET `meta_value` = meta_value + 10000 WHERE `action` LIKE 'connected to';
UPDATE dt14330_dt_activity_log SET `meta_value` = meta_value + 10000 WHERE `action` LIKE 'share';
UPDATE dt14330_dt_activity_log SET `meta_value` = CONCAT('user-',SUBSTRING_INDEX(meta_value, '-', -1) + 1000) WHERE meta_key='assigned_to';
UPDATE dt14330_dt_activity_log SET `old_value` = CONCAT('user-',SUBSTRING_INDEX(old_value, '-', -1) + 1000) WHERE `old_value` LIKE '%user%';


UPDATE dt14330_dt_notifications SET `id`= id + 10000 WHERE 1=1;
UPDATE dt14330_dt_notifications SET `user_id`= user_id + 1000 WHERE 1=1;
UPDATE dt14330_dt_notifications SET `source_user_id`= source_user_id + 1000 WHERE 1=1;
UPDATE dt14330_dt_notifications SET `post_id`= post_id + 10000 WHERE 1=1;

UPDATE dt14330_dt_share SET `id`= id + 10000 WHERE 1=1;
UPDATE dt14330_dt_share SET `user_id`= user_id + 1000 WHERE 1=1;
UPDATE dt14330_dt_share SET `post_id`= post_id + 10000 WHERE 1=1;

UPDATE dt14330_p2p SET p2p_id = p2p_id + 10000 WHERE 1=1;
UPDATE dt14330_p2p SET p2p_from = p2p_from + 10000 WHERE 1=1;
UPDATE dt14330_p2p SET p2p_to = p2p_to + 10000 WHERE 1=1;

UPDATE dt14330_p2pmeta SET p2p_id = p2p_id + 10000 WHERE 1=1;
UPDATE dt14330_p2pmeta SET meta_id = meta_id + 10000 WHERE 1=1;

UPDATE dt14330_users SET ID = ID + 1000 WHERE 1=1;

UPDATE dt14330_usermeta SET umeta_id = umeta_id + 10000 WHERE 1=1;
UPDATE dt14330_usermeta SET user_id = user_id + 1000 WHERE 1=1;
