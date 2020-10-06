<?php
include_once('simple_html_dom.php');

class WillHabenHelper
{

    protected $html;

    function getInbetweenStrings( $str, $start, $end)
    {

    
        $value = strstr($str, $start); //gets all text from needle on
        $value = substr($value, 1);
        $value = strstr($value, $end, true); //gets all text before needle
        var_dump($value);
        return $value;
    }

    public function getResultDiv(): string
    {
        $results  = [];
        $resultsPrice  = [];

        $resultDiv = $this->html->find(".content-section div.info");

        var_dump(count($resultDiv));


        foreach($resultDiv as $result) {
            $priceTag = str_replace(" ", "", trim($result->children[1]->innertext));
            
            $price = $this->getInbetweenStrings($priceTag, "+", "'");
            $price = substr($price,0,-30);
            //TODO TAKE PRICE LENGTH WHEN SUBSTR
            $price = base64_decode($price);
            $resultsPrice[] = $price;
        } 
        var_dump($resultsPrice);


        die;
        $this->html->load($resultDiv);


        # get an element representing the second paragraph
        $element = $this->html->find(".search-result-entry");
        var_dump($element);
        die;
        # modify it
        //$element[1]->innertext .= " and we're here to stay.";


        $resultEntries = $this->html->find("article[class=search-result-entry]", 0);
        echo $resultEntries;
        die;
        return "";
    }

    public function getResults(string $searchParam): string
    {


        $this->html = new simple_html_dom();

        $this->fetchWillHabenDom($searchParam);

        $resultDiv = $this->getResultDiv();

        return "";
    }


    public function fetchWillHabenDom(string $searchParam)
    {
        $basicSearchUrl = 'https://www.willhaben.at/iad/kaufen-und-verkaufen/marktplatz?rows=25&keyword=';
        $this->html->load_file($basicSearchUrl . $searchParam);
    }
}

$helper = new WillHabenHelper();

echo $helper->getResults("grafikkarten");
echo "test";
