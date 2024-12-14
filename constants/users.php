<?php
class UserConstants {
    // Define the constants for the table fields
    const TABLE_NAME = "users";
    const USER_ID = 'user_id';
    const EMAIL = 'email';
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const DATE_ADDED = 'date_added';
    const LAST_ACCESSED = 'last_accessed';
    const IS_AUTH = 'is_auth';
    const AUTH_CODE = 'auth_code';
    const SESSION_TOKEN = 'session_token';
    const USER_LEVEL = 'user_level';
    const LOGIN_TOKEN = "user_login_token";

    public static function getTableName() {
        return self::TABLE_NAME;
    }

    public static function getLoginToken() {
        return self::LOGIN_TOKEN; // for session only
    }

    // Getter method for USER_ID
    public static function getUserId() {
        return self::USER_ID;
    }

    // Getter method for EMAIL
    public static function getEmail() {
        return self::EMAIL;
    }

    // Getter method for USERNAME
    public static function getUsername() {
        return self::USERNAME;
    }

    // Getter method for PASSWORD
    public static function getPassword() {
        return self::PASSWORD;
    }

    // Getter method for DATE_ADDED
    public static function getDateAdded() {
        return self::DATE_ADDED;
    }

    // Getter method for LAST_ACCESSED
    public static function getLastAccessed() {
        return self::LAST_ACCESSED;
    }

    // Getter method for IS_AUTH
    public static function getIsAuth() {
        return self::IS_AUTH;
    }

    // Getter method for AUTH_CODE
    public static function getAuthCode() {
        return self::AUTH_CODE;
    }

    // Getter method for SESSION_TOKEN
    public static function getSessionToken() {
        return self::SESSION_TOKEN;
    }

    // Getter method for USER_LEVEL
    public static function getUserLevel() {
        return self::USER_LEVEL;
    }
}

?>