<footer>
      <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pronto para partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" abaixo se você estiver pronto para encerrar sua sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{route('logout')}}">Sair</a>
                </div>
            </div>
        </div>
    </div>
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

    {{-- bloc page --}}
    <div class="AppBlock block d-none">
       
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{url('theme-sdb-admin-2/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('theme-sdb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{url('theme-sdb-admin-2/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{url('theme-sdb-admin-2/vendor/accounting/accounting.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{url('theme-sdb-admin-2/js/sb-admin-2.min.js')}}"></script>
    <script src="{{url('panel/js/ultils.js')}}"></script>
    <script src="{{url('panel/js/user.js')}}"></script>
    <script src="{{url('panel/js/company.js')}}"></script>
    <script src="{{url('panel/js/category.js')}}"></script>
    <script src="{{url('panel/js/dashboard.js')}}"></script>
    <script src="{{url('koolChartJs/KoolChart/JS/KoolChart.js')}}"></script>
    <script src="{{url('koolChartJs/LicenseKey/KoolChartLicense.js')}}"></script>
    <script src="{{url('jQueryMask/jquery.mask.js')}}"></script>
    
    <script src="{{url('theme-sdb-admin-2/vendor/sweetalert2/sweetalert.all.js')}}" type="text/javascript"></script>
    <script src="{{url('theme-sdb-admin-2/vendor/mommentJS/momment.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{url('theme-sdb-admin-2/vendor/datatables/dataTable.js')}}"></script>
    <script src="{{url('theme-sdb-admin-2/vendor/axiosJS/axios.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    {{-- <script src="{{asset('js/bootstrap.js')}}" defer></script> --}}
    
    <script type="text/javascript">
        $(document).ready(function(){
            Ultils.construct();
            User.construct();
            Company.construct();
            Category.construct();
            Dashboard.construct();
            
        })
        
        
    </script>
    @yield('scripts')
</footer>