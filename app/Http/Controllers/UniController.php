<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Promotion;
class UniController extends Controller
{
    //
    function get_form(){
        return view('promotion.form');
    }
    function post_pre_process(Request $request){
        $images = $request->file('img');
        $image_name = array();
        if(!empty($images)){
            foreach ($images as $image){
                # code...
                $image->move(public_path().'/promotion/img',$image->getClientOriginalName());
                // echo "success";
                array_push($image_name, $image->getClientOriginalName());
            }

        }

        if(count($images)<= 4){
            return view('promotion.2-2',compact('image_name'));
        }   
        else{
            return view('promotion.3-3',compact('image_name'));
        }     
    }
    function init($array){
        if(empty($array)){
            $array = [];
        }
        return $array;
    }
    function count_recursive($arr){
        if(!is_array($arr)) return 0;
        $leaves = 0;
        array_walk_recursive($arr, function ($leaves) use (&$leaves) {
          $leaves++;
        });
        return $leaves;
    }
    function compare_brand($a, $b) {
        // echo "<pre>";
        // print_r($b);
        // echo $this->count_recursive($b);
        if($this->count_recursive($a) == $this->count_recursive($b)) return 0;
        return ($this->count_recursive($a) > $this->count_recursive($b)) ? -1 : 1;
    }
    function post_promotion(Request $request){
    	if(Input::hasFile('table-promo')){
    		$file = Input::file('table-promo');
    		$file->move(public_path().'/promotion/', $file->getClientOriginalName());
            $promotion = new Promotion();
            $promotion->input = $file->getClientOriginalName();
            $promotion->from_week = $request->from;
            $promotion->to_week = $request->to;
            $promotion->save();
            $time = $request->time;
            $input = fopen(public_path().'/promotion/'. $file->getClientOriginalName(), 'r');
            
            
            $priority = ['HAIR','Hair','ORAL','Oral','Skin','SKIN','Sc','SC','DEO','Deo'];
            $name = [ "HAIR" => "CHĂM SÓC TÓC",
                        "Hair" => "CHĂM SÓC TÓC",
                        "Oral" => "CHĂM SÓC RĂNG MIỆNG",
                        "ORAL" => "CHĂM SÓC RĂNG MIỆNG",
                        "SKIN" => "CHĂM SÓC DA",
                        "Skin" => "CHĂM SÓC DA",
                        "SC" => "CHĂM SÓC CƠ THỂ",
                        "DEO" => "NGĂN MÙI",
                        "Deo" => "NGĂN MÙI",
                        "ST"=> "Sữa tắm"];
            $color = ["HAIR" => '#fed47f',
                        "ORAL" => "#5e9cd3",
                        "SKIN" => "#72ac4d",
                        "SC" => "#fd7f7c",
                        "DEO" => "#a6a6a6",
                        "Hair" => '#fed47f',
                        "Oral" => "#5e9cd3",
                        "Skin" => "#72ac4d",
                        "SC" => "#fd7f7c",
                        "Deo" => "#a6a6a6"];
            $cat = [];
            $brand = [];
            $type = [];
            $line = [];
            $kc = [];
            $count = array();
            $temp = '';
            while($data = fgetcsv($input,10000,',')){
                // echo "<pre>";
                // print_r($data);

                if(empty($cat[$data[0]])){
                    $cat[$data[0]] = [];
                }
                if(empty($cat[$data[0]][$data[1]])){
                    $cat[$data[0]][$data[1]] = [];
                }
                if(empty($cat[$data[0]][$data[1]][$data[3]])){
                    $cat[$data[0]][$data[1]][$data[3]] = [];
                }
                if(empty($cat[$data[0]][$data[1]][$data[3]][$data[4]])){
                    $cat[$data[0]][$data[1]][$data[3]][$data[4]] = [];
                }
                if(empty($cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]])){
                    $cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]] = [];                    
                }
                if(empty($cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]][$data[6]])){
                    $cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]][$data[6]] = '';
                }
                $cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]][$data[6]] .= $data[8]."-";
                
            }  

            
            $body = '';
            $i = 0;
            foreach ($priority as $v) {
                # code...
                if(!empty($cat[$v])){
                    $brand = $cat[$v];
                    $c = $v;
                }
                else { continue; }

                # code...
                // echo "<pre>";
                // print_r($brand);
                //SAP XEP CAC BRAND THEO THU TU SO LUONG CHUONG TRINH
                uasort($brand, array($this, 'compare_brand'));                
                //DAC BIET LEN DAU
                foreach ($brand as $u => $val) {
                    # code...
                    if(strpos($u, 'ĐẶC BIỆT') !== false || strpos($u, 'Đặc biệt') !== false){
                        $brand = array($u => $val)+ $brand;
                    }
                }
                // echo "<pre>";
                // print_r($brand);
                $body .= "<td rowspan='".$this->count_recursive($brand)."' style='text-align: center; background-color: ".$color[$c]."; color:black; font-weight:bold;' class='vertical-center'>{$name[$c]}</td>\r\n";
                foreach ($brand as $b => $t) {
                    # code...
                    if(array_search($b, array_keys($brand)) > 0){
                        if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                             $body.= "<tr bgcolor='#ffedb9'>";
                        }
                        else{
                             $body.= "<tr>";
                        }
                    }
                    if(file_exists('resources/views/promotion/'.str_replace('/','',$b).".png")){
                        
                        if($this->count_recursive($t) == 1){
                            $body .= "<td rowspan='".$this->count_recursive($t)."' style='text-align: center;' class='vertical-center'><img style='max-width: 40px' src='resources/views/promotion/".str_replace('/','',$b).".png'></td>\r\n";
                        }
                        else{
                            $body .= "<td rowspan='".$this->count_recursive($t)."' style='text-align: center;' class='vertical-center'><img style='max-width: 50px' src='resources/views/promotion/".str_replace('/','',$b).".png'></td>\r\n";
                        }
                    }

                    else{
                        if(strpos($b, 'ĐẶC BIỆT')  !== false){
                            $b = str_replace('ĐẶC BIỆT', '<strong> ĐẶC BIỆT</strong>', $b);
                        } 
                        $body .= "<td bgcolor='#ffedb9' rowspan='".$this->count_recursive($t)."' style='align: center;' class='vertical-center'>{$b}</td>\r\n";

                    }                               
                        foreach ($t as $type => $line) {
                            # code...
                            if(array_search($type, array_keys($t)) > 0){
                                if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                                     $body.= "<tr bgcolor='#ffedb9'>";
                                }
                                else{
                                     $body.= "<tr>";
                                }
                            }
                            $type = str_replace("ST", 'Sữa tắm', $type);
                            if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                                 $body .="<td bgcolor='#ffedb9' rowspan='".$this->count_recursive($line)."'>{$type}</td>\r\n";
                            }
                            else{
                                 $body .="<td rowspan='".$this->count_recursive($line)."'>{$type}</td>\r\n";
                            }
                                foreach ($line as $l => $kc) {
                                    # code...
                                    if(array_search($l, array_keys($line)) > 0){
                                        if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                                             $body.= "<tr bgcolor='#ffedb9'>";
                                        }
                                        else{
                                             $body.= "<tr>";
                                        }
                                    }
                                    
                                    if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                                        $body .="<td bgcolor='#ffedb9' rowspan='".$this->count_recursive($kc)."'>{$l}</td>\r\n";
                                    }
                                    else{
                                        $body .="<td rowspan='".$this->count_recursive($kc)."'>{$l}</td>\r\n";
                                    }
                                        foreach ($kc as $kichco => $ct) {
                                            # code...
                                            if(array_search($kichco, array_keys($kc)) > 0){
                                               if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                                                     $body.= "<tr bgcolor='#ffedb9'>";
                                                }
                                                else{
                                                     $body.= "<tr>";
                                                }
                                            }
                                            if(strlen($kichco) > 20){
                                                if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                                                    $body .="<td bgcolor='#ffedb9' rowspan='".$this->count_recursive($ct)."' style='font-size: 9;'>{$kichco}</td>\r\n";
                                                }
                                                else{
                                                    $body .="<td rowspan='".$this->count_recursive($ct)."' style='font-size: 9;'>{$kichco}</td>\r\n";
                                                }
                                                
                                            }
                                            else{
                                                
                                                if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                                                   $body .="<td  bgcolor='#ffedb9' rowspan='".$this->count_recursive($ct)."'>{$kichco}</td>\r\n";
                                                }
                                                else{
                                                   $body .="<td rowspan='".$this->count_recursive($ct)."'>{$kichco}</td>\r\n";
                                                }
                                            }
                                            foreach ($ct as $chuongtrinh => $td) {
                                                # code...
                                                if(array_search($chuongtrinh, array_keys($ct)) > 0){
                                                    if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                                                         $body.= "<tr bgcolor='#ffedb9'>";
                                                    }
                                                    else{
                                                         $body.= "<tr>";
                                                    }
                                                }
                                                if(strpos($b, 'ĐẶC BIỆT') !== false || strpos($b, 'Đặc biệt') !== false){
                                                    $body .="<td  bgcolor='#ffedb9' >{$chuongtrinh}</td>\r\n";
                                                    $body .="<td  bgcolor='#ffedb9' >".substr($td, 0, strlen($td)-1)."</td>\r\n";
                                                }
                                                else{
                                                    $body .="<td>{$chuongtrinh}</td>\r\n";
                                                    $body .="<td>".substr($td, 0, strlen($td)-1)."</td>\r\n";
                                                }
                                                
                                                $body .= "</tr>\r\n";
                                            }

                                        }
                                }
                        }
                    
                }

            }
        
    	}
        else{       return "failed";  }

        return view('promotion.table', compact('body','time'));
    }
    
}
