<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>观世界后台管理系统</title>
    <meta name="keywords" content="全国首家专做目的地的在线旅游平台">
    <meta name="description" content="全国首家专做目的地的在线旅游平台！">
    <link rel="stylesheet" href="css/will.css" />
    <link rel="stylesheet" href="css/login.css" />
    <script src="js/angular.min.js"></script>
    <script src="js/angular-cookies.min.js"></script>
</head>
<body ng-app="myApp">
	<div id="header">
		<img src="img/logo.png" alt="" title="">
		<h1>观世界后台管理系统</h1>
	</div>
	<div class="content" ng-controller="myCtrl">
		<form name="myForm" class="ng-pristine ng-valid">
			<div class="login-box">
				<i class="iconfont will-huiyuan"></i>
				<input type="text" class="login-text" ng-model="name" placeholder="请输入登录账号" />
			</div>
			<div class="login-box">
				<i class="iconfont will-xiugaimima"></i>
				<input type="password" ng-model="pwd" class="login-text" placeholder="请输入密码" />
			</div>
			<input type="submit" class="login-submit" value="登录" ng-click="login()" />
		</form>
		<a class="forget-pwd" href="forgotPassword.php">忘记密码？</a>
	</div>
	<div id="browser_ie">
		<div class="brower_info">
			<div class="notice_info">
				<p>你的浏览器版本过低，可能导致网站不能正常访问！<BR>为了你能正常使用网站功能，请使用这些浏览器。</p>
			</div>
			<div class="browser_list">
				<span>
					<a  href="http://www.google.cn/intl/zh-CN/chrome/browser/" target="_blank">
						<img src="img/Chrome.png" />Chrome
					</a>
				</span>
				<span>
					<a href="http://www.firefox.com.cn/" target="_blank">
						<img src="img/Firefox.png" />Firefox
					</a>
				</span>
				<span>
					<a href="https://www.apple.com/cn/safari/" target="_blank">
						<img src="img/Safari.png" />Safari
					</a>
				</span>
				<span>
					<a href="http://rj.baidu.com/soft/detail/23360.html?ald" target="_blank">
						<img src="img/IE.png" />IE10及以上
					</a>
				</span>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/jquery.min.js" ></script>
	<script type="text/javascript" src="js/layer/layer.min.js" ></script>
	<script type="text/javascript">
	    angular.module('myApp', ['ngCookies']).controller('myCtrl', function ($scope, $http, $cookies) {
	        var name_ck = $cookies.get("name_ck");
	        var pwd = '';
	        if (name_ck != '') {
	            $scope.name = name_ck;
	        }
	        if (pwd != '') {
	            $scope.pwd = pwd;
	            $cookies.put("name_ck", $scope.name, {expires: new Date(new Date().getTime() + 609638400)});
	            var user = {
	                type: "login",
	                name: $scope.name,
	                pwd: $scope.pwd
	            }
	            $http.post("login/loginAction.php", user).then(function (result) {  //正确请求成功时处理
	                if (result.data.code>0) {
	                    var host = "http://"+window.location.host;
	                    location.href=host + '/admin/index.php';
	                } else {
	                    layer.msg(result.data.message, {time: 2000});
	                }
	            }).catch(function () { //捕捉错误处理
	                layer.msg('服务端请求错误！', {time: 2000});
	            });
	        }
	        $scope.login = function () {
	            $cookies.put("name_ck", $scope.name, {expires: new Date(new Date().getTime() + 609638400)});
	            var user = {
	                type: "login",
	                name: $scope.name,
	                pwd: $scope.pwd
	            }
	            $http.post("login/loginAction.php", user).then(function (result) {  //正确请求成功时处理
	            	if (result.data.code>0) {
	                    var host = "http://"+window.location.host;
	                    location.href=host + '/admin/index.php';
	                } else {
	                    layer.msg(result.data.message, {time: 2000});
	                }
	            }).catch(function () { //捕捉错误处理
	                layer.msg('服务端请求错误！', {time: 2000});
	            });
	        }
	    });
	</script>
	<script>
		if(navigator.appName == "Microsoft Internet Explorer"&&parseInt(navigator.appVersion.split(";")[1].replace(/[ ]/g, "").replace("MSIE",""))<10){
	        $("#browser_ie").show();
	        $("#header").hide();
	        $("#content").hide();
	    }
	</script>
</body>
</html>