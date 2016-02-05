@extends('app')

@section('title')
    {{ trans('common.users.home.panel_label') }}
@endsection

@section('content')
    <div class="panel-body">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-heading text-center">Welcome {{ $user->email }}!</h4>
                </div>
                <div class="panel-body text-center">
                    {!! Html::image(
                        config()->get('paths.user_image') . $user->avatar,
                        $user->name,
                        ['class' => 'thumbnail'])
                    !!}
                </div>
                <div class="panel-footer text-center">
                    {!! link_to_route('users.edit', 'Update Profile') !!}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            {!! link_to('words/', 'Words') !!}
            {!! link_to('categories/', 'Lesson') !!}
            <h2>Activities</h2>
            <table class="col-md-9">
                <thead>
                    <tr>
                        <th class="col-md-3">Date</th>
                        <th class="col-md-6">Activity</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->created_at }}</td>
                        <td>{{ $activity->activity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr>
        </div>
    </div>
@endsection
