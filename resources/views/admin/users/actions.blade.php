     @if ($status != 'deleted')
         <a onclick=showItem({{ $id }}) data-toggle="modal" data-target="#user-show" style="color:#f5cb42;">
            <span class="icon" data-feather="alert-circle"></span> </a>
         @can('edit user')
             <a onclick=editItem({{ $id }}) class="item-edit" data-toggle="modal" data-target="#user-edit"
                 style="color:#7367f0">
                 <i  data-feather="edit"></i>
            {{-- <span class="btn btn-success">delete</span> --}}
                </a>
         @endcan

         <a onclick="blockedItem({{ $id }})" class="delete-record" data-toggle="modal"
             data-target="#block-modal" style="color: #6780E5;">
             <span class="icon" data-feather="lock"></span></a>


             @can('delete user')
             <a onclick="deleteItem({{ $id }})" class="delete-record" data-toggle="modal"
                 data-target="#delete-modal" style="color: #EE4B2B;">
                 <span class="icon" data-feather="trash-2"></span>
             </a>
         @endcan

         <meta name="csrf-token" content="{{ csrf_token() }}">
         </meta>
     @else
         @can('delete user')
             <a onclick="restoreItem({{ $id }})" data-toggle="modal" data-target="#restore-modal"
                 style="color: #2C9151;">
                 <span class="icon" data-feather="rotate-cw"></span></a>
         @endcan

         <meta name="csrf-token" content="{{ csrf_token() }}">
         </meta>
     @endif
