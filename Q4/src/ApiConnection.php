<?php
namespace Q4\src;

class ApiConnection
{
    /**
     * @var string $url The url to fetch data from
     */
    private $url;

    /**
     * ApiConnection constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Fetch data from the given url
     * @return array
     */
    function fetchData()
    {
        $request = curl_init();
        curl_setopt($request, CURLOPT_URL, $this->url);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_CONNECTTIMEOUT, 3);
        $data = curl_exec($request);
        curl_close($request);
        $results = json_decode($data);

        return is_null($results) ? [] : $results;
    }

    /**
     * Fetch data from the given url and return only those products with a rating >= 4
     * @return array
     */
    function fetchHighRated()
    {
        $data = $this->fetchData();
        return array_filter($data, function($product) {
            return $product->rating >= 4;
        });
    }
}
