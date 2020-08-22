<div class="table-responsive-sm">
    <table class="table table-striped" id="items-table">
        <thead>
            <tr>
                <th>@lang("pwweb::core.Environment")</th>
                <th>@lang("pwweb::core.Left")</th>
                <th>@lang("pwweb::core.Right")</th>
                <th>@lang("pwweb::core.Parent ID")</th>
                <th>@lang("pwweb::core.Level")</th>
                <th>@lang("pwweb::core.Identifier")</th>
                <th>@lang("pwweb::core.Name")</th>
                <th>@lang("pwweb::core.Separator")</th>
                <th>@lang("pwweb::core.Class")</th>
                <th colspan="3">@lang("pwweb::core.Actions")</th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->environment->name }}</td>
                <td>{{ $item->_lft }}</td>
                <td>{{ $item->_rgt }}</td>
                <td>{{ $item->parent_id }}</td>
                <td>{{ $item->level }}</td>
                <td>{{ $item->identifier }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->separator }}</td>
                <td>{{ $item->class }}</td>
                <td>
                    {!! Form::open(['route' => ['core.menu.items.destroy', $item->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('core.menu.items.show', [$item->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('core.menu.items.edit', [$item->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
