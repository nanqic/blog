<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:79:"D:\Software\Wamp\www\blog\public/../application/index\view\article\article.html";i:1561540653;s:67:"D:\Software\Wamp\www\blog\application\index\view\common\header.html";i:1561604052;s:70:"D:\Software\Wamp\www\blog\application\index\view\common\right_bar.html";i:1561552852;s:67:"D:\Software\Wamp\www\blog\application\index\view\common\footer.html";i:1561553787;}*/ ?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>文章详情 | <?php echo $article['title']; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
    <link href="/static/index/style/lady.css" type="text/css" rel="stylesheet" />
    <script type='text/javascript' src='/static/index/style/ismobile.js'></script>
</head>

<body>
    <!-- 引入顶部 -->
    <div class="ladytop" style="height: 75px">
    <div class="nav">
                <div style="display: inline-block;position: relative; "><img src="/static/index/images/bitbull.png"  style="position: relative;bottom:10px;" alt=""></div>
                <div class="right">
            <div class="box">
                <a href="<?php echo url('/index'); ?>">首页</a>
                <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo url('cate/index',array('cateid'=>$vo['id'])); ?>"><?php echo $vo['catename']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="hotmenu">
    <div class="con">热门标签：
        <?php if(is_array($click) || $click instanceof \think\Collection || $click instanceof \think\Paginator): $i = 0; $__LIST__ = $click;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <a href="<?php echo url('/index/search/index', ['keywords'=>$vo['keywords']]); ?>"><?php echo $vo['keywords']; ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
    <!--顶部通栏-->
    <div class="position"><a href='<?php echo url('/index'); ?>'>主页 </a>> <a href='#'><?php echo $catename['catename']; ?></a> > </div>

    <div class="overall">
        <div class="left">
            <div class="scrap">
                <h1><?php echo $article['title']; ?></h1>
                <div class="spread">
                    <span class="writor">发布时间：<?php echo $article['time']; ?></span>
                    <span class="writor">编辑：<?php echo $article['author']; ?></span>
                    <span class="writor">标签：<a href='#'><?php echo $article['keywords']; ?></a></span>
                    <span class="writor">热度：<?php echo $article['click']; ?></span>
                </div>
            </div>
            <?php if($article['pic'] != ''): ?>
            <div style="height:200px;width: 500px; ">
                <img src="http://127.0.0.1/blog/public/<?php echo $article['pic']; ?>" width="220" alt="">
            </div>
            <?php else: ?>
            <img src="/static/index/images/error.png" width="220" alt="">
            <?php endif; ?>
            <div class="substance">
                <p><?php echo $article['content']; ?></p>
            </div>
        </div>

        <div class="right">
            <!-- 引入右边栏 -->
            <div class="right">
    <!--右侧-->
    <div id="hm_t_57953">
        <div style="height:15px"></div>
        <div id="bdcs">
            <div class="bdcs-container">
                <meta content="IE=9" http-equiv="x-ua-compatible"> <!-- 嵌入式 -->
                <div id="default-searchbox" class="bdcs-main bdcs-clearfix">
                    <div id="bdcs-search-inline" class="bdcs-search bdcs-clearfix">
                        <form id="bdcs-search-form" autocomplete="off" class="bdcs-search-form" target="_blank"
                            method="get" action="<?php echo url('/index/search'); ?>"> 
                                <input
                                type="text" placeholder="请输入关键词" id="bdcs-search-form-input"
                                class="bdcs-search-form-input" name="keywords" autocomplete="off"
                                style="line-height: 30px; width:220px;"> 
                               <button class="btn" type="submit">搜索</button> 
                            </form>
                    </div>
                    <div id="bdcs-search-sug" class="bdcs-search-sug" style="top: 552px; width: 239px;">
                        <ul id="bdcs-search-sug-list" class="bdcs-search-sug-list"></ul>
                    </div>
                </div>
            </div>
        </div>
        <div style="height:15px"></div>

        <div
            style="display: block; margin: 0px; padding: 0px; float: none; clear: none; overflow: hidden; position: relative; border: 0px none; background: transparent none repeat scroll 0% 0%; max-width: none; max-height: none; border-radius: 0px; box-shadow: none; transition: none 0s ease 0s ; text-align: left; box-sizing: content-box; width: 300px;">
            <div class="hm-t-container" style="width: 298px;">
                <div class="hm-t-main">
                    <div class="hm-t-header">热门点击</div>
                    <div class="hm-t-body">
                        <ul class="hm-t-list hm-t-list-img">
                            <?php if(is_array($click) || $click instanceof \think\Collection || $click instanceof \think\Paginator): $i = 0; $__LIST__ = $click;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <li class="hm-t-item hm-t-item-img"><a data-pos="0" target="_blank"
                                    href="<?php echo url('article/index',['id'=>$vo['id']]); ?>" class="hm-t-img-title"
                                    style="visibility: visible;"><span><?php echo $vo['title']; ?></span></a>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height:15px"></div>
    <div id="hm_t_57953">
        <div
            style="display: block; margin: 0px; padding: 0px; float: none; clear: none; overflow: hidden; position: relative; border: 0px none; background: transparent none repeat scroll 0% 0%; max-width: none; max-height: none; border-radius: 0px; box-shadow: none; transition: none 0s ease 0s ; text-align: left; box-sizing: content-box; width: 300px;">
            <div style="width: 298px;" class="hm-t-container">
                <div class="hm-t-main">
                    <div class="hm-t-header">推荐阅读</div>
                    <div class="hm-t-body">
                        <ul class="hm-t-list hm-t-list-img">
                            <?php if(is_array($recom) || $recom instanceof \think\Collection || $recom instanceof \think\Paginator): $i = 0; $__LIST__ = $recom;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$recom): $mod = ($i % 2 );++$i;?>
                            <li class="hm-t-item hm-t-item-img"><a style="visibility: visible;" class="hm-t-img-title"
                                    href="<?php echo url('article/index',array('id'=>$recom['id'])); ?>" target="_blank""
                                    data-pos=" 0"><span><?php echo $recom['title']; ?></span></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height:15px"></div>
    <div id="hm_t_57953">
        <div
            style="display: block; margin: 0px; padding: 0px; float: none; clear: none; overflow: hidden; position: relative; border: 0px none; background: transparent none repeat scroll 0% 0%; max-width: none; max-height: none; border-radius: 0px; box-shadow: none; transition: none 0s ease 0s ; text-align: left; box-sizing: content-box; width: 300px;">
            <div style="width: 298px;" class="hm-t-container">
                <div class="hm-t-main">
                    <div class="hm-t-header">友情链接</div>
                    <div class="hm-t-body">
                        <ul class="hm-t-list hm-t-list-img">
                            <?php if(is_array($links) || $links instanceof \think\Collection || $links instanceof \think\Paginator): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$links): $mod = ($i % 2 );++$i;?>
                            <li class="hm-t-item hm-t-item-img"><a style="visibility: visible;" class="hm-t-img-title"
                                    href="<?php echo $links['url']; ?>" target="_blank""
                                        data-pos=" 0"><span><?php echo $links['title']; ?></span></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
        <!-- 引入底部 -->
        <div class="footerd">
    <ul>
        <li>Bitbull Copyright &#169; 2019 Powered by ThinkPHP all rights reserved. </li>
    </ul>
</div>
</body>

</html>