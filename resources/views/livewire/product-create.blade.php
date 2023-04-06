<div class="mt-4">
    <form wire:submit.prevent="save">
        @csrf
        <div class="form-group">
            <input type="file" hidden id="upload" wire:model="photo" accept="image/png, image/jpeg, image/jpg,">
            @if ($photo)
                <img class="rounded mx-auto d-block img-thumbnail" style="width: 200px;height:150px;" src="{{ $photo->temporaryUrl() }}">
            @else
                <img class="rounded mx-auto d-block img-thumbnail" style="width: 200px;height:150px;" src="{{asset('storage/image-not-found.png')}}" alt=""/>
            @endif
            <div class="d-flex justify-content-center mt-1">
                @error('photo')
            <span class=" text-danger error">{{$message}}</span>
            @enderror
            </div>
            <div class="d-flex justify-content-center mt-2">
                <label class="btn btn-small btn-outline-success" for="upload"><small><i class="zmdi zmdi-image mr-2"></i>Product Image</small></label>
            </div>

        </div>
        <div class="form-group">
            <label class="form-label" for="name">Name</label>
            <input class="au-input au-input--full" autofocus id="name" type="text" wire:model="name" placeholder="Enter Product Name">
            @error('name')
            <span class="text-danger error">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label">Category</label>
            <select wire:model="category" type="text" class="au-input au-input--full form-control">
                <option value="">Choose Product Category</option>
                @foreach ($datas as $item)
                <option value="{{ $item->category_id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('category')
            <span class="text-danger error">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control" id="description" type="text" wire:model="description" cols="10" rows="3" placeholder="Detail about the product..."></textarea>
            @error('description')
            <span class="text-danger error">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label class="form-label" for="price">Price</label>
                    <div class="input-group">
                        <input class="au-input au-input--full form-control" id="price" type="text" wire:model="price" placeholder="10,000">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">MMK</span>
                        </div>
                    </div>
                    @error('price')
                    <span class="text-danger error">{{$message}}</span>
                    @enderror
                </div>
                <div class="col">
                    <label class="form-label" for="time">Waiting Time</label>
                    <div class="input-group">
                        <input class="au-input au-input--full form-control" id="time" type="text" wire:model="time" placeholder="15">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">mins</span>
                        </div>
                    </div>
                    @error('time')
                    <span class="text-danger error">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mt-5">
            <button id="payment-button" type="submit" class="btn btn-lg bg-success btn-outline-success text-white btn-block">
                <span id="payment-button-amount">Create</span>
            </button>
        </div>
    </form>
</div>
