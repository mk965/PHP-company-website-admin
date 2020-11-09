<?php
	public function uploadImage(Request $request){
	//thinkphp5的框架，如果是原生的，用$_FiLES['file']获取到图片，
        $file 	= $request->$_FiLES['file'];
        $info 	= $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
             $name_path =str_replace('\\',"/",$info->getSaveName());

                $result['data']["src"] = "/uploads/layui/".$name_path;
            $url 	= $info->getSaveName();
            //图片上传成功后，组好json格式，返回给前端
            $arr = array(
                'code' => 0,
                'message' => '',
                'data' => array(
                    'src' => "/uploads/".$name_path
                    ),
                );
        }

        echo json_encode($arr);

    }
?>