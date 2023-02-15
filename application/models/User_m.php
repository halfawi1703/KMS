<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_user(
        $limit = false,
        $page = false,
        $field = false,
        $id = false,
        $email = false,
        $created_at_min = false,
        $created_at_max = false,
        $status = false,
        $sort = false
    ) {
        // Set Default Value
        if ($limit) {
            if (!$page) {
                $page = 1;
            }

            $offset = ($page - 1) * $limit;
        }

        if (!$field) {
            $field = ['*'];
        }

        if (!$status) {
            $status = 1;
        }

        if (!$sort) {
            $sort = ['user.created_at' => 'desc'];
        }

        $this->db->select($field);

        if ($id) {
            if (is_array($id)) {
                $this->db->where_in('user.id', $id);
            } else {
                $this->db->where('user.id', $id);
            }
        }

        if ($email) {
            if (is_array($id)) {
                $this->db->where_in('user.email', $email);
            } else {
                $this->db->where('user.email', $email);
            }
        }

        if ($created_at_min) {
            $this->db->where('user.created_at <', $created_at_min);
        }

        if ($created_at_max) {
            $this->db->where('user.created_at >', $created_at_max);
        }

        if ($status) {
            if (is_array($status)) {
                $this->db->where_in('user.status', $status);
            } else {
                $this->db->where('user.status', $status);
            }
        }

        if ($sort) {
            foreach ($sort as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get('user');

        $data = $query->result();

        $output = [];

        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $row = $value;

                if (!in_array('user.password', $field)) {
                    if (property_exists($value, 'password')) {
                        unset($row->password);
                    }
                }

                $output[$key] = $row;
            }
        }

        return $output;
    }

    public function get_user_role(
        $limit = false,
        $page = false,
        $field = false,
        $id = false,
        $user_id = false,
        $branch_id = false,
        $status = false,
        $sort = false
    ) {
        // Set Default Value
        if ($limit) {
            if (!$page) {
                $page = 1;
            }

            $offset = ($page - 1) * $limit;
        }

        if (!$field) {
            $field = ['*'];
        }

        if (!$status) {
            $status = 1;
        }

        if (!$sort) {
            $sort = ['user_role.created_at' => 'desc'];
        }

        $this->db->select($field);

        if ($id) {
            if (is_array($id)) {
                $this->db->where_in('user_role.id', $id);
            } else {
                $this->db->where('user_role.id', $id);
            }
        }

        if ($user_id) {
            if (is_array($user_id)) {
                $this->db->where_in('user_role.user_id', $user_id);
            } else {
                $this->db->where('user_role.user_id', $user_id);
            }
        }

        if ($branch_id) {
            if (is_array($branch_id)) {
                $this->db->where_in('user_role.branch_id', $branch_id);
            } else {
                $this->db->where('user_role.branch_id', $branch_id);
            }
        }

        if ($status) {
            if (is_array($status)) {
                $this->db->where_in('user_role.status', $status);
            } else {
                $this->db->where('user_role.status', $status);
            }
        }

        if ($sort) {
            foreach ($sort as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get('user_role');

        $data = $query->result();

        $output = [];

        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $row = $value;

                if (!in_array('user.password', $field)) {
                    if (property_exists($value, 'password')) {
                        unset($row->password);
                    }
                }

                $output[$key] = $row;
            }
        }

        return $output;
    }

    public function count_user(
        $limit = false,
        $page = false,
        $id = false,
        $email = false,
        $created_at_min = false,
        $created_at_max = false,
        $status = false
    ) {
        // Set Default Value
        if ($limit) {
            if (!$page) {
                $page = 1;
            }

            $offset = ($page - 1) * $limit;
        }

        if (!$status) {
            $status = 1;
        }

        $this->db->select('user.id');

        if ($email) {
            if (is_array($id)) {
                $this->db->where_in('user.email', $email);
            } else {
                $this->db->where('user.email', $email);
            }
        }

        if ($created_at_min) {
            $this->db->where('user.created_at <', $created_at_min);
        }

        if ($created_at_max) {
            $this->db->where('user.created_at >', $created_at_max);
        }

        if ($status) {
            if (is_array($status)) {
                $this->db->where_in('user.status', $status);
            } else {
                $this->db->where('user.status', $status);
            }
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get('user');

        $data = $query->num_rows();

        $output = $data;

        return $output;
    }

    public function auth($email, $hash_password = false)
    {
        $this->db->where('user.email', $email);

        if ($hash_password) {
            $this->db->where('user.password', $hash_password);
        }

        $query = $this->db->get('user', 1);

        $data = $query->num_rows();

        $output = ($data > 0) ? true : false;

        return $output;
    }

    public function insert_user($data_insert = [])
    {
        $this->db->insert('user', $data_insert);

        return $this->db->trans_status();
    }

    public function insert_user_role($data_insert = [])
    {
        $this->db->insert('user_role', $data_insert);

        return $this->db->trans_status();
    }

    public function update_user($data_update = [], $id = '', $email = '')
    {
        if (!$id && !$email) {
            return false;
        }

        if ($id) {
            if (is_array($id)) {
                $this->db->where_in('user.id', $id);
            } else {
                $this->db->where('user.id', $id);
            }
        }

        if ($email) {
            if (is_array($email)) {
                $this->db->where_in('user.email', $email);
            } else {
                $this->db->where('user.email', $email);
            }
        }

        $this->db->update('user', $data_update);

        return $this->db->affected_rows();
    }

}
