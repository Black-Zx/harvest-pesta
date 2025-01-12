@extends('cs.layouts.app')

@section('page-title', 'Banner')

@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('messages.banner') }}</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{ __('messages.customer_service') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.banner') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="banner">
            <form method="POST" action="{{ route('cs.uploadPhoto') }}" enctype="multipart/form-data">
                @csrf
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $message)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    <div class="alert-body">
                                        <i data-feather="info" class="mr-50 align-middle"></i>
                                        {{ $message }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('messages.upload_banner') }}</h4>
                            </div>

                            <div class="card-body">
                                <input type="hidden" value="1" name="state">
                                <input type="hidden" value="banner" name="name">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="image">{{ __('messages.upload_image') }}
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image"
                                                    accept="image/*" required>
                                                <label class="custom-file-label"
                                                    for="image1">{{ __('messages.choose_file') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p>{{ __('messages.banner_upload_requirement_1') }} <br>
                                    {{ __('messages.banner_upload_requirement_2') }}</p>

                                <input type="submit" id="submit"
                                    class="btn btn-primary waves-effect waves-float waves-light"
                                    value="{{ __('messages.submit') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>

        <section class="custom-radio mt-3">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.select_banner') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                @csrf
                                <div class="demo-inline-spacing">
                                    @foreach ($photos as $key => $photo)
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio-{{ $key }}" name="photo_id"
                                                class="custom-control-input" value="{{ $photo->id }}" @if ($banner->photo_id == $photo->id) checked @endif />
                                            <label class="custom-control-label" for="customRadio-{{ $key }}">
                                                <img src="/storage{{ $photo->image }}" alt="" height="100" />
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <input type="submit" class="btn btn-primary waves-effect waves-float waves-light mt-2"
                                    value="{{ __('messages.submit') }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div aria-live="polite" aria-atomic="true" style="position: relative">
            <div id="notification-body" style="position: fixed; top: 1rem; right: 1rem; margin-left: 1rem; z-index: 1030">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                title: '{{ __('messages.thank_you') }}',
                text: '{{ __('messages.success_msg') }}',
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        </script>
    @endif
@endpush
