@extends('layout')
@section('title')
Finance
@endsection
@section('content')
		<main id="main" role="main">
			<section class="block-storage">
				<div class="container">
					<div class="row">
						<div class="col-3 left-col">
							<h1>Do You Need Storage?</h1>
							<p>Vivamus elementum semper <br> nisi. Aenean vulputate <br>eleifend tellus. </p>
						</div>
						<div class="col-9 right-col">
							<div class="image-holder"><img src="images/img26.jpg" alt="image description"></div>
							<div class="caption-holder">
								<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="block-tabs">
				<ul class="tabset">
					<li>
						<a href="#tab1" class="active">
							<span class="option">Option 1</span>
							<span class="description">With Approved Financing Plan</span>
						</a>
					</li>
					<li>
						<a href="#tab2">
							<span class="option">Option 2</span>
							<span class="description">Rent-to-Own</span>
						</a>
					</li>
					<li>
						<a href="#tab3">
							<span class="option">Option 3</span>
							<span class="description">Lay Away</span>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="tab1" class="tab-area active">
						<div class="container">
							<h2>capitol sheds has partnered with</h2>
							<div class="logo-area">
								<a href="#"><img src="images/img28.png" alt="image description"></a>
							</div>
							<div class="plan-area">
								<h3><span class="text">Plan 1:   12 Month, No Interest</span></h3>
								<strong class="title">4 Easy Steps to Financing: </strong>
								<div class="row">
									<div class="col-4" data-animation="left">
										<ol class="list">
											<li class="active">Call Today: <a href="tel:8664057600" class="tel">866-405-7600</a></li>
											<li><a href="#">Dealer ID: 9804</a></li>
											<li><a href="#">Loan Promo Code: 821177,</a></li>
											<li><a href="#">How much financing do you need?</a></li>
										</ol>
									</div>
									<div class="col-8 right-area" data-animation="right">
										<p>Loans provided by EnerBank USA (1245 Brickyard Road, Suite 600, Salt Lake City, UT 84106) on approved credit, for a limited time. Repayment terms vary from 24 to 132 months. Interest waived if repaid in 365 days. 16.72% fixed APR, effective as of October 1, 2015, subject to change.</p>
									</div>
								</div>
							</div>
							<div class="plan-area">
								<h3><span class="text">Plan 2:   9.99% Traditional Installment Loan</span></h3>
								<strong class="title">4 Easy Steps to Financing: </strong>
								<div class="row">
									<div class="col-4" data-animation="left">
										<ol class="list">
											<li class="active">Call Today: <a href="tel:8664057600" class="tel">866-405-7600</a></li>
											<li><a href="#">Dealer ID: 9804</a></li>
											<li><a href="#">No Loan Promo Code,</a></li>
											<li><a href="#">How much financing do you need?</a></li>
										</ol>
									</div>
									<div class="col-8 right-area" data-animation="right">
										<p>Loans provided by EnerBank USA (1245 Brickyard Road, Suite 600, Salt Lake City, UT 84106) on approved credit, for a limited time. Repayment terms vary from 12 to 144 months depending on loan amount. 9.99% fixed APR, effective as of October 1, 2015, subject to change. The first monthly payment will be due 30 days after the loan closes.</p>
									</div>
								</div>
							</div>
							<div class="block-payments" data-animation="fade">
								<form class="form-calculator" action="#">
									<header class="head">
										<h2>Calculate Payments</h2>
										<p>Find Out Your Monthly Payment with Financing at 9.9%</p>
									</header>
									<div class="pymnt_cal_50">
									<div class="field-frame">
										<div class="lable-area">
											<label for="price">Enter shed price:</label>
										</div>
										<div class="field-holder">
											<input type="text" id="price">
											<div id="errormessage"></div>
											
										</div>
										
										
										
										
										
										
									</div>
									<div class="field-frame">
										<div class="lable-area">
											<label for="price1">Monthly for 36 Months:</label>
										</div>
										<div class="field-holder">
											<input type="text" id="price1" readonly>
										</div>
									</div>
									<div class="field-frame">
										<div class="lable-area">
											<label for="price2">Monthly for 48 Months:</label>
										</div>
										<div class="field-holder">
											<input type="text" id="price2" readonly>
										</div>
									</div>
									<div class="field-frame">
										<div class="lable-area">
											<label for="price3">Monthly for 60 Months:</label>
										</div>
										<div class="field-holder">
											<input type="text" id="price3" readonly>
										</div>
									</div>
									<div class="field-frame">
										
										<div class="lable-area">
											<label for="price4">Monthly for 72 Months:</label>
										</div>
										<div class="field-holder">
											<input type="text" id="price4" readonly>
										</div>
									</div>
								</div>
								<div class="pymnt_cal_35">
								<div class="btn-holder">
											<a class="btn calculate_payment">calculate payments</a>
										</div>
										</div>
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div id="tab2" class="tab-area">
						<div class="container">
							<h2>tab2</h2>
						</div>
					</div>
					<div id="tab3" class="tab-area">
						<div class="container">
							<h2>tab3</h2>
						</div>
					</div>
				</div>
			</section>
		</main>
	@endsection
	@section('js')
	<script type="text/javascript">
	
	$(document).ready(function(){
    
		
			$(document).on('click','.calculate_payment',function(){
				addLoader('.form-calculator');
				 $('#price1').val('');
				 $('#price2').val('');
	      		 $('#price3').val('');
				 $('#price4').val('');
				 $("#errormessage").html("");
			var price_shed = $('#price').val();
			var token = "{{ csrf_token() }}";
							$.ajax({
							url : path+'finance',
							data : 'shed_price='+price_shed+'&_token='+token,
							dataType : 'json',
							method :'post',
							
							complete : function() {
								removeLoader('.form-calculator');
							},
							success : function(data) {
								
							$('#price1').val(data.thirtysix);
							$('#price2').val(data.fourtyeight);
							$('#price3').val(data.sixty);
							$('#price4').val(data.seventytwo);
							
							},
							error : function(xhr, ajaxOptions, thrownError) {
								var errorz = xhr.responseJSON.shed_price;
								
								$("#errormessage").html("<span  id='errormessage' class='finance_error' >"+errorz+"</span>");
								console.log(xhr);
							
							}
							});
			
			});
			});
			</script>
@endsection
