<html>
	<head>
                <title> 搜索页 </title>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
                <meta name="baidu-site-verification" content="25JagZe9G4" />
                <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
                <link rel="stylesheet" href="assets/css/main.css" />
                <link rel="stylesheet" href="assets/css/share.min.css" />
                <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
                <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

                <style>
                  .row{padding: 20px 0 0 20px}
                  .row-pad{padding: 20px 0 0 60px}
                </style>
        </head>

<body>
<div id="wrapper">
                  <div id="main">
                              <div class="inner">

<?php
//error_reporting(0);

set_time_limit("600");
//获取搜索关键字
$keyword=trim($_GET["keyword"]);
//检查是否为空

if($keyword==""){
   echo"您要搜索的关键字不能为空";
   exit;//结束程序
}

function listFiles($dir,$keyword,&$array){
   $handle=opendir($dir);
   while(false!==($file=readdir($handle))){
          if($file!="."&&$file!=".."){
          if(is_dir("$dir/$file")){
             listFiles("$dir/$file",$keyword,$array);
          }
              else{
            $data=fread(fopen("$dir/$file","r"),filesize("$dir/$file"));
                        if(preg_match("#<body([^>]+)>(.+)</body>#",$data,$b)){
                 $body=strip_tags($b["2"]);
                        }
                        else{
                 $body=strip_tags($data);
                        }
                        if($file!="search.php"){
                            if(preg_match("/$keyword/",$body)){
                                   if(preg_match("#<title>(.+)</title>#",$data,$m)){
                        $title=$m["1"];
                                   }
                                   else{
                        $title="没有标题";
                                   }
                                   $array[]="$dir/$file $title";
                            }
                        }
             }
      }
   }
}
$array=array();
listFiles(".","$keyword",$array);
foreach($array as $value){
   //拆开
   //list($filedir,$title)=split("[ ]",$value,"2");
   list($filedir,$title)=explode(" ",$value,"2");
   //输出
   echo "<a href=$filedir target=_blank>$title </a>"."<br>\n";
}
?>
</div>
</div>
</div>

			<script src="assets/js/jquery.min.js"></script>
                        <script src="assets/js/skel.min.js"></script>
                        <script src="assets/js/util.js"></script>
                        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
                        <script src="assets/js/main.js"></script>
                        <script src="assets/js/jquery.share.min.js"></script>

</body>
</html>

