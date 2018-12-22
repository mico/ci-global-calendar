{{--
    This modal is used in the event.create and event.edit view to add a new teacher
    It is loaded in view/partials/forms/modal-frame when the 
    button "Add new venue" is clicked in the event create view
--}}

@extends('layouts.modal')

@section('content')
    <div class="row">
        <div class="col-12">
            <button type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="col-12 pt-4">
            <h2>@lang('views.add_new_venue')</h2>
        </div>
    </div>

    @include('partials.forms.error-management', [
          'style' => 'alert-danger',
    ])

    <form action="{{ route('eventVenues.storeFromModal') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-12">
                @include('partials.forms.input', [
                    'title' => __('general.name'),
                    'name' => 'name',
                    'placeholder' => 'Name'
                ])
            </div>
            
            <div class="col-12">
                @include('partials.forms.input', [
                    'title' => __('views.street'),
                    'name' => 'address',
                    'placeholder' => ''
                ])
            </div>
            <div class="col-12">
                @include('partials.forms.input', [
                    'title' => __('views.city'),
                    'name' => 'city',
                    'placeholder' => ''
                ])
            </div>
            <div class="col-12">
                @include('partials.forms.input', [
                    'title' => __('views.state_province'),
                    'name' => 'state_province',
                    'placeholder' => ''
                ])
            </div>
            <div class="col-12">
                @include('partials.forms.select', [
                      'title' => __('views.country'),
                      'name' => 'country_id',
                      'placeholder' => 'Select country',
                      'records' => $countries,
                ])
            </div>
            <div class="col-12">
                @include('partials.forms.input', [
                    'title' => __('views.zip_code'),
                    'name' => 'zip_code',
                    'placeholder' => '',
                    'value' => ''
                ])
            </div>
            <div class="col-12">
                @include('partials.forms.input', [
                    'title' => __('views.website'),
                    'name' => 'website',
                    'placeholder' => 'https://...',
                    'value' => ''
                ])
            </div>
            <div class="col-12">
                @include('partials.forms.textarea', [
                    'title' => __('general.description'),
                    'name' => 'description',
                    'placeholder' => 'Event description'
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
