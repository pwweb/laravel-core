<div class="table-responsive-sm">
    <table class="table table-striped" id="environments-table">
        <thead>
            <tr>
                <th>@lang("pwweb::core.Name")</th>
                <th colspan="3">@lang("pwweb::core.Actions")</th>
            </tr>
        </thead>
        <tbody>
        @foreach($environments as $environment)
            <tr>
                <td>{{ $environment->name }}</td>
                <td>
                    {!! Form::open(['route' => ['core.menu.environments.destroy', $environment->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('core.menu.environments.show', [$environment->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('core.menu.environments.edit', [$environment->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
