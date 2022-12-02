<?php
$output = "<></>";
$options = [ 
    'http' => [ 
        'method' => "GET", 
        'header' => 
                      "Authorization: Basic YWE6 "
                    . "Content-Type: application/x-www-form-urlencoded; charset=utf-8' " 
                    . "Cookie: HSESSION=457D70DF-51620277-2DF144FF-7148A3FA-E412709F; country=global"
       // . "Accept: */*\n\r"
       //. "Connection:keep-alive\n"
       //, 'content'=> $output->asXML()
       //, 'ignore_errors' => true
    ] 
];
$context  = stream_context_create($options);
$putResult = file_get_contents("https://s001.excellent.ee:1902/api/1/INVc", false,$context); //
print ($putResult)
?>