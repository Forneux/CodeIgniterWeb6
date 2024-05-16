<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Project extends CI_Controller
{

  /*
     Display all records in page
  */

  public function index()
  {
    $data = [
      'projects' => $this->project->get_all(),
      'title' => 'CodeIgniter Project Manager'
    ];

    $this->load->view('layout/head', $data);
    $this->load->view('layout/header');
    $this->load->view('project/index', $data);
    $this->load->view('layout/footer');

  }

  public function login()
  {
    $data = [
      'title' => 'Login'
    ];

    $this->load->view('layout/head', $data);
    $this->load->view('project/login');
    $this->load->view('layout/footer');

  }

  public function logout()
  {
    session_unset();
    session_destroy();
    redirect(base_url());
  }

  public function register()
  {
    $data = [
      'title' => 'Register'
    ];

    $this->load->view('layout/head', $data);
    $this->load->view('project/register');
    $this->load->view('layout/footer');
  }

  public function register_user()
  {

    $check = $this->project->verify_username($_POST['username']);

    if ($check->count != 0) {

      $this->session->set_flashdata('error', 'Username already exists.');
      redirect(base_url('register'));
    }

    $this->form_validation->set_rules('fname', 'First Name', 'required');
    $this->form_validation->set_rules('lname', 'Last Name', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if (!$this->form_validation->run()) {

      $this->session->set_flashdata('error', validation_errors());
      redirect(base_url('register'));

    } else {

      $config = [
        'upload_path' => 'assets/profimg',
        'allowed_types' => 'gif|jpg|jpeg|png',
        'max_size' => 100,
        'max_width' => 1024,
        'max_height' => 768
      ];

      $this->load->library('upload', $config);
      $this->upload->initialize($config);

      if ($this->upload->do_upload('pic')) {

        $exec = $this->project->register_user();

        if ($exec == true) {
          $this->session->set_flashdata('success', 'User registered successfully.');
          redirect(base_url());
        } else {
          $this->session->set_flashdata('error', $exec);
          redirect(base_url());
        }
      } else {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect(base_url('register'));
      }
    }
  }

  public function login_user()
  {
    $exec = $this->project->verify_user();
    if (!$exec) {
      $this->session->set_flashdata('error', 'Username or Password incorrect.');
      redirect(base_url());

    } else {
      $this->load->library('session');

      $userdata = [
        'User_ID' => $exec->User_ID,
        'First_Name' => $exec->First_Name,
        'Last_Name' => $exec->Last_Name,
        'Username' => $exec->Username,
        'Profile_Pic' => $exec->Profile_Pic
      ];

      $this->session->set_userdata($userdata);
      redirect(base_url('home'));
    }
  }

  /*
    Display a record
  */

  public function show($id)
  {
    $data = [
      'project' => $this->project->get($id),
      'title' => "Show Project"
    ];

    $this->load->view('layout/head', $data);
    $this->load->view('layout/header');
    $this->load->view('project/show', $data);
    $this->load->view('layout/footer');
  }

  /*
    Create a record page
  */
  public function create()
  {
    $data['title'] = "Create Project";
    $this->load->view('layout/head', $data);
    $this->load->view('layout/header');
    $this->load->view('project/create', $data);
    $this->load->view('layout/footer');
  }

  /*
    Save the submitted record
  */
  public function store()
  {

    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');

    if (!$this->form_validation->run()) {
      $this->session->set_flashdata('errors', validation_errors());
      redirect(base_url('project/create'));

    } else {

      $config = [
        'upload_path' => 'assets/project_images',
        'allowed_types' => 'gif|jpg|jpeg|png',
        'max_size' => 100,
        'max_width' => 1024,
        'max_height' => 768
      ];

      $this->load->library('upload', $config);
      
      if ($this->upload->do_upload('image')) {

        $this->project->store();

        $this->session->set_flashdata('success', "Saved Successfully!");
        redirect(base_url('home'));

      } else {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect(base_url('home'));
      }

    }

  }

  /*
    Edit a record page
  */
  public function edit($id)
  {
    $data['project'] = $this->project->get($id);
    $data['title'] = "Edit Project";

    $this->load->view('layout/head', $data);
    $this->load->view('layout/header');
    $this->load->view('project/edit', $data);
    $this->load->view('layout/footer');
  }

  /*
    Update the submitted record
  */
  public function update($id)
  {
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');

    if (!$this->form_validation->run()) {
      $this->session->set_flashdata('errors', validation_errors());
      redirect(base_url('project/edit/' . $id));
    } else {

      $config = [
        'upload_path' => 'assets/project_images',
        'allowed_types' => 'gif|jpg|jpeg|png',
        'max_size' => 100,
        'max_width' => 1024,
        'max_height' => 768
      ];

      $this->load->library('upload', $config);
      
      if ($this->upload->do_upload('image')) {

        $this->project->update($id);
        $this->session->set_flashdata('success', "Updated Successfully!");
        redirect(base_url('home'));

      }
      else {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect(base_url('home'));
      }
    }

  }

  /*
    Delete a record
  */

  public function delete($id)
  {
    $item = $this->project->delete($id);

    $this->session->set_flashdata('success', "Deleted Successfully!");

    redirect(base_url('home'));
  }


}