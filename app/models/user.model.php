<?php
class User
{
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $phone;
    private $division;
    private $district;
    private $upazila;
    private $zipcode;

    public function __construct()
    {
        // Constructor left empty for flexibility
    }

    /**
     * Authenticate a user with email and password
     * 
     * @param string $email User email
     * @param string $password User password
     * @return bool True if login successful, false otherwise
     */
    public function login($email, $password)
    {
        global $db;
        $email = sanitizeInput($email);

        $query = "SELECT password FROM users WHERE email = :email";
        $params = [':email' => $email];
        $hashedPasswordResult = $db->query($query, $params)->fetchColumn();

        if ($hashedPasswordResult && password_verify($password, $hashedPasswordResult)) {
            return true; // Login successful
        }
        return false; // Login failed
    }

    /**
     * Get user data by ID
     * 
     * @param int $id User ID
     * @return array User data
     * @throws InvalidArgumentException If ID is invalid
     */
    public function getUserDataByID($id)
    {
        global $db;
        if (!isset($id) || !is_numeric($id) || $id <= 0) {
            throw new InvalidArgumentException("Invalid user ID provided.");
        }
        $query = "SELECT * FROM users WHERE id = :id";
        $params = [':id' => $id];
        return $db->query($query, $params)->fetch();
    }

    /**
     * Get user data by email
     * 
     * @param string $email User email
     * @return array|false User data or false if not found
     */
    public function getUserByEmail($email)
    {
        global $db;
        $email = sanitizeInput($email);

        $query = "SELECT * FROM users WHERE email = :email";
        $params = [':email' => $email];
        return $db->query($query, $params)->fetch();
    }

    /**
     * Check if email already exists
     * 
     * @param string $email User email
     * @return bool True if email exists, false otherwise
     */
    public function emailExists($email)
    {
        global $db;
        $email = sanitizeInput($email);

        $query = "SELECT COUNT(*) FROM users WHERE email = :email";
        $params = [':email' => $email];
        return $db->query($query, $params)->fetchColumn() > 0;
    }

    /**
     * Save a new user to the database
     * 
     * @param string $first_name User's first name
     * @param string $last_name User's last name
     * @param string $email User's email
     * @param string $password User's password
     * @param string $phone User's phone number
     * @param string $division User's division
     * @param string $district User's district
     * @param string $upazila User's upazila
     * @param string $zipcode User's zipcode
     * @return bool True if user saved successfully
     */
    public function save($first_name, $last_name, $email, $password, $phone, $division, $district, $upazila, $zipcode)
    {
        global $db;

        // Sanitize inputs
        $first_name = sanitizeInput($first_name);
        $last_name = sanitizeInput($last_name);
        $email = sanitizeInput($email);
        $phone = sanitizeInput($phone);
        $division = sanitizeInput($division);
        $district = sanitizeInput($district);
        $upazila = sanitizeInput($upazila);
        $zipcode = sanitizeInput($zipcode);

        // Check if email already exists
        if ($this->emailExists($email)) {
            return false;
        }

        $query = "INSERT INTO users (email, password, first_name, last_name, phone, division, district, upazila, zipcode, created_at) 
                  VALUES (:email, :password, :first_name, :last_name, :phone, :division, :district, :upazila, :zipcode, NOW())";
        $params = [
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':phone' => $phone,
            ':division' => $division,
            ':district' => $district,
            ':upazila' => $upazila,
            ':zipcode' => $zipcode
        ];
        $db->query($query, $params);
        return true;
    }

    /**
     * Update user profile information
     * 
     * @param int $id User ID
     * @param array $data Data to update
     * @return bool True if update successful
     */
    public function updateProfile($id, $data)
    {
        global $db;

        if (!isset($id) || !is_numeric($id) || $id <= 0) {
            return false;
        }

        $allowedFields = ['first_name', 'last_name', 'phone', 'division', 'district', 'upazila', 'zipcode'];
        $updates = [];
        $params = [':id' => $id];

        foreach ($data as $field => $value) {
            if (in_array($field, $allowedFields)) {
                $updates[] = "{$field} = :{$field}";
                $params[":{$field}"] = sanitizeInput($value);
            }
        }

        if (empty($updates)) {
            return false;
        }

        $query = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = :id";
        $db->query($query, $params);
        return true;
    }
}
