<header class="flex items-center justify-center sm:text-4xl font-bold text-gray-900 mb-[-60px]">    
    <img src="{{ url('panel/img/logo/icon-page.svg') }}" alt=""><p>CbFood.</p>
</header>
<br><br>
@if(Auth::user())
<h4 class="mb-3 font-bold text-gray-900 text-xl my-5">Olá {{Auth::user()->name}}</h4>
<hr class="mb-4">
<div class="col order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted font-bold text-gray-900">Seu Carrinho</span>
        <span class="badge badge-secondary badge-pill">{{@count($cartItens)}}</span>
    </h4>
    <ul class="list-group mb-3">
        @foreach ($cartItens as $item) 
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                <h6 class="my-0">{{$item->name}} - Qt ({{$item->quantity}})</h6>
                <small class="text-muted">{{$item->description}}</small>
                </div>
                <span class="text-muted">R$ {{number_format($item->price,2,",",".")}}</span>
            </li>
        @endforeach
        <li class="list-group-item d-flex justify-content-between">
            <span>Total </span>
            <strong>R$ {{number_format(Cart::getTotal(),2,",",".") }}</strong>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col my-3 ">
        <form action="" class="send-address-user" novalidate>
            <hr class="mb-4">
            <hr class="mb-4">
            {{-- Method Payment --}}
            <h4 class="mb-3 font-bold text-gray-900 text-2xl">Forma de Pagamento</h4>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="payment_method" checked  type="radio" class="custom-control-input checkbox-credcard"  value="credcard">
                    <label class="custom-control-label" for="credit">Cartão</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="payment_method" type="radio" class="custom-control-input checkbox-money" value="money">
                    <label class="custom-control-label" for="debit">Dinheiro</label>
                </div>
                <div class="custom-control custom-radio hidden">
                    <input id="paypal" name="payment_method" type="radio" class="custom-control-input" value="pix">
                    <label class="custom-control-label" for="paypal">Pix</label>
                </div>
            </div>
            <div class="col-sm-6 col content-thing mb-4" style="display: none;margin-left:-10px">
                <label for="lastName">Troco?</label>
                <input type="text" class="form-control" name="thing" placeholder="" required>
            </div>
            <hr class="mb-4">
            {{-- Retirar no local --}}
            <h4 class="mb-3 font-bold text-gray-900 text-2xl">Retirar no Local?</h4>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="pick_up_on_the_spot-yes" checked name="pick_up_on_the_spot" type="radio" @if(((float)$company['company']['settings'][0]->hasDelivery == 0) || ($company['company']['settings'][0]->limit_send_delivery == null)) checked  @else @if($company['company']['settings'][0]->limit_send_delivery > number_format(Cart::getTotal(),2,",",".")) checked @endif @endif  class="custom-control-input"  value="sim">
                    <label class="custom-control-label" for="pick_up_on_the_spot-yes">Sim</label>
                </div>
                @if(($company['company']['settings'][0]->hasDelivery == 1) && ($company['company']['settings'][0]->limit_send_delivery == null))

                
                    <div class="custom-control custom-radio">
                        <input id="pick_up_on_the_spot-no" name="pick_up_on_the_spot" type="radio" class="custom-control-input" value="não">
                        <label class="custom-control-label" for="pick_up_on_the_spot-no">Não</label>
                    </div>
                @else
                    @if($company['company']['settings'][0]->limit_send_delivery < number_format(Cart::getTotal(),2,",","."))
                        <div class="custom-control custom-radio">
                            <input id="pick_up_on_the_spot-no" name="pick_up_on_the_spot" type="radio" class="custom-control-input" value="não">
                            <label class="custom-control-label" for="pick_up_on_the_spot-no">Não</label>
                        </div>
                    @endif
                @endif
            </div>
            <div class="mx-auto w-full mt-4 content-info-delivery-price" style="display: none">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    @if($company['company']['settings'][0]->deliveryPrice != null)
                        <strong>Aviso !</strong>
                        Você terá um custo adicional de R$ {{number_format($company['company']['settings'][0]->deliveryPrice, 2, ',','.')}} por conta da entrega
                     @else
                        <strong>Parabéns !</strong>
                        Você ganhou uma entrega gratís.
                     @endif

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <hr class="mb-4">
            <article class="flex items-center flex-col sm:flex-row"><p class="text-xl tex-gray-600">Selecione um dos Seus endereços Abaixo ou</p> <a href="#" class="bg-green-300 text-green-600 font-bold p-2 rounded-xl ml-3 no-underline show-modal-insert-new-addrees-user">Adicionar novo endereço</a></article>
        @foreach(Auth::user()->address as $addres)
        <div class="custom-control custom-radio shadow py-3 my-3 rounded-2xl cursor-pointer">
            <input id="{{$addres->id}}" name="address" type="checkbox" checked class="custom-control-input ml-3 cursor-pointer z-40" value="{{$addres->id}}">
            <label class="custom-control-label ml-3 cursor-pointer z-40" for="{{$addres->id}}">Rua {{$addres->road}}, Nª {{$addres->number}}, Bairro {{$addres->distric}}, Cidade {{$addres->city}}/{{$addres->states}}...</label>
        </div>
        @endforeach
        <button class="bg-green-300 text-green-600 font-bold p-2 rounded-xl text-lg my-3" type="submit">Confirma Compra</button>
    </form>
    </div>
</div>
@else
<div class="wrapper">
    
	<div class="header">
		<ul>
			<li class="active form_1_progessbar">
				<div>
					<p>1</p>
				</div>
			</li>
			<li class="form_2_progessbar">
				<div>
					<p>2</p>
				</div>
			</li>
			<li class="form_3_progessbar">
				<div>
					<p>3</p>
				</div>
			</li>
		</ul>
	</div>
	<div class="form_wrap">
		<div class="form_1 data_info w-[280px] ml-[-55px] sm:w-full sm:ml-0">
			<h2 class="font-bold tex-2xl tex-gray-600">Resumo do Carrinho</h2>
            {{-- Item in Cart --}}
            <div class="col order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted font-bold text-gray-900">Seu Carrinho</span>
                <span class="badge badge-secondary badge-pill">{{@count($cartItens)}}</span>
            </h4>
            <ul class="list-group mb-3">
                @foreach ($cartItens as $item) 
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                        <h6 class="my-0">{{$item->name}} - Qt ({{$item->quantity}})</h6>
                        <small class="text-muted">{{$item->description}}</small>
                        </div>
                        <span class="text-muted">{{$item->price}}</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total </span>
                    <strong>R$ {{ number_format(Cart::getTotal()) }}</strong>
                </li>
                </ul>
            </div>
		</div>
        <form class="needs-validation form-checkout-new-user" novalidate>
            <div class="form_2 data_info w-[280px] ml-[-55px] sm:w-full sm:ml-0" style="display: none;">
                <h2>Informações Pessoal</h2>
                
                    <div class="form_container">
                        <div class="row font-bold text-gray-900">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Nome</label>
                                <input type="text" class="form-control" name="name" id="firstName" placeholder="" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">WhatApp Number</label>
                                <input type="text" class="form-control phone_number" id="lastName" name="number_phone" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="mb-3 font-bold text-gray-900">
                            <label for="username">Senha (A senha deve ter 8 Caracteres)</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="username" name="password" required>
                            </div>
                        </div>
                        <div class="mb-3 font-bold text-gray-900">
                            <label for="username">E-mail (Opicional)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" class="form-control" id="username" name="email" >
                            </div>
                        </div>
                    </div>
                    <div class="btns_wrap col">
                        <div class="common_btns form_2_btns w-[280px] ml-[-10px] sm:w-full sm:ml-0" style="display: none;">
                            <button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Voltar</button>
                            <button type="button" class="btn_next">Proximo <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
                        </div>
                    </div>
            </div>
            <div class="form_3 data_info w-[280px] ml-[-55px] sm:w-full sm:ml-0" style="display: none;">
                <h2>Informações de Pagamento e Endereço</h2>
                    <div class="form_container">
                        <div class="row font-bold text-gray-900">
                            <div class="col-md-6 mb-3">
                                <label for="lastName">CEP</label>
                                <input type="text" class="form-control cep" name="zipe_code" placeholder="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Estado</label>
                                <input type="text" class="form-control" name="states" placeholder="">
                            </div>
                            
                        </div>
                        <div class="row font-bold text-gray-900">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Cidade</label>
                                <input type="text" class="form-control" name="city" placeholder="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Rua</label>
                                <input type="text" class="form-control" name="road" placeholder="" required>
                            </div>
                        </div>
                        <div class="row font-bold text-gray-900">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Bairro</label>
                                <input type="text" class="form-control" name="distric" placeholder="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Nª</label>
                                <input type="text" class="form-control" name="number" placeholder="" required>
                            </div>
                        </div>
                        <div class="row font-bold text-gray-900">
                            <div class="col mb-3">
                                <label for="firstName">Ponto de Referêcia</label>
                                <input type="text" class="form-control" name="complement" placeholder="" required>
                            </div>
                        </div>
                        <hr class="mb-4">
                        {{-- Method Payment --}}
                        <h4 class="mb-3 font-bold text-gray-900 text-2xl">Forma de Pagamento</h4>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="payment_method" type="radio" class="custom-control-input checkbox-credcard" checked value="credcard">
                                <label class="custom-control-label" for="credit">Cartão</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="payment_method" type="radio" class="custom-control-input checkbox-money" value="money">
                                <label class="custom-control-label" for="debit">Dinheiro</label>
                            </div>
                            <div class="custom-control custom-radio hidden">
                                <input id="paypal" name="payment_method" type="radio" class="custom-control-input" value="pix">
                                <label class="custom-control-label" for="paypal">Pix</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col content-thing mb-4" style="display: none;margin-left:-10px">
                            <label for="lastName">Troco?</label>
                            <input type="text" class="form-control" name="thing" placeholder="" required>
                        </div>
                     @php
                        //dd($company);
                     @endphp
                        <hr class="mb-4">
                        {{-- Retirar no local --}}
                        <h4 class="mb-3 font-bold text-gray-900 text-2xl">Retirar no Local?</h4>
                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input id="pick_up_on_the_spot-yes" checked name="pick_up_on_the_spot" type="radio" @if(((float)$company['company']['settings'][0]->hasDelivery == 0) || ($company['company']['settings'][0]->limit_send_delivery == null)) checked  @else @if($company['company']['settings'][0]->limit_send_delivery > number_format(Cart::getTotal(),2,",",".")) checked @endif @endif  class="custom-control-input"  value="sim">
                                <label class="custom-control-label" for="pick_up_on_the_spot-yes">Sim</label>
                            </div>
                            @if(($company['company']['settings'][0]->hasDelivery == 1) && ($company['company']['settings'][0]->limit_send_delivery == null))
                                <div class="custom-control custom-radio">
                                    <input id="pick_up_on_the_spot-no" name="pick_up_on_the_spot" type="radio" class="custom-control-input" value="não">
                                    <label class="custom-control-label" for="pick_up_on_the_spot-no">Não</label>
                                </div>
                            @else
                                @if(number_format(Cart::getTotal(),2,",",".") >= $company['company']['settings'][0]->limit_send_delivery)
                                    <div class="custom-control custom-radio">
                                        <input id="pick_up_on_the_spot-no" name="pick_up_on_the_spot" type="radio" class="custom-control-input" value="não">
                                        <label class="custom-control-label" for="pick_up_on_the_spot-no">Não</label>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <div class="mx-auto w-full mt-4 content-info-delivery-price" style="display: none">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                @if($company['company']['settings'][0]->deliveryPrice != null)
                                    <strong>Aviso !</strong>
                                    Você terá um custo adicional de R$ {{number_format($company['company']['settings'][0]->deliveryPrice, 2, ',','.')}} por conta da entrega
                                @else
                                    <strong>Parabéns !</strong>
                                    Você ganhou uma entrega gratís.
                                @endif

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <hr class="mb-4">
                        
                    </div>
                    <div class="btns_wrap col">
                        <div class="common_btns form_3_btns w-[280px] ml-[-10px] sm:w-full sm:ml-0" style="display: none;">
                            <button type="button" class="btn_back"><span class="icon"><ion-icon name="arrow-back-sharp"></ion-icon></span>Voltar</button>
                            <button type="submit" class="btn_done">Concluir</button>
                        </div>
                    </div>
            </div>
        </form>
	</div>
	<div class="btns_wrap col">
		<div class="common_btns form_1_btns col">
			<button type="button" class="btn_next col">Proximo <span class="icon"><ion-icon name="arrow-forward-sharp"></ion-icon></span></button>
		</div>
		
		
	</div>
</div>

<div class="modal_wrapper">
	<div class="shadow"></div>
	<div class="success_wrap">
		<span class="modal_icon"><ion-icon name="checkmark-sharp"></ion-icon></span>
		<p>Paabén,seu pedido foi realizado com sucesso.</p>
	</div>
</div>
@endif

<style scoped>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap');

:root{
	--primary: #f25c04;
	--secondary: #bfc0c0;
	--white: #fff;
	--text-clr: #5b6475;
	--header-clr: #25273d;
	--next-btn-hover: #8577d2;
	--back-btn-hover: #8b8c8c;
}

*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	list-style: none;
	outline: none;
	font-family: 'Open Sans', sans-serif;
}

body{
	
	color: var(--text-clr);
	font-size: 16px;
	position: relative;
}

.wrapper{
	width: 750px;
	max-width: 100%;
	background: var(--white);
	margin: 50px auto 0;
	padding: 50px;
	border-radius: 5px;
}

.wrapper .header{
	margin-bottom: 35px;
	display: flex;
	justify-content: center;
}

.wrapper .header ul{
	display: flex;
}

.wrapper .header ul li{
	margin-right: 50px;
	position: relative;
}

.wrapper .header ul li:last-child{
	margin-right: 0;
}

.wrapper .header ul li:before{
	content: "";
	position: absolute;
	top: 50%;
	transform: translateY(-50%);
	left: 55px;
	width: 100%;
	height: 2px;
	background: var(--secondary);
}

.wrapper .header ul li:last-child:before{
	display: none;
}

.wrapper .header ul li div{
	padding: 5px;
	border-radius: 50%;
}

.wrapper .header ul li p{
	width: 50px;
	height: 50px;
	background: var(--secondary);
	color: var(--white);
	text-align: center;
	line-height: 50px;
	border-radius: 50%;
}

.wrapper .header ul li.active:before{
	background: var(--primary);
}

.wrapper .header ul li.active p{
	background: var(--primary);
}

.wrapper .form_wrap{
	margin-bottom: 35px;
}

.wrapper .form_wrap h2{
	color: var(--header-clr);
	text-align: center;
	text-transform: uppercase;
	margin-bottom: 20px;
}

.wrapper .form_wrap .input_wrap{
	width: 350px;
	max-width: 100%;
	margin: 0 auto 20px;
}

.wrapper .form_wrap .input_wrap:last-child{
	margin-bottom: 0;
}

.wrapper .form_wrap .input_wrap label{
	display: block;
	margin-bottom: 5px;
}

.wrapper .form_wrap .input_wrap .input{
	border: 2px solid var(--secondary);
	border-radius: 3px;
	padding: 10px;
	display: block;
	width: 100%;	
	font-size: 16px;
	transition: 0.5s ease;
}

.wrapper .form_wrap .input_wrap .input:focus{
	border-color: var(--primary);
}

.wrapper .btns_wrap{
	width: 350px;
	max-width: 100%;
	margin: 0 auto;
}

.wrapper .btns_wrap .common_btns{
	display: flex;
	justify-content: space-between;
}

.wrapper .btns_wrap .common_btns.form_1_btns{
	justify-content: flex-end;
}

.wrapper .btns_wrap .common_btns button{
	border: 0;
	padding: 12px 15px;
	background: var(--primary);
	color: var(--white);
	width: 135px;
	justify-content: center;
	display: flex;
	align-items: center;
	font-size: 16px;
	border-radius: 3px;
	transition: 0.5s ease;
	cursor: pointer;
}

.wrapper .btns_wrap .common_btns button.btn_back{
	background: var(--secondary);
}

.wrapper .btns_wrap .common_btns button.btn_next .icon{
	display: flex;
	margin-left: 10px;
}

.wrapper .btns_wrap .common_btns button.btn_back .icon{
	display: flex;
	margin-right: 10px;
}



.modal_wrapper{
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	visibility: hidden;
}

.modal_wrapper .shadow{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(0,0,0,0.8);
	opacity: 0;
	transition: 0.2s ease;
}

.modal_wrapper .success_wrap{
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-800px);
	background: var(--white);
	padding: 50px;
	display: flex;
	align-items: center;
	border-radius: 5px;
	transition: 0.5s ease;
}

.modal_wrapper .success_wrap .modal_icon{
	margin-right: 20px;
	width: 50px;
	height: 50px;
	background: var(--primary);
	color: var(--white);
	border-radius: 50%;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 32px;
	font-weight: 700;
}

.modal_wrapper.active{
	visibility: visible;
}

.modal_wrapper.active .shadow{
	opacity: 1;
}

.modal_wrapper.active .success_wrap{
	transform: translate(-50%,-50%);
}
</style>
<script>
    var form_1 = document.querySelector(".form_1");
var form_2 = document.querySelector(".form_2");
var form_3 = document.querySelector(".form_3");


var form_1_btns = document.querySelector(".form_1_btns");
var form_2_btns = document.querySelector(".form_2_btns");
var form_3_btns = document.querySelector(".form_3_btns");


var form_1_next_btn = document.querySelector(".form_1_btns .btn_next");
var form_2_back_btn = document.querySelector(".form_2_btns .btn_back");
var form_2_next_btn = document.querySelector(".form_2_btns .btn_next");
var form_3_back_btn = document.querySelector(".form_3_btns .btn_back");

var form_2_progessbar = document.querySelector(".form_2_progessbar");
var form_3_progessbar = document.querySelector(".form_3_progessbar");

var btn_done = document.querySelector(".btn_done");
var modal_wrapper = document.querySelector(".modal_wrapper");
var shadow = document.querySelector(".shadow");

form_1_next_btn.addEventListener("click", function(){
	form_1.style.display = "none";
	form_2.style.display = "block";

	form_1_btns.style.display = "none";
	form_2_btns.style.display = "flex";

	form_2_progessbar.classList.add("active");
});

form_2_back_btn.addEventListener("click", function(){
	form_1.style.display = "block";
	form_2.style.display = "none";

	form_1_btns.style.display = "flex";
	form_2_btns.style.display = "none";

	form_2_progessbar.classList.remove("active");
});

form_2_next_btn.addEventListener("click", function(){
	form_2.style.display = "none";
	form_3.style.display = "block";

	form_3_btns.style.display = "flex";
	form_2_btns.style.display = "none";

	form_3_progessbar.classList.add("active");
});

form_3_back_btn.addEventListener("click", function(){
	form_2.style.display = "block";
	form_3.style.display = "none";

	form_3_btns.style.display = "none";
	form_2_btns.style.display = "flex";

	form_3_progessbar.classList.remove("active");
});

// btn_done.addEventListener("click", function(){
// 	modal_wrapper.classList.add("active");
// })

// shadow.addEventListener("click", function(){
// 	modal_wrapper.classList.remove("active");
// })
</script>