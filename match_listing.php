<?php


require_once 'vendor/autoload.php';

chdir(__DIR__);

class AmazonListingApi {

	private $path;
	private $fileName;
	private $prductsArray;
	private $feedResponse;
	private $feedSubmissionId;
	private $channel;
	private $feedContent;

	function __construct(){
	}


	public function startOfProgram(){


        $creds = [
            'Marketplace_Id' => '',
            'Seller_Id' => '',
            'Access_Key_ID' => '',
            'Secret_Access_Key' => '',
            
        ];


		$client = new MCS\MWSClient($creds);

        $dataArray = [
            [
                'query' =>'Monoprice'
            ]
           
        ];


        foreach($dataArray as $value):
            $product = $value['query'];

               $this->prductsArray[] = $product;
        endforeach;
       $string_version = implode(',',$this->prductsArray );
 // print_r($string_version);exit;
		$this->matchResponse = $client->ListMatchingProducts($string_version);


     
$asins = [];
        foreach($this->matchResponse['Products']['Product'] as $product):
       $asins[]= $product['Identifiers']['MarketplaceASIN']['ASIN'];
      endforeach;
print_r($asins);
	}


}

$auFeed = new AmazonListingApi();
$auFeed -> startOfProgram();

   
    