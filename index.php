<?php
$showtime = date("Y-m-d H:i:s");
$fangwen = "访问者IP:";
$fangwentime = "访问时间:";
$ips = $_SERVER['REMOTE_ADDR'];

// 设置调试模式，生产环境中将其设置为 false
$debug = false;

// 使用提供的 API 查询 IP 归属地信息
$apiKey = 'jDLz5WWtKBwELhHObulLbf3YUO8XsTWtYls5sT8SRAHFwUZl0zy2DT8yA5vrIqyT'; // 你的 API key
$apiUrl = "https://api.ipplus360.com/ip/geo/v1/city/?key=$apiKey&ip=$ips&coordsys=WGS84"; // 使用提供的 API

$location = file_get_contents($apiUrl);
$locationData = json_decode($location, true);

if ($debug) {
    // 调试信息：输出API返回的数据
    echo "<pre>";
    print_r($locationData);
    echo "</pre>";
}

if ($locationData && isset($locationData['data'])) {
    $continent = $locationData['data']['continent'] ?? '未知大陆';
    $country = $locationData['data']['country'] ?? '未知国家';
    $province = $locationData['data']['prov'] ?? '未知省份';
    $city = $locationData['data']['city'] ?? '未知城市';
    $locationInfo = "$continent, $country, $province, $city";
} else {
    $locationInfo = "未知地点";
}

if ($debug) {
    // 调试信息：输出解析后的位置信息
    echo "IP: $ips<br>";
    echo "Location Info: $locationInfo<br>";
}

$file = "/www/wwwroot/www.josphersun.ink/access_log.txt"; // 确保路径和权限设置正确
$fp = fopen($file, "a");
if ($fp) {
    $txt = "$fangwen $ips ---- 归属地: $locationInfo ---- $fangwentime $showtime\n"; // 添加归属地信息
    fputs($fp, $txt);
    fclose($fp); // 关闭文件
} else {
    echo "Failed to open file for writing.";
}
?>


<!DOCTYPE html>
<!-- saved from url=(0077)./index.html -->
<html lang="en-US"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <title>Page Title</title>
  </head>
  <body class="home page-template-default page page-id-13 wp-embed-responsive cooltimeline-body no-sidebar">
    <!--?php
    $fp = fopen('file.txt', 'w');
    $txt = "Content to write into the file.\n";
    fputs($fp, $txt);
    fclose($fp);
    ?-->
  





<title>Welcome to my vitae site!</title>


<link rel="alternate" type="application/rss+xml" title="Welcome to my vitae site! » Feed" href="file:///feed/">
<link rel="alternate" type="application/rss+xml" title="Welcome to my vitae site! » Comments Feed" href="file:///comments/feed/">
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/12.0.0-1\/svg\/","svgExt":".svg","source":{"concatemoji":"\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.2.9"}};
			!function(a,b,c){function d(a,b){var c=String.fromCharCode;l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,a),0,0);var d=k.toDataURL();l.clearRect(0,0,k.width,k.height),l.fillText(c.apply(this,b),0,0);var e=k.toDataURL();return d===e}function e(a){var b;if(!l||!l.fillText)return!1;switch(l.textBaseline="top",l.font="600 32px Arial",a){case"flag":return!(b=d([55356,56826,55356,56819],[55356,56826,8203,55356,56819]))&&(b=d([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]),!b);case"emoji":return b=d([55357,56424,55356,57342,8205,55358,56605,8205,55357,56424,55356,57340],[55357,56424,55356,57342,8203,55358,56605,8203,55357,56424,55356,57340]),!b}return!1}function f(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var g,h,i,j,k=b.createElement("canvas"),l=k.getContext&&k.getContext("2d");for(j=Array("flag","emoji"),c.supports={everything:!0,everythingExceptFlag:!0},i=0;i<j.length;i++)c.supports[j[i]]=e(j[i]),c.supports.everything=c.supports.everything&&c.supports[j[i]],"flag"!==j[i]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[j[i]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(h=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",h,!1),a.addEventListener("load",h,!1)):(a.attachEvent("onload",h),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),g=c.source||{},g.concatemoji?f(g.concatemoji):g.wpemoji&&g.twemoji&&(f(g.twemoji),f(g.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
	<link rel="stylesheet" id="wp-block-library-css" href="./index_files/style.min.css" type="text/css" media="all">
<link rel="stylesheet" id="wp-block-library-theme-css" href="./index_files/theme.min.css" type="text/css" media="all">
<link rel="stylesheet" id="gctl-timeline-styles-css-css" href="./index_files/blocks.style.build.css" type="text/css" media="all">
<link rel="stylesheet" id="cvee-style-css" href="./index_files/style.css" type="text/css" media="all">
<link rel="stylesheet" id="FontAwesome-css" href="./index_files/fontawesome-all.css" type="text/css" media="all">
<link rel="stylesheet" id="cvee_google_fonts-css" href="./index_files/ded3443e91494124990ff1aa74b14163.css" type="text/css" media="all">
<link rel="stylesheet" id="custom-style-css" href="./index_files/style.css" type="text/css" media="all">
<style id="custom-style-inline-css" type="text/css">

                #masthead{
                        background-image: url();
                        background-size:cover;
                        background-repeat:no-repeat;
                }
</style>
<script type="text/javascript" src="./index_files/jquery.js"></script>
<script type="text/javascript" src="./index_files/jquery-migrate.min.js"></script>
<link rel="https://api.w.org/" href="file:///wp-json/">
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="file:///xmlrpc.php?rsd">
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="file:///wp-includes/wlwmanifest.xml"> 
<meta name="generator" content="WordPress 5.2.9">
<link rel="canonical" href="file:///">
<link rel="shortlink" href="file:///">
<link rel="alternate" type="application/json+oembed" href="file:///wp-json/oembed/1.0/embed?url=%2F">
<link rel="alternate" type="text/xml+oembed" href="file:///wp-json/oembed/1.0/embed?url=%2F&amp;format=xml">
    <style type="text/css">

      #masthead {background-color: #f1f5f8;}
      .menu-toggle {color: #111111;}
      .site-title a {color: #fff;}
      body {font-family: Times New Roman, Times, serif;}

      .footer-widget h2, .rssSummary ,  .footer-widget h3, .footer-widget p, .footer-widget a, .footer-widget .wp-calendar, .footer-widget ul {color: #ffffff;}
      .footer-widget {background-color: #fff;}
      body {line-height: 25px;}
    </style>
    

  
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="./index_%E5%89%AF%E6%9C%AC.html#content">Skip to content</a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
							<p class="site-title"><a href="file:///" rel="home">Welcome to my vitae site!</a></p>
						</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main default_page">

		
<article id="post-13" class="post-13 page type-page status-publish hentry">
	<header class="entry-header">
		<h1 class="entry-title">Qiao Sun</h1>	</header><!-- .entry-header -->

	
	<div class="entry-content">
		
<div class="wp-block-columns has-2-columns">
<div class="wp-block-column">
<p style="text-align:right">繁：孫橋<br>简：孙桥<br>Nickname: Jospher<br>E-mail: qiaosun22@m.fudan.edu.cn<br><span style="text-decoration: underline;"><a href="./index_%E5%89%AF%E6%9C%AC.html#links">Publications</a></span><br><span style="text-decoration: underline;"><a rel="noreferrer noopener" aria-label=" (opens in a new tab)" href="https://github.com/qiaosun22" target="_blank">Github</a></span><br><span style="text-decoration: underline;"><a href="./index_files/QiaoSun_sResume.pdf" target="_blank" rel="noreferrer noopener" aria-label=" (opens in a new tab)">CV</a></span></p>
</div>



<div class="wp-block-column">
<p style="font-size:17px;text-align:left"><img class="wp-image-15" style="width: 150px;" src="./index_files/WechatIMG1392.png" alt=""><br></p>
</div>
</div>



<p style="font-size:15px;text-align:center">Keywords: Representation Learning, Physics-informed Large Language Models, Natural Language Processing, Multimodality Perception, Memristor-based Analog Computing</p>
<!--<div style="-->
<!--  height: 32px; text-align: center;">-->
<!--            <nav>-->
<!--                <a style="-->
<!--  display: block;-->
<!--  margin-right: -1px;-->
<!--  padding: 0 20px;-->
<!--  border: 1px solid #EEE;-->
<!--  height: 32px;-->
<!--  line-height: 32px;-->
<!--  color: #444;-->
<!--  float: left;-->
<!--  background: #F6F6F6;" href="file:///">Home Page</a>-->
<!--              <a style="-->
<!--  display: block;-->
<!--  margin-right: -1px;-->
<!--  padding: 0 20px;-->
<!--  border: 1px solid #EEE;-->
<!--  height: 32px;-->
<!--  line-height: 32px;-->
<!--  color: #444;-->
<!--  float: left;" href="https://www.josphersun.ink/bk/Researches.html" title="Researches">Researches</a>-->
<!--                </nav>-->
<!--</div>-->
    
    
<!---->
<!--<div style="-->
<!--  height: 32px; -->
<!--  text-align: center;">-->
<!--  <nav style="-->
<!--  display: flex;-->
<!--  justify-content: center;-->
<!--  align-items: center;">-->
<!--    <a style="-->
<!--  display: block;-->
<!--  margin-right: -1px;-->
<!--  padding: 0 20px;-->
<!--  border: 1px solid #EEE;-->
<!--  height: 32px;-->
<!--  line-height: 32px;-->
<!--  color: #444;-->
<!--  background: #F6F6F6;" href="./index.html">Home Page</a>-->
<!--    <a style="-->
<!--  display: block;-->
<!--  margin-right: -1px;-->
<!--  padding: 0 20px;-->
<!--  border: 1px solid #EEE;-->
<!--  height: 32px;-->
<!--  line-height: 32px;-->
<!--  color: #444;" href="https://www.josphersun.ink/bk/Researches.html" title="Researches">Researches</a>-->
<!--  </nav>-->
<!--</div>-->

<!--hr class="wp-block-separator is-style-dots"/-->
<br>


<h3 style="text-align:center">Current Progress</h3>

<p>Update as of June 17, 2024: </p>

    <ul>
      <li>
        <strong>New paper revision</strong>, “<em><a href="./index_files/MiniConGTS_EMNLP_24__0617backup_arxiv.pdf">MiniConGTS: A Near Ultimate Minimalist Contrastive Grid Tagging Scheme for Aspect Sentiment Triplet Extraction</a></em>”. In the last review, it won 3/3/3.5 overall assessment and 4 meta overall assessment (out of 5). In this new release, I give active feedback to all the suggestions and comments. I have supplemented more detailed LLM-based experiments and conducted an in-depth analysis of error cases, revealing interesting facts and insights for ABSA (Aspect-Based Sentiment Analysis) in the context of the current era of LLMs! 
          <br>
        Additionally, I have re-illustrated all the figures and reorganized the structure of the narratives.
        <br><br>
        Key contributions of the study include a <em>Minimalist Grid Tagging Scheme</em> using the fewest classes of labels, integration of a novel <em>Token-level Contrastive Learning Strategy</em> to enhance the Pretrained Language Model (PLM) representation, which largely facilitate the internal potential of PLMs and achieve SOTA with entirely <strong>NO</strong> reliance on complicated classification head design or external semantic enhancement. 
        
        Additionally, strategic evaluations on GPT models—where the Chain-of-Thought method is evaluated for the first time in this release—demonstrate the effectiveness of the approach. Both 1) notable proofs and theoretical analyses and 2) case study are provided to support the efficacy of the new tagging scheme and the contrastive learning enhancements.   
        
        <br><br><img src="./index_files/screenshot-20240618-123708-MiniConGTS-cleffect.png" height="300" width="700" alt="" class="slider-699 slide-700" title="sqa_gan_auxiliary_network" draggable="false">        
      </li>

      <br>

      <li>
        <strong>Ongoing project</strong>, “<em><a href="https://github.com/qiaosun22/ChineseHealthcareQA">Healthcare Large Language Model</a></em>”, tackles the challenges in rotated object detection (ROD), especially in few-shot and out-of-distribution (OoD) scenarios. This paper introduces the VL-Rotate model, which incorporates vision-language integration to improve detection performance significantly.
        <br>
        Current Progress:
          <ol>
            <li>Gathered open-sourced literature corpus from website. </li>
            <li>Data wrangling, cleansing, and validating. </li>
            <li>Made a QA Dataset. </li>
            <li>Finetuned Llama-3 Chinese and ChatGLM on this dataset. </li>
          </ol>
        Next step & Future Vision:
        <ol>
          <li>Gathered more data from wider resources and form a open-source professional Healthcare Dataset. </li>
          <li>Develop systematical metrics & benchmark dataset for evaluation. </li>
          <li>Enable multimodality embedding & understanding. </li>
          <li>Enable multimodality planning. </li>
          <li>Simulating and combining with the real robotic system. </li>
        </ol>
      </li>
      
      <br>
      
      
      <li>        
        <strong>New paper</strong>, “<em><a href="./index_files/VL-Rotate_Vision-Language_Learning_for_Few-Shot_OoD_Rotated_Object_Detection.pdf">VL-Rotate: Vision-Language Learning for Few-Shot OoD Rotated Object Detection</a></em>”, tackles the challenges in rotated object detection (ROD), especially in few-shot and out-of-distribution (OoD) scenarios. This paper introduces the VL-Rotate model, which incorporates vision-language integration to improve detection performance significantly.
        <br><br>
        Key contributions of the study include:
        <ol>
          <li>A novel <strong>Oriented Object Text Alignment Module (OOTA)</strong> and <strong>Fine-Grained Region-Text Contrastive Module (FRTC)</strong>, enhancing text-image alignment and model fine-tuning.</li>
          <li>Extensive evaluations on multiple challenging datasets, where VL-Rotate achieves state-of-the-art results, demonstrating up to 75.2% mAP on HRSCOoD dataset.</li>
          <li>Detailed theoretical analysis and empirical evidence proving the effectiveness of integrating vision-language approaches in improving ROD, particularly in complex scenarios.</li>
        </ol>
      </li>

      <div id="metaslider-id-699" style="width: 100%;" class="ml-slider-3-20-2 metaslider metaslider-flex metaslider-699 ml-slider">
        <div id="metaslider_container_699">
          <div id="metaslider_699" class="flexslider">
            <ul aria-live="polite" class="slides">
              <li style="display: block; width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; z-index: 1;" class="slide-700 ms-image" data-thumb-alt="" aria-hidden="true"><img src="./index_files/VLrotate.png" height="300" width="700" alt="" class="slider-699 slide-700" title="sqa_gan_auxiliary_network" draggable="false"></li>
              <li style="display: block; width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; z-index: 2;" class="slide-701 ms-image flex-active-slide" data-thumb-alt=""><img src="./index_files/VLresult.png" height="300" width="700" alt="" class="slider-699 slide-701" title="sqa_gan_contrastive" draggable="false"></li>
            </ul>
            <ol class="flex-control-nav flex-control-paging"><li><a href="./index_%E5%89%AF%E6%9C%AC.html#" class="">1</a></li><li><a href="./index_%E5%89%AF%E6%9C%AC.html#" class="flex-active">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index_%E5%89%AF%E6%9C%AC.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index_%E5%89%AF%E6%9C%AC.html#">Next</a></li></ul><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index_%E5%89%AF%E6%9C%AC.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index_%E5%89%AF%E6%9C%AC.html#">Next</a></li></ul><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#" class="">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#" class="">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul></div>
          
        </div>
      </div>
  </li>
  
    <br>
    
      <li>
        <strong>New paper</strong>, “<em><a href="./index_files/Rethinking_ASTE-A_Minimalist_Tagging_Scheme_Alongside_Contrastive_Learning.pdf">Rethinking ASTE: A Minimalist Tagging Scheme Alongside Contrastive Learning</a></em>”, revises the conventional ASTE methods by proposing a minimalist tagging scheme. The key advancements include simplifying the classification challenges associated with Aspect Sentiment Triplet Extraction (ASTE) and enhancing the performance using contrastive learning, which significantly outperforms large language models like GPT-3.5 and GPT-4 in targeted scenarios.
        <br><br>
        Key contributions of the study include a simplified tagging scheme that reduces the number of label categories needed, integration of a token-level contrastive learning approach to improve the Pretrained Language Model (PLM) representation, and strategic evaluations on GPT models highlighting the effectiveness of the approach in context learning scenarios. Notable proofs and theoretical analyses are provided to support the efficacy of the new tagging scheme and the contrastive learning enhancements.


      <br><br><img src="./index_files/astenetwork.png" height="300" width="700" alt="" class="slider-699 slide-700" title="sqa_gan_auxiliary_network" draggable="false">
  
      
      </li>
  
      <br>
  
    </ul>


    <h3 style="text-align:center" id="links">Research Papers and Manuscripts</h3>
    
    
    
    <ul>
      <li>
        <strong>Multimodality Learning Research: </strong>
        Weihan Yin, <strong>Qiao Sun</strong>, <em>et al.</em> (5<sup>th</sup>/9 author). VL-Rotate: Vision-Language Learning for Few-Shot OoD Rotated Object Detection. Submitted to <em><strong>NeurIPS</strong></em>, 2024. Link: 
        <a href="./index_files/VL-Rotate_Vision-Language_Learning_for_Few-Shot_OoD_Rotated_Object_Detection.pdf">Manuscript</a><br><br>
      </li>
      
      <li>
        <strong>Natural Language Extraction Research: </strong>
        <strong>Qiao Sun</strong>, <em>et al. </em>Rethinking ASTE: A Minimalist Tagging Scheme Alongside Contrastive Learning. To be submitted to <em><strong>EMNLP</strong></em>, 2024. Link: 
        <a href="https://arxiv.org/abs/2403.07342">Preprint</a>
        <br><br>
      </li>
      
      <li>
        <strong>Computer Vision and Human Vision System Research: </strong>
        Qi Fan, <strong>Qiao Sun</strong>, <em>et al. </em>DV2DM: A Learning-based Visible Difference Predictor for Videos. Submitted to <em><strong>TPAMI</strong></em>, 2024. Link: 
        <a href="./index_files/DV2DM_PAMI.pdf">Manuscript</a><br><br>
      </li>
      
      <li>
        <strong>Memristor-based Neuromorphic Analog Computing Research: </strong>
        Nanyang Ye, <strong>Qiao Sun</strong>, <em>et al. </em>(Co-first author). Synergistic Development of Perovskite Memristors and Algorithms for Robust Analog Computing. Under Review in <em><strong>Nature Communications</strong></em>, 2024. Link: 
        <a href="./index_files/SynergisticDesign_AnalogDNN_R1.pdf">Manuscript</a><br><br>
      </li>



<!--  <li><strong>Balanced Batch</strong> <strong>Semi-supervised GAN</strong> <strong>Publication (BSS-GAN):</strong> Gao, Zhai and Mosalam (2020). <em>Balanced Semi-supervised Generative Adversarial Network in Vision-based Structural Damage Assessment under the Low-data and Imbalanced-class Regime</em>. In proceedings of the 17th World Conference on Earthquake Engineering (<a href="file:///wp-content/uploads/2020/10/WCEE_BSSGAN.pdf">Conference Paper</a>) and submitted to <em>Computer-Aided Civil and Infrastructure Engineering</em> (<a href="file:///wp-content/uploads/2021/02/Balanced_Semi_supervised_GAN__Submit_to_CACIAE.pdf">Journal Paper</a>)<br>Links: <a href="file:///wp-content/uploads/2021/02/Balanced_Semi_supervised_GAN__Submit_to_CACIAE.pdf">Journal Paper</a> | <a aria-label=" (opens in a new tab)" href="file:///wp-content/uploads/2020/10/WCEE_BSSGAN.pdf">Conference Paper</a> | <a href="https://github.com/BILLYZZ/BSS_GAN">Code</a><br><br></li>-->
<!--  <li><strong>Text Analytics for Resilience GAN with Knowledge Distillation Publication (TAR-GAN): </strong>Tsai, Gunay, Li, Hwang, Zhai, El Ghaoui, Mosalam (2020). <em>Text Analytics for Resilience-Enabled Extreme Events Reconnaissance. </em>Submitted to NeurIPS 2020 Artificial Intelligence for Humanitarian Assistance and Disaster Response Workshop. Link: <a rel="noreferrer noopener" aria-label=" (opens in a new tab)" href="file:///wp-content/uploads/2020/10/Text_Analytics_for_Reconnaissance__TAR_-2.pdf" target="_blank">Paper</a> | <a href="https://github.com/BILLYZZ/TAR_GAN">Code</a><br><br></li>-->
<!--  <li><strong>Simulate Path-Integral Markov Chain Monte Carlo Quantum Ising Distribution with GAN (SQA-GAN):</strong> Zhai (2020). <em>Simulate Quantum Annealing Ising Model with Conditional Generative Adversarial Network</em>. Link: <a rel="noreferrer noopener" aria-label=" (opens in a new tab)" href="file:///wp-content/uploads/2021/02/Simulated_quantum_annealing_GAN_Mutual_Information.pdf" target="_blank">Working Draft</a> | <a href="https://github.com/BILLYZZ/SQA-GAN">Code</a><br><br></li>-->
<!--  <li><strong>Extract</strong> <strong>Semantic Features from French Revolution Era Media with GAN: </strong>Zhai (2020),<em> What Makes Satires Satirical? Discover Patterns from French Revolution Media with Deep Learning</em>. Link: <a href="file:///wp-content/uploads/2021/02/Paper_French_Images-5.pdf">Manuscript</a><br><br></li>-->
<!--  <li><strong>ECM</strong> <strong>Optimization Algorithm:</strong> Find the optimal combination of Energy Conservation Measure (ECM) packages for a building. Github Links: <a href="file:///wp-content/uploads/2020/10/ECM_LBNL.pdf">Summary</a> | <a href="https://github.com/BILLYZZ/ECM_MIP_Optimization">Code (Ruby with GLPK engine)</a> | <a rel="noreferrer noopener" href="https://github.com/BILLYZZ/ECM_MIP_Optimization_Gurobi_Version" target="_blank">Code (Python with Gurobi engine)</a><br><br></li>-->
<!--  <li><strong>Linear Programming in Plastic Structural Analysis:</strong> Establish a physical connection between solving for maximum loads in a plastic system and the simplex algorithm in linear programming through a 3-element plane truss system. <a href="file:///wp-content/uploads/2020/10/A-Linear-Programming-View-on-Plastic-Structural-Analysis.pdf">Manuscript</a></li>-->
<!---->
    
    </ul>
    
    <h3 style="text-align:center">Literature Investigation</h3>



    <ul><li><strong>Event Extraction. </strong><a href="./index_files/Survey_on_EE_and_CL.pdf">Manuscript</a></li></ul>
    
    
    <ul><li><strong>3D Reconstruction. </strong><a href=".pdf">Manuscript</a></li></ul>    
    
    <ul><li><strong>SNN. </strong><a href="./index_files/Survey_on_SNN_bonedet.pdf">Manuscript</a></li></ul>    
    
    
    
    <h3 style="text-align:center">Dataset Development</h3>
    
    
    
    <ul><li><strong>ViLocVis: A Dataset for Video Visible Difference Prediction. </strong>We collected responses of the human visual system (HVS) 
to distorted videos under various luminance and viewing 
distance. We gathered a dataset named ViLocVis, which com- 
prises of several reference-distorted video pairs and corre- 
sponding marking videos. The dataset is divided into two 
parts: manually annotated data and synthetic data. Link: <a href="./index_files/DV2DM_PAMI.pdf">Paper</a> | <a href="https://github.com/qiaosun22/DVVM">Code</a></li></ul>
    
    
    
    <h3 style="text-align:center">Textbook Translation</h3>
    
    
    
    <ul><li><strong>Niklas Lidströmer, Hutan Ashrafian - Artificial Intelligence in Medicine (2022, Springer) <a href="https://link.springer.com/referencework/10.1007/978-3-030-64573-1">Link. </a></strong> Translated P898 (start from "Challenges in the Path") - P903; P905 - P916; P919 - P933; P939 - P947; P951 - P957 (end at "BE Cancer Detection Using Narrow-Band Imaging"). Link: <a href="=./index_files/Translation.pdf">Manuscript</a></li></ul>
    
    
    <h3 style="text-align:center">Lectures</h3>
    
    <ul><li><strong>The Emerging LLM-based Frameworks for Vision-centric Tasks. </strong>Delivered at The Vision Sensor Research Group of Shanghai AI Lab, Feb, 9, 2024. <a href="./index_files/survey_on_vision_centric.pdf">Manuscript</a></li></ul>       
    
    <ul><li><strong>The Transformer Architecture. </strong>Delivered at HealthCare Intelligence Research Group of Fudan University, Apr, 4, 2023. <a href="./index_files/lecture_Transformer.pdf">Link: Manuscript</a></li></ul>
    
 
    

<!--<div class="slider-container">-->
<!--  <div class="slide active">-->
<!--    <img src="./index_files/sqa_gan_auxiliary_network-700x300.png" alt="SQA GAN Auxiliary Network">-->
<!--  </div>-->
<!--  <div class="slide">-->
<!--    <img src="./index_files/sqa_gan_contrastive-700x300.png" alt="SQA GAN Contrastive">-->
<!--  </div>-->
<!--  <div class="navigation">-->
<!--    <button id="prevBtn">Prev</button>-->
<!--    <button id="nextBtn">Next</button>-->
<!--  </div>-->
<!--</div>-->
<!--<div class="slider">-->
<!--  <input type="radio" name="slider" id="slide1" checked>-->
<!--  <input type="radio" name="slider" id="slide2">-->
<!--  -->
<!--  <div class="slides">-->
<!--    <label for="slide1" class="slide">-->
<!--      <img src="./index_files/sqa_gan_auxiliary_network-700x300.png" alt="SQA GAN Auxiliary Network">-->
<!--    </label>-->
<!--    <label for="slide2" class="slide">-->
<!--      <img src="./index_files/sqa_gan_contrastive-700x300.png" alt="SQA GAN Contrastive">-->
<!--    </label>-->
<!--  </div>-->
<!--  <div class="navigation">-->
<!--    <label for="slide1" class="nav-btn"></label>-->
<!--    <label for="slide2" class="nav-btn"></label>-->
<!--  </div>-->
<!--</div>-->


<!--<div id="metaslider-id-699" style="width: 100%;" class="ml-slider-3-20-2 metaslider metaslider-flex metaslider-699 ml-slider">-->
<!--  <div id="metaslider_container_699">-->
<!--    <div id="metaslider_699" class="flexslider">-->
<!--      <ul aria-live="polite" class="slides">-->
<!--        <li style="display: block; width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; z-index: 1;" class="slide-700 ms-image" data-thumb-alt="">-->
<!--          <img src="./index_files/sqa_gan_auxiliary_network-700x300.png" height="300" width="700" alt="sqa_gan_auxiliary_network" draggable="false">-->
<!--        </li>-->
<!--        <li style="display: block; width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; z-index: 2;" class="slide-701 ms-image flex-active-slide" data-thumb-alt="">-->
<!--          <img src="./index_files/sqa_gan_contrastive-700x300.png" height="300" width="700" alt="sqa_gan_contrastive" draggable="false">-->
<!--        </li>-->
<!--      </ul>-->
<!--      <ol class="flex-control-nav flex-control-paging">-->
<!--        <li><a>1</a></li>-->
<!--        <li><a class="flex-active">2</a></li>-->
<!--      </ol>-->
<!--      <ul class="flex-direction-nav">-->
<!--        <li class="flex-nav-prev"><a class="flex-prev" href="#">Previous</a></li>-->
<!--        <li class="flex-nav-next"><a class="flex-next" href="#">Next</a></li>-->
<!--      </ul>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->




    </div>
    

<h3 style="text-align:center">Brief Timeline</h3>

<!---->
<!--<ul><li><strong>New paper</strong>, “<em><a href="file:///wp-content/uploads/2021/02/Simulated_quantum_annealing_GAN_Mutual_Information.pdf">Information Maximization and Contrastive Learning Generative Adversarial Network for Simulated Quantum Annealing</a></em>” contains a revised model to replace the original design (<a href="file:///wp-content/uploads/2020/10/SQA_GAN.pdf">old paper link</a>). In the new model, I combined and tested various mutual information (lower bound) maximization strategies to the GAN framework to <strong>improve the generator’s data output quality </strong>at continuous target labels.<br><br>Additionally, rigorous proofs are provided to give a unifying view on the following mutual information lower bound maximization methods: 1. variational lower bound through <strong>difference of entropies</strong> (DoE), 2. noice-contrastive estimation (NCE) methods, 3. Wasserstein Dependency Measure (WDM), by formulating them as an optimization problem involving maximum likelihood estimation on positive and/or negative samples.</li></ul>-->
<!---->
<!---->
<!--<div id="metaslider-id-699" style="width: 100%;" class="ml-slider-3-20-2 metaslider metaslider-flex metaslider-699 ml-slider">-->
<!--<div id="metaslider_container_699">-->
<!--    <div id="metaslider_699" class="flexslider">-->
<!--        <ul aria-live="polite" class="slides">-->
<!--            <li style="display: block; width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; z-index: 1;" class="slide-700 ms-image" data-thumb-alt="" aria-hidden="true"><img src="./index_files/sqa_gan_auxiliary_network-700x300.png" height="300" width="700" alt="" class="slider-699 slide-700" title="sqa_gan_auxiliary_network" draggable="false"></li>-->
<!--            <li style="display: block; width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; z-index: 2;" class="slide-701 ms-image flex-active-slide" data-thumb-alt=""><img src="./index_files/sqa_gan_contrastive-700x300.png" height="300" width="700" alt="" class="slider-699 slide-701" title="sqa_gan_contrastive" draggable="false"></li>-->
<!--        </ul>-->
<!--    <ol class="flex-control-nav flex-control-paging"><li><a href="./index_%E5%89%AF%E6%9C%AC.html#" class="">1</a></li><li><a href="./index_%E5%89%AF%E6%9C%AC.html#" class="flex-active">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index_%E5%89%AF%E6%9C%AC.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index_%E5%89%AF%E6%9C%AC.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index_%E5%89%AF%E6%9C%AC.html#">1</a></li><li><a href="./index_%E5%89%AF%E6%9C%AC.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index_%E5%89%AF%E6%9C%AC.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index_%E5%89%AF%E6%9C%AC.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"><li><a href="./index.html#">1</a></li><li><a href="./index.html#">2</a></li></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev" href="./index.html#">Previous</a></li><li class="flex-nav-next"><a class="flex-next" href="./index.html#">Next</a></li></ul></div>-->
<!--    -->
<!--</div>-->
<!--</div>-->
<!---->
<!---->
<!---->
<!--<ul><li>Final paper for French History Class, Hist 103B, titled “<a href="file:///wp-content/uploads/2021/02/Paper_French_Images-5.pdf"><em>What Makes Satires Satirical? Discover Patterns from French Revolution Media with Deep Learning</em></a>“. I used GAN to extract salient visual features from French Revolution era artworks (engravings, pamphlets, etc) and argued that political engravings use wide and complex scenes to showcase political tension, meanwhile pamphlet pictures use simple metaphorical motifs to comment on political events and public figures.</li></ul>-->
<!---->
<!---->
<!--<div id="metaslider-id-704" style="width: 100%;" class="ml-slider-3-20-2 metaslider metaslider-flex metaslider-704 ml-slider">-->
<!--<div id="metaslider_container_704">-->
<!--    <div id="metaslider_704" class="flexslider">-->
<!--        <ul aria-live="polite" class="slides">-->
<!--            <li style="display: block; width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; z-index: 2;" class="slide-706 ms-image flex-active-slide"><img src="./index_files/screen-shot-2021-02-13-at-6.52.00-pm-700x300.png" height="300" width="700" alt="" class="slider-704 slide-706" title="Screen Shot 2021-02-13 at 6.52.00 PM" draggable="false"></li>-->
<!--        </ul>-->
<!--    <ol class="flex-control-nav flex-control-paging"></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="./index_%E5%89%AF%E6%9C%AC.html#" tabindex="-1">Previous</a></li><li class="flex-nav-next"><a class="flex-next flex-disabled" href="./index_%E5%89%AF%E6%9C%AC.html#" tabindex="-1">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="./index_%E5%89%AF%E6%9C%AC.html#" tabindex="-1">Previous</a></li><li class="flex-nav-next"><a class="flex-next flex-disabled" href="./index_%E5%89%AF%E6%9C%AC.html#" tabindex="-1">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="./index.html#" tabindex="-1">Previous</a></li><li class="flex-nav-next"><a class="flex-next flex-disabled" href="./index.html#" tabindex="-1">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="./index.html#" tabindex="-1">Previous</a></li><li class="flex-nav-next"><a class="flex-next flex-disabled" href="./index.html#" tabindex="-1">Next</a></li></ul><ol class="flex-control-nav flex-control-paging"></ol><ul class="flex-direction-nav"><li class="flex-nav-prev"><a class="flex-prev flex-disabled" href="./index.html#" tabindex="-1">Previous</a></li><li class="flex-nav-next"><a class="flex-next flex-disabled" href="./index.html#" tabindex="-1">Next</a></li></ul></div>-->
<!--    -->
<!--</div>-->
<!--</div>-->
<!---->









<!--<div class="wp-block-columns alignfull has-2-columns">-->
<!--<div class="wp-block-column">-->
<!--<div class="wp-block-ctl-instant-timeline"><div class="ctl-instant-timeline block-1602808458463  one-sided" style="--timeLineColor:#D91B3E;--textColor:#000;--titleSize:15px;--descriptionSize:12px;--timeSize:12px"><div class="timeline-content"><div class="ctl-row"><div class="ctl-col-6"><div class="story-time"><div style="color:#000;font-size:12px">June, 2020 -Now<br><br>Independent Research<br><br><em>UC Berkeley EECS Department</em></div></div></div><div class="ctl-col-6"><div class="story-details"><div class="story-image"><img src="./index_files/screen-shot-2020-10-15-at-6.28.18-pm.png"></div><h3 style="color:#000;font-size:15px;line-height:20.1px">Simulate Path-Integral MCMC Quantum Ising Distribution with GAN&nbsp;<a href="file:///simulate-path-integral-markov-chain-monte-carlo-quantum-ising-distribution-with-gan/">click for details</a></h3><p style="color:#000;font-size:12px;line-height:20.759999999999998px"><em>Simulate Path-Integral MCMC with GAN!</em><br><a href="file:///wp-content/uploads/2021/02/Simulated_quantum_annealing_GAN_Mutual_Information.pdf">In-progress Draft</a><br><a href="https://github.com/BILLYZZ/SQA-GAN">Code on Github</a></p></div></div></div></div><div class="timeline-content"><div class="ctl-row"><div class="ctl-col-6"><div class="story-details"><div class="story-image"><img src="./index_files/tar-gan-arch.png"></div><h3 style="color:#000;font-size:15px;line-height:20.1px">GAN with Knowledge Distillation for Text Analytics and Reconnaissance&nbsp;<a href="file:///text-analytics-for-reconnaissance-tar/">click for details</a></h3><p style="color:#000;font-size:12px;line-height:20.759999999999998px"><em>NLP for extreme event recovery analysis</em><br><a href="file:///wp-content/uploads/2021/02/TAR_NIPS2020.pdf" target="_blank" rel="noreferrer noopener" aria-label=" (opens in a new tab)">Paper</a><br><a href="https://github.com/BILLYZZ/TAR_GAN">Code on Github</a><em>&nbsp;</em><br><a href="https://peer.berkeley.edu/news/peer-research-project-highlight-text-analytics-social-media-resilience-enabled-extreme-events">PEER project highlight</a></p></div></div><div class="ctl-col-6"><div class="story-time"><div style="color:#000;font-size:12px">Aug, 2020 –&nbsp;Now<br><br>PI:&nbsp;<a href="https://people.eecs.berkeley.edu/~elghaoui/">Prof. El Ghaoui</a><br><br><em>UC Berkeley EECS Department&nbsp;</em><br><br>&amp;<br><br>PI:&nbsp;<a href="https://ce.berkeley.edu/people/faculty/mosalam">Prof. Khalid Mosalam</a>&nbsp; <br><br><em>Pacific Earthquake Engineering Research Center<br>(PEER)</em></div></div></div></div></div><div class="timeline-content"><div class="ctl-row"><div class="ctl-col-6"><div class="story-time"><div style="color:#000;font-size:12px">Sept, 2018 – Now<br><br>PI:&nbsp;<a href="https://ce.berkeley.edu/people/faculty/mosalam">Prof. Khalid Mosalam</a><br><br><em>UC Berkeley Civil and Environmental Engineering Department</em><br></div></div></div><div class="ctl-col-6"><div class="story-details"><div class="story-image"><img src="./index_files/screen-shot-2020-08-28-at-11.15.55-pm.png"></div><h3 style="color:#000;font-size:15px;line-height:20.1px">Generative Adversarial Networks for Structural Health Monitoring&nbsp;<a href="file:///generative-adversarial-networks-for-structural-health-monitoring/">click for details</a></h3><p style="color:#000;font-size:12px;line-height:20.759999999999998px"><em>Venture into the low-data and imbalanced-class regime!&nbsp;</em><br><a rel="noreferrer noopener" aria-label=" (opens in a new tab)" href="file:///wp-content/uploads/2020/10/WCEE_BSSGAN.pdf" target="_blank">17th WCEE Conference Paper</a>&nbsp;<br><a href="file:///wp-content/uploads/2021/02/Balanced_Semi_supervised_GAN__Submit_to_CACIAE.pdf">Journal Paper</a><br><a href="https://github.com/BILLYZZ/BSS_GAN">Code on Github</a></p></div></div></div></div><div class="timeline-content"><div class="ctl-row"><div class="ctl-col-6"><div class="story-details"><div class="story-image"><img src="./index_files/screen-shot-2021-02-12-at-5.46.04-am.png"></div><h3 style="color:#000;font-size:15px;line-height:20.1px">Extract Visual Features from French-Revolution era media</h3><p style="color:#000;font-size:12px;line-height:20.759999999999998px"><a href="file:///wp-content/uploads/2021/02/Paper_French_Images-5.pdf">Manuscript</a></p></div></div><div class="ctl-col-6"><div class="story-time"><div style="color:#000;font-size:12px">Dec 2020<br>French History Class Final paper</div></div></div></div></div></div></div>-->
<!--</div>-->
<!---->


<div class="wp-block-column">
<!--  <div class="wp-block-ctl-instant-timeline"><div class="ctl-instant-timeline block-1602808466351  one-sided" style="--timeLineColor:#D91B3E;--textColor:#000;--titleSize:15px;--descriptionSize:12px;--timeSize:12px"><div class="timeline-content"><div class="ctl-row"><div class="ctl-col-6"><div class="story-time"><div style="color:#000;font-size:12px">Oct, 2023 – May, 2024<br><br>PI:&nbsp;<a href="https://ynysjtu.github.io/">Prof. Nanyang Ye</a><br><br><em>Shanghai Jiao Tong University</em></div></div></div><div class="ctl-col-6"><div class="story-details"><div class="story-image"><img src="./index_files/VLrotate.png"></div><h3 style="color:#000;font-size:15px;line-height:20.1px">VL-Rotate: Vision-Language Learning for Few-Shot OoD Rotated Object Detection <a href="file:///discrete-optimization-with-building-energy-conservation-measures/">click for details</a></h3><p style="color:#000;font-size:12px;line-height:20.759999999999998px"><em>Novel CLIP application for the rotation object detection task!&nbsp;</em><br><a href="./index_files/VL-Rotate_Vision-Language_Learning_for_Few-Shot_OoD_Rotated_Object_Detection.pdf">Paper</a><br></p></div></div></div></div><div class="timeline-content"><div class="ctl-row"><div class="ctl-col-6"><div class="story-details"><div class="story-image"><img src="./index_files/UViT.png"></div><h3 style="color:#000;font-size:15px;line-height:20.1px">A UViT architecture for video visible difference prediction</h3><p style="color:#000;font-size:12px;line-height:20.759999999999998px"><em>Design and establish a U-Net-style vision Transformer to handle the video VDP problem.</em><br><a href="https://github.com/fanqiNO1/DVVM">Code on GitHub</a></p></div></div><div class="ctl-col-6"><div class="story-time"><div style="color:#000;font-size:12px">Sept, 2023 – May, 2024<br><br>Mentor:&nbsp;<a href="https://www.cl.cam.ac.uk/~rkm38/">Prof. Rafał Mantiuk</a><br><br><em>Rainbow Research Group,-->
<!--University of Cambridge</em></div></div></div></div></div><div class="timeline-content"><div class="ctl-row"><div class="ctl-col-6"><div class="story-time"><div style="color:#000;font-size:12px">Sept, 2023 – May, 2024<br><br>Mentor:&nbsp;<a href="https://www.cl.cam.ac.uk/~rkm38/">Prof. Rafał Mantiuk</a><br><br><em>Rainbow Research Group,-->
<!--University of Cambridge<br></em></div></div></div><div class="ctl-col-6"><div class="story-details"><div class="story-image"><img src="./index_files/dataset.png"></div><h3 style="color:#000;font-size:15px;line-height:20.1px">ViLocVis dataset collecting and labelling</h3><p style="color:#000;font-size:12px;line-height:20.759999999999998px"><em>For better compression and watermark algorithm in this video era!</em><br><a href="https://github.com/fanqiNO1/DVVM">Code on Github</a></p></div></div></div></div><div class="timeline-content"><div class="ctl-row"><div class="ctl-col-6"><div class="story-details"><div class="story-image"><img src="./index_files/robot.png"></div><h3 style="color:#000;font-size:15px;line-height:20.1px">Design and kinematics of a tandem robot with five degrees of freedom</h3><p style="color:#000;font-size:12px;line-height:20.759999999999998px"><em>A Coursework Design.</em><br><a href="http://app.fedeas.com/">Term Presentation</a></p></div></div><div class="ctl-col-6"><div class="story-time"><div style="color:#000;font-size:12px">Dec, 2022<br><br>PI:&nbsp;<a href="https://scholar.google.com.hk/citations?user=hgXRiG8AAAAJ&amp;hl=en&amp;oi=sra">Prof. Dan Zhang</a><br><br><em>Academy for Engineering &amp; Techonology, Fudan University</em></div></div></div></div></div><div class="timeline-content"><div class="ctl-row"><div class="ctl-col-6"><div class="story-time"><div style="color:#000;font-size:12px">Oct, 2023 – May, 2024<br><br>PI:&nbsp;<a href="https://ynysjtu.github.io/">Prof. Nanyang Ye</a><br><br><em>Shanghai Jiao Tong University</em></div></div></div><div class="ctl-col-6"><div class="story-details"><div class="story-image"><img src="./index_files/VLrotate.png"></div><h3 style="color:#000;font-size:15px;line-height:20.1px">VL-Rotate: Vision-Language Learning for Few-Shot OoD Rotated Object Detection <a href="file:///discrete-optimization-with-building-energy-conservation-measures/">click for details</a></h3><p style="color:#000;font-size:12px;line-height:20.759999999999998px"><em>Novel CLIP application for the rotation object detection task!&nbsp;</em><br><a href="./index_files/VL-Rotate_Vision-Language_Learning_for_Few-Shot_OoD_Rotated_Object_Detection.pdf">Paper</a><br></p></div></div></div></div></div></div>-->
  
  <div class="wp-block-column">
    <div class="wp-block-ctl-instant-timeline">
      <div class="ctl-instant-timeline block-1602808466351 one-sided" style="--timeLineColor:#D91B3E;--textColor:#000;--titleSize:15px;--descriptionSize:12px;--timeSize:12px">
        <div class="timeline-content">

          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                June, 2024<br><br>
                Independent Reseach
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/screenshot-20240618-123708-MiniConGTS-archi.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">A new revised version of past work on Fine-grained Sentiment Analysis. </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>The first known GPT-4 CoT evaluation on this challenging task, where our method overwhelm GPTs on all the aspects!</em><br>
                  <a href="https://arxiv.org/abs/2406.11234">Preprint Link</a> | <a href="https://github.com/qiaosun22/MiniConGTS">GitHub Link</a><br>
                </p>
              </div>
            </div>
          </div>
          

          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                May, 2024<br><br>
                PI: <a href="https://ynysjtu.github.io/">Prof. Shijie Guo</a><br><br>
                <em>Academy of Engineering & Technology, Fudan University</em>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/healthcaredataset.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">A Chinese QA Dataset for Health Care LLM Finetuning. </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>Contribution to the AI Health Care. Towards more informed LLM Agents!</em><br>
                  <a href="https://github.com/qiaosun22/ChineseHealthcareQA">GitHub Link</a><br>
                </p>
              </div>
            </div>
          </div>
<!--      __________________-->
          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Dec, 2023 – May, 2024<br><br>
                PI: <a href="https://ynysjtu.github.io/">Prof. Nanyang Ye</a><br><br>
                <em>School of Electronics, Shanghai Jiao Tong University</em>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/VLrotate.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">VL-Rotate: Vision-Language Learning for Few-Shot OoD Rotated Object Detection. </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>Novel and Powerful CLIP application boosts the rotation object detection task substantially!</em><br>
                  <a href="./index_files/VL-Rotate_Vision-Language_Learning_for_Few-Shot_OoD_Rotated_Object_Detection.pdf">Paper</a><br>
                </p>
              </div>
            </div>
          </div>

          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/coursework_datascience.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">Distance Comparison Operators for Approximate Nearest Neighbor Search: Exploration and Benchmark </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>A Coursework Project.</em><br>
                  <a href="">Code</a>
                </p>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Dec, 2023<br><br>
                Mentor: <a href="https://cscw.fudan.edu.cn/lishang/list.htm">Prof. Li Shang</a><br><br>
                <em>School of Computer Science, Fudan University</em>
              </div>
            </div>
          </div>
          
          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">A LangChain LLM Agent for Arxiv Digest</h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>A Coursework Project.</em><br>
                  <a href="">Code</a>
                </p>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Dec, 2023<br><br>
                Mentor: <a href="https://cscw.fudan.edu.cn/lishang/list.htm">Prof. Li Shang</a><br><br>
                <em>School of Computer Science, Fudan University</em>
              </div>
            </div>
          </div>
          
          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Oct, 2023 – Mar, 2024<br><br>
                PI: <a href="https://scholar.google.com/citations?user=uWe1d3YAAAAJ&hl=en">Young Research Scientist, Dr. Qinying Gu</a><br><br>
                <em>Shanghai AI Lab</em>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/astecontrastive.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">Rethinking ASTE: A Minimalist Tagging Scheme Alongside Contrastive Learning </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>Novel contrastive learning strategy aligns seamlessly with a minimalist 2D tagging scheme, which effectively facilitate the Aspect Sentiment Triplet Extraction!</em><br>
                  <a href="./index_files/Rethinking_ASTE-A_Minimalist_Tagging_Scheme_Alongside_Contrastive_Learning.pdf">Paper</a><br>
                </p>
              </div>
            </div>
          </div>
          
          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/UViT.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">A U-ViT architecture for video visible difference prediction</h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>Design and establish a U-Net-style vision Transformer to handle the video VDP problem.</em><br>
                  <a href="https://github.com/fanqiNO1/DVVM">Code on GitHub</a>
                </p>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Sept, 2023 – May, 2024<br><br>
                Mentor: <a href="https://www.cl.cam.ac.uk/~rkm38/">Prof. Rafał Mantiuk</a><br><br>
                <em>Rainbow Research Group, University of Cambridge</em>
              </div>
            </div>
          </div>
          
          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Oct, 2023<br><br>
                Mentor: <a href="https://www.cl.cam.ac.uk/~rkm38/">Prof. Rafał Mantiuk</a><br><br>
                <em>Rainbow Research Group, University of Cambridge</em>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/dataset.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">ViLocVis dataset collecting and labelling</h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>For better compression and watermark algorithm in this video era!</em><br>
                  <a href="https://github.com/fanqiNO1/DVVM">Code on Github</a>
                </p>
              </div>
            </div>
          </div>

          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Nov, 2023 – Dec, 2023<br><br>
                PI: <a href="https://scholar.google.com/citations?user=uWe1d3YAAAAJ&hl=en">Young Research Scientist, Dr. Qinying Gu</a><br><br>
                <em>Shanghai AI Lab</em>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">Memristor crossbar in-situ training algorithm </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>Noise modeling for memristor crossbars, using signal theory, frequency analysis, and chaos theory, where we first adopt a spatial frequency analysis on the memristor crossbars. </em><br>
                  <a href="">Code</a><br>
                </p>
              </div>
            </div>
          </div>

          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Oct, 2023<br><br>
                PI: <a href="https://scholar.google.com/citations?user=uWe1d3YAAAAJ&hl=en">Young Research Scientist, Dr. Qinying Gu</a><br><br>
                <em>Shanghai AI Lab</em>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">Memristor crossbar noise modeling </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>Noise modeling for memristor crossbars, using signal theory, frequency analysis, and chaos theory, where we first adopt a spatial frequency analysis on the memristor crossbars. </em><br>
                  <a href="">Code</a><br>
                </p>
              </div>
            </div>
          </div>
          
          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Mar, 2023 – Oct, 2023<br><br>
                PI: <a href="https://scholar.google.com/citations?user=uWe1d3YAAAAJ&hl=en">Young Research Scientist, Dr. Qinying Gu</a><br><br>
                <em>Shanghai AI Lab</em>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/synergistic.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">Synergistic Development of Perovskite Memristors and Algorithms for Robust Analog Computing </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>Co-design for optimization of memristor fabrication and robust algorithm, achieving up to 100 times performance enhancement!</em><br>
                  <a href="./index_files/SynergisticDesign_AnalogDNN_R1.pdf">Paper</a><br>
                </p>
              </div>
            </div>
          </div>
          
          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/robot.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">Design and kinematics of a tandem robot with five degrees of freedom. </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>A Coursework Project.</em><br>
                  <a href="./index_files/roboticKinematicsPre.pdf">Term Presentation</a>
                </p>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Dec, 2022<br><br>
                Mentor: <a href="https://scholar.google.com.hk/citations?user=hgXRiG8AAAAJ&hl=en&oi=sra">Prof. Dan Zhang</a><br><br>
                <em>Academy for Engineering & Technology, Fudan University</em>
              </div>
            </div>
          </div>
          
          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="./index_files/myoutput2.png">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">A simple implementation for image registration </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>A Coursework Project.</em><br>
                  <a href="">Code</a>
                </p>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                Oct, 2022<br><br>
                Mentor: <a href="http://www.fudanmiccai.org/nd.jsp?id=94">Dr. Xinrong Chen</a><br><br>
                <em>Academy for Engineering & Technology, Fudan University</em>
              </div>
            </div>
          </div>
          
          <div class="ctl-row">
            <div class="ctl-col-6">
              <div class="story-details">
                <div class="story-image">
                  <img src="">
                </div>
                <h3 style="color:#000;font-size:15px;line-height:20.1px">An implementation of CNN framework </h3>
                <p style="color:#000;font-size:12px;line-height:20.76px">
                  <em>A NumPy CNN framework from scratch.</em><br>
                  <a href="">Code</a>
                </p>
              </div>
            </div>
            <div class="ctl-col-6">
              <div class="story-time" style="color:#000;font-size:12px">
                April, 2022<br><br>
<!--            Mentor: <a href="http://www.fudanmiccai.org/nd.jsp?id=94">Dr. Xinrong Chen</a><br><br>-->
<!--            <em>Academy for Engineering & Technology, Fudan University</em>-->
              </div>
            </div>
          </div>
          
  
  
        </div>
      </div>
    </div>
  </div>

  
</div>
<!--</div>-->
	</article></main></div><!-- .entry-content -->

	<!-- #post-13 -->

		<!-- #main -->
	</div><!-- #primary -->


<div class="clearfix"></div>
    <section class="footer-widget">
                <div class="clearfix"></div>
  	</section>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" style="clear: both; margin-top: 189.76px;">
		<div class="site-info">
			
				Copyright(c) 2024 Qiao Sun			
			
				
				
				
				
		</div><!-- .site-info -->
		<a href="./index_%E5%89%AF%E6%9C%AC.html#" class="scrolltotop"><i class="fas fa-chevron-up" style="display: block;"></i></a>
	</footer><!-- #colophon -->
<!-- #page -->

<link rel="stylesheet" id="metaslider-flex-slider-css" href="./index_files/flexslider.css" type="text/css" media="all" property="stylesheet">
<link rel="stylesheet" id="metaslider-public-css" href="./index_files/public.css" type="text/css" media="all" property="stylesheet">
<script type="text/javascript" src="./index_files/sidr.js"></script>
<script type="text/javascript" src="./index_files/cv.js"></script>
<script type="text/javascript" src="./index_files/skip-link-focus-fix.js"></script>
<script type="text/javascript" src="./index_files/wp-embed.min.js"></script>
<script type="text/javascript" src="./index_files/jquery.flexslider.min.js"></script>
<script type="text/javascript">
var metaslider_699 = function($) {$('#metaslider_699').addClass('flexslider');
            $('#metaslider_699').flexslider({ 
                slideshowSpeed:3000,
                animation:"fade",
                controlNav:true,
                directionNav:true,
                pauseOnHover:true,
                direction:"horizontal",
                reverse:false,
                animationSpeed:600,
                prevText:"Previous",
                nextText:"Next",
                fadeFirstSlide:false,
                slideshow:true
            });
            $(document).trigger('metaslider/initialized', '#metaslider_699');
        };
        var timer_metaslider_699 = function() {
            var slider = !window.jQuery ? window.setTimeout(timer_metaslider_699, 100) : !jQuery.isReady ? window.setTimeout(timer_metaslider_699, 1) : metaslider_699(window.jQuery);
        };
        timer_metaslider_699();
var metaslider_704 = function($) {$('#metaslider_704').addClass('flexslider');
            $('#metaslider_704').flexslider({ 
                slideshowSpeed:3000,
                animation:"fade",
                controlNav:true,
                directionNav:true,
                pauseOnHover:true,
                direction:"horizontal",
                reverse:false,
                animationSpeed:600,
                prevText:"Previous",
                nextText:"Next",
                fadeFirstSlide:false,
                slideshow:true
            });
            $(document).trigger('metaslider/initialized', '#metaslider_704');
        };
        var timer_metaslider_704 = function() {
            var slider = !window.jQuery ? window.setTimeout(timer_metaslider_704, 100) : !jQuery.isReady ? window.setTimeout(timer_metaslider_704, 1) : metaslider_704(window.jQuery);
        };
        timer_metaslider_704();
</script>



<div id="sidr-main" class="sidr sidr-right" style="transition: right 0.2s ease 0s;"><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle">undefined<span class="menu_close"><i class="fas fa-times"></i></span></div><div class="pad_menutitle"><i class="fa fa-bars"></i><span class="menu_close"><i class="fas fa-times"></i></span></div><div class="sidr-inner">
				<button href="#sidr" class="sidr-class-menu-toggle" aria-controls="primary-menu" aria-expanded="false" data-sidr="sidr-main"><i class="sidr-class-fa sidr-class-fa-bars"></i></button>
				<div id="sidr-id-menu" class="sidr-class-menu"><ul>
<li class="sidr-class-page_item sidr-class-page-item-527"><a href="file:///discrete-optimization-with-building-energy-conservation-measures/">Discrete Optimization with Building Energy Conservation Measures</a></li>
<li class="sidr-class-page_item sidr-class-page-item-77"><a href="file:///generative-adversarial-networks-for-structural-health-monitoring/">Generative Adversarial Networks for SHM</a></li>
<li class="sidr-class-page_item sidr-class-page-item-13 sidr-class-current_page_item"><a href="file:///" aria-current="page">Pengyuan Zhai</a></li>
<li class="sidr-class-page_item sidr-class-page-item-455"><a href="file:///r-tree-for-spatially-joining-multi-polygon-data/">R-Tree for Spatially Joining Multi-polygon Data</a></li>
<li class="sidr-class-page_item sidr-class-page-item-356"><a href="file:///simulate-path-integral-markov-chain-monte-carlo-quantum-ising-distribution-with-gan/">Simulate Path-integral Markov Chain Monte Carlo Quantum Ising Distribution with GAN</a></li>
<li class="sidr-class-page_item sidr-class-page-item-167"><a href="file:///text-analytics-for-reconnaissance-tar/">Text Analytics for Reconnaissance (TAR)</a></li>
</ul></div>
			</div></div></body></html>