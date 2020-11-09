<?php
//	function uploadImage(Request $request){
//		echo '123';
//	//thinkphp5的框架，如果是原生的，用$_FiLES['file']获取到图片，
//      $file 	= $request->$_FiLES['file'];
//      $info 	= $file->move(ROOT_PATH . 'public' . DS . 'uploads');
//      if($info){
//           $name_path =str_replace('\\',"/",$info->getSaveName());
//
//              $result['data']["src"] = "/img/".$name_path;
//          $url 	= $info->getSaveName();
//          //图片上传成功后，组好json格式，返回给前端
//          $arr = array(
//              'code' => 0,
//              'message' => '',
//              'data' => array(
//                  'src' => "/img/".$name_path
//                  ),
//              );
//      }
//
//      echo json_encode($arr);
//
//  }	
//	
?>
<?php/*****layui上传的后台接口 */
	namespace app\admin\controller;
	use \think\Controller;
	class Upload extends Controller{    
		public function index(){        
			$ret = array();  //返回的上传文件状态数组        
			if ($_FILES["file"]["error"] > 0) {            
				$ret["message"] =  $_FILES["file"]["error"] ;            
				$ret["status"] = 0;            
				$ret["src"] = "";            
				return json($ret);          
			}else{               
				$pic =  $this->upload();               
				if($pic['info']== 1){                  
					$url = '/uploads/'.$pic['savename'];               
				}  else {                   
					$ret["message"] = $this->error($pic['err']);                    
					$ret["status"] = 0;                 }                
					$ret["message"]= "图片上传成功！";                
					$ret["status"] = 1;                  
					$ret["src"] = $url;                
					return json($ret);        
			}     //图片上传代码    
			private  function upload(){       
				$file = request()->file('file');        
				// 移动到框架应用根目录/public/uploads/ 目录下        
				$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');        
				$reubfo = array();  //定义一个返回的数组       
				if($info){            
					$reubfo['info']= 1;            
					$reubfo['savename'] = $info->getSaveName();        
				}else{            
					// 上传失败获取错误信息            
					$reubfo['info']= 0;            
					$reubfo['err'] = $file->getError();;        
				}        
				return $reubfo;    
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="frame/layui/css/layui.css">
    <script type="text/javascript" src='frame/js/jquery-3.2.1.min.js'></script>
    <script type="text/javascript" src='frame/layui/layui.js'></script>
    <title></title>
</head>

<body>
<div class="right" style="margin: 90px 0 0 190px;">
    <form action="{:url('upload2')}" enctype="multipart/form-data" method="post">

            <textarea class="layui-textarea" id="LAY_demo1" name="details" style="display: none;">  
            </textarea>
        <input type="submit" name="" value="提交">
    </form>

</div>
</body>
<script>
layui.use('layedit', function(){
  var layedit = layui.layedit;
  layedit.set({
      uploadImage: {
        url: '/uploadImage' //接口url
        ,type: 'post', //默认post
        success:function(res){

        }
      }
    });

  //构建一个默认的编辑器
  var index = layedit.build('LAY_demo1',{
    height:800
  });

  //编辑器外部操作
  var active = {
    content: function(){
      alert(layedit.getContent(index)); //获取编辑器内容
    }
    ,text: function(){
      alert(layedit.getText(index)); //获取编辑器纯文本内容
    }
    ,selection: function(){
      alert(layedit.getSelection(index));
    }
  };

  $('.site-demo-layedit').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });

  //自定义工具栏
  layedit.build('LAY_demo2', {
    tool: ['face', 'link', 'unlink', '|', 'left', 'center', 'right']
    ,height: 100
  })
});
</script>
</html>
