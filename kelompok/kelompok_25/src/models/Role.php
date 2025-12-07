<?php

/**
 * Role Model
 */

require_once ROOT_PATH . '/core/Model.php';

class Role extends Model
{
    protected $table = 'roles';

    /**
     * Find role by code
     */
    public function findByCode($code)
    {
        return $this->findBy('code', $code);
    }

    /**
     * Get all active roles
     */
    public function getActive()
    {
        return $this->where('is_active', 1);
    }

    /**
     * Get role with permissions
     */
    public function findWithPermissions($roleId)
    {
        $sql = "SELECT r.*,
                       GROUP_CONCAT(p.id) as permission_ids,
                       GROUP_CONCAT(p.code) as permission_codes,
                       GROUP_CONCAT(p.name) as permission_names
                FROM roles r
                LEFT JOIN role_permissions rp ON r.id = rp.role_id
                LEFT JOIN permissions p ON rp.permission_id = p.id
                WHERE r.id = ?
                GROUP BY r.id";

        $stmt = $this->query($sql, [$roleId]);
        return $stmt->fetch();
    }

    /**
     * Assign permission to role
     */
    public function assignPermission($roleId, $permissionId, $isDefault = true)
    {
        $sql = "INSERT INTO role_permissions (role_id, permission_id, is_default) 
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE is_default = ?";
        
        $stmt = $this->query($sql, [$roleId, $permissionId, $isDefault ? 1 : 0, $isDefault ? 1 : 0]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Remove permission from role
     */
    public function removePermission($roleId, $permissionId)
    {
        $sql = "DELETE FROM role_permissions WHERE role_id = ? AND permission_id = ?";
        $stmt = $this->query($sql, [$roleId, $permissionId]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Get users by role
     */
    public function getUsers($roleId)
    {
        $sql = "SELECT u.*
                FROM users u
                JOIN user_roles ur ON u.id = ur.user_id
                WHERE ur.role_id = ?";

        $stmt = $this->query($sql, [$roleId]);
        return $stmt->fetchAll();
    }
}
