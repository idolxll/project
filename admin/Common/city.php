<?php
//联动查城市
header("Content-type:text/html;charset=utf-8");
include_once('../Action/SYSCityAction.php');
$SYSCityAction = new SYSCityAction();
if (isset($_REQUEST["ac"])) {
    if ($_REQUEST["ac"] == "getprov") {
        //查询所有的省
        $provincearr = $SYSCityAction->getLists("id,name", "", "pid=0", "", "10000");
        $provincerows = $provincearr["data"];
        echo json_encode($provincerows);
        exit();
    }
    if ($_REQUEST["ac"] == "getcity") {
        if (isset($_REQUEST["prov_id"]) && $_REQUEST["prov_id"] > 0) {
            $city_arr = $SYSCityAction->getLists("id,name", "", "pid='" . $_REQUEST['prov_id'] . "' and level=2", "", "10000");
            //$where=array("parent"=>$_POST["prov_id"]);
            //$city_arr = $trems->getList("term_id,name", $where, "", "10000");
            //print_r($city_arr);
            $city_rows = $city_arr["data"];
            echo json_encode($city_rows);
            exit();
        }
    }
    if ($_REQUEST["ac"] == "getdistrict") {
        if (isset($_REQUEST["city_id"]) && $_REQUEST["city_id"] > 0) {
            $city_arr = $SYSCityAction->getLists("id,name", "", "pid='" . $_REQUEST['city_id'] . "' and level=3", "", "10000");
            //$where=array("parent"=>$_POST["prov_id"]);
            //$city_arr = $trems->getList("term_id,name", $where, "", "10000");
            //print_r($city_arr);
            $city_rows = $city_arr["data"];
            echo json_encode($city_rows);
            exit();
        }
    }
    if ($_REQUEST["ac"] == "getcity_code") {
        if (isset($_REQUEST["prov_id"]) && $_REQUEST["prov_id"] > 0) {
            $sql = "select id,name from SYSCity where state=1 and pid='" . $_REQUEST['prov_id'] . "' and level=2 and code!='NULL' and code!='' ";
            $row = $SYSCityAction->query($sql);
            $city_rows = $row['data'];
            echo json_encode($city_rows);
            exit();
        }
    }
    if ($_REQUEST["ac"] == "get_code") {
        if (isset($_REQUEST["city_id"]) && $_REQUEST["city_id"] > 0) {
            $sql = "select code from SYSCity where state=1 and id='".$_REQUEST["city_id"]."'";
            $row = $SYSCityAction->query($sql);
            $city_rows = $row['data'][0];
            echo json_encode($city_rows);
            exit();
        }
    }
}