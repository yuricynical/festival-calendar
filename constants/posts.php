<?php
    class PostConstants {
        // Define the constants for the table fields
        const TABLE_NAME = "posts";
        const POST_ID = 'post_id';
        const USER_ID = 'user_id';
        const DESCRIPTION = 'description';
        const IMAGE = 'image';
        const DATE_ADDED = 'date_added';
    
        // Getter method for POST_ID
        public static function getPostId() {
            return self::POST_ID;
        }
    
        // Getter method for USER_ID
        public static function getUserId() {
            return self::USER_ID;
        }
    
        // Getter method for DESCRIPTION
        public static function getDescription() {
            return self::DESCRIPTION;
        }
    
        // Getter method for IMAGE
        public static function getImage() {
            return self::IMAGE;
        }
    
        // Getter method for DATE_ADDED
        public static function getDateAdded() {
            return self::DATE_ADDED;
        }
    }
?>