@extends('app')

@section('title')
    {{ trans('common.users.activities') }}
@endsection
@section('content')
    <div class="panel-body">
        <div class="col-md-9">
            <table class="col-md-9">
                <thead>
                    <tr>
                        <th class="col-md-3">Date</th>
                        <th class="col-md-3">User</th>
                        <th class="col-md-6">Activity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td>{{ $activity->created_at }}</td>
                            <td>
                                <span>
                                    <a href="{{ URL::to('users/show/' . $activity->user->id) }}">
                                        {!! Html::image(config()->get('paths.user_image') . $activity->user->avatar,
                                            $activity->user->name, [
                                                'class' => 'thumbnail',
                                                'title' => $activity->user->name,
                                                'alt' => $activity->user->name
                                            ])
                                        !!}
                                    </a>
                                </span>
                            </td>
                            <td>{{ $activity->activity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        </div>
    </div>
@endsection
