<?php
$output = "<></>";
$options = [ 
    'http' => [ 
        'method' => Method, 
        'header' =>     "Authorization: Basic YWE6\n\r"
    ] 
];

$context  = stream_context_create($options);
$url = apiUrl."/".tabel."?".fields."&".filter;

//$url = apiUrl."/sodi"; // Katkise lingi test

if (debug) {
    $testUrl = "../XML/Lah".$filter.".xml";
    $xml  =simplexml_load_file( $testUrl) or die("Error: Cannot create object");
} else {
    // print $url; exit();
    @$xml = simplexml_load_string( file_get_contents($url , false,$context));
    if (false === $xml) {
        print json_encode (["Error"=>"Standard Books Api andis vea", "url"=>$url ]);
        exit();
    }
}
    $json = json_encode($xml);
    $obj = json_decode($json);
    $obj->url  =$url;
    $json = json_encode($obj);
    print $json ;
?>