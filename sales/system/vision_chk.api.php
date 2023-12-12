<?php
    session_start();
    require_once '../../db-conn.php';
    date_default_timezone_set("Asia/Bangkok");

    $data = json_decode(file_get_contents("php://input"));
    $img_id = $data->img_id;

    function extract_int($str){  
        preg_match_all('!\d+!', $str, $matches);
        $data = implode(' ', $matches[0]);
        return str_replace(' ', '', $data);
    }

    function isValidThaiId($thaiId)
    {
        $thaiId = preg_replace('/[^0-9]/', '', $thaiId);

        if (strlen($thaiId) === 13) {
            $digits = str_split($thaiId);

            $checkDigit = $digits[12];

            $sum = 0;
            for ($i = 0; $i < 12; $i++) {
                $sum += intval($digits[$i]) * (13 - $i);
            }

            $expectedCheckDigit = (11 - ($sum % 11)) % 10;

            if ($checkDigit == $expectedCheckDigit) {
                return true;
            }
        }
        return false;
    }
    

    $db->join("a77_agent_img i", "i.aimg_parent=a.agen_id", "INNER");
    $db->where('aimg_group',2)->where('aimg_status',1)->where('i.aimg_img_id',$img_id);
    $chk = $db->getOne('a77_agent a', null, 'i.aimg_link, i.aimg_parent');

    if(count($chk) > 0){

        /* api google vision */
        $url = "https://vision.googleapis.com/v1/images:annotate?key=AIzaSyAky4XpPkC7MYL9gUkYM3wcBOOd4PGn9lw";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = '{
        "requests": [
            {
            "features": [
                {
                "type": "TEXT_DETECTION"
                }
            ],
            "image": {
                "source": {
                "imageUri": "'.$chk['aimg_link'].'"
                }
            }
            }
        ]
        }';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);

        $results =json_decode($resp);
        $results = $results->responses[0]->textAnnotations[0]->description;
        $results = explode("\n", $results);
        $results = array_filter($results, function($value) { return $value !== ''; });


        $db->join("a77_provinces p", "p.code=a.agen_province", "INNER");
        $db->where('a.agen_id',$chk['aimg_parent']);
        $agent = $db->getOne('a77_agent a', null, 'a.agen_id, a.agen_first_name, a.agen_last_name, a.agen_people_id,p.name_in_thai');
        
        $data_name = '/'.$agent['agen_first_name'].'/';
        $name = preg_grep($data_name, $results);

        //$name_arr = explode(" ", $name[key($name)]);
        //if($name_arr[2] == $agent['agen_first_name'] && $name_arr[3] == $agent['agen_last_name']){
        if(count($name) > 0){

            $pid_arr = explode(" ", $results[0]);
            $id = substr($agent['agen_people_id'], 5, 5);
            $find_id = '/'.$id.'/';
            $id_arr = preg_grep($find_id, $results);

            $pid_data = $results[key($id_arr)];
            $pidf = extract_int($pid_data);

            if($pidf == $agent['agen_people_id']){

                if (isValidThaiId($agent['agen_people_id'])) {
                    
                    $data_pv = '/'.$agent['name_in_thai'].'/';
                    $pv = preg_grep($data_pv, $results);

                    if(count($pv) > 0){

                        $db->where('agen_id',$agent['agen_id']);
                        $db->update('a77_agent', array('agen_status' => 2));
                        if ($db->count > 0){
                            $api = array(
                                'status' => '200',
                                'message' => 'อนุมัติการยืนยันตัวตน'
                            );
                        } else {
                            $db->where('agen_id',$agent['agen_id']);
                            $db->update('a77_agent', array('agen_status' => '10'));
                            if($db->count > 0){
                                $api = array(
                                    'status' => '400',
                                    'message' => 'ข้อมูลไม่ถูกต้อง อาจเกิดจากการถ่ายภาพไม่ชัดเจน หรือ ข้อมูลไม่ตรงกับที่ลงทะเบียนไว้'
                                );
                            } else {
                                $api = array(
                                    'status' => '505',
                                    'message' => 'เกิดข้อผิดพลาด'
                                );
                            }
                        }

                    } else {
                        $db->where('agen_id',$agent['agen_id']);
                        $db->update('a77_agent', array('agen_status' => '10'));
                        if($db->count > 0){
                            $api = array(
                                'status' => '400',
                                'message' => 'ข้อมูลไม่ถูกต้อง อาจเกิดจากการถ่ายภาพไม่ชัดเจน หรือ ข้อมูลไม่ตรงกับที่ลงทะเบียนไว้'
                            );
                        }
                    }

                } else {
                    $db->where('agen_id',$agent['agen_id']);
                    $db->update('a77_agent', array('agen_status' => '10'));
                    if($db->count > 0){
                            $api = array(
                                'status' => '400',
                                'message' => 'ข้อมูลไม่ถูกต้อง อาจเกิดจากการถ่ายภาพไม่ชัดเจน หรือ ข้อมูลไม่ตรงกับที่ลงทะเบียนไว้'
                            );
                    }
                }

            } else {
                $db->where('agen_id',$agent['agen_id']);
                $db->update('a77_agent', array('agen_status' => '10'));
                if($db->count > 0){
                    $api = array(
                        'status' => '400',
                        'message' => 'ข้อมูลไม่ถูกต้อง อาจเกิดจากการถ่ายภาพไม่ชัดเจน หรือ ข้อมูลไม่ตรงกับที่ลงทะเบียนไว้'
                    );
                }
            }


        } else {
            $db->where('agen_id',$agent['agen_id']);
            $db->update('a77_agent', array('agen_status' => '10'));
            if($db->count > 0){
                $api = array(
                    'status' => '400',
                    'message' => 'ข้อมูลไม่ถูกต้อง อาจเกิดจากการถ่ายภาพไม่ชัดเจน หรือ ข้อมูลไม่ตรงกับที่ลงทะเบียนไว้'
                );
            }
        }
    } else {
        $api = array(
            'status' => '400',
            'message' => 'ไม่พบข้อมูล'
        );
    }

    echo json_encode($api);

    
    
