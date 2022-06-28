<table class="table table-info">
    <thead>
        <tr>
            <th>Nome</th>
            <th class="text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($profiles as $profile)
        @php 
            $has = 0;
            if(sizeof($hasAssociationPemmissionWithModule) > 0){
                foreach($hasAssociationPemmissionWithModule as $associate){
                    if($associate->profiles_id == $profile->id){
                        $has = 1;
                    }
                }
            }
        @endphp
            <tr>
                <td>{{$profile->label}}</td>
                <td class="text-center">
                    <a href="#" class="@if(!$has) text-info associate-permission-with-profile @else remove-profile-association-with-user text-danger @endif" value="{{$profile->id}}" data-permission_id="{{$permission_id}}">
                        @if(!$has) 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        @endif
                    </a>   
                </td>
            </tr>
        @empty    
            
        @endforelse
    </tbody>
</table>