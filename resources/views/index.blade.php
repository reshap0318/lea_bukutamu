<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1">

	<title>LEA | Buku Tamu</title>
	<link rel="icon" href="{{asset('img/lea-logo.png')}}" type="image/png">
	<link rel="shortcut icon" href="{{asset('img/lea-logo.png')}}" type="img/x-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600' rel='stylesheet' type='text/css'>

	<link href="{{asset('knight/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('knight/css/style.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('knight/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('knight/css/responsive.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('knight/css/magnific-popup.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('knight/css/animate.css')}}" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="{{asset('knight/js/jquery.1.8.3.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('knight/js/bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{asset('knight/js/jquery-scrolltofixed.js')}}"></script>
	<script type="text/javascript" src="{{asset('knight/js/jquery.easing.1.3.js')}}"></script>
	<script type="text/javascript" src="{{asset('knight/js/jquery.isotope.js')}}"></script>
	<script type="text/javascript" src="{{asset('knight/js/wow.js')}}"></script>
	<script type="text/javascript" src="{{asset('knight/js/classie.js')}}"></script>
	<script type="text/javascript" src="{{asset('knight/js/magnific-popup.js')}}"></script>
	<script src="{{asset('knight/contactform/contactform.js')}}"></script>
	<!-- datatable -->
	<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{asset('js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('js/buttons.colVis.min.js')}}"></script>
	<!-- <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"> -->
	<link href="{{asset('css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css">
	<script type="text/javascript">
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
    </script>

	<!-- =======================================================
    Theme Name: Knight
    Theme URL: https://bootstrapmade.com/knight-free-bootstrap-theme/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
	======================================================= -->

</head>

<body>
	<header class="header" id="header">
		<!--header-start-->
		<div class="container">
			<figure class="logo animated fadeInDown delay-07s">
				<a href="http://lea.si.fti.unand.ac.id/"><img src="{{asset('img/lea-logo.png')}}" alt=""></a>
			</figure>
			<h1 class="animated fadeInDown delay-07s">Selamat Datang Di Laboratorium Enterprise Application - Unand</h1>
			<ul class="we-create animated fadeInUp delay-1s">
				<li>Patuhi Aturannya dan Dapatkan Ketenganan Di-lEA</li>
			</ul>
			<a class="link animated fadeInUp delay-1s servicelink" href="#buku_tamu">Isi Buku Tamu</a>
		</div>
	</header>
	<!--header-end-->

	<nav class="main-nav-outer" id="test">
		<!--main-nav-start-->
		<div class="container">
			<ul class="main-nav">
				<li><a href="#buku_tamu">Buku Tamu</a></li>
				<li class="small-logo"><a href="#header"><img src="{{asset('img/lea-logo.png')}}" alt="" style="height:40px"></a></li>
				<li><a href="#grafik">Grafik</a></li>
			</ul>
			<a class="res-nav_click" href="#"><i class="fa fa-bars"></i></a>
		</div>
	</nav>
	<!--main-nav-end-->



	<section class="main-section" id="buku_tamu">
		<!--main-section-start-->
		<div class="container">
			<h2>Buku Tamu</h2>
			<h6>Isikan Dengan Benar NIM dan Tujuan Anda</h6>
			<div class="row">
	      <div class="col-lg-12 col-sm-12 wow fadeInUp delay-05s">
	        <div class="form">
	          <div id="sendmessage">Your message has been sent. Thank you!</div>
	          <div id="errormessage"></div>
						{{ Form::open(array('url' => 'isi_buku','role'=>'form')) }}
	            <div class="row">
								<div class="form-group col-lg-5 col-sm-5">
		              <input type="text" name="nim" class="form-control input-text" id="nim" placeholder="Masukan Nomor Induk Mahasiswa" data-rule="minlen:10" data-msg="Masukan NIM Dengan Benar" />
		              <div class="validation"></div>
		            </div>
		            <div class="form-group col-lg-5 col-sm-5">
									<select onchange="gantiyak()" class="form-control input-text select" name="keperluan" id="keperluan" data-rule="required" data-msg="Masukan Tujuan Dengan Benar">
										@foreach($tujuans as $tujuan)
											<option value="{{$tujuan}}">{{$tujuan}}</option>
										@endforeach
											<option value="lainnya">Lainnya</option>
									</select>
									<input type="text" name="lainnya" class="form-control input-text" id="lainnya" placeholder="Lainnya" data-rule="minlen:10" data-msg="Masukan NIM Dengan Benar" />
		              <div class="validation"></div>
		            </div>
								<div class="col-lg-2 col-sm-2">
		            	<div class="text-center"><button type="submit" class="input-btn">Simpan</button></div>
								</div>
	            </div>
	          {{ Form::close() }}
						<br><br><br>
						<table id="example" class="table table-striped table-bordered" style="width:100%">
			        <thead>
			            <tr>
			                <th class="text-center" style="width:30px">No</th>
			                <th class="text-center">Nama</th>
			                <th class="text-center">Tujuan</th>
			            </tr>
			        </thead>
			        <tbody>
								<tr>
									<td class="text-center"></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
										<th colspan="2" class="text-center">Total Pengunjung</th>
										<th class="text-center" id="totalakhir">0 Orang</th>
		            </tr>
							</tfoot>
						</table>
	        </div>
	      </div>
	    </div>
		</div>
	</section>
	<!--main-section-end-->



	<section class="main-section alabaster" id="grafik">
		<!--main-section alabaster-start-->
		<div class="container">
			<h2>Grafik Pengunjung LEA</h2>
			<div class="row">
				<div class="col-lg-12 col-sm-12 featured-work">
					<div id="app">
            {!! $chart_pengunjung->container() !!}
	        </div>
	        <script src="https://unpkg.com/vue"></script>
	        <script>
	            var app = new Vue({
	                el: '#app',
	            });
	        </script>
					@php
						$chart_pengunjung->api_url = '';
					@endphp
	        <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
	        {!! $chart_pengunjung->script() !!}
				</div>
			</div>
<br><br>
			<div class="row">
				<div class="col-lg-6 col-sm-6 featured-work">
					<div id="app2">
            {!! $chart_tujuan->container() !!}
	        </div>
	        <script src="https://unpkg.com/vue"></script>
	        <script>
	            var app = new Vue({
	                el: '#app2',
	            });
	        </script>
					@php
						$chart_tujuan->api_url = '';
					@endphp
	        <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
	        {!! $chart_tujuan->script() !!}
				</div>
				<div class="col-lg-6 col-sm-6 featured-work">
					<div id="app3">
            {!! $chart_pengunjung_terbiasa->container() !!}
	        </div>
	        <script src="https://unpkg.com/vue"></script>
	        <script>
	            var app = new Vue({
	                el: '#app3',
	            });
	        </script>
					@php
						$chart_pengunjung_terbiasa->api_url = '';
					@endphp
	        <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
	        {!! $chart_pengunjung_terbiasa->script() !!}
				</div>
			</div>
		</div>
	</section>
	<!--main-section alabaster-end-->

	<footer class="footer">
		<div class="container">
			<div class="footer-logo"><a href="#"><img src="{{asset('img/lea-logo.png')}}" alt="" style="height:80px"></a></div>
			<span class="copyright">&copy; Reinaldo Shandev Pratama - 1611522012</span>
			<div class="credits">
				<!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Knight
        -->
				Instagram <a href="https://www.instagram.com/naldo_reshap/">Naldo Reshap</a>
			</div>
		</div>
	</footer>

	@include('toast::messages-jquery')

	<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

	<script type="text/javascript">

	@if (count($errors) > 0)
		@foreach ($errors->all() as $error)
			toastr.options.progressBar = true;
			toastr.error("{{ $error }}", 'Eror', {timeOut: 5000});
		@endforeach
	@endif


	var lainnya = $("#lainnya" );
	var keperluan = $( "#keperluan" );
	lainnya.hide();
	lainnya.prop('disabled', true);
	function gantiyak() {
		if(keperluan.val()=="lainnya"){
			lainnya.show();
			lainnya.prop('disabled', false);
		}else{
			lainnya.hide();
			lainnya.prop('disabled', true);
		}
	}

	var total = document.getElementById('totalakhir');

		$(document).ready(function() {
			var t = $('#example').DataTable({
				"ajax": "{{url('pengunjung-data')}}",
	      "columns": [
						{ "data": "nama"},
	          { "data": "nama"},
	          { "data": "keperluan"},
	      ],
				"order": [[ 1, 'asc' ]],
	      "ordering": false,
	      "info":     false,
				dom: 'Bfrtip',
				buttons: [
						{
								text: '1 Hari',
								action: function ( e, dt, node, config ) {
	                t.ajax.url("{{url('pengunjung-data')}}?data=1").load();
	              }
						},
						{
								text: '30 Hari',
								action: function ( e, dt, node, config ) {
	                t.ajax.url("{{url('pengunjung-data')}}?data=30").load();
	              }
						},
						{
								text: '365 Hari',
								action: function ( e, dt, node, config ) {
	                t.ajax.url("{{url('pengunjung-data')}}?data=365").load();
	              }
						}
				],

				"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + 1;
                }, 0 );

            // Update footer
            $( api.column( 2 ).footer() ).html(
                total +' Orang'
            );
        }

			});

			t.on( 'order.dt search.dt', function () {
	        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	            cell.innerHTML = i+1;
	        } );
	    } ).draw();

		});

	</script>

	<script type="text/javascript">
		$(document).ready(function(e) {

			$('#test').scrollToFixed();
			$('.res-nav_click').click(function() {
				$('.main-nav').slideToggle();
				return false
			});

      $('.Portfolio-box').magnificPopup({
        delegate: 'a',
        type: 'image'
      });

		});
	</script>

	<script>
		wow = new WOW({
			animateClass: 'animated',
			offset: 100
		});
		wow.init();
	</script>


	<script type="text/javascript">
		$(window).load(function() {

			$('.main-nav li a, .servicelink').bind('click', function(event) {
				var $anchor = $(this);

				$('html, body').stop().animate({
					scrollTop: $($anchor.attr('href')).offset().top - 102
				}, 1500, 'easeInOutExpo');
				/*
				if you don't want to use the easing effects:
				$('html, body').stop().animate({
					scrollTop: $($anchor.attr('href')).offset().top
				}, 1000);
				*/
				if ($(window).width() < 768) {
					$('.main-nav').hide();
				}
				event.preventDefault();
			});
		})
	</script>

	<script type="text/javascript">
		$(window).load(function() {


			var $container = $('.portfolioContainer'),
				$body = $('body'),
				colW = 375,
				columns = null;


			$container.isotope({
				// disable window resizing
				resizable: true,
				masonry: {
					columnWidth: colW
				}
			});

			$(window).smartresize(function() {
				// check if columns has changed
				var currentColumns = Math.floor(($body.width() - 30) / colW);
				if (currentColumns !== columns) {
					// set new column count
					columns = currentColumns;
					// apply width to container manually, then trigger relayout
					$container.width(columns * colW)
						.isotope('reLayout');
				}

			}).smartresize(); // trigger resize to set container width
			$('.portfolioFilter a').click(function() {
				$('.portfolioFilter .current').removeClass('current');
				$(this).addClass('current');

				var selector = $(this).attr('data-filter');
				$container.isotope({

					filter: selector,
				});
				return false;
			});

		});
	</script>

</body>

</html>
