<?php
class Project_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    /*
        Get all the records from the database
    */
    public function get_all()
    {
        $projects = $this->db->get("projects")->result();
        return $projects;
    }

    public function register_user()
    {

        $userdata = [
            'First_Name' => $this->input->post('fname'),
            'Last_Name' => $this->input->post('lname'),
            'Username' => $this->input->post('username'),
            'Password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'Profile_Pic' => $this->upload->data('file_name')
        ];

        try {
            $this->db->insert('user', $userdata);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }
    public function verify_user()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $check = $this->db->get_where('user', ['Username' => $username])->row();

        if (password_verify($password, $check->Password)) {
            return $check;
        } else {
            return false;
        }
    }

    /*
        Store the record in the database
    */
    public function store()
    {

        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'created_at' => date("Y/m/d/H:i:s"),
            'image' => $this->upload->data('file_name')
        ];

        $result = $this->db->insert('projects', $data);
        return $result;
    }

    /*
        Get a specific record from the database
    */
    public function get($id)
    {
        $project = $this->db->get_where('projects', ['id' => $id])->row();
        return $project;
    }


    /*
        Update or Modify a record in the database
    */
    public function update($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'image' => $this->upload->data('file_name')
        ];

        $result = $this->db->where('id', $id)->update('projects', $data);
        return $result;

    }

    /*
        Destroy or Remove a record in the database
    */
    public function delete($id)
    {
        $result = $this->db->delete('projects', array('id' => $id));
        return $result;
    }

    public function verify_username($username)
    {

        $count = $this->db->query('SELECT COUNT(`Username`) AS count FROM user WHERE Username = ?', $username)->row();
        return $count;

    }
}
?>