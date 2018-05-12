@extends('layout.master')
@section('rightcontent')

	<div class="container">	
		<div class ="row">
			<div class="col-md-3">
				
			</div>
			<div class="col-md-6">
				<div class="card text-center">
					  <div class="card-header">
					      <span style="font-family: 'Gamja Flower', cursive;font-size: 25px;font-weight: 500">Messages</span>
					  </div>
					  <div class="card-body">
					  	@if($messages !=null)
	                        @foreach($messages as $message)
							    <div class="response-customer" style="border-bottom: 1px solid #dcc0c0;text-align: left!important;">
										 <div>
											<span style="background-color: #3275ca;color: #ffffff">From Admin:</span>
										    <span class="name_comment" style="font-weight: 700">
										     Admin
										    </span>
										 </div>

										 <div>
											<span style="background-color: #3275ca;color: #ffffff">to Employee:</span>
										    <span class="name_comment" style="font-weight: 700">
										     	{!! session('data')['name']; !!}
										    </span>
										 </div>

										 <div class="content_commnet" style="margin-left: 24px;">
									        {!! $message->reason !!}
									     </div>
									     <div class="time_comment" style="font-style: italic;font-size: 12px;float: right;">
									     	{!!  $message->create_at !!}
									     </div>
									     <br>
								    </div>
								    <br>
							@endforeach
					    @endif
					   </div>
					    <div class="card-footer text-muted" style="font-family: 'Gamja Flower', cursive;font-size: 25px;font-weight: 500">
					    You should check advance again and follow new message.
					    </div>
				</div>	
			</div>

			<div class="col-md-3">
				
			</div>
		</div>
	</div>
@endsection