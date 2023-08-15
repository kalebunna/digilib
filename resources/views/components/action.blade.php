<div>
    <td>
        <div class="action-btn">
            <a href="javascript:void(0)" onclick="edit(this)" data-id="{{ $id }}"
                @foreach ($datas as $data)
        data-{{ $data['nama'] }}="{{ $data['nilai'] }}" @endforeach
                class="text-info edit" data-bs-toggle="modal" data-bs-target="#modal_edit">
                <i class="ti ti-eye fs-5"></i>
            </a>
            <a href="javascript:void(0)" onclick="hapus({{ $id }})"class="text-dark delete ms-2"
                data-bs-toggle="modal" data-bs-target="#modal-delete">
                <i class="ti ti-trash fs-5"></i>
            </a>
        </div>
    </td>
</div>
