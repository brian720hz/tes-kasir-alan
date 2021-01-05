<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_home');
        $this->load->library('pdf');
    }

    public function index()
    {
        $data['makanan'] = $this->M_home->get_data_makanan();
        $this->load->view('V_home', $data);
    }

    public function Tambah_data()
    {
        $data['makanan'] = $this->M_home->get_data_makanan();
        $this->load->view('V_tambah_data', $data);
    }

    public function Save_bill()
    {
        $this->session->set_flashdata('pesan', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data berhasil ditambahkan</div>');
        redirect('Home');
    }

    public function Tambah_data_makanan()
    {
        $nama = $this->input->post('nama');
        $harga = $this->input->post('harga');

        $nama_foto = $nama;

        // Set preference
        $config['upload_path']          = './assets/img/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 5120;
        $config['file_name']            = $nama_foto;

        $this->upload->initialize($config);

        // File upload
        if ($this->upload->do_upload('foto')) {
            $upload_data = $this->upload->data();
            $image = $upload_data["file_name"];

            $data = array(
                "nama" => $nama,
                "harga" => $harga,
                "foto" => $image
            );

            $this->M_home->tambah_data($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data berhasil ditambahkan</div>');
        }

        redirect('Home/Tambah_data');
    }

    function add_to_cart()
    {
        $data = array(
            'id' => $this->input->post('product_id'),
            'name' => $this->input->post('product_name'),
            'price' => $this->input->post('product_price'),
            'qty' => $this->input->post('quantity'),
            'foto' => $this->input->post('foto'),
        );
        $this->cart->insert($data);
        //print_r($this->cart->contents());
        echo $this->show_cart();
    }

    function show_cart()
    {
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .= '
                <tr>
                    <td> <img src=" ' . base_url() . 'assets/img/' . $items['foto'] . '" style="width: 50px; height: 50px;"></td>
                    <td style="font-weight: bold;">' . $items['name'] . '</td>
                    <td style="font-weight: bold;"> x' . $items['qty'] . '</td>             
                    <td style="font-weight: bold; color: #17aaff">' . number_format($items['subtotal']) . '</td>
                    
                </tr>
            ';
        }
        $output .= '    
            <tr>
                <th colspan="4"><button type="button" class="clear_cart btn" style="width: 100%; background-color: white; border-width: 2px; border-style: solid; border-color: red; color: red;">Clear Cart</button></th>
            </tr>
            <tr>
                <th colspan="4">
                <button type="button" class="btn" data-toggle="modal" data-target="#SaveBill" style="width: 49%; background-color: #2f9153; color: white;"> Save Bill </button>
                <button type="button" class="btn" data-toggle="modal" data-target="#PrintBill" style="width: 49%; background-color: #2f9153; color: white;"> Print Bill</button>
                </th>
            </tr>
            <tr>
                <th colspan="4"> <button type="button" class="btn" data-toggle="modal" data-target="#ModalCharge" style="width: 100%; background-color: #17aaff; color: white;">' . ' Charge Rp ' . number_format($this->cart->total()) . '</button> </th>
            </tr>
        ';
        return $output;
    }

    function load_cart()
    {
        echo $this->show_cart();
    }

    function delete_cart()
    {
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'qty' => 0,
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

    function clear_cart()
    {
        $this->cart->destroy();
        echo $this->show_cart();
    }

    function cek_kembalian()
    {
        $uang = $_POST["uang"];
        $total = $this->cart->total();
        $kembalian = $uang - $total;
        if ($kembalian >= 0) {
            echo '<span style="color:red;"> Kembalian : ' . $kembalian . '</span>';
        } else {
            echo '<span style="color:red;"> Kembalian : Maaf uang anda kurang </span>';
        }
    }

    public function pdf()
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('');
        $pdf->Write(0, 'Tagihan Pembayaran', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('');

        $tabel = '
        <br><br>
        <table class="table table-striped">
        <tr>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Harga</th>
        </tr>
        ';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $tabel .= '
                <tr>
                    <td style="font-weight: bold;">' . $items['name'] . '</td>
                    <td style="font-weight: bold;"> x' . $items['qty'] . '</td>             
                    <td style="font-weight: bold; color: #17aaff">' . number_format($items['subtotal']) . '</td>
                    
                </tr>
            ';
        }

        $tabel .= '
                <tr>
                <br><br>    
                <td colspan="4">Total : Rp ' . number_format($this->cart->total()) . '</td>
                </tr>        
        </table>
            ';
        $pdf->writeHTML($tabel);
        $pdf->Output('Cetak Bill.pdf', 'I');
    }
}
