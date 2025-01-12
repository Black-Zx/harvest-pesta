@extends('member.layouts.app')

@section('page-title', 'Dashboard')
<style>
#preview {
	position: fixed;
	top: 50%;
	/*bottom: 0;*/
	left: 50%;
	/*right: 0;*/
	z-index: 99;
	height: 100%;

	-webkit-transform: translate(-50%, -50%);
	-moz-transform: translate(-50%, -50%);
	-ms-transform: translate(-50%, -50%);
	-o-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
}
.qr-logo {
	position: fixed;
	top: 3vh;
	left: 40;
	right: 40;
	text-align: center;
	z-index: 101;
	height: 20vh;
}
.qr-logo img {
	object-fit: contain;
    max-height: 100%;
    max-width: 100%;
}
.qr-overlay {
	background: url(img/scan-qr.png) no-repeat center top / cover;
	position: fixed;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 100;
	/* height: 30vh; */
}
.qr-scan {
	position: fixed;
	top: 30vh;
	left: 10%;
	right: 10%;
	text-align: center;
	z-index: 101;
	bottom: 30vh;
}
.qr-btn {
	position: fixed;
	bottom: 100px;
	left: 10%;
	right: 10%;
	text-align: center;
	z-index: 101;
}
.qr-scan img {
	object-fit: contain;
	max-height: 100%;
	max-width: 100%;
}
.force-full-width {
	width: 100% !important;
	height: auto !important;
}
.btn-block {
	display: block;
	width: 100%;
	padding-left: 0;
	padding-right: 0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.btn-block + .btn-block {
	margin-top: 5px;
}
input[type="submit"].btn-block,
input[type="reset"].btn-block,
input[type="button"].btn-block {
	width: 100%;
}

.btn-primary, .btn-primary:hover, .btn-primary:focus .swal2-confirm {
    border-color: #66a349 !important;
    background-color: #309545 !important;
    color: #fff !important;
    border-radius: 1.25rem;
}
</style>
@section('content')
<div class="qr-overlay"></div>
<div class="qr-btn">
<h1 style="background-color:#041E41;color:#fff;">Scanner</h1>
	<a href="{{route('member.dashboard')}}">
		<button id="check_in" type="button" class="btn btn-primary">Back</button>
	</a>	

</div>
<video id="preview" muted></video>

@endsection

@push('scripts')
    <script>
    var scanQr = "{{ route('member.checkIn') }}";
	var iOS = (/iPad|iPhone|iPod/.test(navigator.platform) || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1)) && !window.MSStream;
	// const btnCheckIn = document.getElementById('check_in');
	// const btnCheckOut = document.getElementById('check_out');
	// var checkInStatus = "check_in";

	// btnCheckIn.addEventListener('click', function onClick() {
	// 	var btn = jQuery( "#check_in" );
	// 	btn.addClass( "btn-pink" );
	// 	btn.removeClass( "btn-white" );
	// 	jQuery( "#check_out" ).removeClass( "btn-pink" );
	// 	jQuery( "#check_out" ).addClass( "btn-white" );
	// 	checkInStatus = "check_in";
	// });

	// btnCheckOut.addEventListener('click', function onClick() {
	// 	var btn = jQuery( "#check_out" );
	// 	btn.addClass( "btn-pink" );
	// 	btn.removeClass( "btn-white" );
	// 	jQuery( "#check_in" ).removeClass( "btn-pink" );
		// jQuery( "#check_in" ).addClass( "btn-white" );
	// 	checkInStatus = "check_out";
	// });

	let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false, scanPeriod: 1,refractoryPeriod: 5000});
	scanner.addListener('scan', function (unique_code) {

		jQuery.ajax({
			url: scanQr,
			type: 'post',
			data: {
				'unique_code': unique_code,
			},
			headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
			success: function(result) {
				console.log(result.data);
				Swal.fire({
						title: 'Hi, '+result.data.name.toUpperCase()+'.',
						showClass: {
							popup: 'animate__animated animate__fadeInDown'
						},
						hideClass: {
							popup: 'animate__animated animate__fadeOutUp'
						}
					});	
			},
			error: function(err) {
				console.log(err);

				Swal.fire({
					title: err.responseJSON.message+ err.responseJSON.data+'.',
					// title: 'Oops, you have already checked in.',
					// title: 'Opss, Please try again.',
					showClass: {
						popup: 'animate__animated animate__fadeInDown'
					},
					hideClass: {
						popup: 'animate__animated animate__fadeOutUp'
					}
				});
			}
		});

	});

	scanner.addListener('active', function(){
		window.setTimeout(function(e){
			// resize video element if necessary
			var thisVideo = document.getElementById('preview');
			var thisWidth = thisVideo.getBoundingClientRect().width;
            var thisHeight = thisVideo.getBoundingClientRect().height;
            /*
			if(iOS){
	            var thisWidth = thisVideo.getBoundingClientRect().height;
	            var thisHeight = thisVideo.getBoundingClientRect().width;
	        }else{
	            thisWidth = thisVideo.getBoundingClientRect().width;
	            thisHeight = thisVideo.getBoundingClientRect().height;
	        };
	        */
	        // window.alert('isIOS: ' + iOS);
	        // window.alert('camera width height: '+thisWidth+', '+thisHeight);
			// window.alert('window width height: '+window.innerWidth+', '+window.innerHeight);
			if(thisWidth < window.innerWidth || thisHeight < window.innerHeight){
				thisVideo.classList.add('force-full-width');
			} else {
				thisVideo.classList.remove('force-full-width');
			};
		}, 500);
	});

	Instascan.Camera.getCameras().then(function (cameras) {
		// window.alert(cameras.length);
		var thisCameraIndex = 0;
		for(var i=0; i<cameras.length; i++){
			// window.alert(cameras[i].name);
			if(cameras[i].name.toLowerCase().indexOf("back") >= 0){
				// back camera found
				thisCameraIndex = i;
				break;
			};
		};
		// window.alert('selected index: ' + thisCameraIndex + ', camera: ' + cameras[thisCameraIndex].name);

		if (cameras.length > 0) {
			scanner.start(cameras[thisCameraIndex]);
		} else {
			console.error('No cameras found.');
		}
	}).catch(function (e) {
		console.error(e);
	});
    </script>
@endpush
