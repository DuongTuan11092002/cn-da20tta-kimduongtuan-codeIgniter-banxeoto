<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndexController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('IndexModel');
		$this->load->library('cart');
		$this->load->library('email');
		$this->data['Category'] = $this->IndexModel->getCategoryHome();
		$this->data['Category_blog'] = $this->IndexModel->getCategoryBlogHome();
		$this->data['AutoMaker'] = $this->IndexModel->getAutoMakerHome();
		$this->data['post_list'] = $this->IndexModel->getPost(); //load blog

		$this->load->library('pagination');
	}

	public function Error404()
	{
		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('404/index', $this->data);
		$this->load->view('Pages/Template/Footer');
	}



	public function index()
	{

		/* ----------------------------- PANIGATION-PAGE ---------------------------- */

		// //custom config link
		// $config = array();
		// $config["base_url"] = base_url() . '/phan-trang/index';
		// $config['total_rows'] = ceil($this->IndexModel->countAllProduct()); //đếm tất cả sản phẩm //8 //hàm ceil làm tròn phân trang 
		// $config["per_page"] = 4; //từng trang 3 sản phẩm
		// $config["uri_segment"] = 3; //lấy số trang hiện tại
		// $config['use_page_numbers'] = TRUE; //trang có số
		// $config['full_tag_open'] = '<ul class="pagination">';
		// $config['full_tag_close'] = '</ul>';
		// $config['first_link'] = 'First';
		// $config['first_tag_open'] = '<li>';
		// $config['first_tag_close'] = '</li>';
		// $config['last_link'] = 'Last';
		// $config['last_tag_open'] = '<li>';
		// $config['last_tag_close'] = '</li>';
		// $config['cur_tag_open'] = '<li class="active"><a>';
		// $config['cur_tag_close'] = '</a></li>';
		// $config['num_tag_open'] = '<li>';
		// $config['num_tag_close'] = '</li>';
		// $config['next_tag_open'] = '<li>';
		// $config['next_tag_close'] = '</li>';
		// $config['prev_tag_open'] = '<li>';
		// $config['prev_tag_close'] = '</li>';
		// //end custom config link
		// $this->pagination->initialize($config); //tự động tạo trang
		// $this->page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1; //Trang hiện tại đang chọn
		// $this->data["links"] = $this->pagination->create_links(); //tự động tạo links phân trang dựa vào trang hiện tại
		// $this->data['allproduct_pagination'] = $this->IndexModel->getIndexPagination($config["per_page"], $this->page);
		// //pagination

		/* ------------------------------- FILTER ------------------------------ */

		$this->data['min_price'] = $this->IndexModel->getMinProductPrice(); //set minimum price
		$this->data['max_price'] = $this->IndexModel->getMaxProductPrice(); //set maximun price
		if (isset($_GET['kytu'])) {
			$kytu = $_GET['kytu'];
			$this->data['AllProductCar'] = $this->IndexModel->getProductKytu($kytu);
		} else if (isset($_GET['gia'])) {
			$gia = $_GET['gia'];
			$this->data['AllProductCar'] = $this->IndexModel->getProductGia($gia);
		} else if (isset($_GET['to']) && $_GET['from']) {

			$from_price = $_GET['from'];
			$to_price = $_GET['to'];

			$this->data['AllProductCar'] = $this->IndexModel->getProductPriceRange($from_price, $to_price);
		} else {
			$this->data['AllProductCar'] = $this->IndexModel->getAllProducts(); //load data

		}

		// category items
		// $data['items_category'] = $this->IndexModel->getCategoryItems();

		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Home', $this->data);
		$this->load->view('Pages/Template/Footer');
	}
	/* -------------------------------------------------------------------------- */
	/*                                  DANH MỤC                                  */

	public function Category($id) //finished with category
	{

		$this->data['min_price'] = $this->IndexModel->getMinCategoryPrice($id); //set minimum price
		$this->data['max_price'] = $this->IndexModel->getMaxCategoryPrice($id); //set maximun price

		/* --------------------------------- FILTER --------------------------------- */
		if (isset($_GET['kytu'])) {
			$kytu = $_GET['kytu'];
			$this->data['Category_Product'] = $this->IndexModel->getCategoryKytu($id, $kytu);
		} else if (isset($_GET['gia'])) {
			$gia = $_GET['gia'];
			$this->data['Category_Product'] = $this->IndexModel->getCategoryGia($id, $gia);
		} else if (isset($_GET['to']) && $_GET['from']) {
			$from_price = $_GET['from'];
			$to_price = $_GET['to'];

			$this->data['Category_Product'] = $this->IndexModel->getCategoryPriceRange($id, $from_price, $to_price);
		} else {
			$this->data['Category_Product'] = $this->IndexModel->getCategoryProduct($id); //load data

		}




		$this->data['title'] = $this->IndexModel->getCategoryTitle($id); //title
		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Category', $this->data);
		$this->load->view('Pages/Template/Footer');
	}


	public function AutoMaker($AutoMakerID)
	{
		/* --------------------------------- FILTER --------------------------------- */

		$this->data['min_price'] = $this->IndexModel->getMinAutoMakerPrice($AutoMakerID); //set minimum price
		$this->data['max_price'] = $this->IndexModel->getMaxAutoMakerPrice($AutoMakerID); //set maximun price

		if (isset($_GET['kytu'])) {
			$kytu = $_GET['kytu'];
			$this->data['AutoMaker_Product'] = $this->IndexModel->getAutoMakerKytu($AutoMakerID, $kytu);
		} else if (isset($_GET['gia'])) {
			$gia = $_GET['gia'];
			$this->data['AutoMaker_Product'] = $this->IndexModel->getAutoMakerGia($AutoMakerID, $gia);
		} else if (isset($_GET['to']) && $_GET['from']) {

			$from_price = $_GET['from'];
			$to_price = $_GET['to'];

			$this->data['AutoMaker_Product'] = $this->IndexModel->getAutoMakerPriceRange($AutoMakerID, $from_price, $to_price);
		} else {
			$this->data['AutoMaker_Product'] = $this->IndexModel->getAutoMakerProduct($AutoMakerID);
		}




		// $this->data['AutoMaker_Product'] = $this->IndexModel->getAutoMakerProduct($AutoMakerID); //load data
		$this->data['title'] = $this->IndexModel->getAutoMakerTitle($AutoMakerID);
		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Brand', $this->data);
		$this->load->view('Pages/Template/Footer');
	}
	/* -------------------------------------------------------------------------- */
	/* -------------------------------------------------------------------------- */
	/*                              CHI TIẾT SẢN PHẨM                             */

	public function ProductCar($id)
	{
		$this->data['Product_Detail'] = $this->IndexModel->getProductDetail($id); //load data 
		// những sản phẩm khác cùng một danh mục
		$this->data['Product_related'] = $this->IndexModel->getProductRelated($id); //load dữ liệu về sản phẩm khác trong cùng một danh mục
		//khi nhấn vào xem chi tiết của một sản phẩm thì trang đó có những sản phẩm khác


		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Product_detail', $this->data);
		$this->load->view('Pages/Template/Footer');
	}
	/* -------------------------------------------------------------------------- */


	/* -------------------------------------------------------------------------- */
	/*                                  GIỎ HÀNG                                  */

	public function Cart()
	{

		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Cart');
		$this->load->view('Pages/Template/Footer');
	}

	//Chức năng đặt hàng và số lượng trong trang chi tiết sản phẩm
	public function AddToCart()
	{
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$this->data['Product_Detail'] = $this->IndexModel->getProductDetail($product_id); //load data
		//DAT-HANG có thư viện có sẵn của CodeIgniter
		foreach ($this->data['Product_Detail'] as $key => $value) {
			//thêm câu lệnh kiểm tra số lượng đặt

			$cart = array(
				'id'      => $value->productCarID,
				'qty'     => $quantity,
				'price'   => $value->giasanpham,
				'name'    => $value->productCarDetailName,
				'options' => array('image' => $value->images)
			);
			//hàm thêm giỏ hàng
			$this->cart->insert($cart);
			redirect(base_url() . 'gio-hang', 'refresh');
		}
	}
	/* -------------------------------------------------------------------------- */
	/* -------------------------------------------------------------------------- */
	/*                            XÓA GIỎ HÀNG                            */
	//xóa tất cả
	public function DeleteAllCart()
	{
		$this->cart->destroy();
		redirect(base_url() . 'gio-hang', 'refresh');
	}

	//xóa từng sản phẩm
	public function DeleteItemCart($rowid)
	{
		$this->cart->remove($rowid);
		redirect(base_url() . 'gio-hang', 'refresh');
	}
	/*                            CẬP NHẬT GIỎ HÀNG                            */
	public function UpdateCart()
	{
		$rowid = $this->input->post('rowid');
		$quantity = $this->input->post('quantity');
		foreach ($this->cart->contents() as $items) {
			if ($rowid == $items['rowid']) {
				$cart = array( //cho phép chỉnh sửa số lượng
					'rowid' => $rowid, //tip: cần phải có rowid mới cập nhật số lượng được
					'qty'     => $quantity, //tip: số lượng tăng hoặc giảm
				);
			}
		}
		$this->cart->update($cart);
		//redirect(base_url().'gio-hang','refresh');
		redirect($_SERVER['HTTP_REFERER']);
	}
	/* -------------------------------------------------------------------------- */
	/* --------------------------- KIỂM-TRA-THANH-TOÁN -------------------------- */
	public function Checkout()
	{
		//kiểm tra khi customer login chưa nếu cố vào trang thanh toán(Checkout) thì đây ra trang giỏ hàng
		if ($this->session->userdata('loggedInCustomer') && $this->cart->contents()) {
			$this->load->view('Pages/Template/Header', $this->data);
			$this->load->view('Pages/Checkout');
			$this->load->view('Pages/Template/Footer');
		} else {
			echo "<script> 
					alert('Vui lòng đăng nhập tài khoản để thanh toán');
			</script>";
			redirect(base_url() . 'gio-hang', 'refresh');
		}
	}



	/* ------------------------------------ - ----------------------------------- */

	/* -------------------------------------------------------------------------- */
	/*                            DANG-NHAP-KHACH-HANG                            */
	public function Login()
	{

		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Login', $this->data);
		$this->load->view('Pages/Template/Footer');
	}


	public function loginCustomer()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);

		if ($this->form_validation->run() == true) {
			//$this->load->view('myform');
			$email = $this->input->post('email'); //create a variable for the email 
			$password = md5($this->input->post('password')); //create a variable for the password
			$this->load->model('LoginModel'); //this is use all functions in file
			$result = $this->LoginModel->checkLoginCustomer($email, $password); //hàm checkLogin(có 2 biến đã tạo) được sử dụng trong model->LoginModel để kiểm tra dữ liệu

			//cho điều kiện if else
			if (count($result) > 0) {
				//mảng session 
				$session_array = array(
					//dòng id sẽ lấy kết quả $result[0] đầu tiên tham chiếu trong cột id database
					'accountName' => $result[0]->accountName,
					//dòng fullname sẽ lấy kết quả $result[0] đầu tiên tham chiếu trong cột fullname database
					'fullname' => $result[0]->fullname,
					//dòng email sẽ lấy kết quả $result[0] đầu tiên tham chiếu trong cột email database
					'email' => $result[0]->email,
				);
				$this->session->set_userdata('loggedInCustomer', $session_array);
				//lệnh thông báo khi đăng nhập thành công
				$this->session->set_flashdata('success', 'Đăng nhập thành công');
				//nhảy trang khi đăng nhập thành công
				redirect(base_url('/gio-hang'));
			} else {
				$this->session->set_flashdata('error', 'Sai tài khoản hoặc mật khẩu');
				redirect(base_url('/dang-nhap'));
			}
		} else {
			$this->Login();
		}
	}



	public function Logout()
	{
		$this->session->unset_userdata('loggedInCustomer');
		redirect(base_url('/dang-nhap'));
	}

	/* -------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------- */
	/*                              ĐĂNG-KÝ-CUSTOMER                              */
	public function Register()
	{

		$this->load->view('Pages/Template/Header');
		$this->load->view('Pages/Register');
		$this->load->view('Pages/Template/Footer');
	}

	public function registerCustomer()
	{
		$this->form_validation->set_rules('account', 'Tài khoản', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		$this->form_validation->set_rules('fullname', 'Họ và tên', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		$this->form_validation->set_rules('address', 'Địa chỉ', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		$this->form_validation->set_rules('phone', 'Số điện thoại', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		$this->form_validation->set_rules('email', 'Email', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		$this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);

		if ($this->form_validation->run() == true) {
			//$this->load->view('myform');
			$account = $this->input->post('account');
			$fullname = $this->input->post('fullname');
			$address = $this->input->post('address');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email'); //create a variable for the email 
			$password = md5($this->input->post('password')); //create a variable for the password
			$data = array(
				'account' => $account,
				'fullname' => $fullname,
				'address' => $address,
				'phone' => $phone,
				'email' => $email,
				'password' => $password

			);
			$this->load->model('LoginModel'); //this is use all functions in file
			$result = $this->LoginModel->RegisterCustomer($data); //hàm checkLogin(có 2 biến đã tạo) được sử dụng trong model->LoginModel để kiểm tra dữ liệu

			//cho điều kiện if else
			if ($result) {
				//mảng session 
				$session_array = array(
					//dòng id sẽ lấy kết quả $result[0] đầu tiên tham chiếu trong cột id database
					'accountName' => $account,
					//dòng fullname sẽ lấy kết quả $result[0] đầu tiên tham chiếu trong cột fullname database
					'fullname' => $fullname,
					//dòng email sẽ lấy kết quả $result[0] đầu tiên tham chiếu trong cột email database
					'email' => $email,
				);
				$this->session->set_userdata('loggedInCustomer', $session_array);
				//lệnh thông báo khi đăng nhập thành công
				$this->session->set_flashdata('success', 'Đăng nhập thành công');
				//nhảy trang khi đăng nhập thành công
				redirect(base_url('/gio-hang'));
			} else {
				$this->session->set_flashdata('error', 'Sai tài khoản hoặc mật khẩu');
				redirect(base_url('dang-ky'));
			}
		} else {
			$this->Register();
		}
	}

	/* -------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------- */
	/*                               XỬ-LÝ-ĐẶT-HÀNG  GỬI ĐƠN                             */
	public function ConfirmCheckout()
	{
		$this->form_validation->set_rules('Fullname', 'Họ và tên', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		$this->form_validation->set_rules('Address', 'Địa chỉ', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		$this->form_validation->set_rules('Phone', 'Số điện thoại', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		$this->form_validation->set_rules('Email', 'Email', 'trim|required', ['required' => 'Vui lòng nhập %s của bạn']);
		if ($this->form_validation->run() == true) {
			$fullname = $this->input->post('Fullname');
			$address = $this->input->post('Address');
			$phone = $this->input->post('Phone');
			$email = $this->input->post('Email'); //email
			$method = $this->input->post('hinh-thuc-thanh-toan'); //create a variable for the email 

			$data = array(
				'fullname' => $fullname,
				'address' => $address,
				'phone' => $phone,
				'email' => $email,
				'method' => $method

			);
			$this->load->model('LoginModel');

			$result = $this->LoginModel->NewShipping($data);

			//cho điều kiện if else
			if ($result) {
				//Phần Order			
				// Cho ngẫu nhiên về mã đơn hàng
				$order_code = rand(00, 99999);
				$data_order = array(
					'order_code' => $order_code,
					'shippingID' => $result,
					'status' => 1

				);
				$them_order = $this->LoginModel->them_order($data_order);

				//Order Detail
				foreach ($this->cart->contents() as $items) {
					$data_order_detail = array(
						'orderCode' => $order_code,
						'productCarID' => $items['id'],
						'quantity' => $items['qty'],

					);
					$them_order_detail = $this->LoginModel->them_order_detail($data_order_detail);
				}
				$this->session->set_flashdata('success', 'Đã đặt hàng thành công chúng tôi sẽ liên hệ sớm nhất');
				$this->cart->destroy(); // sau khi thanh toán xong thì xóa sản phẩm khỏi giỏ hàng
				//Gửi email sau khi khách hàng xác nhận mua hàng

				// set email
				$to_email = $email;
				$title = "Đặt hàng thành công tại F8-Car cho bạn";
				$message = "Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất";
				//send email
				$this->sendEmail($to_email, $title, $message);
				redirect(base_url('/cam-on'));
			} else {
				$this->session->set_flashdata('error', 'Xác nhận thanh toán không thành công');
				redirect(base_url('/kiem-tra-thanh-toan'));
			}
		} else {
			$this->Checkout();
		}
	}

	/* -------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------- */
	/*                                 CẢM-ƠN-PAGE                                */
	public function Thank()
	{

		$this->load->view('Pages/Template/Header');
		$this->load->view('Pages/Thank');
		$this->load->view('Pages/Template/Footer');
	}
	/* -------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------- */
	/*                                  TÌM-KIẾM                                  */
	public function Search()
	{
		if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
			$Keyword = $_GET['keyword'];
		}
		$this->data['Product'] = $this->IndexModel->getProductByKeyWord($Keyword); //load data
		$this->data['title'] = $Keyword; //title
		$this->config->config['pagetitle'] = 'Tìm kiếm từ khóa:' . $Keyword;
		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Search', $this->data);
		$this->load->view('Pages/Template/Footer');
	}
	/* -------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------- */
	/*                             PHÂN-TRANG-SẢN-PHẨM                            */

	/* -------------------------------------------------------------------------- */


	/* -------------------------------------------------------------------------- */
	/*                                  GỬI-EMAIL                                 */
	public function SendEmail($to_email, $title, $message)
	{
		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_user'] = 'Kim884740@gmail.com';
		$config['smtp_pass'] = 'eqfvwielrqtyecnh'; // mật khẩu ứng dụng
		$config['smtp_port'] = 465;
		$config['charset'] = 'utf-8';
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		//config
		$this->email->from('Kim884740@gmail.com', 'Công ty F8-Car'); // email gửi
		$this->email->to($to_email); // email nhận
		// $this->email->cc('another@another-example.com');
		// $this->email->bcc('them@their-example.com');

		$this->email->subject($title);
		$this->email->message($message);

		$this->email->send();
	}
	/* -------------------------------------------------------------------------- */

	/* -------------------------------------------------------------------------- */
	/*                                   CONTACT                                  */
	public function Contact()
	{
		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Contact', $this->data);
		$this->load->view('Pages/Template/Footer');
	}


	public function SendContact()
	{
		$data = array(
			'fullname' => $this->input->post('fullname'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'address' => $this->input->post('address'),
			'subject' => $this->input->post('subject'),
			'message' => $this->input->post('message'),
		);
		$result = $this->IndexModel->insertContact($data);
		if ($result) {
			$to_email =  $this->input->post('email');
			$title =   "Tiêu đề khách hàng cần liên hệ:" .  $this->input->post('subject');
			$message = "Thông tin ghi chú của khách hàng" . $this->input->post('message');
			$this->SendEmail($to_email, $title, $message);
		}
		$this->session->set_flashdata('success', 'Gửi  thành công , chúng tôi sẽ liên hệ sớm nhất');
		//nhảy trang khi đăng nhập thành công
		redirect(base_url('/lien-he'));
	}
	/* -------------------------------------------------------------------------- */
	public function CategoryBlog($id)
	{

		$this->data['Slug'] = $this->IndexModel->getCategorySlugBlog($id); //load title slug
		$this->data['Category_blog_with_id'] = $this->IndexModel->getCategoryBlogByID($id); //load blog

		$this->data['title'] = $this->IndexModel->getCategoryBlogTitle($id); //title
		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Category_Blog', $this->data);
		$this->load->view('Pages/Template/Footer');
	}

	public function Blog($id)
	{

		$this->data['Slug'] = $this->IndexModel->getCategorySlugBlog($id); //load title slug
		$this->data['post_list'] = $this->IndexModel->getPost(); //load blog

		$this->load->view('Pages/Template/Header', $this->data);
		$this->load->view('Pages/Blog', $this->data);
		$this->load->view('Pages/Template/Footer');
	}
}
