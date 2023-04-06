<div class="mt-4">
    <form wire:submit.prevent="save">
        @csrf
        <div class="form-group">
            <input type="file" hidden id="upload" wire:model="photo" accept="image/png, image/jpeg, image/jpg,">
            @if ($photo)
                <img class="rounded mx-auto d-block img-thumbnail" style="width: 200px;height:190px;" src="{{ $photo->temporaryUrl() }}">
            @else
                <img class="rounded mx-auto d-block img-thumbnail" style="width: 200px;height:190px;" src="{{asset('storage/image-not-found.png')}}" alt=""/>
            @endif
            <div class="d-flex justify-content-center mt-1">
                @error('photo')
            <span class=" text-danger error">{{$message}}</span>
            @enderror
            </div>
            <div class="d-flex justify-content-center mt-2">
                <label class="btn btn-small btn-outline-success" for="upload"><small><i class="zmdi zmdi-image mr-2"></i>Profile Photo</small></label>
            </div>

        </div>
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input class="au-input au-input--full" id="name" type="text" wire:model="name" placeholder="Full Name">
            @error('name')
            <span class="text-danger error">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input class="au-input au-input--full" id="email" type="email" wire:model="email" placeholder="Email Address">
            @error('email')
            <span class="text-danger error">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="phone">Phone</label>
            <input class="au-input au-input--full" id="phone" type="text" wire:model="phone" placeholder="Phone Number">
            @error('phone')
            <span class="text-danger error">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="address">Address</label>
            <input class="au-input au-input--full" id="address" type="text" wire:model="address" placeholder="Address">
            @error('address')
            <span class="text-danger error">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="au-input au-input--full" id="password" type="password" wire:model="password" placeholder="Enter Password">
            @error('password')
            <span class="text-danger error">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <input class="au-input au-input--full" id="password_confirmation" type="password" wire:model="password_confirmation" placeholder="Re-enter your password">
            @error('password_confirmation')
            <span class="text-danger error">{{$message}}</span>
            @enderror
        </div>
        <div class="mt-5">
            <button id="payment-button" type="submit" class="btn btn-lg bg-success btn-outline-success text-white btn-block">
                <span id="payment-button-amount">Create</span>
            </button>
        </div>
    </form>
</div>
