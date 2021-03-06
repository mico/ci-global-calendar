{{--
    This modal is used in the event.create and event.edit view to add a new teacher
    It is loaded in view/partials/forms/modal-frame when the 
    button "Add new venue" is clicked in the event create view
--}}

@extends('laravel-events-calendar::layouts.modal')

@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="col-12 pb-3">
            <h4>@lang('laravel-events-calendar::eventVenue.add_new_venue')</h4>
        </div>
    </div>

    @include('laravel-events-calendar::partials.error-management', [
          'style' => 'alert-danger',
    ])

    <form action="{{ route('eventVenues.storeFromModal') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-12">
                @include('laravel-events-calendar::partials.input', [
                    'title' => __('laravel-events-calendar::general.name'),
                    'name' => 'name',
                    'placeholder' => 'Name',
                    'required' => true,
                ])
            </div>
            
            <div class="col-12">
                @include('laravel-events-calendar::partials.input', [
                    'title' => __('laravel-events-calendar::eventVenue.street'),
                    'name' => 'address',
                    'placeholder' => '',
                    'required' => false,
                ])
            </div>
            <div class="col-12">
                @include('laravel-events-calendar::partials.input', [
                    'title' => __('laravel-events-calendar::eventVenue.city'),
                    'name' => 'city',
                    'placeholder' => '',
                    'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-events-calendar::partials.input', [
                    'title' => __('laravel-events-calendar::eventVenue.state_province'),
                    'name' => 'state_province',
                    'placeholder' => '',
                    'required' => false,
                ])
            </div>
            <div class="col-12">
                @include('laravel-events-calendar::partials.select', [
                      'title' => __('laravel-events-calendar::eventVenue.country'),
                      'name' => 'country_id',
                      'placeholder' => 'Select country',
                      'records' => $countries,
                      'liveSearch' => 'true',
                      'mobileNativeMenu' => false,
                      'required' => true,
                ])
            </div>
            <div class="col-12">
                @include('laravel-events-calendar::partials.input', [
                    'title' => __('laravel-events-calendar::eventVenue.zip_code'),
                    'name' => 'zip_code',
                    'placeholder' => '',
                    'value' => '',
                    'required' => false,
                ])
            </div>
            <div class="col-12">
                @include('laravel-events-calendar::partials.input', [
                    'title' => __('laravel-events-calendar::general.website'),
                    'name' => 'website',
                    'placeholder' => 'https://...',
                    'value' => '',
                    'required' => false,
                ])
            </div>
            <div class="col-12">
                @include('laravel-events-calendar::partials.textarea', [
                    'title' => __('laravel-events-calendar::general.description'),
                    'name' => 'description',
                    'placeholder' => 'Event description',
                    'required' => false,
                ])
            </div>
       </div>

       <div class="row mt-5">
           <div class="col-6 pull-left">
               <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('general.close')</button>
           </div>
           <div class="col-6 pull-right">
               <button type="submit" class="btn btn-primary float-right">@lang('general.submit')</button>
           </div>
       </div>

    </form>

@endsection
