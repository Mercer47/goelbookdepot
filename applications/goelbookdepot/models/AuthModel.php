<?php


class AuthModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
    }

    public function createUser($userData)
    {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $query = $this->db->query($sql,$userData['email']);
        $user = $query->num_rows();

        if ($user > 0) {
            return false;
        }

        $userData['password'] = password_hash($userData['password'],PASSWORD_BCRYPT);
        if ($this->db->insert('users',$userData)) {
            $this->db->where('id', $this->db->insert_id());
            $user = $this->db->get('users')->first_row();
            return $user;
        } else {
            return false;
        }
    }

    public function attemptLogin($credentials)
    {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $query = $this->db->query($sql,$credentials['email']);
        $user = $query->first_row();

        if (password_verify($credentials['password'], $user->password)) {
            return $user;
        }

        return false;
    }

    public function checkIfAccountExists($email)
    {
        return $this->db->get_where('users', array('email' => $email))->first_row();
    }

    public function updatePassword($user, $email)
    {
        $this->db->where('email', $email);
        return $this->db->update('users', $user);
    }

    public function confirmUser($token, $email)
    {
        $this->db->where('email', $email);
        $this->db->where('confirmed_user', false);
        $this->db->where('confirm_user_token', $token);
        $user = $this->db->get('users')->first_row();

        if (!is_null($user)) {
            $this->db->set('confirmed_user', true);
            $this->db->where('email', $email);
            $this->db->update('users');
            return $user;
        }
        return false;
    }

    public function createNewPasswordToken($email, $token)
    {
        $this->db->set('password_reset_token', $token);
        $this->db->set('updated_at', date("Y-m-d H:i:s"));
        $this->db->where('email', $email);
        $this->db->update('users');
    }

    public function validatePasswordResetToken($token, $email)
    {
        $this->db->where('email', $email);
        $this->db->where('password_reset_token', $token);
        $user = $this->db->get('users')->first_row();

        if (!is_null($user)) {
            if (time() - strtotime(date("Y-m-d H:i:s", strtotime($user->updated_at))) < 600) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function getUnverifiedUserByEmail($email)
    {
        return $this->db->get_where('users', array('email' => $email, 'confirmed_user' => 0))
            ->first_row();
    }

}