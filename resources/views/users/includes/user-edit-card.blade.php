<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50; height:50px; border-radius:50%;" class="me-3 avatar-sm rounded-circle"
                        src="{{ $user->getImageURL() }}"
                        alt="{{ $user->name }}">
                    <div>
                        <input name="name" value="{{ $user->name }}" type="text" class="form-control">

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                <div>
                    @auth()
                        @if (Auth::id() === $user->id)
                            <a href="{{ route('users.show', $user->id) }}">View</a>
                        @endif
                    @endauth
                </div>
            </div>
            <div class="mt-5">
                <label for="">Profile Image</label>
                <input name="image" class="form-control" type="file">
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>
                <div class="mb-3">
                    <textarea name="bio" class="form-control" id="bio" rows="3">{{ $user->bio }}</textarea>
                    @error('bio')
                        <span class="d-block mt-2 text-danger">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="btn btn-dark btn-sm mt-2">Save</button>
                </div>

               @include('users.includes.user-stats')
                @auth()
                    @if (Auth::id() !== $user->id)
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm"> Follow </button>
                        </div>
                    @endif
                @endauth
            </div>
        </form>
    </div>

</div>
