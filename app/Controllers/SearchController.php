<?php
/**
 * Created by PhpStorm.
 * User: tamat
 * Date: 10.07.18
 * Time: 15:42
 */

namespace App\Controllers;


use App\Controller;
use GuzzleHttp\Client;

class SearchController extends Controller
{

    public function actionSearch()
    {
        $response = [];
        $query = $this->request['query'] ?? '';

        if (!empty($query)) {
            if ($dom = $this->sendRequest($query)) {
                $div = $dom->getElementById('ires');
                $ol = $div->childNodes->item(0);
                foreach ($ol->childNodes as $value) {
                    if (empty($value->nodeValue)) {
                        continue;
                    }

                    $title = $value->firstChild->textContent ?? null;
                    $url = $value->lastChild->getElementsByTagName('cite')->item(0)->nodeValue ?? null;
                    $description = $value->lastChild->childNodes->item(1)->nodeValue ?? null;

                    if(empty($url) || empty($description)) {
                        continue;
                    }

                    if (!preg_match('/^(http|https):\/\//i', $url)) {
                        $url = 'http://' . $url;
                    }

                    $response[] = compact('title', 'url', 'description');
                }

            }

        }

        return json_encode($response);
    }


    /**
     * Make http requets to google and return html with search results
     *
     * @param $query
     * @return bool|\DOMDocument
     */
    public function sendRequest($query)
    {
        $client = new Client();
        $url = sprintf('https://google.com/search?q=%s', $query);

        $res = $client->request('GET', $url);

        if ($res->getStatusCode() == 200) {
            $body = $res->getBody()->getContents();

            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($body);
            libxml_use_internal_errors(false);

            return $dom;
        }

        return false;
    }
}