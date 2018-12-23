<?php

namespace Karamel\Http;

class Response
{


    public function setJsonContent($array)
    {
        header('Content-Type : application/json');
        echo json_encode($array);
    }

    public function setStatusCode($statusCode = 200)
    {
        header('status : 200');
    }

    public function setContent($content)
    {
        header('Content-Type : text/html');
        echo $content;
    }


}