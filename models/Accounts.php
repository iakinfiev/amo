<?php

// comment out the following two lines when deployed to production
/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/
class Accounts
{	

	// const YOUR_API_KEY = '23bc075b710da43f0ffb50ff9e889aed';
	// const HOST = 'https://api.s1.yadrocrm.ru/tmp';
	const COUNT = 100;
	const OFFSET = 100;

	public $apiKeyClients;
	public $host;
	public $status;
	public $dateOt;
	public $dateDo;
	public $offset;
	private $price;
	private $allPrice;


	function __construct()
	{
		require_once __DIR__ . '/../vendor/autoload.php';

	}

	public function getAllPrice()
	{
		return $this->allPrice;
	}
	
	function getLeadSuccessfullyImplemented()
	{
		Introvert\Configuration::getDefaultConfiguration()->setApiKey('key', $this->apiKeyClients);
		Introvert\Configuration::getDefaultConfiguration()->setHost($this->host);
		$api = new Introvert\ApiClient();
		$crm_user_id = array(); // int[] | фильтр по id ответственного
		// $status = array(142); // int[] | фильтр по id статуса
		$id = array(); // int[] | фильтр по id
		$ifmodif =null; // string | фильтр по дате изменения. timestamp или строка в формате 'D, j M Y H:i:s'
		// $count = 56; // int | Количество запрашиваемых элементов
		// $offset = 0; // int | смещение, относительно которого нужно вернуть элементы

		$result['count'] = 0;
		$lead = [];
		$i = 1;
		try {

			do {
			    $result = $api->lead->getAll($crm_user_id, $this->status, $id, $ifmodif, self::COUNT, $this->offset);
			    $lead = array_merge((array)$lead, (array)$result['result']);
		    	$this->offset += 100;

			} while ($result['count'] == self::OFFSET);
		    
			} catch (Exception $e) {
			    echo 'Exception when calling LeadApi->getAll: ', $e->getMessage(), PHP_EOL;
			}

		$result = $this->getFilterResut($lead);
		$this->allPrice += $result;
		return $result;
	}

	private function getFilterResut($lead)
	{
		$result = [];		
		$prices = [];		
		
		foreach ($lead as $key => $value) {		
			if ( $value['date_close'] >= $this->dateOt && $value['date_close'] <= $this->dateDo ) {
				$result[] = $value;
				if(!empty($value['price'])){
					$prices[] = $value['price'];
					$this->price += $value['price'];
				}
			}
		}
	    
		return $this->price;
	}

	// public function getAccount()
	// {
	// 	$api = new Introvert\ApiClient();
	// 	try {
	// 	    $result = $api->account->info();
	// 	} catch (Exception $e) {
	// 	    echo 'Exception when calling AccountApi->info: ', $e->getMessage(), PHP_EOL;
	// 	}
	// 	return $result;
	// }

	function getClients() {
	    return [
	        [
	            'id' => 1,
	            'name' =>'intrdev',
	            'api' => '',
	        ],
	        [
	            'id' => 2,
	            'name' => 'artedegrass0',
	            'api' => '23bc075b710da43f0ffb50ff9e889aed',
	        ],
	    ];
	}

} 
	// $api = new Introvert\ApiClient();
	$run = new Accounts;	
//	$run->dateOt = strtotime('2019-01-01 11:00:00');		//  переделать на GET['dateOt']
	$run->dateOt = $_GET['dateOt'];
//	$run->dateDo = strtotime(date("Y-m-d H:i:s"));			//  переделать на GET['dateDo']
	$run->dateDo = $_GET['dateDo'];
	$run->status = array(142);
	$run->host = 'https://api.s1.yadrocrm.ru/tmp';
	$run->offset = 0;

	$getClients = $run->getClients();
	$listsClient = [];
	foreach ($getClients as $key => $value) {
		if (!empty($value['api'])) {
			$run->apiKeyClients = $value['api'];
			unset($value['api']);
			$listsClient[$value['id']] = $value;
			$listsClient[$value['id']]['price'] = $price = $run->getLeadSuccessfullyImplemented();			
		}
	}
	$allPrice = $run->getAllPrice();
?>