<?php

class AddressesController extends Controller
{
    public function index($params = false)
    {
        $data = file_get_contents('php://input');
        $method = $_SERVER['REQUEST_METHOD'];
        $addr = $this->model('Addresses');

        switch ($method) {
            case 'GET':
                $addresses = $addr->get($params);
                break;
            case 'POST':
                $data = !$_POST ? $data : $_POST;
                $addresses = $addr->post($data);
                break;
            case 'DELETE':
                $addresses = $addr->delete($params);
                break;
            case 'PUT':
                $addresses = $addr->put($data, $params);
                break;
            default:
                Router::error404("Unsupported method. Only get,post,put,delete available");
                break;
        }

        $this->view('Addresses/index', $addresses);
    }
}