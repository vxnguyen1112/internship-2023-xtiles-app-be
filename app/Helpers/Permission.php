<?php

    namespace App\Helpers;

    class Permission
    {
        public const VIEW = 'VIEW';
        public const EDIT = 'EDIT';

        public static function getRole($role)
        {
            switch ($role) {
                case 'VIEW':
                    return 'viewer';
                case 'EDIT':
                    return 'editor';
            }
            return "Unknown";
        }
    }
