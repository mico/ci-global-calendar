@extends('events.layout')

@section('javascript-document-ready')
    {{--  Clear filters on click reset button --}}
        $("#resetButton").click(function(){
            $("input[name=keywords]").val("");
            $("select[name=category_id] option").prop("selected", false).trigger('change');
            $("select[name=country_id] option").prop("selected", false).trigger('change');
            $('form.searchForm').submit();
        });
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>@lang('views.events_management')</h2>
        </div>
        <div class="col-12 mt-4 mt-sm-0 text-right">
            <a class="btn btn-success" href="{{ route('events.create') }}">@lang('views.create_new_event')</a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-4">
            <p>{{ $message }}</p>
        </div>
    @endif

    {{-- Search form --}}
    <form class="row searchForm mt-3" action="{{ route('events.index') }}" method="GET">
        @csrf
        <div class="form-group col-12 col-sm-12 col-md-4 col-lg-3 mb-2">
            <input type="text" name="keywords" class="form-control" placeholder="@lang('views.search_by_event_name')" value="{{ $searchKeywords }}">
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-2">
            <select name="category_id" class="selectpicker" data-live-search="true" title="@lang('views.filter_by_category')">
                @foreach ($eventCategories as $value => $eventCategory)
                    {{-- {{ $event->category_id == $value ? 'selected' : '' }} --}}
                    <option value="{{$value}}" {{ $searchCategory == $value ? 'selected' : '' }} >{!! $eventCategory !!} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <select name="country_id" class="selectpicker" data-live-search="true" title="@lang('views.filter_by_country')">
                @foreach ($countries as $value => $country)
                    <option value="{{$value}}" {{ $searchCountry == $value ? 'selected' : '' }} >{!! $country !!} </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 mt-3 mt-sm-2 mt-lg-0">
            <a id="resetButton" class="btn btn-info float-right ml-2" href="#">@lang('general.reset')</a>
            <input type="submit" value="@lang('general.search')" class="btn btn-primary float-right">
        </div>
    </form>

    {{-- List of events --}}
    {{-- <table class="table table-bordered mt-4">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Country</th>
            <th width="280">Action</th>
        </tr>
        @foreach ($events as $event)
        <tr>
            <td>{{ $event->id }}</td>
            <td>{{ $event->title }}</td>
            <td>{{ $eventCategories[$event->category_id] }}</td>
            <td>
                {{ $countries[$venues[$event->venue_id]] }}
            </td>
            <td>
                <form action="{{ route('events.destroy',$event->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('events.show',$event->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('events.edit',$event->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>--}}
    
    <div class="eventList my-4">
        @foreach ($events as $event)
            <div class="row p-1 {{ $loop->index % 2 ? 'bg-light': 'bg-white' }}">
                <div class="col-12 col-md-6 col-lg-8 py-2 title">
                    <a href="{{ route('events.edit',$event->id) }}">{{ $event->title }}</a>
                </div>
                <div class="col-6 col-md-3 col-lg-2 pb-2 py-md-2 category">
                    <i data-toggle="tooltip" data-placement="top" title="" class="fa fa-tag mr-2" data-original-title="@lang('general.category')"></i>
                    {{ $eventCategories[$event->category_id] }}
                </div>
                <div class="col-6 col-md-3 col-lg-2 pb-2 py-md-2 country">
                    <i data-toggle="tooltip" data-placement="top" title="" class="far fa-globe-americas mr-2" data-original-title="@lang('general.country')"></i>
                    {{ $countries[$venues[$event->venue_id]] }}
                </div>
                <div class="col-12 pb-2 action">
                    <form action="{{ route('events.destroy',$event->id) }}" method="POST">

                        <a class="btn btn-info mr-2" href="{{ route('events.show',$event->id) }}">@lang('views.view')</a>
                        <a class="btn btn-primary" href="{{ route('events.edit',$event->id) }}">@lang('views.edit')</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger float-right">@lang('views.delete')</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>


    {!! $events->links() !!}


@endsection
