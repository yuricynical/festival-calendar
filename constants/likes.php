<?php

    class LikeConstants {
        // Define the constants for the table fields
        const TABLE_NAME = "likes";
        const LIKE_ID = 'like_id';
        const POST_ID = 'post_id';
        const COMMENT_ID = 'comment_id';
        const USER_ID = 'user_id';
        const DATE_ADDED = 'date_added';

        // Getter method for LIKE_ID
        public static function getLikeId() {
            return self::LIKE_ID;
        }

        // Getter method for POST_ID
        public static function getPostId() {
            return self::POST_ID;
        }

        // Getter method for COMMENT_ID
        public static function getCommentId() {
            return self::COMMENT_ID;
        }

        // Getter method for USER_ID
        public static function getUserId() {
            return self::USER_ID;
        }

        // Getter method for DATE_ADDED
        public static function getDateAdded() {
            return self::DATE_ADDED;
        }
    }
?>