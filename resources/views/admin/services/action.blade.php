<a href="{{env('SERVICE_FORNT_PORT') . "/form/$id"}}" >
    <x-bx-show-alt style="width:30px;height:30px;color: #f5cb42"/>
</a>


<a onclick=editItem('{{ $id }}')  data-toggle="modal" data-target="#edit-modal">
        <x-feathericon-edit style="width:30px;height:30px"/>
</a>


<a onclick="deleteItem('{{ $id }}')" class="delete-record" data-toggle="modal" data-target="#delete-modal">
        <x-heroicon-o-trash style="width:30px;height:30px;color: #EE4B2B"/>
</a>

<meta name="csrf-token" content="{{ csrf_token() }}">
</meta>
