<?php 


if(isset($application_key) && $application_key != ''){
    if($application_key=="SSSVN"){
        require '././config.php';
        $db=new database();
        $app= new app();
        $json_data=[
            'Name'=>$app->name,
            'Address'=>$app->address,
            'Email'=>$app->email,
            'Phone'=>$app->phone,
            'Website'=>$app->website,
            'Logo'=>url::myurl().'/'.$app->logo,
            'ShortName'=>$app->short_name,
            'CurrencySymbol'=>$app->currency_symbol,
            'City'=>$app->city,
            'data_token'=>uniqid($app->short_name)
        ];
        echo json_encode($json_data);
    }
}