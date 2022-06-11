<?php

namespace GuardsmanPanda\LarabearAuth\Service;

use Illuminate\Support\Facades\DB;

class AuthService {
    private static string|int|null $userId = null;
    private static array|null $permissions = null;
    private static array|null $roles = null;

    public static function id(): string|int|null {
        return self::$userId;
    }

    public static function getUserId(): string|int|null {
        return self::$userId;
    }

    public static function setUserId(string|int|null $userId): void {
        self::$userId = $userId;
    }


    public static function hasPermission(string|array $permission): bool {
        if (self::$userId === null) {
            return false;
        }
        if (self::$permissions === null) {
            $perms = DB::select(query: "
                SELECT DISTINCT p.permission_slug
                FROM bear_user_permission up
                LEFT JOIN bear_permission p ON p.permission_slug = up.permission_slug
                WHERE up.user_id = ?
                UNION DISTINCT
                SELECT DISTINCT p.permission_slug
                FROM bear_user_role ur
                LEFT JOIN bear_role_permission rp on rp.role_slug = ur.role_slug
                LEFT JOIN bear_permission p on p.permission_slug = rp.permission_slug
                WHERE ur.user_id = ?
            ", bindings: [self::$userId, self::$userId]);
            self::$permissions = array_column(array: $perms, column_key: 'permission_slug');
        }
        if (is_string(value: $permission)) {
            $permission = explode(separator: '|', string: $permission);
        }
        foreach ($permission as $perm) {
            if (in_array(needle: $perm, haystack: self::$permissions, strict: true)) {
                return true;
            }
        }
        return false;
    }


    public static function hasRole(string|array $role): bool {
        if (self::$userId === null) {
            return false;
        }
        if (self::$roles === null) {
            $tmp = DB::select(query: "
                    SELECT r.role_slug
                    FROM bear_role r
                    JOIN bear_user_role ur ON ur.role_slug = r.role_slug
                    WHERE ur.user_id = ?
            ", bindings: [self::$userId]);
            self::$roles = array_column(array: $tmp, column_key: 'role_slug');
        }
        if (is_string(value: $role)) {
            $role = explode(separator: '|', string: $role);
        }
        foreach ($role as $r) {
            if (in_array(needle: $r, haystack: self::$roles, strict: true)) {
                return true;
            }
        }
        return false;
    }
}
