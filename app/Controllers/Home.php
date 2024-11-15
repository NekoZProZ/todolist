<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_kk;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class Home extends BaseController
{
	protected $logo;

    public function __construct()
    {
        // Initialize the model
        $this->model = new M_kk();

        // Populate the $logo property by calling the protected method
        $this->logo = $this->fetchLogoData();
    }

    // Protected method to fetch data
    protected function fetchLogoData()
    {
        $logoData = [];
        
        // Define your query conditions
        $whereLogo = ['id_setting' => '1'];
        $logoData['logo'] = $this->model->getWhere('setting', $whereLogo);

        // $whereUser = ['id_user' => session()->get('id')];
        // $logoData['acc'] = $this->model->getWhere('menu', $whereUser);

        return $logoData;
    }

	public function check_connection()
    {
        $url = "https://www.google.com";
        
        // Initialize cURL session
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);  // Timeout of 5 seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Execute cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        // Close cURL session
        curl_close($ch);
        
        // Check if the response was successful
        if ($response && $http_code >= 200 && $http_code < 300) {
            // Online
            $data = [
                'status' => 'online',
                'message' => 'You are connected to the internet.'
            ];
        } else {
            // Offline
            $data = [
                'status' => 'offline',
                'message' => 'No internet connection detected.'
            ];
        }

        // Load view or return JSON (if an API endpoint)
        print_r($data);
    }

	public function index()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		// 	$where=array('logo_id' => '1');
		// $logo['menu'] = $model->getwhere('logo',$where);
		// $where1=array('id_user' =>session()->get('id'));
		// $logo['acc'] = $model->getwhere('menu',$where1);
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		echo view('dashboard');
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function settings()
	{
		if(session()->get('level')>0){
			$model=new M_kk;
			// $isi=array(
			// 'activity_time'=>date('Y-m-d H:i:s'),
			// 'activity'=>session()->get('nama').' masuk ke halaman settings'
			// );
			// $model->tambah('activity_log', $isi);
		// 	$where=array('logo_id' => '1');
		// $logo['menu'] = $model->getwhere('logo',$where);
		// $where1=array('id_user' =>session()->get('id'));
		// $logo['acc'] = $model->getwhere('menu',$where1);
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		echo view('settings');
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_settings()
	{
		
		$nama = $this->request->getPost('nama');
		$icon=$this->request->getFile('icon');
		$logo=$this->request->getFile('logo');

		$model=new M_kk;
		//print_r($table);
		if ($icon->isFile()) {
            // Process the icon file
            $model->delete_icon();
            $model->upload_icon($icon);
        } else {
            // Handle the case where no icon file was uploaded
        }
        if ($logo->isFile()) {
            // Process the logo file
            $model->delete_logo();
            $model->upload_logo($logo);
        } else {
            // Handle the case where no logo file was uploaded
        }
        // Check if $nama has a value
        if (!empty($nama)) {
            // Process the $nama value
            $change=array(
		'nama_web'=>$nama
		);
            $where=array(
		'id_setting'=>'1'
		);

		//print_r($storage);
    	$model->edit('setting',$change,$where);
        } else {
            // Handle the case where $nama is empty
        }
		
		return redirect()->to('home/settings');
	}

	public function login()
	{
		if(session()->get('level')>0){
			return redirect()->to('home/index');
			}else{
				$url = "https://www.google.com";
        
        // Initialize cURL session
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);  // Timeout of 5 seconds
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Execute cURL request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        // Close cURL session
        curl_close($ch);
        
        // Check if the response was successful
        if ($response && $http_code >= 200 && $http_code < 300) {
            // Online
            $data['capt'] = [
                'status' => 'online'
            ];
        } else {
            // Offline
            $data['capt'] = [
                'status' => 'offline'
            ];
        }
				$model=new M_kk;
			$where=array('logo_id' => '1');
		
		echo view('login', $this->logo);
		
	}

		
	}

	

public function aksi_login()
	{
		$user = $this->request->getPost('username');
		$pass = $this->request->getPost('password');
		$tb = $this->request->getPost('tb');
		

		$login=array(
		'username'=>$user,
		'password'=>md5($pass)
		
		);

		$model=new M_kk;
		//print_r($table);
		//$cek = $model->getwhere('user',$login);
		if ($tb==1){
			$cek = $model->getwhere('tb_masyarakat',$login);
			session()->set('nama',$cek->username);
			session()->set('id',$cek->id_user);
			if ($cek>0){
			session()->set('level','3');
			}
		}
		if ($tb==2){
			$cek = $model->getwhere('tb_petugas',$login);
			session()->set('nama',$cek->username);
			session()->set('id',$cek->id_petugas);
			session()->set('level',$cek->id_level);
		}
		

		if ($cek>0){
			// if ($table='dokter') {
			// 	session()->set('nama',$cek->username);
			// session()->set('id',$cek->user_id);
			// session()->set('level',$cek->level);

			

			return redirect()->to('home/index');
		}else{
			return redirect()->to('home/login');
		}
		
	}

	

	public function register()
	{
		echo view('header');
		echo view('register');
		
	}

	public function aksi_register()
	{
		$model=new M_kk;

		$first = $this->request->getPost('first_name');
		$last = $this->request->getPost('last_name');
		$pass = md5($this->request->getPost('password'));
		$email = $this->request->getPost('email');

		// Extract domain from email
    	$domain = explode('@', $email)[1];

    	// Check if domain is from Google
    	if ($model->checkGoogleDomain($domain)) {
        //echo "Valid Google email address";
    		$storage=array(
		'username'=>$first . ' ' . $last,
		'password'=>$pass,
		'email'=>$email,
		'level'=> 1
		);

		//print_r($storage);
    	$model->tambah('user',$storage);

		$login=array(
		'email'=>$email,
		'password'=>$pass
		
		);

		$cek = $model->getwhere('user',$login);


		if ($cek>0){
			session()->set('nama',$cek->username);
			session()->set('email',$cek->email);
			session()->set('id',$cek->id_user);
			session()->set('level',$cek->level);
			return redirect()->to('home/index');
		}else{
			return redirect()->to('home/login');
		}
    	} else {
        //echo "Not a Google email address";
    		return redirect()->to('home/register');
    	}

		

		

	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('home/login');
		
	}













// DATA
// USER
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////
public function data_user()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		$where=array('delete_at' => NULL);
		$data['clara'] = $model->joinwhere('tb_petugas','tb_level','tb_level.id_level=tb_petugas.id_level',$where);
		echo view('data_user', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function data_masy()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		$where=array('delete_at' => NULL);
		$data['clara'] = $model->whereshow('tb_masyarakat',$where);
		echo view('data_masy', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function data_barang()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		// $where=array('delete_at' => NULL);
		$data['clara'] = $model->tampil('tb_barang');
		echo view('data_barang', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function data_lelang()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		// $where=array('delete_at' => NULL);
		$data['clara'] = $model->jointwo('tb_lelang', 'tb_barang', 'tb_petugas', 'tb_lelang.id_barang=tb_barang.id_barang', 'tb_lelang.id_petugas=tb_petugas.id_petugas');
		echo view('data_lelang', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function daftar_lelang()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		// $where=array('delete_at' => NULL);
		$data['clara'] = $model->jointwo('tb_lelang', 'tb_barang', 'tb_petugas', 'tb_lelang.id_barang=tb_barang.id_barang', 'tb_lelang.id_petugas=tb_petugas.id_petugas');
		echo view('daftar_lelang', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function data_history()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		// $where=array('delete_at' => NULL);
		$data['clara'] = $model->jointhere('history_lelang','tb_lelang','tb_barang','tb_masyarakat',
											'history_lelang.id_lelang = tb_lelang.id_lelang',
											'history_lelang.id_barang = tb_barang.id_barang',
											'history_lelang.id_user = tb_masyarakat.id_user');
		echo view('data_history', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function restore_masy()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		// $where=array('delete_at' => NULL);
		$where=array('delete_at !=' => null);
		$data['clara'] = $model->whereshow('tb_masyarakat',$where);
		echo view('restore_masy', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function edit_masy($id)
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		$where=array('id_user' => $id);
		$data['clara'] = $model->getwhere('tb_masyarakat',$where);
		echo view('edit_masy', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function edit_barang($id)
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		$where=array('id_barang' => $id);
		$data['clara'] = $model->getwhere('tb_barang',$where);
		echo view('edit_barang', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function tawar_lelang($id)
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		$where=array('id_lelang' => $id);
		$data['clara'] = $model->getwhere('tb_lelang',$where);
		echo view('tawar', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function restore_user()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		//$where=array('delete_at' => NULL);
		//$data['clara'] = $model->query('select * from user WHERE delete_at IS NOT NULL');
		$where=array('delete_at !=' => null);
		$data['clara'] = $model->joinwhere('tb_petugas','tb_level','tb_level.id_level=tb_petugas.id_level',$where);
		echo view('restore_user', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function delete_user($id)
	{

			$model=new M_kk;
			$where=array('id_petugas' => $id);
			$isi=array(
			'delete_at'=>date('Y-m-d H:i:s')
			);
			$model->edit('tb_petugas', $isi, $where);
			// $isi=array(
			// 'activity_time'=>date('Y-m-d H:i:s'),
			// 'activity'=>session()->get('nama').' delete data user '.$id
			// );
			// $model->tambah('activity_log', $isi);
			// $model->hapus('users',$where);
		
		return redirect()->to('home/data_user');
	}

	public function delete_masy($id)
	{

			$model=new M_kk;
			$where=array('id_user' => $id);
			$isi=array(
			'delete_at'=>date('Y-m-d H:i:s')
			);
			$model->edit('tb_masyarakat', $isi, $where);
			// $isi=array(
			// 'activity_time'=>date('Y-m-d H:i:s'),
			// 'activity'=>session()->get('nama').' delete data user '.$id
			// );
			// $model->tambah('activity_log', $isi);
			// $model->hapus('users',$where);
		
		return redirect()->to('home/data_masy');
	}

	public function aksi_restore_user($id)
	{

			$model=new M_kk;
			$where=array('id_petugas' => $id);
			$isi=array(
			'delete_at'=>NULL
			);
			$model->edit('tb_petugas', $isi, $where);
		
		return redirect()->to('home/restore_user');
	}

	public function aksi_restore_masy($id)
	{

			$model=new M_kk;
			$where=array('id_user' => $id);
			$isi=array(
			'delete_at'=>NULL
			);
			$model->edit('tb_masyarakat', $isi, $where);
		
		return redirect()->to('home/restore_masy');
	}

	public function edit_user($id)
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		$where=array('id_petugas' => $id);
		$data['clara'] = $model->getwhere('tb_petugas',$where);
		echo view('edit_user', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function reset_pass($id)
	{

			$model=new M_kk;
			$where=array('user_id' => $id);
			$isi=array(
			'password'=>md5('1')
			);
			$model->edit('users', $isi, $where);
		
		return redirect()->to('home/detail_user/'.$id);
	}
	public function aksi_edit_user($id)
	{

			$model=new M_kk;
			$na = $this->request->getPost('nama');
			$us = $this->request->getPost('username');

			$where=array('id_petugas' => $id);
			$isi=array(
			'nama_petugas'=>$na,
			'username'=>$us
			);
			$model->edit('tb_petugas', $isi, $where);
		
		return redirect()->to('home/data_user');
	}


	public function aksi_tawar($id)
	{

			$model=new M_kk;
			$na = $this->request->getPost('tawar');

			$where=array('id_lelang' => $id);
			$isi=array(
			'harga_akhir'=>$na,
			'id_user'=>session()->get('id')
			);
			$model->edit('tb_lelang', $isi, $where);
		
		return redirect()->to('home/daftar_lelang');
	}



	public function aksi_edit_barang($id)
	{

			$model=new M_kk;
			$na = $this->request->getPost('nama');
			$us = $this->request->getPost('harga');
			$de = $this->request->getPost('des');

			$where=array('id_barang' => $id);
			$isi=array(
			'nama_barang'=>$na,
			'harga_awal'=>$us,
			'deskripsi_barang'=>$de
			);
			$model->edit('tb_barang', $isi, $where);
		
		return redirect()->to('home/data_barang');
	}

	public function aksi_edit_masy($id)
	{

			$model=new M_kk;
			$na = $this->request->getPost('nama');
			$us = $this->request->getPost('username');
			$te = $this->request->getPost('telp');

			$where=array('id_user' => $id);
			$isi=array(
			'nama_lengkap'=>$na,
			'username'=>$us,
			'telp'=>$te
			);
			// print_r($isi);
			$model->edit('tb_masyarakat', $isi, $where);
		
		return redirect()->to('home/data_masy');
	}

	public function tambah_user()
	{

			if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);

		echo view('tambah_user');
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function tambah_barang()
	{

			if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);

		echo view('tambah_barang');
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_tambah_barang()
	{

			$model=new M_kk;
			$user = $this->request->getPost('nama');
			$pass = $this->request->getPost('har');
			$nl = $this->request->getPost('des');
			$currentDate = date('Y-m-d');
			
			$isi=array(
			'nama_barang'=>$user,
			'harga_awal'=>$pass,
			'deskripsi_barang'=>$nl,
			'tgl'=>$currentDate
			);
			$model->tambah('tb_barang', $isi);
		
		return redirect()->to('home/data_barang');
	}

	public function tutup_lelang($id)
	{

			$model=new M_kk;
			// $user = $this->request->getPost('nama');
			// $pass = $this->request->getPost('har');
			// $nl = $this->request->getPost('des');
			//$currentDate = date('Y-m-d');
			$where=array('id_lelang' => $id);
			$isi=array(
				'status'=>'ditutup'
				);
			$model->edit('tb_lelang', $isi, $where);
			$cek = $model->getwhere('tb_lelang',$where);
			//session()->set('nama',$cek->username);
			
			$isi=array(
			'id_lelang'=>$cek->id_lelang,
			'id_barang'=>$cek->id_barang,
			'id_user'=>$cek->id_user,
			'penawaran_harga'=>$cek->harga_akhir
			);
			$model->tambah('history_lelang', $isi);
		
		return redirect()->to('home/data_lelang');
	}

	public function buka_lelang($id)
	{

			$model=new M_kk;

			$currentDate = date('Y-m-d');
			
			$isi=array(
			'id_barang'=>$id,
			'tgl_lelang'=>$currentDate,
			'id_petugas'=> session()->get('id'),
			'status'=>'dibuka'
			);
			$model->tambah('tb_lelang', $isi);
		
		return redirect()->to('home/data_barang');
	}

	public function aksi_tambah_user()
	{

			$model=new M_kk;
			$user = $this->request->getPost('nama');
			$pass = $this->request->getPost('username');
			$nl = $this->request->getPost('password');
			$jk = $this->request->getPost('level');
			
			$isi=array(
			'nama_petugas'=>$user,
			'username'=>$pass,
			'password'=>md5($nl),
			'id_level'=>$jk
			);
			$model->tambah('tb_petugas', $isi);
		
		return redirect()->to('home/data_user');
	}





	public function tambah_masy()
	{

			if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);

		echo view('tambah_masy');
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}
	public function aksi_tambah_masy()
	{

			$model=new M_kk;
			$user = $this->request->getPost('nama');
			$pass = $this->request->getPost('username');
			$nl = $this->request->getPost('password');
			$jk = $this->request->getPost('telp');
			
			$isi=array(
			'nama_lengkap'=>$user,
			'username'=>$pass,
			'password'=>md5($nl),
			'telp'=>$jk
			);
			$model->tambah('tb_masyarakat', $isi);
		
		return redirect()->to('home/data_masy');
	}





public function data_kendaraan()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			$isi=array(
			'activity_time'=>date('Y-m-d H:i:s'),
			'activity'=>session()->get('nama').' masuk ke halaman data kendaraan'
			);
			$model->tambah('activity_log', $isi);
			$where=array('logo_id' => '1');
		$logo['menu'] = $model->getwhere('logo',$where);
		$where1=array('id_user' =>session()->get('id'));
		$logo['acc'] = $model->getwhere('menu',$where1);
		echo view('header', $logo);
		echo view('menu', $logo);
		$data['clara'] = $model->tampil('kendaraan');
		echo view('data_kendaraan', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}
	public function tambah_kendaraan()
	{

			if(session()->get('level')>0){

			$model=new M_kk;
			$isi=array(
			'activity_time'=>date('Y-m-d H:i:s'),
			'activity'=>session()->get('nama').' masuk ke halaman tambah kendaraan'
			);
			$model->tambah('activity_log', $isi);
			$where=array('logo_id' => '1');
		$logo['menu'] = $model->getwhere('logo',$where);
		$where1=array('id_user' =>session()->get('id'));
		$logo['acc'] = $model->getwhere('menu',$where1);
		echo view('header', $logo);
		echo view('menu', $logo);

		echo view('tambah_kendaraan');
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}
	public function aksi_tambah_kendaraan()
	{

			$model=new M_kk;
			$nk = $this->request->getPost('nk');
			$tk = $this->request->getPost('tk');
			$wk = $this->request->getPost('wk');
			$hk = $this->request->getPost('hk');
			
			$isi=array(
			'nomor_kendaraan'=>$nk,
			'tipe_kendaraan'=>$tk,
			'warna_kendaraan'=>$wk,
			'harga_kendaraan'=>$hk,
			'create_at'=>date('Y-m-d H:i:s'),
			'create_by'=>session()->get('id')
			);
			$model->tambah('kendaraan', $isi);
		
		return redirect()->to('home/data_kendaraan');
	}
	public function delete_kendaraan($id)
	{

			$model=new M_kk;
			$where=array('kendaraan_id' => $id);
			$model->hapus('kendaraan',$where);
		
		return redirect()->to('home/data_kendaraan');
	}
	public function delete_barang($id)
	{

			$model=new M_kk;
			$where=array('id_barang' => $id);
			$model->hapus('tb_barang',$where);
		
		return redirect()->to('home/data_barang');
	}
	public function detail_kendaraan($id)
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			$isi=array(
			'activity_time'=>date('Y-m-d H:i:s'),
			'activity'=>session()->get('nama').' masuk ke halaman detail kendaraan'
			);
			$model->tambah('activity_log', $isi);
			$where=array('logo_id' => '1');
		$logo['menu'] = $model->getwhere('logo',$where);
		$where1=array('id_user' =>session()->get('id'));
		$logo['acc'] = $model->getwhere('menu',$where1);
		echo view('header', $logo);
		echo view('menu', $logo);
		$where=array('kendaraan_id' => $id);
		$data['clara'] = $model->getwhere('kendaraan',$where);
		echo view('detail_kendaraan', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}
	public function edit_kendaraan($id)
	{

			$model=new M_kk;
			$nk = $this->request->getPost('nk');
			$tk = $this->request->getPost('tk');
			$wk = $this->request->getPost('wk');
			$hk = $this->request->getPost('hk');
			$where=array('kendaraan_id' => $id);
			$isi=array(
			'nomor_kendaraan'=>$nk,
			'tipe_kendaraan'=>$tk,
			'warna_kendaraan'=>$wk,
			'harga_kendaraan'=>$hk,
			'update_at'=>date('Y-m-d H:i:s'),
			'update_by'=>session()->get('id')
			);
			$model->edit('kendaraan', $isi, $where);
		
		return redirect()->to('home/detail_kendaraan/'.$id);
	}

	public function sewa()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			$where=array('logo_id' => '1');
		$logo['menu'] = $model->getwhere('logo',$where);
		$where1=array('id_user' =>session()->get('id'));
		$logo['acc'] = $model->getwhere('menu',$where1);
		echo view('header', $logo);
		echo view('menu', $logo);
		$data['clara'] = $model->tampil('kendaraan');
		echo view('sewa', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}
	public function aksi_sewa()
	{

			$model=new M_kk;
			$kd = $this->request->getPost('kd');
			$lama = $this->request->getPost('lama');
			$harga = $this->request->getPost('harga');
			
			$isi=array(
			'user_id'=>session()->get('id'),
			'kendaraan_id'=>$kd,
			'lama_sewa'=>$lama,
			'total_harga'=>$harga,
			'status'=>'belum_dibayar',
			'create_at'=>date('Y-m-d H:i:s'),
			'create_by'=>session()->get('id')
			);
			$model->tambah('sewa', $isi);
		
		return redirect()->to('home/sewa');
	}
	public function list_bayar()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			$where=array('logo_id' => '1');
		$logo['menu'] = $model->getwhere('logo',$where);
		$where1=array('id_user' =>session()->get('id'));
		$logo['acc'] = $model->getwhere('menu',$where1);
		echo view('header', $logo);
		echo view('menu', $logo);
		$where=array('user_id' => session()->get('id'),
					 'status' => 'belum_dibayar');
		$data['clara'] = $model->joinwhere('sewa', 'kendaraan', 'sewa.kendaraan_id=kendaraan.kendaraan_id', $where);
		echo view('list_bayar', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function bayar($id)
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			$where=array('logo_id' => '1');
		$logo['menu'] = $model->getwhere('logo',$where);
		$where1=array('id_user' =>session()->get('id'));
		$logo['acc'] = $model->getwhere('menu',$where1);
		echo view('header', $logo);
		echo view('menu', $logo);
		$where=array('sewa_id' => $id);
		$data['clara'] = $model->getwherejoin('sewa', 'kendaraan', 'sewa.kendaraan_id=kendaraan.kendaraan_id', $where);
		echo view('bayar', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}
	public function aksi_bayar($id)
	{

			$model=new M_kk;
			$bayar = $this->request->getPost('bayar');
			$kembalian = $this->request->getPost('kembalian');
			
			$isi=array(
			'sewa_id'=>$id,
			'bayar'=>$bayar,
			'kembalian'=>$kembalian,
			'create_at'=>date('Y-m-d H:i:s'),
			'create_by'=>session()->get('id')
			);
			$model->tambah('pembayaran', $isi);

			$where=array('sewa_id' => $id);
			$isi=array(
			'status'=>'dibayar',
			'update_at'=>date('Y-m-d H:i:s'),
			'update_by'=>session()->get('id')
			);
			$model->edit('sewa', $isi, $where);
		
		return redirect()->to('home/list_bayar');
	}



	public function folder()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		$where=array('delete_at' => NULL);
		$data['clara'] = $model->joinwhere('file', 'jenis_doc', 'file.jenis_file=jenis_doc.jenis_id', $where);
		$data['jenis'] = $model->tampil('jenis_doc');
		echo view('folder', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function tambah_file()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		
		$data['clara'] = $model->tampil('jenis_doc');
		echo view('tambah_file', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_tambah_file()
	{
		
		$nama = $this->request->getPost('nama');
		$jenis = $this->request->getPost('jenis');
		$file=$this->request->getFile('file');

		$fileName = $file->getName();

		$model=new M_kk;
		if ($file->isValid() && !$file->hasMoved()) {
			$file->move(FCPATH . 'pdf');
			// return 'File uploaded successfully!';
		} else {
			// return 'There was an error uploading the file.';
		}
		$isi=array(
			'nama_file'=>$nama,
			'lokasi_file'=>$fileName,
			'jenis_file'=>$jenis
			);
			$model->tambah('file', $isi);
        
		
		return redirect()->to('home/folder');
	}

	public function delete_file($id)
	{

			$model=new M_kk;
			$where=array('file_id' => $id);
			$isi=array(
			'delete_at'=>date('Y-m-d H:i:s')
			);
			$model->edit('file', $isi, $where);
			// $isi=array(
			// 'activity_time'=>date('Y-m-d H:i:s'),
			// 'activity'=>session()->get('nama').' delete data user '.$id
			// );
			// $model->tambah('activity_log', $isi);
			// $model->hapus('users',$where);
		
		return redirect()->to('home/folder');
	}

	public function aksi_restore_file($id)
	{

			$model=new M_kk;
			$where=array('file_id' => $id);
			$isi=array(
			'delete_at'=>NULL
			);
			$model->edit('file', $isi, $where);
			// $isi=array(
			// 'activity_time'=>date('Y-m-d H:i:s'),
			// 'activity'=>session()->get('nama').' restore data user '.$id
			// );
			// $model->tambah('activity_log', $isi);
			// $model->hapus('users',$where);
		
		return redirect()->to('home/restore_file');
	}

	public function jenis_doc()
	{
		if(session()->get('level')>0){

			$model=new M_kk;
			
		echo view('header', $this->logo);
		echo view('menu', $this->logo);
		$where=array('delete_at' => NULL);
		$data['clara'] = $model->whereshow('jenis_doc',$where);
		echo view('jenis_doc', $data);
		echo view('footer');
		//echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function sendEmail()
    {
        $email = \Config\Services::email();

        $email->setFrom('roxukagamer@gmail.com', 'C.N');
        $email->setTo('roxukagamerz@gmail.com');
        $email->setSubject('Test Email');
        $email->setMessage('<p>This is a test email sent from CodeIgniter 4.</p>');

        if ($email->send()) {
            echo 'Email successfully sent';
        } else {
            // Display error message if email fails to send
            $data = $email->printDebugger(['headers']);
            echo 'Failed to send email';
            print_r($data);
        }
    }

































































































































































































// 	public function forget_pass()
// 	{
		
// 		echo view('forget_pass');
		
// 	}

// 	public function aksi_forget()
// 	{
// 		$model=new M_kk;

// 		$email = $this->request->getPost('email');

// 		// Extract domain from email
//     	$domain = explode('@', $email)[1];

//     	// Check if domain is from Google
//     	if ($model->checkGoogleDomain($domain)) {
//         //echo "Valid Google email address";
//     		$subject = 'Password Reset';
//     		$message = 'Click the link to reset your password: http://yourdomain.com/reset_password.php?token=your_generated_token';
//     		$headers = 'From: roxukagamer@gmail.com';
//     		mail($email, $subject, $message, $headers);
//     		return redirect()->to('home/login');
//     	} else {
//         //echo "Not a Google email address";
//     		return redirect()->to('home/forget_pass');
//     	}

		

		

// 	}

// 	public function cari()
// 	{
// 		if(session()->get('level')>0){
// 			$model=new M_kk;
// 		echo view('header');
// 		echo view('menu');
// 		$data['nelson'] = $model->tampil('dokter');
// 		echo view('cari',$data);

// 		echo view('footer');
// 		echo view('theme_panel');
// 		}else{
// 		return redirect()->to('home/login');
// 	}
// 	}

// 	public function aksi_cari()
// 	{
// 		$id_dok = $this->request->getPost('id_dokter');
// 		$id_pas = $this->request->getPost('id_pasien');
// 		//$pass = $this->request->getPost('password');
		

// 		$isi=array(
// 		'id_dokter'=>$id_dok,
// 		'id_pasien'=>$id_pas,
// 		'status'=>1
// 		);

// 		$model=new M_kk;
// 		//print_r($table);
// 		$model->tambah('group',$isi);
		

// 		// if ($cek>0){
// 		// 	if ($table="dokter") {
// 		// 		session()->set('nama',$cek->nama);
// 		// 	session()->set('id',$cek->id_dokter);
// 		// 	session()->set('level',$cek->status);
// 		// 	session()->set('per','dokter');
// 		// 	} else {
// 		// 		session()->set('nama',$cek->nama);
// 		// 	session()->set('id',$cek->id_pasien);
// 		// 	session()->set('level',$cek->status);
// 		// 	session()->set('per','pasien');
// 		// 	}
			

// 			return redirect()->to('home/index');
// 		// }else{
// 		// 	return redirect()->to('home/login');
// 		// }
// 	}

// 	public function list_chat()
// 	{
// 		if(session()->get('level')>0){
// 			$model=new M_kk;
// 		echo view('header');
// 		echo view('menu');
// 		if(session()->get('per')=='dokter'){
// 			$wh = 'a.id_dokter = '.session()->get('id');
// 		} else {
// 			$wh = 'a.id_pasien = '.session()->get('id');
// 		}

// 		$data['nelson'] = $model->query('select a.id_group,a.id_dokter,a.id_pasien,a.status,b.nama as nama_dokter,c.nama as nama_pasien FROM `group` a
// LEFT JOIN dokter b ON b.id_dokter=a.id_dokter
// LEFT JOIN pasien c ON c.id_pasien=a.id_pasien
// WHERE a.status=1 and '.$wh.'');
// 		//print_r($data);
// 		echo view('list_chat',$data);

// 		echo view('footer');
// 		echo view('theme_panel');
// 		}else{
// 		return redirect()->to('home/login');
// 	}
// 	}

// 	public function chat($group)
// 	{
// 		if(session()->get('level')>0){
// 			$model=new M_kk;
// 		echo view('header');
// 		echo view('menu');
// 		// if(session()->get('per')=='dokter'){
// 		// 	$wh = 'a.id_dokter = '.session()->get('id');
// 		// } else {
// 		// 	$wh = 'a.id_pasien = '.session()->get('id');
// 		// }
// 		$data = [
// 			'group' => $group
// 		];

// 		$data['nelson'] = $model->query('select * FROM `chat` WHERE id_group = '.$group.'');
// 		//print_r($data);
// 		echo view('chat',$data);

// 		echo view('footer');
// 		echo view('theme_panel');
// 		}else{
// 		return redirect()->to('home/login');
// 	}
// 	}

// 	public function aksi_send($group)
// 	{
// 		$model=new M_kk;
// 		$nama = $this->request->getPost('nama');
// 		$chat = $this->request->getPost('chat');
// 		//echo date('Y-m-d H:i:s');
// 		$isi=array(
// 		'id_group'=>$group,
// 		'user'=>$nama,
// 		'chat'=>$chat,
// 		'time'=>date('Y-m-d H:i:s')
// 		);

		
// 		$model->tambah('chat',$isi);
// 		return redirect()->to('home/chat/'.$group);
// 	}

// 	public function tutup($group)
// 	{
// 		if(session()->get('level')>0){
// 			$model=new M_kk;
// 		echo view('header');
// 		echo view('menu');
// 		// if(session()->get('per')=='dokter'){
// 		// 	$wh = 'a.id_dokter = '.session()->get('id');
// 		// } else {
// 		// 	$wh = 'a.id_pasien = '.session()->get('id');
// 		// }
// 		$data = [
// 			'group' => $group
// 		];

// 		$data['nelson'] = $model->query('select * FROM `chat` WHERE id_group = '.$group.'');
// 		//print_r($data);
// 		echo view('tutup',$data);

// 		echo view('footer');
// 		echo view('theme_panel');
// 		}else{
// 		return redirect()->to('home/login');
// 	}
// 	}

// 	public function aksi_tutup($group)
// 	{
// 		$model=new M_kk;
// 		$biaya = $this->request->getPost('biaya');
// 		$keterangan = $this->request->getPost('keterangan');

// 		$where=array(
// 		'id_group'=>$group
// 		);
// 		//print_r($table);
// 		$cek = $model->getwhere('group',$where);
// 		//echo date('Y-m-d H:i:s');
// 		$isi=array(
// 		'id_pasien'=>$cek->id_pasien,
// 		'harga'=>$biaya,
// 		'keterangan'=>$keterangan,
// 		'waktu'=>date('Y-m-d H:i:s'),
// 		'status'=>1,
// 		'bayar'=>0,
// 		'kembalian'=>0
// 		);
// 		//print_r($isi);
// 		$model->tambah('transaksi',$isi);

// 		$edi=array(
// 		'status'=>2
// 		);

// 		$model->edit('group',$edi,$where);
// 		return redirect()->to('home/index');
// 	}




















































// 	public function list_bayar()
// 	{
// 		if(session()->get('level')>0){
// 			$model=new M_kk;
// 		echo view('header');
// 		echo view('menu');

// 		$data['nelson'] = $model->query('select * FROM `transaksi` 
// WHERE status=1 and id_pasien='.session()->get('id').'');
// 		//print_r($data);
// 		echo view('list_bayar',$data);

// 		echo view('footer');
// 		echo view('theme_panel');
// 		}else{
// 		return redirect()->to('home/login');
// 	}
// 	}

	// public function bayar($tran)
	// {
	// 	if(session()->get('level')>0){
	// 		$model=new M_kk;
	// 	echo view('header');
	// 	echo view('menu');
	// 	// if(session()->get('per')=='dokter'){
	// 	// 	$wh = 'a.id_dokter = '.session()->get('id');
	// 	// } else {
	// 	// 	$wh = 'a.id_pasien = '.session()->get('id');
	// 	// }
	// 	$data = [
	// 		'tran' => $tran
	// 	];

	// 	$data['nelson'] = $model->query_row('select * FROM `transaksi` WHERE id_transaksi = '.$tran.'');
	// 	//print_r($data);
	// 	echo view('bayar',$data);

	// 	echo view('footer');
	// 	echo view('theme_panel');
	// 	}else{
	// 	return redirect()->to('home/login');
	// }
	// }

	// public function aksi_bayar($tran)
	// {
	// 	$model=new M_kk;
	// 	$bayar = $this->request->getPost('bayar');
	// 	$kembalian = $this->request->getPost('kembalian');

	// 	$where=array(
	// 	'id_transaksi'=>$tran
	// 	);
	// 	//print_r($table);
	// 	//$cek = $model->getwhere('group',$where);
	// 	//echo date('Y-m-d H:i:s');
	// 	// $isi=array(
	// 	// 'id_pasien'=>$cek->id_pasien,
	// 	// 'harga'=>$biaya,
	// 	// 'keterangan'=>$keterangan,
	// 	// 'waktu'=>date('Y-m-d H:i:s'),
	// 	// 'status'=>1,
	// 	// 'bayar'=>0,
	// 	// 'kembalian'=>0
	// 	// );
	// 	// //print_r($isi);
	// 	// $model->tambah('transaksi',$isi);

	// 	$edi=array(
	// 	'status'=>2,
	// 	'bayar'=>$bayar,
	// 	'kembalian'=>$kembalian
	// 	);

	// 	$model->edit('transaksi',$edi,$where);
	// 	return redirect()->to('home/index');
	// }

	public function riwayat()
	{
		if(session()->get('level')>0){
			$model=new M_kk;
		echo view('header', $this->logo);
		echo view('menu', $this->logo);

		$data['nelson'] = $model->query('select * FROM `transaksi` a
Left join pasien b on b.id_pasien=a.id_pasien
WHERE a.status=2');
		//print_r($data);
		echo view('riwayat',$data);

		echo view('footer');
		echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function laporan()
	{
		if(session()->get('level')>0){
			$model=new M_kk;
		// echo view('header', $this->logo);
		// echo view('menu', $this->logo);

// 		$data['nelson'] = $model->query('select * FROM `transaksi` a
// Left join pasien b on b.id_pasien=a.id_pasien
// WHERE a.status=2');
		//print_r($data);
		$data['clara'] = $model->jointhere('history_lelang','tb_lelang','tb_barang','tb_masyarakat',
											'history_lelang.id_lelang = tb_lelang.id_lelang',
											'history_lelang.id_barang = tb_barang.id_barang',
											'history_lelang.id_user = tb_masyarakat.id_user');
		echo view('laporan', $data);

		// echo view('footer_lprn');
		// echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}















































	public function print_excel()
	{
		$model=new M_kk;
		$dari = $this->request->getPost('tgl_darie');
		$sampai = $this->request->getPost('tgl_sampe');
		$fileName = 'Laporan_Excel.xlsx';

		$spreadsheet = new Spreadsheet();

		$cek = $model->query('select * FROM `transaksi` a
Left join pasien b on b.id_pasien=a.id_pasien
WHERE a.status=2 AND waktu BETWEEN "'.$dari.'" AND "'.$sampai.'"');

		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Pasien');
		$sheet->setCellValue('C1', 'Keterangan');
		$sheet->setCellValue('D1', 'Waktu');
		$sheet->setCellValue('E1', 'Harga');
		$sheet->setCellValue('F1', 'Bayar');
		$sheet->setCellValue('G1', 'Kembalian');

		$row = 2;
		$no = 1;
		foreach ($cek as $val) {
			$sheet->setCellValue('A'.$row, $no);
		$sheet->setCellValue('B'.$row, $val->nama);
		$sheet->setCellValue('C'.$row, $val->keterangan);
		$sheet->setCellValue('D'.$row, $val->waktu);
		$sheet->setCellValue('E'.$row, $val->harga);
		$sheet->setCellValue('F'.$row, $val->bayar);
		$sheet->setCellValue('G'.$row, $val->kembalian);
		$row++;
		$no++;
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save($fileName);

		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length:' . filesize($fileName));

		flush();
		readfile($fileName);
		exit;

				//session()->set('nama',$cek->nama);
	}

	public function print_print()
	{
		$model=new M_kk;
		$dari = $this->request->getPost('tgl_darip');
		$sampai = $this->request->getPost('tgl_sampp');

		$data['nelson'] = $model->query('select * FROM `transaksi` a
Left join pasien b on b.id_pasien=a.id_pasien
WHERE a.status=2 AND waktu BETWEEN "'.$dari.'" AND "'.$sampai.'"');

		echo view('header_print');

		echo view('print',$data);
		echo view('footer_print');

				//session()->set('nama',$cek->nama);
	}

	public function print_pdf()
	{
		$model=new M_kk;
		$dompdf =new Dompdf();
		
		$dari = $this->request->getPost('tgl_darif');
		$sampai = $this->request->getPost('tgl_sampf');

		$data['nelson'] = $model->query('select * FROM `transaksi` a
Left join pasien b on b.id_pasien=a.id_pasien
WHERE a.status=2 AND waktu BETWEEN "'.$dari.'" AND "'.$sampai.'"');

		

		$html =  view('pdf',$data);
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

				//session()->set('nama',$cek->nama);
	}


}
