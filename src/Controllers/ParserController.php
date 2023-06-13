<?php

namespace App\Controllers;

use App\Services\ParserService;
use App\Services\ParserServiceInterface;

class ParserController extends BaseController
{

    private $parser;

    public function __construct() {
        parent::__construct();
        $this->parser = new ParserService();
    }

    public function index($request){
        $template = $this->twig->load('./hello.twig');
        $data = $this->parser->execute($request);

        echo $template->render(['data' => $data]);

        return;
    }

}