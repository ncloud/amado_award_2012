<?php
    require_once('./awards.php');
    
    $base_url = 'http://award.amado.kr';
    $header_title = '아마도상 2012';
    $header_description = '2012년 5월 14일부터 11월 29일까지의 총 200일 기념';
    $facebook_app_id = '228778467237901';
    
    $now_award = null;
    
    $request_uri = $_SERVER['REQUEST_URI']; // FOR Rewrite;
    if($request_uri == '/') {
        $og_title = $header_title;
        $og_description = $header_description;
        $og_image = $base_url . '/images/logo_amado.png';
    } else {
        $new_awards = array();
        $menu = substr($request_uri,1);
        if(strpos($menu,'?') !== false) {
            $menu = substr($menu,0,strpos($menu,'?'));
        }
        
        foreach($awards as $award) {
            if($award['id'] == $menu) {
                $now_award = $award;
                $og_title = $now_award['who'] . ' - ' . $now_award['name'] . ' :: ' . $header_title;
                $og_description = $header_title . '의 수상을 진심으로 축하드려요. :)';
                $og_image = $now_award['thumbnail'] . '?type=large';
                continue;
            }
            
            $new_awards[] = $award;
        }
        
        $awards = $new_awards;
    }
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title><?php echo $header_title;?></title>
<meta name="title" content="">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />

<?php if(isset($og_title)) { ?><meta property="og:title" content="<?php echo $og_title;?>" /><?php } ?>
<?php if(isset($og_description)) { ?><meta property="og:description" content="<?php echo str_replace('"','\'',$og_description);?>" /><?php } ?>
<?php if(isset($og_url)) { ?><meta property="og:url" content="<?php echo $og_url;?>" /><?php } ?>
<?php if(isset($og_site_name)) { ?><meta property="og:site_name" content="<?php echo $og_site_name;?>" /><?php } ?>
<?php if(isset($og_image)) { ?><meta property="og:image" content="<?php echo $og_image;?>" /><?php } ?>    
<link rel="stylesheet" href="./links/reset.css" />
</head>
<body>      

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/ko_KR/all.js#xfbml=1&appId=<?php echo $facebook_app_id;?>";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <style type="text/css">
        body {  
                background:#eaeaea;
                font-family: "나눔고딕", "NanumGothic", "맑은고딕", "Malgun Gothic", "Helvetica", "Tahoma";
                font-size: 12px;
                padding-left:10px;
                padding-right:10px;
              }
       
       .logo { display:block; margin:0 auto; margin-top: 25px; width:65px; height:66px; background:url(./images/logo_amado.png) no-repeat; }
            
        #header { background:#fff; width:100%; margin-left:-10px; padding-left:10px; padding-right:10px; border-bottom:2px solid #d4d4d4; }
            #header .header_wrap { min-width:300px; max-width:960px; margin:0 auto; position:relative;  }
            #header .logo_amadosang { padding-top:60px; padding-bottom:25px; }
            
                #header .logo_amadosang h1 { display:inline-block; vertical-align:middle; margin-right:6px;  }
                    #header .logo_amadosang h1 a { display:inline-block; text-indent:-10000px; overflow:hidden; width:131px; height:27px; background:url(./images/logo_amadosang.png) no-repeat; }
                #header .logo_amadosang h2 { display:inline-block; vertical-align:middle; font-size:24px; font-weight:bold; color:#a2a2a2; }
                #header .logo_amadosang h3 { font-size:12px; color:#888; margin-top:10px; }
                
            
        #content { min-width:300px; max-width:960px; margin:0 auto; padding-bottom:25px; }
            #content ul { position:relative; overflow:hidden; }
                #content ul li { margin-top:15px; width:100%; background:#fff; border-radius:2px; box-shadow:0px 1px 1px rgba(0,0,0,0.2); }
                #content ul li.sep { height:20px; border-radius:0; box-shadow:none; background:url(./images/bg_line_sep.png) no-repeat center; }
                 
                #content ul li .profile { position:relative; left:15px; top:15px; width:72px; height:72px; border:1px solid #bbb; float:left; margin-right:14px; overflow:hidden; }
                    #content ul li .profile img { position:absolute; width:72px; }
                    
                        #content ul li .profile img.who { z-index:2;}
                        #content ul li .profile img.thumbnail { z-index:1; }
                         
                #content ul li .data { padding-left:100px; padding-top:20px; padding-bottom:20px; padding-right:20px; margin-right:15px; }
                    #content ul li .data h4 { font-size:16px; font-weight:bold; color:#000; margin-bottom:6px; }
                        #content ul li .data h4 .who { }
                        #content ul li .data h4 .sep { color:#aaa; margin-left:8px; margin-right:8px; }
                        
                        #content ul li.is_secret .data h4 .who,
                        #content ul li.is_secret .data h4 .sep  { display:none; }
                        
                        #content ul li .data h4 a { color:#000; text-decoration:none; }
                        #content ul li .data h4 a:hover { text-decoration:underline; }
                        
                    #content ul li .data p { font-size:13px; color:#555; line-height:18px; }
                  
                    #content ul li .data .permalink { position:absolute; right:22px; top:22px; color:#999; }
                    
        a.button { margin-top:20px; display:inline-block; background:url(./images/bg_button.png) repeat-x; color:#fff; font-weight:bold; font-size:12px; padding:5px; text-decoration:none; border-radius:4px; box-shadow:0px 1px 1px rgba(0,0,0,0.1); }
            .is_secret a.button:hover { background:#319ac3; }
            .is_secret a.button:active { background:#1e87b0; box-shadow:inset 0px 1px 1px rgba(0,0,0,0.5); }
            
        a.button.disabled { background:#ddd; color:#333; }
        
        .social_wrap { position:absolute; left:190px; bottom:21px; display:block; }
            .is_secret .social_wrap { display:none; }
        
    </style>
 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.js"></script>
    <script type="text/javascript" src="./links/jquery.plugins.js"></script>
    <div id="header">
        <div class="header_wrap">
            <div class="logo_amadosang">
                <h1><a href="/">아마도상 /</a></h1>
                <h2>2012</h2>
                <h3><?php echo $header_description;?></h3>
            </div>
        </div>
    </div>
    <div id="content">
        <ul>
        <?php
            if($now_award) {
        ?>

            <li id="award_select" style="border:2px solid #1e86b0; box-sizing: border-box;">
                <div class="profile"><a href="<?php echo $now_award['permalink'];?>" target="_blank"><img class="thumbnail" src="<?php echo $now_award['thumbnail'];?>" alt="" /></a></div>
                <div class="data">
                    <h4><span class="who"><a href="<?php echo $now_award['permalink'];?>" target="_blank"><?php echo $now_award['who'];?></a></span><span class="sep">-</span><a href="<?php echo $base_url;?>/<?php echo $award['id'];?>"><?php echo $now_award['name'];?></a></h4>
                    <p><?php echo $now_award['description'];?></p>
                    
                    <a href="#" class="button disabled">축하합니다. :)</a>
                    
                    <div class="social_wrap">
                        <div class="fb-like" data-href="<?php echo $base_url;?>/<?php echo $now_award['id'];?>" data-layout="button_count" data-send="false" data-width="450" data-show-faces="false"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
            <li class="sep">
                
            </li>
        <?php
            }
            
            $index = 1;
            foreach($awards as $award) {
        ?>
            <li id="award_<?php echo $index;?>" class="is_secret">
                <div class="profile"><img class="who" src="./images/who.png" alt="" /><a href="<?php echo $award['permalink'];?>" target="_blank"><img class="thumbnail" src="<?php echo $award['thumbnail'];?>" alt="" /></a></div>
                <div class="data">
                    <h4><span class="who"><a href="<?php echo $award['permalink'];?>" target="_blank"><?php echo $award['who'];?></a></span><span class="sep">-</span><a href="<?php echo $base_url;?>/<?php echo $award['id'];?>"><?php echo $award['name'];?></a></h4>
                    <p><?php echo $award['description'];?></p>
                    
                    <a href="#" class="button" onclick="viewAward(this, <?php echo $index;?>); return false;">수상자 확인</a>
                    
                    <div class="social_wrap">
                        <div class="fb-like" data-href="<?php echo $base_url;?>/<?php echo $award['id'];?>" data-layout="button_count" data-send="false" data-width="450" data-show-faces="false"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </li>
        <?php
                $index ++;
            }
        ?>
        </ul>
            
        <a class="logo" href="http://space.amado.kr" target="_blank"></a>
    </div>
    
    
    <script type="text/javascript">
        function viewAward(obj, index)
        {
            var $obj = $(obj);
            if($obj.hasClass('disabled')) return false;
            
            var $award = $("#award_" + index);
            $award.removeClass('is_secret');
            
            $award.find('.data h4 .who').show();
            $award.find('.data h4 .sep').show();
                
            $award.find('.button').addClass('disabled').text('축하합니다. :)');
            $award.find('.profile img.who').transition({ left: '-72px', easing: 'snap', duration: 500});
        }
    
        var works = Array();
        var topPos = 0;
        $("#content ul li").each(function(index, data) {
            var $data = $(data).css('position','absolute');
            works.push([topPos, $data]);
            topPos += $data.outerHeight(true);
        });
        
        topPos += 4;
        
        $("#content ul").css('height',topPos + 'px');
        $("#content ul li").css('top',topPos + 'px');
        
        $.each(works, function(index, item) {
            item[1].transition({
                        top: item[0],
                        duration: 1000,
                        delay: index * 100,
                        easing: 'snap'
                    });
        });
        
        $(window).resize(function() {
        
        var topPos = 0;
            $("#content ul li").each(function(index, data) {
                var $data = $(data);
                $data.css('top', topPos + 'px');
                topPos += $data.outerHeight(true);
            });
        });
    </script>
    
    <!-- Google Analytics -->
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-32004041-2']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
</body>
</html>