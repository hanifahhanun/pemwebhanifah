<?php
class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		
		// cek keberadaan session 'username'	
		if (!isset($_SESSION['username'])){
			// jika session 'username' blm ada, maka arahkan ke kontroller 'login'
			redirect('login');
		}
    }
    //method untuk menambah kategori

	public function insertKategori(){
		// membaca data dari form insert buku
		$kategoriBaru = $_POST['kategoriBaru'];

		//memanggil method insertBook di model 'book_model' untuk menjalankan query
		$this->kategori_model->insertkategori($kategoriBaru);

		// mengarahkan ke method books di kontroller dashboard
		redirect('kategori/showKategori');
    }

    public function showInsertKategori(){
        $data['fullname'] = $_SESSION['fullname'];

        $this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/addkategori', $data);
        $this->load->view('dashboard/footer');	
    }
    
    public function showKategori(){
        $data['kategori'] = $this->kategori_model->showKategori();

		$data['countBukuTeks'] = 0;
		$data['countMajalah'] = 0;
		$data['countSkripsi'] = 0;
		$data['countThesis'] = 0;
		$data['countDisertasi'] = 0;
		$data['countNovel'] = 0;

		// baca data session 'fullname' untuk ditampilkan di view
		$data['fullname'] = $_SESSION['fullname'];

		// tampilkan view 'dashboard/books'
		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/kategori', $data);
		$this->load->view('dashboard/footer', $data);   
  
    }

    public function delete($id){
        $this->kategori_model->delKategori($id);
		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('kategori/showkategori');
    }

    public function edit($id){
        $data['kategori']=$this->kategori_model->showKategori($id);
		
		$data['fullname'] = $_SESSION['fullname'];

		$this->load->view('dashboard/header', $data);
        $this->load->view('dashboard/editkategori', $data);
        $this->load->view('dashboard/footer');		
    }

    public function update(){
        $idkategori = $_POST['idkategori'];
		$kategori = $_POST['kategori'];

		// panggil method insertBook() di model 'book_model' untuk menjalankan query insert
		$this->kategori_model->editKategori($idkategori,$kategori);

		// arahkan ke method 'books' di kontroller 'dashboard'
		redirect('kategori/showkategori');
    }
}
?>