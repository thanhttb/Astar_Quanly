<?php
namespace App\Http\Controllers;
use App\SchedulerEvent;
use App\Classes;
use Dhtmlx\Connector\SchedulerConnector;

class SchedulerController extends Controller
{
    public function data() {
        $connector = new SchedulerConnector(null, "PHPLaravel");
        $connector->configure(new SchedulerEvent(), "id", "start_Time, end_Time, class_std_");
        $connector->render();
    }
}
