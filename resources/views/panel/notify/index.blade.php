@foreach($notify as $key => $not)
    <a class="dropdown-item d-flex align-items-center" href="#">
        <div class="mr-3">
            <div class="icon-circle bg-success text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
                </svg>
            </div>
        </div>
        <div>
            <div class="small text-gray-500">
                {{date('F', strtotime($not['body']['order']['created_at']))}} 
                {{date('j', strtotime($not['body']['order']['created_at']))}}
                {{date('Y', strtotime($not['body']['order']['created_at']))}}
                {{date('H:i', strtotime($not['body']['order']['created_at']))}}
            </div>
            <span class="font-weight-bold">Você tem um novo Pedido de  {{$not['userRequesOrder'][0]['name']}}</span>
        </div>
    </a>
@endforeach