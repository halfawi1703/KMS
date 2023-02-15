<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_session_m extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_session(
        $limit = false,
        $page = false,
        $field = false,
        $id = false,
        $user_id = false,
        $session_id = false,
        $access_token = false,
        $refresh_token = false,
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
            $field = ['user_session_log.*'];
        }

        if (!$sort) {
            $sort = ['user_session_log.created_at' => 'desc'];
        }

        $this->db->select($field);

        if ($id) {
            if (is_array($id)) {
                $this->db->where_in('user_session_log.id', $id);
            } else {
                $this->db->where('user_session_log.id', $id);
            }
        }

        if ($user_id) {
            if (is_array($user_id)) {
                $this->db->where_in('user_session_log.user_id', $user_id);
            } else {
                $this->db->where('user_session_log.user_id', $user_id);
            }
        }

        if ($session_id) {
            if (is_array($session_id)) {
                $this->db->where_in('user_session_log.session_id', $session_id);
            } else {
                $this->db->where('user_session_log.session_id', $session_id);
            }
        }

        if ($access_token) {
            if (is_array($access_token)) {
                $this->db->where_in('user_session_log.access_token', $access_token);
            } else {
                $this->db->where('user_session_log.access_token', $access_token);
            }
        }

        if ($refresh_token) {
            if (is_array($refresh_token)) {
                $this->db->where_in('user_session_log.refresh_token', $refresh_token);
            } else {
                $this->db->where('user_session_log.refresh_token', $refresh_token);
            }
        }

        if ($status) {
            if (is_array($status)) {
                $this->db->where_in('user_session_log.status', $status);
            } else {
                $this->db->where('user_session_log.status', $status);
            }
        }

        if ($sort) {
            foreach ($sort as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }

        if ($limit) {
            $this->db->limit($limit);
        }

        $query = $this->db->get('user_session_log');

        $data = $query->result();

        $output = [];

        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $row = $value;
                $output[$key] = $row;
            }
        }

        return $output;
    }

    public function insert_session($data_insert = [])
    {
        $this->db->insert('user_session_log', $data_insert);

        return $this->db->trans_status();
    }

    public function update_session(
        $data_update = [],
        $id = false,
        $user_id = false,
        $session_id = false,
        $access_token = false,
        $refresh_token = false,
        $status = false
    ) {
        if (!$id && !$user_id && !$session_id && !$access_token && !$refresh_token) {
            return false;
        }

        if ($id) {
            if (is_array($id)) {
                $this->db->where_in('user_session_log.id', $id);
            } else {
                $this->db->where('user_session_log.id', $id);
            }
        }

        if ($user_id) {
            if (is_array($user_id)) {
                $this->db->where_in('user_session_log.user_id', $user_id);
            } else {
                $this->db->where('user_session_log.user_id', $user_id);
            }
        }

        if ($session_id) {
            if (is_array($session_id)) {
                $this->db->where_in('user_session_log.session_id', $session_id);
            } else {
                $this->db->where('user_session_log.session_id', $session_id);
            }
        }

        if ($access_token) {
            if (is_array($access_token)) {
                $this->db->where_in('user_session_log.access_token', $access_token);
            } else {
                $this->db->where('user_session_log.access_token', $access_token);
            }
        }

        if ($refresh_token) {
            if (is_array($refresh_token)) {
                $this->db->where_in('user_session_log.refresh_token', $refresh_token);
            } else {
                $this->db->where('user_session_log.refresh_token', $refresh_token);
            }
        }

        if ($status) {
            if (is_array($status)) {
                $this->db->where_in('user_session_log.status', $status);
            } else {
                $this->db->where('user_session_log.status', $status);
            }
        }

        $this->db->update('user_session_log', $data_update);

        return $this->db->trans_status();
    }

}
