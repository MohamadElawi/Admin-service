@can('edit role')
    <a href="{{ route('roles.edit', $id) }}">
        <x-feathericon-edit style="width:30px;height:30px" />
    </a>
@endcan

@can('change status role')
    <a onclick="changeStatus({{ $id }})" data-toggle="modal" data-target="#change-status-modal">
        <x-heroicon-o-arrow-path-rounded-square style="width:30px;height:30px;color: #18b2c6d0" />
    @endcan

    @can('delete role')
        <a onclick="deleteItem({{ $id }})" class="delete-record" data-toggle="modal" data-target="#delete-modal">
            <x-heroicon-o-trash style="width:30px;height:30px;color: #EE4B2B" />
        </a>
    @endcan

    <meta name="csrf-token" content="{{ csrf_token() }}">
    </meta>


