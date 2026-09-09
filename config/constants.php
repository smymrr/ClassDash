<?php
/**
 * config/constants.php
 * Static, non-sensitive app values.
 */

// Role hierarchy — matches the `role` ENUM on the users table:
// ENUM('president','vice','treasurer','secretary','student')
// Lower number = higher permission level.
define('ROLE_PRESIDENT', 'president');
define('ROLE_VICE', 'vice');
define('ROLE_TREASURER', 'treasurer');
define('ROLE_SECRETARY', 'secretary');
define('ROLE_STUDENT', 'student');

const ROLE_PERMISSION_LEVELS = [
    ROLE_PRESIDENT  => 1,
    ROLE_VICE       => 2,
    ROLE_TREASURER  => 3,
    ROLE_SECRETARY  => 3,
    ROLE_STUDENT    => 4,
];

// Transaction categories used by the Treasury module.
const TRANSACTION_CATEGORIES = [
    'dues',
    'event_proceeds',
    'supplies',
    'decoration',
    'debt_payment',
    'other',
];

// Info Board post tags.
const INFO_BOARD_TAGS = [
    'event',
    'schedule',
    'misc',
];
