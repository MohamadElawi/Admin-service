<a onclick=showItem({{ $id }}) data-toggle="modal" data-target="#show">
    <x-bx-show-alt style="width:30px;height:30px;color: #f5cb42"/>
</a>

{{-- @can('edit user')
    <a onclick=editItem({{ $id }})  data-toggle="modal" data-target="#edit-modal">
        <x-feathericon-edit style="width:30px;height:30px"/>
    </a>
@endcan

<a onclick="changeStatus({{ $id }})"  data-toggle="modal" data-target="#change-status-modal">
    <x-heroicon-o-arrow-path-rounded-square style="width:30px;height:30px;color: #18b2c6d0" />


@can('delete user')
    <a onclick="deleteItem({{ $id }})" class="delete-record" data-toggle="modal" data-target="#delete-modal">
        <x-heroicon-o-trash style="width:30px;height:30px;color: #EE4B2B"/>
    </a>
@endcan

<meta name="csrf-token" content="{{ csrf_token() }}">
</meta> --}}
