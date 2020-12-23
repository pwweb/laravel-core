<div class="table-responsive-sm">
    <table class="table table-striped" id="users-table">
        <thead>
            <tr>
                <th>
                    @lang("pwweb::core.Name")
                </th>
                <th>
                    @lang("pwweb::core.Email")
                </th>
                <th>
                    @lang("pwweb::core.Email verified at")
                </th>
                <th>
                    @lang("pwweb::core.Role")
                </th>
                <th colspan="3">
                    @lang("pwweb::core.Action")
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    @isnotnull($user->person){{ $user->person->display_name }}
                        @endisnotnull
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at }}</td>
                <td><span class="badge badge-dark">{{ $user->getRoleNames() }}</span></td>
                <td>
                    {!! Form::open(['route' => ['core.users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('core.users.show', [$user->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        @can('edit_users')
                        <a href="{{ route('core.users.edit', [$user->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('delete_users')
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
