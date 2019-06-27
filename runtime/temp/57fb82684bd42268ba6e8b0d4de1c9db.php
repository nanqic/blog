<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"D:\Software\Wamp\www\blog\public/../application/admin\view\article\edit.html";i:1561551123;s:67:"D:\Software\Wamp\www\blog\application\admin\view\common\header.html";i:1561555873;s:68:"D:\Software\Wamp\www\blog\application\admin\view\common\sidebar.html";i:1561357599;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>后台 | 文章管理</title>

    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="/static/admin/style/bootstrap.css" rel="stylesheet">
    <link href="/static/admin/style/font-awesome.css" rel="stylesheet">
    <link href="/static/admin/style/weather-icons.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="/static/admin/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="/static/admin/style/demo.css" rel="stylesheet">
    <link href="/static/admin/style/typicons.css" rel="stylesheet">
    <link href="/static/admin/style/animate.css" rel="stylesheet">


</head>

<body>
    <!-- 头部 -->
    <div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                        <img src="/static/admin/images/logo.png" alt="">
                    </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <!-- /Sidebar Collapse -->
            <!-- Account Area and Settings -->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile" style="border-left:0;">
                                    <img src="/static/admin/images/null.png">
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo \think\Request::instance()->session('username'); ?></span></span></h2>
                                </section>
                            </a>
                            <!--Login Area Dropdown-->
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="username"><a>David Stevenson</a></li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/logout'); ?>">
                                        退出登录
                                    </a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="<?php echo url('admin/edit',array('id'=>\think\Request::instance()->session('uid'))); ?>">
                                        修改密码
                                    </a>
                                </li>
                            </ul>
                            <!--/Login Area Dropdown-->
                        </li>
                        <!-- /Account Area -->
                    </ul>
                </div>
            </div>
            <!-- /Account Area and Settings -->
        </div>
    </div>
</div>
    <!-- /头部 -->

    <div class="main-container container-fluid">
        <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar" id="sidebar">
    <!-- Page Sidebar Header-->
    <div class="sidebar-header-wrapper">
        <input class="searchinput" type="text">
        <i class="searchicon fa fa-search"></i>
        <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
    </div>
    <!-- /Page Sidebar Header -->
    <!-- Sidebar Menu -->
    <ul class="nav sidebar-menu">
        <!--Dashboard-->
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">管理员</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('admin/lst'); ?>">
                        <span class="menu-text">
                            管理列表 </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text">栏目管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('cate/lst'); ?>">
                        <span class="menu-text">
                            栏目列表 </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-file-text"></i>
                <span class="menu-text">文章管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('article/lst'); ?>">
                        <span class="menu-text">
                            文章列表 </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-link"></i>
                <span class="menu-text">友情链接</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('links/lst'); ?>">
                        <span class="menu-text">
                            链接列表 </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-gear"></i>
                <span class="menu-text">系统</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="#">
                        <span class="menu-text">
                            配置 </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- /Sidebar Menu -->
</div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">系统</a>
                        </li>
                        <li>
                            <a href="<?php echo url('article/lst'); ?>">文章管理</a>
                        </li>
                        <li class="active">修改文章</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Body -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="widget">
                                <div class="widget-header bordered-bottom bordered-blue">
                                    <span class="widget-caption">修改文章</span>
                                </div>
                                <div class="widget-body">
                                    <div id="horizontal-form">
                                        <form class="form-horizontal" role="form" action="" method="post"
                                            enctype="multipart/form-data">
                                            <input type="hidden" value="<?php echo $article['id']; ?>">
                                            <div class="form-group">
                                                <label for="username"
                                                    class="col-sm-2 control-label no-padding-right">文章标题</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="title" placeholder="" name="title"
                                                        type="text" value="<?php echo $article['title']; ?>">
                                                </div>
                                                <p class="help-block col-sm-4 red">* 必填</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id"
                                                    class="col-sm-2 control-label no-padding-right">文章作者</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="author" placeholder="" name="author"
                                                        type="text" value="<?php echo $article['author']; ?>">
                                                </div>
                                                <p class="help-block col-sm-4 red">* 必填</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id"
                                                    class="col-sm-2 control-label no-padding-right">文章描述</label>
                                                <div class="col-sm-6">
                                                    <textarea name="dsc" class="form-control"><?php echo $article['dsc']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id"
                                                    class="col-sm-2 control-label no-padding-right">关键字</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="keywords" placeholder=""
                                                        value="<?php echo $article['keywords']; ?>" name="keywords" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id"
                                                    class="col-sm-2 control-label no-padding-right">缩略图</label>
                                                <div class="col-sm-6">
                                                    <?php if($article['pic'] != ''): ?>
                                                    <img src="http://127.0.0.1/blog/public/<?php echo $article['pic']; ?>" alt="" width="150px"
                                                        height="100px">
                                                    <?php else: ?>暂无缩略图
                                                    <?php endif; ?>
                                                    <input type="file" name="pic">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id"
                                                    class="col-sm-2 control-label no-padding-right">所属栏目</label>
                                                <div class="col-sm-6">
                                                    <select name="cate" id="" value="">
                                                        <?php if(is_array($cates) || $cates instanceof \think\Collection || $cates instanceof \think\Paginator): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                        <option <?php if($vo['id'] == $article['cate']): ?>
                                                            selected="selected" <?php endif; ?> value="<?php echo $vo['id']; ?>"><?php echo $vo['catename']; ?>
                                                        </option>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id"
                                                    class="col-sm-2 control-label no-padding-right">是否推荐</label>
                                                <div class="col-sm-6">
                                                    <label>
                                                        <input class="checkbox-slider" type="checkbox" <?php if($article['state'] == 1): ?> checked="" <?php endif; ?>
                                                            name="state">
                                                        <span class="text"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="group_id"
                                                    class="col-sm-2 control-label no-padding-right">文章内容</label>
                                                <div class="col-sm-6">
                                                    <textarea id="editor" name="content" placeholder="写点什么.." autofocus><?php echo $article['content']; ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-default">保存信息</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
        </div>
    </div>

    <!--Basic Scripts-->
    <script src="/static/admin/style/jquery_002.js"></script>
    <script src="/static/admin/style/bootstrap.js"></script>
    <script src="/static/admin/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="/static/admin/style/beyond.js"></script>
    <!-- 引入编辑器依赖 -->
    <link rel="stylesheet" type="text/css" href="/static/admin/editor/site/assets/styles/simditor.css" />
    <script type="text/javascript" src="/static/admin/editor/site/assets/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="/static/admin/editor/site/assets/scripts/module.js"></script>
    <script type="text/javascript" src="/static/admin/editor/site/assets/scripts/hotkeys.js"></script>
    <script type="text/javascript" src="/static/admin/editor/site/assets/scripts/uploader.js"></script>
    <script type="text/javascript" src="/static/admin/editor/site/assets/scripts/simditor.js"></script>
    <!-- 实例化编辑器 -->
    <script>var editor = new Simditor({
            textarea: $('#editor')
        });
    </script>

</body>

</html>