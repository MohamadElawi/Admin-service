     @if ($status != 'deleted')
         <a onclick=showItem({{ $id }}) data-toggle="modal" data-target="#user-show" style="color:#f5cb42;">
            <x-bx-show-alt style="width:30px;height:30px;color: #f5cb42"/>
         @can('edit user')
             <a onclick=editItem({{ $id }}) class="item-edit" data-toggle="modal" data-target="#user-edit"
                 style="color:#7367f0">
                 <x-feathericon-edit style="width:30px;height:30px"/>
                 {{-- <span class="btn btn-success">delete</span> --}}
             </a>
         @endcan

         @can('block user')
             <a onclick="blockedItem({{ $id }})" class="delete-record" data-toggle="modal"
                 data-target="#block-modal" style="color: #6780E5;">
                 <x-heroicon-o-arrow-path-rounded-square style="width:30px;height:30px;color: #18b2c6d0" /></a>
         @endcan



         
             <a onclick="deleteItem({{ $id }})" class="delete-record" data-toggle="modal"
                 data-target="#delete-modal" style="color: #EE4B2B;">
                 <x-heroicon-o-trash style="width:30px;height:30px;color: #EE4B2B" />
             </a>


         <meta name="csrf-token" content="{{ csrf_token() }}">
         </meta>
     @else
         @can('block user')
             <a onclick="restoreItem({{ $id }})" data-toggle="modal" data-target="#restore-modal"
                 style="color: #2C9151;">
                <x-lineawesome-trash-restore-alt-solid   style="width:30px;height:30px;color: #2bee99" /></a>
         @endcan

         <meta name="csrf-token" content="{{ csrf_token() }}">
         </meta>
     @endif
