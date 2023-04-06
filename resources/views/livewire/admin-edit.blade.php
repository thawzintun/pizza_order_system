<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-3">
                <input type="file" hidden id="upload" wire:model="photo" accept="image/png, image/jpeg, image/jpg,">
                @if ($adminData->profile_photo_path == null && $photo)
                    <img class="rounded mx-auto d-block img-thumbnail" src="{{ $photo->temporaryUrl() }}">
                @elseif ($adminData->profile_photo_path == null)
                    <img class="rounded mx-auto d-block img-thumbnail" src="https://ui-avatars.com/api/?name={{ $adminData->name }}&size=512&color=7F9CF5&background=63c76a&color=ffffff&format=svg" alt=""/>
                @elseif ($adminData->profile_photo_path && $photo)
                    <img class="rounded mx-auto d-block img-thumbnail" src="{{ $photo->temporaryUrl() }}">
                @else
                    <img class="rounded mx-auto d-block img-thumbnail" src="{{asset("storage/".$adminData->profile_photo_path)}}" alt=""/>
                @endif
                <div class="d-flex justify-content-center mt-2">
                    <label class="btn btn-outline-success" for="upload"><i class="zmdi zmdi-image mr-2"></i>Change Photo</label>
                </div>
                @error('photo')
                <span class=" text-danger error">{{$message}}</span>
                @enderror
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <input class="au-input au-input--full" id="name" type="text" wire:model="name" placeholder="Full Name">
                            @error('name')
                            <span class="text-danger error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone Number</label>
                            <input class="au-input au-input--full" id="phone" type="text" wire:model="phone" placeholder="09 xxx xxx xxx">
                            @error('phone')
                            <span class="text-danger error">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input class="au-input au-input--full" id="email" type="email" wire:model="email" placeholder="Email">
                            @error('email')
                            <span class="text-danger error">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="address">Address</label>
                            <input class="au-input au-input--full" id="address" type="text" wire:model="address" placeholder="Address">
                            @error('address')
                            <span class="text-danger error">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="">Gender</label> <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border" type="radio" wire:model="gender" id="male" value="Male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input border" type="radio" wire:model="gender" id="female" value="Female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-outline-success mt-5 w-50" type="submit">Update</button>
        </div>
    </form>
</div>
