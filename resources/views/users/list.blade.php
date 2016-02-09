@extends('app')

@section('title')
    {{ trans('common.users.list_users_title') }}
@endsection

@section('content')
    <div class="panel-body">
        <div class="col-md-12">
            <table class="col-md-12">
                <thead>
                    <tr>
                        <th class="col-md-2" colspan='2'>User</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usersList as $followedUser)
                        @if (!($followedUser->isAdmin()))
                        <tr>
                            <td>
                                {!! Html::image(config()->get('paths.user_image') . $followedUser->avatar,
                                    $followedUser->name, [
                                        'class' => 'thumbnail'
                                    ])
                                !!}
                            </td>
                            <td>
                                {!! link_to('users/show/' . $followedUser->id,$followedUser->name) !!}
                                <br />
                                {{ $followedUser->email }}
                            </td>
                            @if (!($user->isAdmin()))
                            <td>
                                @if (in_array($followedUser->id, $follows))
                                    {!! link_to_route('user.unfollow',
                                        trans('common.users.unfollow'),
                                        $followedUser->id )
                                    !!}
                                @else
                                    {!! link_to_route('user.follow',
                                        trans('common.users.follow'),
                                        $followedUser->id )
                                    !!}
                                @endif
                            </td>
                            @else
                            <td>
                                {!! link_to('users/show/' . $followedUser->id,'View') !!}
                            </td>
                            @endif
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>
    </div>
@endsection
