<?php
class User extends CI_Controller {

		public function __construct(){
			parent::__construct();

			// cek keberadaan session 'username'	
            /*
			if (!isset($_SESSION['username'])){
				// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
				redirect('login');
			}
            */
        }
        // method untuk menambah data user
		public function insert(){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $role = $_POST['role'];

            $this->user_model->insertUser($username, $password, $fullname, $role);

            redirect('user/showUser');

        }

        public function showInsertUser(){
            $data['fullname'] = $_SESSION['fullname'];

            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/adduser', $data);
            $this->load->view('dashboard/footer', $data);
        }

        public function showUser(){

        	// panggil method showBook() dari book_model untuk membaca seluruh data buku
        	$data['user'] = $this->user_model->showUser();

        	// baca data session 'fullname' untuk ditampilkan di view
        	$data['fullname'] = $_SESSION['fullname'];

        	// tampilkan view 'dashboard/books'
        	$this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/user', $data);
            $this->load->view('dashboard/footer', $data);
        }

        public function delete($username){
            $this->user_model->delUser($username);
            // arahkan ke method 'books' di kontroller 'dashboard'
            redirect('user/showUser');
        }

        public function edit($username){
            // get the data
            $data['user'] = $this->user_model->showUser($username);
            // get the user that edit from session
            $data['fullname'] = $_SESSION['fullname'];
    
            $this->load->view('dashboard/header', $data);
            $this->load->view('dashboard/edituser', $data);
            $this->load->view('dashboard/footer');		
        }
    
        // method untuk update data buku berdasarkan id
        public function update(){
    
            // baca data dari form insert buku
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $password = $_POST['password'];
            $role = $_POST['role'];
    
            // panggil method insertBook() di model 'book_model' untuk menjalankan query insert
            $this->user_model->editUser($username, $fullname, $password, $role);
    
            // arahkan ke method 'books' di kontroller 'dashboard'
            redirect('user/showuser');		
        }
    }