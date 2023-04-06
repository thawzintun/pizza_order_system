<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-3">
                <input type="file" hidden id="upload" wire:model="photo" accept="image/png, image/jpeg, image/jpg,">
                @if ($photo)
                    <img class="rounded mx-auto d-block img-thumbnail" style="width:350px;height:180px;"
                        src="{{ $photo->temporaryUrl() }}">
                @else
                    <img class="rounded mx-auto d-block img-thumbnail" style="width:350px;height:180px;"
                        src="{{ asset('storage/' . $image) }}" alt="">
                @endif
                <div class="d-flex justify-content-center mt-2">
                    <label class="btn btn-outline-success" for="upload"><i class="zmdi zmdi-image mr-2"></i>Update Image</label>
                </div>
                @error('photo')
                    <span class=" text-danger error">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control" id="name" type="text" wire:model="name"
                                placeholder="Product Name">
                            @error('name')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" type="text" wire:model="description" rows="5"></textarea>
                            @error('description')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Category</label>
                            <select wire:model="p_category_id" type="text" class="form-control">
                                <option value="">Choose Product Category</option>
                                @foreach ($editData as $item)
                                <option value="{{$item->category_id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('p_category_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-label" for="time">Waiting Time</label>
                                <div class="input-group">
                                    <input class="form-control" id="time" type="text" wire:model="time"
                                        placeholder="15">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">mins</span>
                                    </div>
                                </div>
                                @error('time')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label class="form-label" for="price">Price</label>
                                <div class="input-group">
                                    <input class="form-control" id="price" type="text" wire:model="price"
                                        placeholder="10,000">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">MMK</span>
                                    </div>
                                </div>
                                @error('price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
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
