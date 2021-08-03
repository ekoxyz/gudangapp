<table class="table table-hover">
    <tbody>
        @foreach ($childs as $item)
        @if (!count($item->children))
        <tr>
            <td>
                {{ $item->name }}
            </td>
            <td class="cell-action">
                <form id="delete-form" action="{{ route('categories.destroy', $item) }}" method="POST"
                    class="" onsubmit="return confirm('Delete this User Permanently?')">
                    @csrf
                    @method('delete')
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-edit" data-toggle="modal"
                            data-target="#modal-edit" data-id="{{ $item }}"
                            data-all="{{ $categories }}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </form>
            </td>
        </tr>
        @else
        <tr data-widget="expandable-table" aria-expanded="false">
            <td>
                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                {{ $item->name }}
            </td>
            <td class="cell-action">
                <form id="delete-form" action="{{ route('categories.destroy', $item) }}" method="POST"
                    class="" onsubmit="return confirm('Delete this User Permanently?')">
                    @csrf
                    @method('delete')
                    <div class="btn-group">
                        <button type="button" class="btn btn-info btn-edit" data-toggle="modal"
                            data-target="#modal-edit" data-id="{{ $item }}"
                            data-all="{{ $categories }}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </form>
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
