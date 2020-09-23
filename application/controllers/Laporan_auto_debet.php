
<?php

//ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * CLASS NAME : transaksi
 * ------------------------------------------------------------------------
 *
 * @author     Muhammad Akbar <muslim.politekniktelkom@gmail.com>
 * @copyright  2016
 * @license    http://aplikasiphp.net
 *
 */

class Laporan_auto_debet extends CI_Controller //MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		/*if($this->session->userdata('ap_level') == 'inventory'){
			redirect();
		}
		*/
	}

	public function index()
	{
		$this->laporan_auto_debet();
	}

	public function laporan_auto_debet()
	{   //$this->load->view('order/trans_order');
		$this->load->view('laporan/laporan_auto_debet');
		/*
		$level = $this->session->userdata('ap_level');
		if($level == 'admin' OR $level == 'kasir')
		{
			if($_POST)
			{
				if( ! empty($_POST['kode_barang']))
				{
					$total = 0;
					foreach($_POST['kode_barang'] as $k)
					{
						if( ! empty($k)){ $total++; }
					}

					if($total > 0)
					{
						$this->load->library('form_validation');
						$this->form_validation->set_rules('nomor_nota','Nomor Nota','trim|required|max_length[40]|alpha_numeric|callback_cek_nota[nomor_nota]');
						$this->form_validation->set_rules('tanggal','Tanggal','trim|required');
						
						$no = 0;
						foreach($_POST['kode_barang'] as $d)
						{
							if( ! empty($d))
							{
								$this->form_validation->set_rules('kode_barang['.$no.']','Kode Barang #'.($no + 1), 'trim|required|max_length[40]|callback_cek_kode_barang[kode_barang['.$no.']]');
								$this->form_validation->set_rules('jumlah_beli['.$no.']','Qty #'.($no + 1), 'trim|numeric|required|callback_cek_nol[jumlah_beli['.$no.']]');
							}

							$no++;
						}
						
						$this->form_validation->set_rules('cash','Total Bayar', 'trim|numeric|required|max_length[17]');
						$this->form_validation->set_rules('catatan','Catatan', 'trim|max_length[1000]');

						$this->form_validation->set_message('required', '%s harus diisi');
						$this->form_validation->set_message('cek_kode_barang', '%s tidak ditemukan');
						$this->form_validation->set_message('cek_nota', '%s sudah ada');
						$this->form_validation->set_message('cek_nol', '%s tidak boleh nol');
						$this->form_validation->set_message('alpha_numeric', '%s Harus huruf / angka !');

						if($this->form_validation->run() == TRUE)
						{
							$nomor_nota 	= $this->input->post('nomor_nota');
							$tanggal		= $this->input->post('tanggal');
							$id_kasir		= $this->input->post('id_kasir');
							$id_pelanggan	= $this->input->post('id_pelanggan');
							$bayar			= $this->input->post('cash');
							$grand_total	= $this->input->post('grand_total');
							$catatan		= $this->clean_tag_input($this->input->post('catatan'));

							if($bayar < $grand_total)
							{
								$this->query_error("Cash Kurang");
							}
							else
							{
								$this->load->model('m_transaksi_master');
								$master = $this->m_transaksi_master->insert_master($nomor_nota, $tanggal, $id_kasir, $id_pelanggan, $bayar, $grand_total, $catatan);
								if($master)
								{
									$id_master 	= $this->m_transaksi_master->get_id($nomor_nota)->row()->id_penjualan_m;
									$inserted	= 0;

									$this->load->model('m_transaksi_detail');
									$this->load->model('m_barang');

									$no_array	= 0;
									foreach($_POST['kode_barang'] as $k)
									{
										if( ! empty($k))
										{
											$kode_barang 	= $_POST['kode_barang'][$no_array];
											$jumlah_beli 	= $_POST['jumlah_beli'][$no_array];
											$harga_satuan 	= $_POST['harga_satuan'][$no_array];
											$sub_total 		= $_POST['sub_total'][$no_array];
											$id_barang		= $this->m_barang->get_id($kode_barang)->row()->id_barang;
											
											$insert_detail	= $this->m_transaksi_detail->insert_detail($id_master, $id_barang, $jumlah_beli, $harga_satuan, $sub_total);
											if($insert_detail)
											{
												$this->m_barang->update_stok($id_barang, $jumlah_beli);
												$inserted++;
											}
										}

										$no_array++;
									}

									if($inserted > 0)
									{
										echo json_encode(array('status' => 1, 'pesan' => "Transaksi berhasil disimpan !"));
									}
									else
									{
										$this->query_error();
									}
								}
								else
								{
									$this->query_error();
								}
							}
						}
						else
						{
							echo json_encode(array('status' => 0, 'pesan' => validation_errors("<font color='red'>- ","</font><br />")));
						}
					}
					else
					{
						$this->query_error("Harap masukan minimal 1 kode barang !");
					}
				}
				else
				{
					$this->query_error("Harap masukan minimal 1 kode barang !");
				}
			}
			else
			{
				$this->load->model('m_user');
				$this->load->model('m_pelanggan');

				$dt['kasirnya'] = $this->m_user->list_kasir();
				$dt['pelanggan']= $this->m_pelanggan->get_all();
				$this->load->view('transaksi/transaksi', $dt);
			}
			
		} 
		*/
		
	}
/*
	public function cek_nota($nota)
	{
		$this->load->model('m_transaksi_master');
		$cek = $this->m_transaksi_master->cek_nota_validasi($nota);

		if($cek->num_rows() > 0)
		{
			return FALSE;
		}
		return TRUE;
	}
*/
    public function set_barcode($code)
	{
		//load library
		$this->load->library('zend');		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}
	
	public function transaksi_cetak()
	{

	   // include('src/BarcodeGenerator.php');
       // include('src/BarcodeGeneratorPNG.php');

	/*$nomor_nota 	= $this->input->get('nomor_nota');
		$tanggal		= $this->input->get('tanggal');
		$id_kasir		= $this->input->get('id_kasir');
		$id_pelanggan	= $this->input->get('id_pelanggan');
		$cash			= $this->input->get('cash');
		$catatan		= $this->input->get('catatan');
		$grand_total	= $this->input->get('grand_total');
*/
        $tanggal=date('Ymdh:m:s') ;
		
		$nomor_nota 	= $this->input->get('idorder');
		//$tanggal		= $this->input->get('tanggal');
		
		// $this->load->library('zend');		//load in folder Zend
		// $this->zend->load('Zend/Barcode');
		//generate barcode
		// Zend_Barcode::render('code128', 'image', array('text'=>$nomor_nota), array());
		
		$id_kasir		= $this->input->get('pengirim');
		$datasip=explode("|",$id_kasir);
				$nmsip=$datasip[0];
				$almsip=$datasip[1];
				$kdposip=$datasip[7];
				$tlpsip=$datasip[8];
				
		$almsip1=substr($almsip,0,50);
		$almsip2=substr($almsip,50,strlen($almsip));
		
		$id_pelanggan	= $this->input->get('penerima');
		$datasial=explode("|",$id_pelanggan);
				$nmsial=$datasial[1];
				$almsial=$datasial[2];
				$kdposial=$datasial[8];
				$tlpsial=$datasial[9];
		$almsial1=substr($almsial,0,50);
		$almsial2=substr($almsial,50,strlen($almsial));
				
				
		$cash			= $this->input->get('tarif');
		$datakiriman=explode("|",$cash);
				$produk=$datakiriman[0]."-"."QCOMM";
				$pelanggan=$datakiriman[1];
				$backsheet=$datakiriman[2];
				$berat=$datakiriman[3];
				$beadasar=round($datakiriman[4]);
				$htnb=round($datakiriman[5]);
				$ppn=round($datakiriman[6]);
				$ppnhtnb=round($datakiriman[7]);
				$isikiriman=$datakiriman[8];
				$nilaibarang=$datakiriman[9];
				$subtotal=$beadasar+$ppn+$htnb+$ppnhtnb;
		$catatan		= $this->input->get('catatan');
		$grand_total	= $this->input->get('grand_total');

		/*
		$this->load->model('m_user');
		$kasir = $this->m_user->get_baris($id_kasir)->row()->nama;
		
		$this->load->model('m_pelanggan');
		$pelanggan = 'umum';
		if( ! empty($id_pelanggan))
		{
			$pelanggan = $this->m_pelanggan->get_baris($id_pelanggan)->row()->nama;
		}
        */
		
		$this->load->library('cfpdf');		
		$pdf = new FPDF('P','mm','A5');
		$pdf->AddPage();
		$pdf->SetFont('courier','',9);

		
		//$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
								// echo '
								// <img height="30px" width="150px" src="data:image/png;base64,'.base64_encode($generator->getBarcode($nomor_nota, $generator::TYPE_CODE_128)).' ">
								// <br><span style="font-size:13px;">
								// '.$nomor_nota.'
								// </span>';
								
		//$pdf->Cell(25, 4, 'BARCODE : '.$nomor_nota, 0, 0, 'L'); 
		/* <center><h4><img src="<?php $barcode=$datas->response_data1;
								// echo site_url(); ?>/label_barcode_save/set_barcode/<?php echo $barcode ?>"> 
							// </img></h4></center>
							*/
		
		$pdf->Cell(10, 4, "B A R C O D E",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(27, 4, $nomor_nota, 0, 0, 'R'); 
		//$pdf->Cell(50, 4, base64_encode($generator->getBarcode($nomor_nota, $generator::TYPE_CODE_128)), 0, 0, 'R'); 
		
		$pdf->Ln();
		$pdf->Cell(10, 4, "Tanggal",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(38, 4, date('Y-m-d H:i:s', strtotime($tanggal)), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Layanan",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $produk, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Berat (Gram)",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, number_format($berat, 0, ',', '.'), 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Isi Kiriman",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $isikiriman, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Nilai Barang",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, number_format($nilaibarang, 0, ',', '.'), 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(130, 5, '-------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();
		
		$pdf->Cell(25, 4, 'P E N G I R I M', 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Nama",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $nmsip, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Alamat",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsip1, 0, 0, 'L'); 
		//$pdf->Cell(25, 4, str_pad("ALAMAT", 10, " ", STR_PAD_RIGHT).str_pad(":", 3, " ", STR_PAD_LEFT).str_pad($almsip1, 30, " ", STR_PAD_RIGHT), 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsip2, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $kdposip, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $tlpsip, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(25, 4, 'P E N E R I M A', 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Nama",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $nmsial, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Alamat",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsial1, 0, 0, 'L'); 
		//$pdf->Cell(25, 4, str_pad("ALAMAT", 10, " ", STR_PAD_RIGHT).str_pad(":", 3, " ", STR_PAD_LEFT).str_pad($almsip1, 30, " ", STR_PAD_RIGHT), 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsial2, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $kdposial, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $tlpsial, 0, 0, 'L');
		$pdf->Ln();

		
		$pdf->Cell(25, 4, 'T A R I F', 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Bea Dasar",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, number_format($beadasar, 0, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "PPN",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, number_format($ppn, 0, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "HTNB",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, number_format($htnb, 0, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "PPN HTNB ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, number_format($ppnhtnb, 0, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Total",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, number_format($subtotal, 0, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(130, 5, '-------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(130, 5, "Terimakasih telah menggunakan layanan kami", 0, 0, 'C');

		$pdf->Output();
	}
/*
	public function ajax_pelanggan()
	{
		if($this->input->is_ajax_request())
		{
			$id_pelanggan = $this->input->post('id_pelanggan');
			$this->load->model('m_pelanggan');

			$data = $this->m_pelanggan->get_baris($id_pelanggan)->row();
			$json['telp']			= ( ! empty($data->telp)) ? $data->telp : "<small><i>Tidak ada</i></small>";
			$json['alamat']			= ( ! empty($data->alamat)) ? preg_replace("/\r\n|\r|\n/",'<br />', $data->alamat) : "<small><i>Tidak ada</i></small>";
			$json['info_tambahan']	= ( ! empty($data->info_tambahan)) ? preg_replace("/\r\n|\r|\n/",'<br />', $data->info_tambahan) : "<small><i>Tidak ada</i></small>";
			echo json_encode($json);
		}
	}

	public function ajax_kode()
	{
		if($this->input->is_ajax_request())
		{
			$keyword 	= $this->input->post('keyword');
			$registered	= $this->input->post('registered');

			$this->load->model('m_barang');

			$barang = $this->m_barang->cari_kode($keyword, $registered);

			if($barang->num_rows() > 0)
			{
				$json['status'] 	= 1;
				$json['datanya'] 	= "<ul id='daftar-autocomplete'>";
				foreach($barang->result() as $b)
				{
					$json['datanya'] .= "
						<li>
							<b>Kode</b> : 
							<span id='kodenya'>".$b->kode_barang."</span> <br />
							<span id='barangnya'>".$b->nama_barang."</span>
							<span id='harganya' style='display:none;'>".$b->harga."</span>
						</li>
					";
				}
				$json['datanya'] .= "</ul>";
			}
			else
			{
				$json['status'] 	= 0;
			}

			echo json_encode($json);
		}
	}

	public function cek_kode_barang($kode)
	{
		$this->load->model('m_barang');
		$cek_kode = $this->m_barang->cek_kode($kode);

		if($cek_kode->num_rows() > 0)
		{
			return TRUE;
		}
		return FALSE;
	}

	public function cek_nol($qty)
	{
		if($qty > 0){
			return TRUE;
		}
		return FALSE;
	}

	public function history()
	{
		$level = $this->session->userdata('ap_level');
		if($level == 'admin' OR $level == 'kasir' OR $level == 'keuangan')
		{
			$this->load->view('transaksi/transaksi_history');
		}
	}

	public function history_json()
	{
		$this->load->model('m_transaksi_master');
		$level 			= $this->session->userdata('ap_level');

		$requestData	= $_REQUEST;
		$fetch			= $this->m_transaksi_master->fetch_data_penjualan($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$nestedData = array(); 

			$nestedData[]	= $row['nomor'];
			$nestedData[]	= $row['tanggal'];
			$nestedData[]	= "<a href='".site_url('transaksi/detail-transaksi/'.$row['id_penjualan_m'])."' id='LihatDetailTransaksi'><i class='fa fa-file-text-o fa-fw'></i> ".$row['nomor_nota']."</a>";
			$nestedData[]	= $row['grand_total'];
			$nestedData[]	= $row['nama_pelanggan'];
			$nestedData[]	= preg_replace("/\r\n|\r|\n/",'<br />', $row['keterangan']);
			$nestedData[]	= $row['kasir'];
		
			if($level == 'admin' OR $level == 'keuangan')
			{
				$nestedData[]	= "<a href='".site_url('transaksi/hapus-transaksi/'.$row['id_penjualan_m'])."' id='HapusTransaksi'><i class='fa fa-trash-o'></i> Hapus</a>";
			}

			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data
			);

		echo json_encode($json_data);
	}

	public function detail_transaksi($id_penjualan)
	{
		if($this->input->is_ajax_request())
		{
			$this->load->model('m_transaksi_detail');
			$this->load->model('m_transaksi_master');

			$dt['detail'] = $this->m_transaksi_detail->get_detail($id_penjualan);
			$dt['master'] = $this->m_transaksi_master->get_baris($id_penjualan)->row();
			
			$this->load->view('transaksi/transaksi_history_detail', $dt);
		}
	}

	public function hapus_transaksi($id_penjualan)
	{
		if($this->input->is_ajax_request())
		{
			$level 	= $this->session->userdata('ap_level');
			if($level == 'admin')
			{
				$reverse_stok = $this->input->post('reverse_stok');

				$this->load->model('m_transaksi_master');

				$nota 	= $this->m_transaksi_master->get_baris($id_penjualan)->row()->nomor_nota;
				$hapus 	= $this->m_transaksi_master->hapus_transaksi($id_penjualan, $reverse_stok);
				if($hapus)
				{
					echo json_encode(array(
						"pesan" => "<font color='green'><i class='fa fa-check'></i> Transaksi <b>".$nota."</b> berhasil dihapus !</font>
					"));
				}
				else
				{
					echo json_encode(array(
						"pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
				}
			}
		}
	}

	public function pelanggan()
	{
		$level = $this->session->userdata('ap_level');
		if($level == 'admin' OR $level == 'kasir' OR $level == 'keuangan')
		{
			$this->load->view('transaksi/pelanggan_data');
		}
	}

	public function pelanggan_json()
	{
		$this->load->model('m_pelanggan');
		$level 			= $this->session->userdata('ap_level');

		$requestData	= $_REQUEST;
		$fetch			= $this->m_pelanggan->fetch_data_pelanggan($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$nestedData = array(); 

			$nestedData[]	= $row['nomor'];
			$nestedData[]	= $row['nama'];
			$nestedData[]	= preg_replace("/\r\n|\r|\n/",'<br />', $row['alamat']);
			$nestedData[]	= $row['telp'];
			$nestedData[]	= preg_replace("/\r\n|\r|\n/",'<br />', $row['info_tambahan']);
			$nestedData[]	= $row['waktu_input'];
			
			if($level == 'admin' OR $level == 'kasir' OR $level == 'keuangan') 
			{
				$nestedData[]	= "<a href='".site_url('transaksi/pelanggan-edit/'.$row['id_pelanggan'])."' id='EditPelanggan'><i class='fa fa-pencil'></i> Edit</a>";
			}

			if($level == 'admin') 
			{
				$nestedData[]	= "<a href='".site_url('transaksi/pelanggan-hapus/'.$row['id_pelanggan'])."' id='HapusPelanggan'><i class='fa fa-trash-o'></i> Hapus</a>";
			}

			$data[] = $nestedData;
		}

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data
			);

		echo json_encode($json_data);
	}

	public function tambah_pelanggan()
	{
		$level = $this->session->userdata('ap_level');
		if($level == 'admin' OR $level == 'kasir' OR $level == 'keuangan')
		{
			if($_POST)
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('nama','Nama','trim|required|alpha_spaces|max_length[40]');
				$this->form_validation->set_rules('alamat','Alamat','trim|required|max_length[1000]');
				$this->form_validation->set_rules('telepon','Telepon / Handphone','trim|required|numeric|max_length[40]');
				$this->form_validation->set_rules('info','Info Tambahan Lainnya','trim|max_length[1000]');

				$this->form_validation->set_message('alpha_spaces','%s harus alphabet !');
				$this->form_validation->set_message('numeric','%s harus angka !');
				$this->form_validation->set_message('required','%s harus diisi !');

				if($this->form_validation->run() == TRUE)
				{
					$this->load->model('m_pelanggan');
					$nama 		= $this->input->post('nama');
					$alamat 	= $this->clean_tag_input($this->input->post('alamat'));
					$telepon 	= $this->input->post('telepon');
					$info 		= $this->clean_tag_input($this->input->post('info'));

					$unique		= time().$this->session->userdata('ap_id_user');
					$insert 	= $this->m_pelanggan->tambah_pelanggan($nama, $alamat, $telepon, $info, $unique);
					if($insert)
					{
						$id_pelanggan = $this->m_pelanggan->get_dari_kode($unique)->row()->id_pelanggan;
						echo json_encode(array(
							'status' => 1,
							'pesan' => "<div class='alert alert-success'><i class='fa fa-check'></i> <b>".$nama."</b> berhasil ditambahkan sebagai pelanggan.</div>",
							'id_pelanggan' => $id_pelanggan,
							'nama' => $nama,
							'alamat' => preg_replace("/\r\n|\r|\n/",'<br />', $alamat),
							'telepon' => $telepon,
							'info' => (empty($info)) ? "<small><i>Tidak ada</i></small>" : preg_replace("/\r\n|\r|\n/",'<br />', $info)						
						));
					}
					else
					{
						$this->query_error();
					}
				}
				else
				{
					$this->input_error();
				}
			}
			else
			{
				$this->load->view('transaksi/pelanggan_tambah');
			}
		}
	}

	public function pelanggan_edit($id_pelanggan = NULL)
	{
		if( ! empty($id_pelanggan))
		{
			$level = $this->session->userdata('ap_level');
			if($level == 'admin' OR $level == 'kasir' OR $level == 'keuangan')
			{
				if($this->input->is_ajax_request())
				{
					$this->load->model('m_pelanggan');
					
					if($_POST)
					{
						$this->load->library('form_validation');
						$this->form_validation->set_rules('nama','Nama','trim|required|alpha_spaces|max_length[40]');
						$this->form_validation->set_rules('alamat','Alamat','trim|required|max_length[1000]');
						$this->form_validation->set_rules('telepon','Telepon / Handphone','trim|required|numeric|max_length[40]');
						$this->form_validation->set_rules('info','Info Tambahan Lainnya','trim|max_length[1000]');

						$this->form_validation->set_message('alpha_spaces','%s harus alphabet !');
						$this->form_validation->set_message('numeric','%s harus angka !');
						$this->form_validation->set_message('required','%s harus diisi !');

						if($this->form_validation->run() == TRUE)
						{
							$nama 		= $this->input->post('nama');
							$alamat 	= $this->clean_tag_input($this->input->post('alamat'));
							$telepon 	= $this->input->post('telepon');
							$info 		= $this->clean_tag_input($this->input->post('info'));

							$update 	= $this->m_pelanggan->update_pelanggan($id_pelanggan, $nama, $alamat, $telepon, $info);
							if($update)
							{
								echo json_encode(array(
									'status' => 1,
									'pesan' => "<div class='alert alert-success'><i class='fa fa-check'></i> Data berhasil diupdate.</div>"
								));
							}
							else
							{
								$this->query_error();
							}
						}
						else
						{
							$this->input_error();
						}
					}
					else
					{
						$dt['pelanggan'] = $this->m_pelanggan->get_baris($id_pelanggan)->row();
						$this->load->view('transaksi/pelanggan_edit', $dt);
					}
				}
			}
		}
	}
*/
	public function pelanggan_hapus($id_pelanggan)
	{
		$level = $this->session->userdata('ap_level');
		if($level == 'admin')
		{
			if($this->input->is_ajax_request())
			{
				$this->load->model('m_pelanggan');
				$hapus = $this->m_pelanggan->hapus_pelanggan($id_pelanggan);
				if($hapus)
				{
					echo json_encode(array(
						"pesan" => "<font color='green'><i class='fa fa-check'></i> Data berhasil dihapus !</font>
					"));
				}
				else
				{
					echo json_encode(array(
						"pesan" => "<font color='red'><i class='fa fa-warning'></i> Terjadi kesalahan, coba lagi !</font>
					"));
				}
			}
		}
	}
}
//echo "<script type='text/javascript' src='qrcode.js'></script>";
?>