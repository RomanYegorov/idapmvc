<?php

class Addresses
{
    protected $db;

    public $id;
    public $label;
    public $street;
    public $housenumber;
    public $postalcode;
    public $city;
    public $country;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function get($id = null)
    {
        $id = Addresses::check_get_param($id);

        $address = $id > 0 ? " WHERE ADDRESSID =" . $id : "";

        $result = $this->db->query("SELECT * FROM ADDRESS" . $address);


        while ($addr = $result->fetch(PDO::FETCH_ASSOC)) {

            $res[] = $addr;
        }

        return isset($res) ? json_encode($res) : Router::error404("No records found");
    }

    public function post($data = false)
    {
        if (!$data)
            Router::error404("No data sended");

        $data = $this->check_post_param($data);

        $query = $this->db->prepare("INSERT INTO ADDRESS (LABEL, STREET, HOUSENUMBER, POSTALCODE, CITY, COUNTRY) values (?, ?, ?, ?, ?, ?)");
        $query->bindParam(1, $data->label);
        $query->bindParam(2, $data->street);
        $query->bindParam(3, $data->housenumber);
        $query->bindParam(4, $data->postalcode);
        $query->bindParam(5, $data->city);
        $query->bindParam(6, $data->country);
        $query->execute();
    }

    public function put($data = false, $id = false)
    {

        if (!$data)
            Router::error404("No data sended");

        $data = $this->check_put_param($data, $id);
        $updated_data = $data[0];
        $updated_params = $data[1];

        $params = "";
        foreach ($updated_params as $param) {
            $upd_name = strtolower($param);
            $params .= $param . "= '" . $updated_data->$upd_name . "' ,";

        }
        $params = rtrim($params, ",");


        $query = $this->db->prepare("UPDATE ADDRESS SET " . $params . " WHERE ADDRESSID=" . $this->id);
        $query->execute();


    }

    public function delete($id = null)
    {
        $id = Addresses::check_get_param($id);
        $result = $this->db->exec("DELETE FROM ADDRESS WHERE ADDRESSID=" . $id);

        return $result == 1 ? "OK" : Router::error404("No data with this id found");
    }

    static function check_get_param($param = false)
    {
        if (preg_match('/^\d*$/', $param) == 0)
            Router::error404("Invalid type set.");

        return htmlspecialchars($param);
    }

    public function check_post_param($data = false)
    {
        $data = json_decode($data);
        if ($data == null)
            Router::error404("invalid data format");

        $data = (array)$data;
        if (!isset($data['LABEL']) || !isset($data['STREET']) || !isset($data['HOUSENUMBER']) || !isset($data['POSTALCODE']) || !isset($data['CITY']) || !isset($data['COUNTRY']))
            Router::error404("invalid json sended");

        $this->label = htmlspecialchars($data['LABEL']);
        $this->street = htmlspecialchars($data['STREET']);
        $this->housenumber = htmlspecialchars($data['HOUSENUMBER']);
        $this->postalcode = htmlspecialchars($data['POSTALCODE']);
        $this->city = htmlspecialchars($data['CITY']);
        $this->country = htmlspecialchars($data['COUNTRY']);

        return $this;
    }

    public function check_put_param($data = false, $id = false)
    {
        $data = json_decode($data);
        if ($data == null)
            Router::error404("invalid data format");

        $data = (array)$data;

        if (!isset($data['ADDRESSID']) && !$id)
            Router::error404("id not found");

        $this->id = isset($data['ADDRESSID']) ? (int)$data['ADDRESSID'] : (int)$id;


        $updated_params = array();

        if (isset($data['LABEL'])) {
            $this->label = htmlspecialchars($data['LABEL']);
            $updated_params[] = 'LABEL';
        }

        if (isset($data['STREET'])) {
            $this->street = htmlspecialchars($data['STREET']);
            $updated_params[] = 'STREET';
        }

        if (isset($data['HOUSENUMBER'])) {
            $this->housenumber = htmlspecialchars($data['HOUSENUMBER']);
            $updated_params[] = 'HOUSENUMBER';
        }

        if (isset($data['POSTALCODE'])) {
            $this->postalcode = htmlspecialchars($data['POSTALCODE']);
            $updated_params[] = 'POSTALCODE';
        }

        if (isset($data['CITY'])) {
            $this->city = htmlspecialchars($data['CITY']);
            $updated_params[] = 'CITY';
        }

        if (isset($data['COUNTRY'])) {
            $this->country = htmlspecialchars($data['COUNTRY']);
            $updated_params[] = 'COUNTRY';
        }


        return array($this, $updated_params);

    }

}