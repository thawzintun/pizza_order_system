@extends('user.layout.master')

@section('title')
    <title>Contact Us</title>
@endsection

@section('contents')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 offset-2 text-center my-3">
                <h3>Contact Us</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi, possimus?</p>
            </div>
            <div class="col-8 offset-2">
                @if (session('messageSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span>{{ session('messageSuccess') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-5 bg-dark border border-dark badge-light px-5 py-4 rounded-left">
                        <div class="row">
                            <div class="col-12 text-white my-3">
                                <h3 class="text-warning">Contact Information</h3>
                                <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maxime amet nesciunt
                                    excepturi. Eius, mollitia dolore!</small>
                            </div>
                            <div class="col-12 my-4 text-white">
                                <div class="my-4">
                                    <i class="fas fa-phone-alt text-warning mr-3"></i> <a href="tel:+959774569866"
                                        class="text-decoration-none text-white">09 77 456 9866</a>
                                </div>
                                <div class="my-4">
                                    <i class="fas fa-envelope text-warning mr-3"></i> <a
                                        href="mailto:thawzintun98@gmail.com"
                                        class="text-decoration-none text-white">thawzintun98@gmail.com</a>
                                </div>
                                <div class="my-4">
                                    <i class="fas fa-map-marker-alt text-warning mr-3"></i> Kamayut, Yangon
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 border border-dark badge-light p-5 rounded-right">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <form action="{{ route('user#sendMessage') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="name">Full Name</label>
                                            <input id="name" name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter your full name" value="{{ old('name') }}">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="phone">Phone</label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                    id="phone" placeholder="09xxxxxxxxx" value="{{ old('phone') }}">
                                                @error('phone')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="text"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    id="email" placeholder="example@gmail.com"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="subject">Subject</label>
                                            <input id="subject" name="subject" type="text"
                                                class="form-control @error('subject') is-invalid @enderror"
                                                placeholder="Title" value="{{ old('subject') }}">
                                            @error('subject')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                                cols="30" rows="7" placeholder="Please describe in details">{{ old('description') }}</textarea>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" class="btn btn-primary rounded">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
