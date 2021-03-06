<div class="table-responsive-sm">
    <table class="table table-striped" id="types-table">
        <thead>
            <tr>
                <th>@lang("pwweb::core.Name")</th>
                <th>@lang("pwweb::core.Global")</th>
                <th colspan="3">@lang("pwweb::core.Action")</th>
            </tr>
        </thead>
        <tbody>
        @foreach($types as $type)
            <tr>
                <td>{{ $type->name }}</td>
                <td>{{ $type->global }}</td>
                <td>
                    {!! Form::open(['route' => ['core.address.types.destroy', $type->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('core.address.types.show', $type->id) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('core.address.types.edit', $type->id) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
