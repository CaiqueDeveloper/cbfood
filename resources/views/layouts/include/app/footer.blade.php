  <!-- button scroll top -->
    <div id="toggleCart" class="bg-orange-600 hidden sm:hidden open-shopping-cart  w-[40px] h-[40px] fixed top-[140px] right-[10px] text-white leading-[40px] text-center text-2xl rounded-full cursor-pointer animate-bounce z-40">
        <i class="fa fa-cart-plus animate-pulse	"></i>
    </div>
    <!-- final  button scroll top -->
    <!-- button scroll top -->
    <div id="toTop" class="bg-orange-600 hidden w-[40px] h-[40px] fixed sm:bottom-[60px] bottom-[100px] right-[10px] text-white leading-[40px] text-center rounded-full cursor-pointer animate-bounce z-40">
        <i class="fa fa-arrow-up "></i>
    </div>
    <div class="w-full h-[100px] sm:h-[50px] shadow-lg fixed bottom-0 z-50">
        <section class="cart-info bg-orange-600 h-12 ">
            <div class="container mx-auto flex  justify-between ">
                <article class="h-12 flex items-center justify-center font-bold text-white cursor-pointer open-shopping-cart">
                    <i class="bi bi-cart-fill mx-2"></i>
                    <p>VER CARRINHO</p>
                </article>
                <article class="h-12 flex items-center " >
                    <p class="total-itemCart bg-orange-300 w-10 h-10 rounded-full text-white font-semibold text-center flex items-center justify-center"></p>
                    <p class="total-priceIntemCart mx-2 text-white font-semibold text-center flex items-center justify-center"></p>
                </article>
            </div>
        </section>
        <section class="menu-mobile h-12 bg-white sm:hidden flex items-center">
            <div class="container mx-auto flex justify-evenly text-2xl">
                <p class=" cursor-pointer" onClick="window.location.reload()">
                    <i class="bi bi-house-door-fill"></i>
                </p>
                <p class=" cursor-pointer show-modal-user">
                    <i class="bi bi-person-fill"></i>
                </p>
                <p class=" cursor-pointer my-bag">
                    <i class="bi bi-file-earmark-text"></i>
                </p>
            </div>   
        </section>
    </div>
    <!-- final  button scroll top -->
    <!-- ini footer -->
    <footer class="w-full h-full bg-black flex  justify-center items-center">
        <div class="container mx-auto flex flex-col justify-center items-center">
            <div class="w-full footer-descritpion text-white font-bold text-xl sm:text-2xl text-left mb-[30px] font-mono">
                <div class="information-company w-full text-center text-gray-500 mt-4">
                    <p class="text-4xl">{{$menuCompany['company']->name}}</p>
                    <p class="text-sm w-full flex items-center justify-center mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map-fill mr-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                            <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                        </svg>
                       @if(@count($menuCompany['company']['address']) > 0) 
                        {{$menuCompany['company']['address'][0]->road}}, {{$menuCompany['company']['address'][0]->number}}, {{$menuCompany['company']['address'][0]->distric}}, {{$menuCompany['company']['address'][0]->city}}/{{$menuCompany['company']['address'][0]->states}}...
                        @else
                            Essa empresa ainda não cadastrou um endereço... 
                        @endif
                    </p>
                </div>
                <div class="social-media-company w-full text-center mt-2 text-gray-500 flex items-center justify-center">
                    <a href="https://www.instagram.com/cbfooddelivery/" class="mx-3" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                        </svg>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone=7398272867&text=Óla ! Gostaria de conhecer um pouco mais da plataforma, vi a pagina da {{$menuCompany['company']->name}} e fiquei muito interessado." target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                          </svg>
                    </a>
                </div>
            </div>
            <div class="w-full footer-more-info border-dashed border-t-2 border-orange-600 mb-[30px]">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-gray-500 mt-[30px]">
                    <p class="text-center sm:text-left text-xs">CbSoftWare<a href="#"> Termos e Condições</a></p>
                    <p class="text-center sm:text-right text-xs">© {{date('Y')}} CbFood</p>
                </div>
            </div>
        </div>
          {{-- bloc page --}}
          <div class="AppBlock block d-none"></div>
        <!-- modal Main -->
        <div class="modal fade" id="modalMain" tabindex="-1" role="dialog" aria-labelledby="modalMainLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        

                        <div class="col-4"><h5 class="modal-title"></h5></div>
                        <div class="col-8 content-button">

                            
                        
                            <a href="#" class="close btn btn-danger btn-circle" data-dismiss="modal" aria-label="Close">× </a>
                        </div>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- final footer -->
    <!-- create event -->
    <script src="{{url('site/js/axiosJS/axios.js')}}"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{url('theme-sdb-admin-2/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('theme-sdb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('theme-sdb-admin-2/js/sb-admin-2.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{url('theme-sdb-admin-2/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{url('site/js/home.js')}}"></script>
    <script src="{{url('site/js/checkout.js')}}"></script>
    <script src="{{url('site/js/ultils.js')}}"></script>
    <script src="{{url('panel/js/ultils.js')}}"></script>
    <script src="{{url('site/js/wolcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{url('site/js/wolcarousel/owl.theme.default.min.js')}}"></script>
    <script src="{{url('theme-sdb-admin-2/vendor/sweetalert2/sweetalert.all.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    
    
    <script>
        Home.constructor()
       
    </script>