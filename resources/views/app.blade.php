<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>2016花旗杯</title>
		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		
		<!-- Fonts -->
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="/home">CitiCup</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="/home">消息中心({{ $data['count'] }})</a>
						</li>
						<li>
							<a href="/home">{{ $data['name'] }} 团队，您好！</a>
						</li>
						<li>
							<a href="{{ url('/auth/logout') }}">登出</a>
							
						</li>
						
					</ul>
				</div>
			</div>
		</nav>
		@yield('content')
		<!-- Scripts -->
		<script src="/js/jquery.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>

	</body>
</html>