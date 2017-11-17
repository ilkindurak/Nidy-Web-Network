<?php 
 


function get_links($url) {

    $xml = new DOMDocument();

    libxml_use_internal_errors(true);

    $html = file_get_contents($url);

    if(!$xml->loadHTML($html)) {
        $errors="";
        foreach (libxml_get_errors() as $error)  {
            $errors.=$error->message."<br/>";
        }
        libxml_clear_errors();
        print "libxml errors:<br>$errors";
        return;
    }

    // Empty array to hold all links to return 
    $links = array();

    //Loop through each <img> tag in the dom and add it to the link array 
    foreach ($xml->getElementsByTagName('img') as $link) {
        $url = $link->getAttribute('src');
        if (!empty($url)) {
            $links[] = $link->getAttribute('src');
        }
    }

    //Return the links 
    return $links;
}

    
    






    
 ?>


 