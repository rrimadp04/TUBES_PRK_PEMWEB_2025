<?php

/**
 * User Model
 */

require_once ROOT_PATH . '/core/Model.php';

class User extends Model
{
    protected $table = 'users';

    /**
     * Find user by email
     */
    public function findByEmail($email)
    {
        return $this->findBy('email', $email);
    }

    /**
     * Find user by email with role
     */
    public function findByEmailWithRole($email)
    {
        $sql = "SELECT u.*, 
                       r.code as role_code, 
                       r.name as role_name
                FROM users u
                LEFT JOIN user_roles ur ON u.id = ur.user_id AND ur.is_default = 1
                LEFT JOIN roles r ON ur.role_id = r.id
                WHERE u.email = ?
                LIMIT 1";

        $stmt = $this->query($sql, [$email]);
        return $stmt->fetch();
    }

    /**
     * Find user by remember token
     */
    public function findByRememberToken($token)
    {
        $sql = "SELECT u.*, 
                       r.code as role_code, 
                       r.name as role_name
                FROM users u
                LEFT JOIN user_roles ur ON u.id = ur.user_id AND ur.is_default = 1
                LEFT JOIN roles r ON ur.role_id = r.id
                WHERE u.remember_token = ?
                LIMIT 1";

        $stmt = $this->query($sql, [$token]);
        return $stmt->fetch();
    }

    /**
     * Create new user
     */
    public function create($data)
    {
        // Hash password
        if (isset($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], HASH_ALGO, ['cost' => HASH_COST]);
            unset($data['password']);
        }

        // Set default values
        $data['is_active'] = $data['is_active'] ?? true;
        $data['created_at'] = date('Y-m-d H:i:s');

        return $this->insert($data);
    }

    /**
     * Update user password
     */
    public function updatePassword($userId, $newPassword)
    {
        $passwordHash = password_hash($newPassword, HASH_ALGO, ['cost' => HASH_COST]);
        
        return $this->update($userId, [
            'password_hash' => $passwordHash,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Assign role to user
     */
    public function assignRole($userId, $roleId, $isDefault = true)
    {
        // If this is default role, unset other default roles
        if ($isDefault) {
            $sql = "UPDATE user_roles SET is_default = 0 WHERE user_id = ?";
            $this->query($sql, [$userId]);
        }

        $sql = "INSERT INTO user_roles (user_id, role_id, is_default) 
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE is_default = ?";
        
        $stmt = $this->query($sql, [$userId, $roleId, $isDefault ? 1 : 0, $isDefault ? 1 : 0]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Get user with roles
     */
    public function findWithRoles($userId)
    {
        $sql = "SELECT u.*, 
                       GROUP_CONCAT(r.id) as role_ids,
                       GROUP_CONCAT(r.code) as role_codes,
                       GROUP_CONCAT(r.name) as role_names
                FROM users u
                LEFT JOIN user_roles ur ON u.id = ur.user_id
                LEFT JOIN roles r ON ur.role_id = r.id
                WHERE u.id = ?
                GROUP BY u.id";

        $stmt = $this->query($sql, [$userId]);
        return $stmt->fetch();
    }

    /**
     * Check if email exists
     */
    public function emailExists($email, $exceptUserId = null)
    {
        if ($exceptUserId) {
            $sql = "SELECT COUNT(*) FROM users WHERE email = ? AND id != ?";
            $stmt = $this->query($sql, [$email, $exceptUserId]);
        } else {
            $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
            $stmt = $this->query($sql, [$email]);
        }

        return $stmt->fetchColumn() > 0;
    }

    /**
     * Update last login
     */
    public function updateLastLogin($userId)
    {
        return $this->update($userId, [
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
