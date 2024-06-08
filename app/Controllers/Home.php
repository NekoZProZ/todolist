<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_kk;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class Home extends BaseController
{
	public function index()
	{
		if(session()->get('level')>0){
		echo view('header');
		echo view('menu');
		echo view('dashboard');
		echo view('footer');
		echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function login()
	{
		
		echo view('login');
		
	}

	public function login_p()
	{
		
		echo view('login_pasien');
		
	}

public function aksi_login()
	{
		$table = $this->request->getPost('table');
		$email = $this->request->getPost('email');
		$pass = $this->request->getPost('password');
		

		$login=array(
		'nama'=>$email,
		'password'=>$pass
		
		);

		$model=new M_kk;
		//print_r($table);
		$cek = $model->getwhere($table,$login);
		

		if ($cek>0){
			// if ($table='dokter') {
				session()->set('nama',$cek->nama);
			session()->set('id',$cek->id_dokter);
			session()->set('level',$cek->status);
			session()->set('per','dokter');
			// } else {
			// 	session()->set('nama',$cek->nama);
			// session()->set('id',$cek->id_pasien);
			// session()->set('level',$cek->status);
			// session()->set('per','pasien');
			// }
			

			return redirect()->to('home/index');
		}else{
			return redirect()->to('home/login');
		}
		
	}

	public function aksi_login_p()
	{
		$table = $this->request->getPost('table');
		$email = $this->request->getPost('email');
		$pass = $this->request->getPost('password');
		

		$login=array(
		'nama'=>$email,
		'password'=>$pass
		
		);

		$model=new M_kk;
		//print_r($table);
		$cek = $model->getwhere($table,$login);
		

		if ($cek>0){
			// if ($table='dokter') {
			// 	session()->set('nama',$cek->nama);
			// session()->set('id',$cek->id_dokter);
			// session()->set('level',$cek->status);
			// session()->set('per','dokter');
			// } else {
				session()->set('nama',$cek->nama);
			session()->set('id',$cek->id_pasien);
			session()->set('level',$cek->status);
			session()->set('per','pasien');
			// }
			

			return redirect()->to('home/index');
		}else{
			return redirect()->to('home/login');
		}
		
	}

	public function register()
	{
		
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

	public function forget_pass()
	{
		
		echo view('forget_pass');
		
	}

	public function aksi_forget()
	{
		$model=new M_kk;

		$email = $this->request->getPost('email');

		// Extract domain from email
    	$domain = explode('@', $email)[1];

    	// Check if domain is from Google
    	if ($model->checkGoogleDomain($domain)) {
        //echo "Valid Google email address";
    		$subject = 'Password Reset';
    		$message = 'Click the link to reset your password: http://yourdomain.com/reset_password.php?token=your_generated_token';
    		$headers = 'From: roxukagamer@gmail.com';
    		mail($email, $subject, $message, $headers);
    		return redirect()->to('home/login');
    	} else {
        //echo "Not a Google email address";
    		return redirect()->to('home/forget_pass');
    	}

		

		

	}

	public function cari()
	{
		if(session()->get('level')>0){
			$model=new M_kk;
		echo view('header');
		echo view('menu');
		$data['nelson'] = $model->tampil('dokter');
		echo view('cari',$data);

		echo view('footer');
		echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_cari()
	{
		$id_dok = $this->request->getPost('id_dokter');
		$id_pas = $this->request->getPost('id_pasien');
		//$pass = $this->request->getPost('password');
		

		$isi=array(
		'id_dokter'=>$id_dok,
		'id_pasien'=>$id_pas,
		'status'=>1
		);

		$model=new M_kk;
		//print_r($table);
		$model->tambah('group',$isi);
		

		// if ($cek>0){
		// 	if ($table="dokter") {
		// 		session()->set('nama',$cek->nama);
		// 	session()->set('id',$cek->id_dokter);
		// 	session()->set('level',$cek->status);
		// 	session()->set('per','dokter');
		// 	} else {
		// 		session()->set('nama',$cek->nama);
		// 	session()->set('id',$cek->id_pasien);
		// 	session()->set('level',$cek->status);
		// 	session()->set('per','pasien');
		// 	}
			

			return redirect()->to('home/index');
		// }else{
		// 	return redirect()->to('home/login');
		// }
	}

	public function list_chat()
	{
		if(session()->get('level')>0){
			$model=new M_kk;
		echo view('header');
		echo view('menu');
		if(session()->get('per')=='dokter'){
			$wh = 'a.id_dokter = '.session()->get('id');
		} else {
			$wh = 'a.id_pasien = '.session()->get('id');
		}

		$data['nelson'] = $model->query('select a.id_group,a.id_dokter,a.id_pasien,a.status,b.nama as nama_dokter,c.nama as nama_pasien FROM `group` a
LEFT JOIN dokter b ON b.id_dokter=a.id_dokter
LEFT JOIN pasien c ON c.id_pasien=a.id_pasien
WHERE a.status=1 and '.$wh.'');
		//print_r($data);
		echo view('list_chat',$data);

		echo view('footer');
		echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function chat($group)
	{
		if(session()->get('level')>0){
			$model=new M_kk;
		echo view('header');
		echo view('menu');
		// if(session()->get('per')=='dokter'){
		// 	$wh = 'a.id_dokter = '.session()->get('id');
		// } else {
		// 	$wh = 'a.id_pasien = '.session()->get('id');
		// }
		$data = [
			'group' => $group
		];

		$data['nelson'] = $model->query('select * FROM `chat` WHERE id_group = '.$group.'');
		//print_r($data);
		echo view('chat',$data);

		echo view('footer');
		echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_send($group)
	{
		$model=new M_kk;
		$nama = $this->request->getPost('nama');
		$chat = $this->request->getPost('chat');
		//echo date('Y-m-d H:i:s');
		$isi=array(
		'id_group'=>$group,
		'user'=>$nama,
		'chat'=>$chat,
		'time'=>date('Y-m-d H:i:s')
		);

		
		$model->tambah('chat',$isi);
		return redirect()->to('home/chat/'.$group);
	}

	public function tutup($group)
	{
		if(session()->get('level')>0){
			$model=new M_kk;
		echo view('header');
		echo view('menu');
		// if(session()->get('per')=='dokter'){
		// 	$wh = 'a.id_dokter = '.session()->get('id');
		// } else {
		// 	$wh = 'a.id_pasien = '.session()->get('id');
		// }
		$data = [
			'group' => $group
		];

		$data['nelson'] = $model->query('select * FROM `chat` WHERE id_group = '.$group.'');
		//print_r($data);
		echo view('tutup',$data);

		echo view('footer');
		echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_tutup($group)
	{
		$model=new M_kk;
		$biaya = $this->request->getPost('biaya');
		$keterangan = $this->request->getPost('keterangan');

		$where=array(
		'id_group'=>$group
		);
		//print_r($table);
		$cek = $model->getwhere('group',$where);
		//echo date('Y-m-d H:i:s');
		$isi=array(
		'id_pasien'=>$cek->id_pasien,
		'harga'=>$biaya,
		'keterangan'=>$keterangan,
		'waktu'=>date('Y-m-d H:i:s'),
		'status'=>1,
		'bayar'=>0,
		'kembalian'=>0
		);
		//print_r($isi);
		$model->tambah('transaksi',$isi);

		$edi=array(
		'status'=>2
		);

		$model->edit('group',$edi,$where);
		return redirect()->to('home/index');
	}




















































	public function list_bayar()
	{
		if(session()->get('level')>0){
			$model=new M_kk;
		echo view('header');
		echo view('menu');

		$data['nelson'] = $model->query('select * FROM `transaksi` 
WHERE status=1 and id_pasien='.session()->get('id').'');
		//print_r($data);
		echo view('list_bayar',$data);

		echo view('footer');
		echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function bayar($tran)
	{
		if(session()->get('level')>0){
			$model=new M_kk;
		echo view('header');
		echo view('menu');
		// if(session()->get('per')=='dokter'){
		// 	$wh = 'a.id_dokter = '.session()->get('id');
		// } else {
		// 	$wh = 'a.id_pasien = '.session()->get('id');
		// }
		$data = [
			'tran' => $tran
		];

		$data['nelson'] = $model->query_row('select * FROM `transaksi` WHERE id_transaksi = '.$tran.'');
		//print_r($data);
		echo view('bayar',$data);

		echo view('footer');
		echo view('theme_panel');
		}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_bayar($tran)
	{
		$model=new M_kk;
		$bayar = $this->request->getPost('bayar');
		$kembalian = $this->request->getPost('kembalian');

		$where=array(
		'id_transaksi'=>$tran
		);
		//print_r($table);
		//$cek = $model->getwhere('group',$where);
		//echo date('Y-m-d H:i:s');
		// $isi=array(
		// 'id_pasien'=>$cek->id_pasien,
		// 'harga'=>$biaya,
		// 'keterangan'=>$keterangan,
		// 'waktu'=>date('Y-m-d H:i:s'),
		// 'status'=>1,
		// 'bayar'=>0,
		// 'kembalian'=>0
		// );
		// //print_r($isi);
		// $model->tambah('transaksi',$isi);

		$edi=array(
		'status'=>2,
		'bayar'=>$bayar,
		'kembalian'=>$kembalian
		);

		$model->edit('transaksi',$edi,$where);
		return redirect()->to('home/index');
	}

	public function riwayat()
	{
		if(session()->get('level')>0){
			$model=new M_kk;
		echo view('header');
		echo view('menu');

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
		echo view('header');
		echo view('menu');

// 		$data['nelson'] = $model->query('select * FROM `transaksi` a
// Left join pasien b on b.id_pasien=a.id_pasien
// WHERE a.status=2');
		//print_r($data);
		echo view('laporan');

		echo view('footer_lprn');
		echo view('theme_panel');
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
