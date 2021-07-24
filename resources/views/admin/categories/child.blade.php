<table class="table table-hover">
    <tbody>
        @foreach ($childs as $item)
        @if (!count($item->children))
        <tr>
            <td>
                {{ $item->name }}
            </td>
            <td class="cell-action">
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-edit" data-toggle="modal" data-target="#modal-edit"
                        data-id="{{ $item }}" data-all="{{ $categories }}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <a href="{{ route('categories.destroy', $item) }}" class="btn btn-danger" onclick="event.preventDefault();
                    document.getElementById('delete-form').submit();">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <form id="delete-form" action="{{ route('categories.destroy', $item) }}" method="POST"
                        class="d-none" onsubmit="return confirm('Delete this User Permanently?')">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </td>
        </tr>
        @else
        <tr data-widget="expandable-table" aria-expanded="false">
            <td>
                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                {{ $item->name }}
            </td>
            <td class="cell-action">
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-edit" data-toggle="modal" data-target="#modal-edit"
                        data-id="{{ $item }}" data-all="{{ $categories }}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <a href="{{ route('categories.destroy', $item) }}" class="btn btn-danger" onclick="event.preventDefault();
                    document.getElementById('delete-form').submit();">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <form id="delete-form" action="{{ route('categories.destroy', $item) }}" method="POST"
                        class="d-none" onsubmit="return confirm('Delete this User Permanently?')">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </td>
        </tr>
        <tr class="expandable-body d-none">
            <td>
                <div class="p-0" style="display: none;">
                    @include('admin.categories.child', ['childs'=> $item->children])
                </div>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
