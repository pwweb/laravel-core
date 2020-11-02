<div class="table-responsive-sm">
    <table class="table table-striped" id="items-table">
        <thead>
            <tr>
                <th>
                    @lang("pwweb::core.Id")
                </th>
                <th>
                    @lang("pwweb::core.Left")
                </th>
                <th>
                    @lang("pwweb::core.Right")
                </th>
                <th>
                    @lang("pwweb::core.Parent ID")
                </th>
                <th>
                    @lang("pwweb::core.Route")
                </th>
                <th>
                    @lang("pwweb::core.Name")
                </th>
                <th>
                    @lang("pwweb::core.Separator")
                </th>
                <th>
                    @lang("pwweb::core.Class")
                </th>
                <th>
                    @lang("pwweb::core.Visible")
                </th>
                <th colspan="3">
                    @lang("pwweb::core.Actions")
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->_lft }}</td>
                <td>{{ $menu->_rgt }}</td>
                <td>{{ $menu->parent_id }}</td>
                <td>{{ $menu->route }}</td>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->separator }}</td>
                <td>{{ $menu->class }}</td>
                <td>{{ $menu->visible }}</td>
                <td>
                    {!! Form::open(['route' => ['core.menus.destroy', $menu->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('core.menus.show', [$menu->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('core.menus.edit', [$menu->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
