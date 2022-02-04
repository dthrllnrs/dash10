<?php
use Illuminate\Support;  // https://laravel.com/docs/5.8/collections - provides the collect methods & collections class
use LSS\Array2Xml;
require_once('classes/Exporter.php');
require_once('classes/SearchMapper.php');
require_once('classes/models/Player.php');
require_once('classes/models/PlayerStats.php');

class Controller {

    protected $exporter;
    protected $searchMapper;

    public function __construct($args) {
        $this->args = $args;
        $this->exporter = new Exporter();
        $this->searchMapper = new SearchMapper();
    }

    public function export($type, $format) {
        $data = [];
        $model = null;
        switch ($type) {
            case 'playerstats':
                $model = new PlayerStats();
                break;
            case 'players':
                $model = new Player();
                break;
        }
        $search = $this->searchMapper->mapSearchParams($model, $this->args);
        $data = $model->search($search);
        if (!$data) {
            exit("Error: No data found!");
        }
        return $this->exporter->format($data, $format);
    }
}