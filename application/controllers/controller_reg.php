<?php 
class Controller_reg extends Controller
{
	public function __construct()
	{
		$this->model = new Model_reg();
		$this->view = new View();
	}

	public function action_index()
	{
		$this->view->generate('reg_view.php', 'template_view.php', []);
	}

	

	public function action_store()
	{
		$_POST['password'] = md5($_POST['password']);
		$this->model->insert($_POST);

		//$_SESSION["user_name"] = $_POST["user_name"];

		header('Location: /');

		// ['description' => 'asdsadsad', 'title' => 'asdasdasdsa']

	}


	public function action_login()
	{
		
		$res = $this->model->runQuery("SELECT * from users where user_name = '".$_POST['user_name']."' and password = '".md5($_POST['password']) ."'");

		if(count($res) > 0){
			$_SESSION["user_name"] = $_POST['user_name'];	
		} else {
			$_SESSION["user_name"] = '';
		}
		
		header('Location: /');

		// ['description' => 'asdsadsad', 'title' => 'asdasdasdsa']

	}

	public function action_edit($id)
	{
		$job = $this->model->update("SELECT * FROM `$this->table` where job_id = $id");
		// stanal job@ databazaic

		// formi mej texadrel jobi tvyalner@ job_id-n het@

		// formi action@ klini /jobs/update/$id

		$this->view->generate('job_view.php', 'template_view.php', $job);

	}

	public function action_delete($id)
	{
		$this->model->delete($id);
	}

	public function action_update($id)
	{
		$this->model->update($id, $_POST);
	}	
}


?>