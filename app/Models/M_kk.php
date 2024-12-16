<?php

namespace App\Models;

use CodeIgniter\Model;

class M_kk extends Model
{

public function tampil($cahya){
		return $this->db->table($cahya)
                        ->get()
                        ->getResult();

	}

	public function whereshow($cahya, $where){
		return $this->db->table($cahya)
                        ->getwhere($where)
                        ->getResult();

	}

	public function tampil_filter($cahya, $filter){
		$columns = $this->db->getFieldNames($cahya);

    // Remove 'id' from the list of columns
    $filteredColumns = array_diff($columns, [$filter]);

		return $this->db->table($cahya)
		->select($filteredColumns)
                        ->get()
                        ->getResult();

	}

	public function tampilarray($cahya){
		return $this->db->table($cahya)
                        ->get()
                        ->getResultArray();

	}

	public function join($cahya, $tadle2, $on){
		return $this->db->table($cahya)
		                ->join($tadle2,$on,'left')
                        ->get()
                        ->getResult();
		//return $this->db->query('select * from barangm join')
        //                ->getResult();
                        

	}

	public function jointhere($cahya, $tadle2, $tadle3, $table4, $on, $on2, $on3){
		return $this->db->table($cahya)
		                ->join($tadle2,$on,'left')
		                ->join($tadle3,$on2,'left')
						->join($table4,$on3,'left')
                        ->get()
                        ->getResult();
	}

	public function jointwo($cahya, $tadle2, $tadle3, $on, $on2){
		return $this->db->table($cahya)
		                ->join($tadle2,$on,'left')
		                ->join($tadle3,$on2,'left')
                        ->get()
                        ->getResult();
		//return $this->db->query('select * from barangm join')
        //                ->getResult();
                        

	}
	public function jointwowhererow($cahya, $tadle2, $tadle3, $on, $on2, $where){
		return $this->db->table($cahya)
		                ->join($tadle2,$on,'left')
		                ->join($tadle3,$on2,'left')
		                ->getwhere($where)
                        ->getRow();
                        
		//return $this->db->query('select * from barangm join')
        //                ->getResult();
                        

	}

	public function jointwowhere($cahya, $tadle2, $tadle3, $on, $on2, $where){
		return $this->db->table($cahya)
		                ->join($tadle2,$on,'left')
		                ->join($tadle3,$on2,'left')
		                ->getwhere($where)
                        ->getResult();
                        
		//return $this->db->query('select * from barangm join')
        //                ->getResult();
                        

	}

	public function joinwhere($cahya, $tadle2, $on, $where){
		return $this->db->table($cahya)
		                ->join($tadle2,$on,'left')
		                ->getwhere($where)
                        ->getResult();
                        
		//return $this->db->query('select * from barangm join')
        //                ->getResult();
                        

	}

	public function joinorder($cahya, $tadle2, $on, $id){
		return $this->db->table($cahya)
		                ->join($tadle2,$on,'left')
		                ->orderBy($id,'desc')
                        ->get()
                        ->getResult();
    //   Cara Pakai                            table      table         ON                           id
    //   $data['nelson'] = $model->joinorder('barangk', 'barang','barangk.id_barang=barang.id_brg','id_bk');
                        

	}

	public function tampilorder($cahya, $id){
		return $this->db->table($cahya)
		                ->orderBy($id,'desc')
                        ->get()
                        ->getResult();
    //   Cara Pakai                             table      id
    //   $data['nelson'] = $model->tampilorder('barang','id_brg');

	}

	public function getwhere($cahya, $where){
		return $this->db->table($cahya)
                        ->getwhere($where)
                        ->getRow();

	}

	public function tampil_filter_where($cahya, $filter, $where){
		$columns = $this->db->getFieldNames($cahya);

    // Remove 'id' from the list of columns
    $filteredColumns = array_diff($columns, [$filter]);

		return $this->db->table($cahya)
		->select($filteredColumns)
                        ->getwhere($where)
                        ->getResult();

	}

	public function upload($file){
		$imageName = $file->getName();
		$file->move(ROOTPATH . 'public/img', $imageName);

	}

	public function replace_f($file, $file_d){
    $imagePath = ROOTPATH . 'public/img';
    $imageName = $file->getName();
    $sec_imageName = $file_d->getName();
    
        // Remove the existing file
        if (file_exists($imagePath . '/' . $sec_imageName)) {
        unlink($imagePath . '/' . $sec_imageName);
    }
    

    // Move the new file to the destination
    $file->move($imagePath, $imageName);
}

	public function upload_logo($file){
		$imageName = $file->getName();
		$filename = 'logo.png';
		$file->move(ROOTPATH.'public/logo',$filename);

	}

	public function delete_logo(){
		$imageName = 'logo.png';
		$imagePath = ROOTPATH . 'public/logo';
		unlink($imagePath . '/' . $imageName);
		// $imageName = 'logo.png';
		// $file->unlink(ROOTPATH . 'public/img/logo', $imageName);
		// $imageName = 'logo.jpg';
		// $file->unlink(ROOTPATH . 'public/img/logo', $imageName);

	}

	public function upload_icon($file){
		$imageName = $file->getName();
		$filename = 'icon.png';
		$file->move(ROOTPATH.'public/logo',$filename);

	}

	public function delete_icon(){
		$imageName = 'icon.png';
		$imagePath = ROOTPATH . 'public/logo';
		unlink($imagePath . '/' . $imageName);
		// unlink(ROOTPATH . 'public/img/logo', $imageName);
		// $imageName = 'icon.jpg';
		// $file->unlink(ROOTPATH . 'public/img/logo', $imageName);

	}

	public function getwherejoin($cahya, $tadle2, $on, $where){
		return $this->db->table($cahya)
		                ->join($tadle2,$on,'left')
                        ->getwhere($where)
                        ->getRow();

	}

	public function tambah($table, $isi){
		return $this->db->table($table)
                        ->Insert($isi);

	}

	public function hapus($table, $yoga){
		return $this->db->table($table)
                        ->delete($yoga);

	}

	public function getbarang($id = false){
		if ($id === false) {
			return $this->findAll();
		}
		else{
			return $this->getwhere(['id_brg'=>$id]);
		}

	}


	public function edit($table, $isi, $where){
return $this->db->table($table)
                        ->update($isi, $where);

	}

	public function update_all($table, $isi){
return $this->db->table($table)
                        ->update($isi);

	}

	public function maxkode($tab){
		return $this->db->table($tab)
                        ->selectmax('kode_obat','kode')
                        ->get()
                        ->getRow();

	}

	public function selesaicart($isi){
		return $this->db->table('transaksi')
                        ->insertBatch(
                        	$isi);


	}

	public function selesaicart2(){
		return $this->db->table('cart')
                        ->truncate();
                        

	}

	public function balikcart($isi){
		return $this->db->table('cart')
                        ->insertBatch(
                        	$isi);


	}

	public function balikcart2($yoga){
		return $this->db->table('transaksi')
                        ->delete($yoga);
                        

	}

	// Function to check if domain is from Google
	public function checkGoogleDomain($domain) {
    $googleDomains = array("gmail.com", "googlemail.com");
    return in_array($domain, $googleDomains);
	}

	public function query($query){
		return $this->db->query($query)
                        //->get()
                        ->getResult();

	}

	public function query_row($query){
		return $this->db->query($query)
                        //->get()
                        ->getRow();

	}

	public function kirim_gambarm($file){
		$imageName = $file->getName();
		$filename = 'logo.png';
		$file->move(ROOTPATH.'public/komisi',$imageName);

	}

}