<?php

class Frontend_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function check_admin_login() {

        // grab user input

        $username = $this->security->xss_clean($this->input->post('username'));

        $password = $this->security->xss_clean($this->input->post('password'));

        // Prep the query

        $this->db->where('email', $username);

        $this->db->where('password', ($password));

        $this->db->where('status', 'Verified');

        // Run the query

        $query = $this->db->get('users');

        // Let's check if there are any results

        if ($query->num_rows == 1) {

            // If there is a user, then create session data

            $row = $query->row();

            $data = array('login_id' => $row->id, 'name' => $row->name, 'role' => $row->role, 'validated' => true);

            $this->session->set_userdata($data);

            return true;
        }

        // If the previous process did not validate
        // then return false.

        return false;
    }

    public function check_user_login() {

        // grab user input

        $username = $this->security->xss_clean($this->input->post('username'));

        $password = $this->security->xss_clean($this->input->post('password'));

        // Prep the query

        $this->db->where('email', $username);

        $this->db->where('password', ($password));

        // Run the query

        $query = $this->db->get('users');

        // Let's check if there are any results

        if ($query->num_rows == 1) {

            // If there is a user, then create session data

            $row = $query->row();

            $data = array('user_id' => $row->id, 'name' => $row->name, 'validated' => true);

            $this->session->set_userdata($data);

            return true;
        }

        // If the previous process did not validate
        // then return false.

        return false;
    }

    public function fetch_sql_record($sql) {

        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function get_sql_record($sql) {

        $query = $this->db->query($sql);

        if ($query->num_rows == 1) {

            $row = $query->row();

            return $row;
        } else {

            return false;
        }
    }

    // function for all record start

    public function fetch_record($tbname, $fname = '', $otype = '') {

        if ($fname != '') {

            $this->db->order_by($fname, $otype);
        }

        $query = $this->db->get($tbname);

        return $query->result_array();
    }

    // function for all record end

    public function fetch_greaterdata($sql) {

        $query = $this->db->query($sql);

        if ($query->num_rows > 0) {

            $row = $query->num_rows();

            return $row;
        } else {
            return false;
        }
    }

    // function for single record start

    public function fetch_recordbyid($tbname, $data) {

        $this->db->where($data);

        $query = $this->db->get($tbname);

        if ($query->num_rows == 1) {

            $row = $query->row();

            return $row;
        } else {

            return false;
        }
    }

    // function for single record end
    // function for insert record start

    public function insert_data($table, $data) {

        $que = $this->db->insert_string($table, $data);

        $this->db->query($que);

        $id = $this->db->insert_id();

        if ($id) {
            return $id;
        } else {
            return false;
        }
    }

    // function for insert record end
    // function for single record start

    public function fetch_condrecord($tbname, $data) {

        $this->db->where($data);

        $query = $this->db->get($tbname);

        if ($query->num_rows > 0) {

            $row = $query->result_array();

            return $row;
        } else {
            return false;
        }
    }

    public function fetch_condrecordorder($tbname, $data, $fname, $otype) {

        $this->db->where($data);

        $this->db->order_by($fname, $otype);

        $query = $this->db->get($tbname);

        if ($query->num_rows > 0) {

            $row = $query->result_array();

            return $row;
        } else {
            return false;
        }
    }

    // function for single record end
    // function for single record start

    public function fetch_condrecordwithfield($tbname, $data, $fname) {

        $this->db->where($data);

        $this->db->select($fname);

        $query = $this->db->get($tbname);

        if ($query->num_rows > 0) {

            $row = $query->result_array();

            return $row;
        } else {
            return false;
        }
    }

    // function for single record end
    // function for update record start

    public function update_data($table, $data, $where) {

        // $this->db->select('*');
        // $this->db->from($table);
        // $this->db->where($where); 

        /* update cart */

        $this->db->where($where);

        $rs = $this->db->update($table, $data);

        if ($rs) {
            return true;
        } else {
            return false;
        }
    }

    // function for update record end
    // function for delete record start

    public function delete_data($table, $where) {

        $rs = $this->db->delete($table, $where);

        if ($rs) {
            return true;
        } else {
            return false;
        }
    }

    public function fetch_join_records($firsttb, $secondtp, $fname, $sname, $wherefield, $val) {

        $this->db->select('*');

        $this->db->from($firsttb);

        $this->db->join($secondtp, "$secondtp.$sname = $firsttb.$fname");

        $this->db->where("$secondtp.$wherefield", $val);

        $query = $this->db->get();

        return $query->result();
    }

    // function for single record start

    public function fetch_condrecordbylimit($tbname, $data, $fname, $limit, $otype) {

        $this->db->where($data);

        $this->db->limit($limit);

        $this->db->order_by($fname, $otype);

        $query = $this->db->get($tbname);

        if ($query->num_rows > 0) {

            $row = $query->result_array();

            return $row;
        } else {
            return false;
        }
    }

    public function fetch_recordbylimit($tbname, $fname, $limit, $otype) {

        $this->db->limit($limit);

        $this->db->order_by($fname, $otype);

        $query = $this->db->get($tbname);

        if ($query->num_rows > 0) {

            $row = $query->result_array();

            return $row;
        } else {
            return false;
        }
    }

    /*     * ***********Query two table join ****************** */

    public function get_data_twotable_column_where($table1, $table2, $id1, $id2, $column = '', $where, $orderby, $like, $between) {

        if ($column != '') {

            $this->db->select($column);
        } else {

            $this->db->select('*');
        }

        $this->db->from($table1);

        $this->db->join($table2, $table2 . '.' . $id2 . '=' . $table1 . '.' . $id1);

        if ($where != '') {

            $this->db->where($where);
        }

        if ($orderby != '') {

            $this->db->order_by($orderby, 'DESC');
        }

        if ($like != '') {

            $this->db->like($like);
        }

        if ($between != '') {

            $this->db->like($between);
        }

        $que = $this->db->get();



        return $que->result_array();
    }

    /*     * **********End Join Two Table****************** */
}
