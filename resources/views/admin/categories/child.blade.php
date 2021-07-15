<table class="table table-hover">
    <tbody>
        @foreach ($childs as $item)
        @if (!count($item->children))
        <tr>
            <td>
                {{ $item->name }}
            </td>
        </tr>
        @else
        <tr data-widget="expandable-table" aria-expanded="false">
            <td>
                <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                {{ $item->name }}
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
