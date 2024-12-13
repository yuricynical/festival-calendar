<?php

    class CommentConst {
        // Define the constants for the table fields
        const TABLE_NAME = "comments";
        const COMMENT_ID = 'comment_id';
        const USER_ID = 'user_id';
        const POST_ID = 'post_id';
        const CONTENT = 'content';
        const DATE_ADDED = 'date_added';

        // Getter method for COMMENT_ID
        public static function getCommentId() {
            return self::COMMENT_ID;
        }

        // Getter method for USER_ID
        public static function getUserId() {
            return self::USER_ID;
        }

        // Getter method for POST_ID
        public static function getPostId() {
            return self::POST_ID;
        }

        // Getter method for CONTENT
        public static function getContent() {
            return self::CONTENT;
        }

        // Getter method for DATE_ADDED
        public static function getDateAdded() {
            return self::DATE_ADDED;
        }
    }

?>